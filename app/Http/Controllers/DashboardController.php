<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Buku;
use App\Models\Buku_Favorit;
use App\Models\Kategori;
use App\Models\PembayaranDenda;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    protected $imageHelper;
    protected $profilPath = 'image/profil/';
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    public function index()
    {
        $tahun = Carbon::now()->year;
        $dataMentah = DB::table('transaksi')
            ->selectRaw('MONTH(created_at) as bulan,status,tanggal_kembali,COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan', 'status', 'tanggal_kembali')
            ->get();
        $bulanTransaksi = [
            'Ditunda' => array_fill(0, 12, 0),
            'Dipinjam' => array_fill(0, 12, 0),
            'Telat' => array_fill(0, 12, 0),
            'Kembali' => array_fill(0, 12, 0),
            'Ditolak' => array_fill(0, 12, 0),
        ];
        $hariIni = Carbon::today();
        foreach ($dataMentah as $data) {
            $index = $data->bulan - 1;

            if ($data->status == 1 && Carbon::parse($data->tanggal_kembali)->lt($hariIni)) {
                $bulanTransaksi['Telat'][$index] += $data->total;
                continue;
            }

            match ($data->status) {
                0 => $bulanTransaksi['Ditunda'][$index] += $data->total,
                1 => $bulanTransaksi['Dipinjam'][$index] += $data->total,
                2 => $bulanTransaksi['Kembali'][$index] += $data->total,
                3 => $bulanTransaksi['Ditolak'][$index] += $data->total,
                default => null
            };
        }

        // untuk admin
        $buku = Buku::all();
        $kategori = Kategori::all();
        $transaksi = Transaksi::all();
        $user = User::where('role_id', 2);

        $BukuHabis = Buku::where('stok', '<=', 1)->get();
        $UserTerlambat = Transaksi::whereHas('user', function ($q) {
            $q->where('status_akun', 'aktif');
        })
            ->where('status', 1) // misal transaksi aktif
            ->where('tanggal_kembali', '<', now())
            ->get();


        $bukuFavorit = Buku_Favorit::where('user_id', auth()->user()->id_user)->get();
        $riwayatTransaksi = Transaksi::where('user_id', auth()->user()->id_user)->get();
        $dipinjam = Transaksi::where('user_id', auth()->user()->id_user)->where('status', 1)->count();
        $denda = Transaksi::where('user_id', auth()->user()->id_user)->sum('total_pinjam');

        // untuk user
        $bukuUser = Buku_Favorit::where('user_id', auth()->user()->id_user)->get();
        $TransaksiUser = Transaksi::where('user_id', auth()->user()->id_user)->get();
        // terus digabung
        $aktivitas = $TransaksiUser
            ->map(fn($t) => [
                'type' => 'transaksi',
                'aksi' => $t->status,
                'buku' => $t->buku->judul_buku,
                'waktu' => $t->created_at
            ])
            ->merge(
                $bukuUser->map(fn($f) => [
                    'type' => 'favorit',
                    'aksi' => 'tambah',
                    'buku' => $f->buku->judul_buku,
                    'waktu' => $f->created_at
                ])
            )
            ->sortByDesc('waktu');


        return view('dashboard.index', [
            // card
            'buku' => $buku,
            'kategori' => $kategori,
            'user' => $user,
            'transaksi' => $transaksi,

            // chart
            'bulanTransaksi' => $bulanTransaksi,

            // lain lain
            'bukuHabis' => $BukuHabis,
            'userTerlambat' => $UserTerlambat,

            // user
            'bukuFavorit' => $bukuFavorit,
            'riwayatTransaksi' => $riwayatTransaksi,
            'dipinjam' => $dipinjam,
            'denda' => $denda,
            'aktivitas' => $aktivitas,
        ]);
    }

    public function edit_profil()
    {
        $user = User::findOrFail(auth()->user()->id_user);

        return view('dashboard.edit_profil', [
            'user' => $user
        ]);
    }

    public function edit_profil_post(Request $request)
    {

        $id = auth()->user()->id_user;
        $validate = $request->validate([
            'nama' => 'required|min:2',
            'username' => "required|min:3|unique:user,username,$id,id_user",
            'profil' => 'nullable|image|mimes:jpg,png,jpeg|max:3072', // Max 3MB
            'hapus_profil' => 'required|in:true,false'
        ]);

        try {
            $user = User::findOrFail($id);
            $profil = $user->profil;
            if ($validate['hapus_profil'] == "true") {
                if ($profil != null) {
                    $imageLama = $this->profilPath . $profil;
                    $this->imageHelper->deleteImage($imageLama);
                }

                $profil = null;
            }

            if ($request->hasFile('profil')) {
                $file = $request->file('profil');

                if ($profil != null) {
                    $profil = $this->imageHelper->uploadImage($file, $this->profilPath, $profil);
                } else {
                    $profil = $this->imageHelper->uploadImage($file, $this->profilPath);
                }
            }

            $validate['profil'] = $profil;

            $user->update($validate);
            return redirect()->route('edit_profil')->with('success', 'Berhasil Mengedit Profil');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Mengedit Profil.');
        }
    }

    public function edit_password(Request $request)
    {
        $validate = $request->validate([
            'password_lama' => 'required',
            'password' => [
                'required',
                'min:5', // minimal 8 karakter
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/'
            ],
        ], [
            'password.regex' => 'Password harus mengandung huruf, angka, dan minimal satu karakter spesial (#, @, !, dll).',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        try {
            $id = auth()->user()->id_user;
            $user = User::findOrFail($id);

            if (!Hash::check($validate['password_lama'], $user->password)) {
                return redirect()->route('edit_profil')->withErrors(['password_lama' => 'Password Lama Tidak Sesuai'])->withInput();
            }

            $password = Hash::make($validate['password']);
            $user->update(['password' => $password]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Berhasil Mengedit Password');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Mengedit Password.');
        }
    }

    public function transaksi_pinjam(Request $request)
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (Transaksi::where('user_id', auth()->user()->id_user)->where('status', 1)->exists()) {
            return redirect()->back()->with('error', 'Maaf, Anda Masih Memiliki Buku Yang Belum Dikembalikan');
        }

        $buku = Buku::where('id_buku', $request->buku_id)->firstOrFail();

        $validate = $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'total_pinjam' => 'required|integer|min:1|max:3'
        ]);

        // total pinjam tidak bileh lebih dari stok
        if ($request->total_pinjam > $buku->stok) {
            return back()->withErrors(['total_pinjam' => 'Jumlah pinjam tidak boleh lebih dari stok buku yang tersedia.'])->withInput();
        }

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);

        if ($tanggalKembali->gt($tanggalPinjam->copy()->addYear())) {
            return back()->withErrors(['tanggal_kembali' => 'Tanggal kembali tidak boleh lebih dari satu tahun dari tanggal pinjam.'])->withInput();
        }

        try {
            $validate['user_id'] = auth()->user()->id_user;
            $validate['buku_id'] = $buku->id_buku;
            $validate['status'] = 0;

            Transaksi::create($validate);
            return redirect()->back()->with('success', 'Transaksi Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Transaksi.');
        }
    }

    public function riwayat(Request $request)
    {
        $query = Transaksi::query()
            ->join('buku', 'transaksi.buku_id', '=', 'buku.id_buku')
            ->where('transaksi.user_id', auth()->user()->id_user)
            ->select('transaksi.*')
            ->with('buku');

        // search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('id_transaksi', 'like', "%{$search}%")

                    ->orWhereHas('buku', function ($b) use ($search) {
                        $b->where('judul_buku', 'like', "%{$search}%")
                            ->orWhere('kode_buku', 'like', "%{$search}%");
                    })

                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('nama', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                    });
            });
        }

        match ($request->order) {
            'asc' => $query
                ->orderByRaw("CASE WHEN status = 1 THEN 0 ELSE 1 END")
                ->orderBy('buku.judul_buku', 'asc'),

            'desc' => $query
                ->orderByRaw("CASE WHEN status = 1 THEN 0 ELSE 1 END")
                ->orderBy('buku.judul_buku', 'desc'),

            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),

            default => $query
                ->orderByRaw("CASE WHEN status = 1 THEN 0 ELSE 1 END")
                ->orderBy('created_at', 'desc'),
        };


        // reset
        if ($request->filled('reset')) {
            return redirect()->route('riwayat');
        }

        $transaksi = $query->get();
        return view('dashboard.riwayat', [
            'transaksi' => $transaksi
        ]);
    }

    public function pengajuan(Request $request)
    {
        $query = Transaksi::query()->where('pengajuan_kembali', '!=', 'null');

        // search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('id_transaksi', 'like', "%{$request->search}%")
                    ->orWhereHas('buku', function ($q2) use ($request) {
                        $q2->where('judul_buku', 'like', "%{$request->search}%")
                            ->orWhere('kode_buku', 'like', "%{$request->search}%");
                    })
                    ->orWhereHas('user', function ($q3) use ($request) {
                        $q3->where('nama', 'like', "%{$request->search}%")
                            ->orWhere('username', 'like', "%{$request->search}%");
                    });
            });
        }

        // reset
        if ($request->filled('reset')) {
            return redirect()->route('transaksi.index');
        }

        // filter waktu
        match ($request->order) {
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'asc'),
        };

        $data = $query->get();

        return view('dashboard.pengajuan', [
            'transaksi' => $data
        ]);
    }

    public function pengajuan_kembali(Request $request, $id)
    {
        try {

            $transaksi = Transaksi::findOrFail($id);
            $pengajuan_kembali = $request->pengajuan_kembali;

            $pengajuan['pengajuan_kembali'] = $pengajuan_kembali;

            $transaksi->update($pengajuan);

            return redirect()->back()->with('success', 'Pengajuan Berhasil Dikirim');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pengajuan Gagal Dikirim');
        }
    }

    public function membatalkan_pengajuan(Request $request, $id)
    {
        try {

            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update([
                'pengajuan_kembali' => null
            ]);

            return redirect()->back()->with('success', 'Pembatalan Berhasil Dilakukan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pembatalan Gagal Dilakukan');
        }
    }

    public function terima_pengajuan(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            $buku = Buku::findOrFail($transaksi->buku_id);

            $jumlahDikembalikan = $transaksi->pengajuan_kembali;

            if (!$jumlahDikembalikan || $jumlahDikembalikan < 1) {
                return redirect()->back()->with('error', 'Jumlah pengajuan kembali tidak valid');
            }

            $buku->stok += $jumlahDikembalikan;
            $buku->save();

            $transaksi->jumlah_dikembalikan += $jumlahDikembalikan;
            $transaksi->pengajuan_kembali = null;
            $transaksi->save();

            $pesan = "Berhasil menerima pengembalian {$jumlahDikembalikan} buku";

            return redirect()->back()->with('success', $pesan);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menerima pengajuan kembali');
        }
    }

    public function favorit(Request $request)
    {
        $bukuFavorit = Buku_Favorit::with('buku')
            ->join('buku', 'buku_favorit.buku_id', '=', 'buku.id_buku')
            ->where('user_id', auth()->user()->id_user);

        if ($request->filled('search')) {
            $bukuFavorit->whereHas('buku', function ($q) use ($request) {
                $q->where('judul_buku', 'like', "%$request->search%");
            });
        }
        if ($request->filled('reset')) {
            return redirect()->route('favorit');
        }

        match ($request->order) {
            'asc' => $bukuFavorit->orderBy('buku.judul_buku', 'asc'),
            'desc' => $bukuFavorit->orderBy('buku.judul_buku', 'desc'),
            'newest' => $bukuFavorit->orderBy('buku_favorit.created_at', 'desc'),
            'oldest' => $bukuFavorit->orderBy('buku_favorit.created_at', 'asc'),
            default => $bukuFavorit->orderBy('buku_favorit.created_at', 'desc'),
        };

        $data = $bukuFavorit->get();

        return view('dashboard.favorit', [
            'bukuFavorit' => $data
        ]);
    }

    public function favorit_toggle(Request $request, string $id_buku)
    {
        $userId = auth()->user()->id_user;

        $favorit = Buku_Favorit::where('user_id', $userId)
            ->where('buku_id', $id_buku)
            ->first();

        if ($favorit) {
            $favorit->delete();
        } else {
            Buku_Favorit::create([
                'user_id' => $userId,
                'buku_id' => $id_buku
            ]);
        }

        return redirect()->back();
    }

    public function favorit_delete(string $id_buku)
    {
        try {
            $favorit = Buku_Favorit::findOrFail($id_buku);
            $favorit->delete();
            return redirect()->route('favorit')->with('success', 'Buku Favorit Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menghapus Buku Favorit.');
        }
    }

    public function denda(Request $request)
    {
        $query = PembayaranDenda::query();

        // search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('id_transaksi', 'like', "%{$request->search}%")
                    ->orWhereHas('buku', function ($q2) use ($request) {
                        $q2->where('judul_buku', 'like', "%{$request->search}%")
                            ->orWhere('kode_buku', 'like', "%{$request->search}%");
                    })
                    ->orWhereHas('user', function ($q3) use ($request) {
                        $q3->where('nama', 'like', "%{$request->search}%")
                            ->orWhere('username', 'like', "%{$request->search}%");
                    });
            });
        }

        // reset
        if ($request->filled('reset')) {
            return redirect()->route('transaksi.index');
        }

        // filter waktu
        match ($request->order) {
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'asc'),
        };


        $denda = (clone $query)->where('user_id', auth()->user()->id_user)->get();
        $semuaDenda = (clone $query)->get();

        return view('dashboard.denda', [
            'denda' => $denda,
            'semuaDenda' => $semuaDenda,
        ]);
    }

    // public function bayar(Request $request, $id)
    // {
    //     $request->validate([
    //         'pembayaran' => 'required|numeric|min:1'
    //     ]);

    //     $transaksi = Transaksi::findOrFail($id);

    //     if ($transaksi->denda <= 0) {
    //         return back()->with('error', 'Tidak ada denda yang harus dibayar');
    //     }

    //     if ($request->pembayaran > $transaksi->denda) {
    //         return back()->with('error', 'Pembayaran melebihi total denda');
    //     }

    //     $sisaDenda = $transaksi->denda - $request->pembayaran;

    //     $transaksi->update([
    //         'denda' => $sisaDenda,
    //         'status_denda' => $sisaDenda == 0 ? 'lunas' : 'belum_bayar'
    //     ]);

    //     return Redirect()->back()->with('success', 'Pembayaran denda berhasil');
    // }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'pembayaran' => 'required|numeric|min:1'
        ]);

        $denda = PembayaranDenda::findOrFail($id);

        $totalDibayar = $denda->total_dibayar ?? 0;
        $sisaDenda = $denda->total_denda - $totalDibayar;

        // kalau sudah lunas
        if ($sisaDenda <= 0) {
            return back()->with('error', 'Denda sudah lunas');
        }

        // kalau bayar lebih dari sisa
        if ($request->pembayaran > $sisaDenda) {
            return back()->with('error', 'Pembayaran melebihi sisa denda');
        }

        // hitung total dibayar baru
        $totalDibayarBaru = $denda->total_dibayar + $request->pembayaran;

        // tentukan status
        if ($totalDibayarBaru >= $denda->total_denda) {
            $status = 'lunas';
        } elseif ($totalDibayarBaru > 0) {
            $status = 'sebagian';
        } else {
            $status = 'belum_bayar';
        }

        $denda->update([
            'total_dibayar' => $totalDibayarBaru,
            'metode_bayar' => 'cash',
            'status_denda' => $status
        ]);

        return back()->with('success', 'Pembayaran denda berhasil');
    }
}
