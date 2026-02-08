<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Buku;
use App\Models\Buku_Favorit;
use App\Models\Kategori;
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
        $totalBuku = Transaksi::where('user_id', auth()->user()->id_user)->sum('total_pinjam');

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
            'totalBuku' => $totalBuku,
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

    public function pengajuan()
    {

        return view('dashboard.pengajuan', [
            'transaksi' => Transaksi::whereNotNull('pengajuan_kembali')->where('pengajuan_kembali', '>', 0)->get()
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

            /* =====================
           KEMBALIKAN STOK
        ====================== */
            $buku->stok += $jumlahDikembalikan;
            $buku->save();

            /* =====================
           UPDATE JUMLAH DIKEMBALIKAN
        ====================== */
            $transaksi->jumlah_dikembalikan += $jumlahDikembalikan;

            /* =====================
           HITUNG DENDA (JIKA TELAT)
        ====================== */
            $tanggalKembali = Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
            $hariIni = now()->startOfDay();

            $hariTelat = 0;
            $dendaTambahan = 0;
            $tarif = 2000;

            if ($hariIni->gt($tanggalKembali)) {
                $hariTelat = $tanggalKembali->diffInDays($hariIni);
                $dendaTambahan = $hariTelat * $jumlahDikembalikan * $tarif;

                if ($dendaTambahan > 0) {
                    $transaksi->denda += $dendaTambahan;
                    $transaksi->hari_telat = $hariTelat;
                    $transaksi->status_denda = 'belum_bayar';
                }
            }

            /* =====================
           STATUS TRANSAKSI
        ====================== */
            if ($transaksi->jumlah_dikembalikan >= $transaksi->total_pinjam) {
                // semua buku sudah kembali
                $transaksi->status = 2; // dikembalikan
            } else {
                // masih ada yang dipinjam
                $transaksi->status = 1;
            }

            /* =====================
           RESET PENGAJUAN
        ====================== */
            $transaksi->pengajuan_kembali = null;
            $transaksi->save();

            /* =====================
           PESAN SUKSES
        ====================== */
            $pesan = "Berhasil menerima pengembalian {$jumlahDikembalikan} buku";

            if ($dendaTambahan > 0) {
                $pesan .= " dengan denda Rp " . number_format($dendaTambahan, 0, ',', '.');
            }

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

        $denda = Transaksi::where('user_id', auth()->user()->id_user)->where('denda', '>', 0)->get();
        return view('dashboard.denda', [
            'denda' => $denda,
            'semuaDenda' => Transaksi::where('denda', '>', 0)->get(),
        ]);
    }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'pembayaran' => 'required|numeric|min:1'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->denda <= 0) {
            return back()->with('error', 'Tidak ada denda yang harus dibayar');
        }

        if ($request->pembayaran > $transaksi->denda) {
            return back()->with('error', 'Pembayaran melebihi total denda');
        }

        $sisaDenda = $transaksi->denda - $request->pembayaran;

        $transaksi->update([
            'denda' => $sisaDenda,
            'status_denda' => $sisaDenda == 0 ? 'lunas' : 'belum_bayar'
        ]);

        return Redirect()->back()->with('success', 'Pembayaran denda berhasil');
    }
}
