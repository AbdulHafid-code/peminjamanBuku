<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{

    public function index(Request $request)
    {
        $query = Transaksi::query();

        // dikembalikan
        match ($request->status_filter) {
            'tunggu' => $query->where('status', 0), //
            'dipinjam' => $query->where('status', 1)->whereDate('tanggal_kembali', '>', Carbon::now()),
            'terlambat' => $query->where('status', 1)->whereDate('tanggal_kembali', '<=', Carbon::now()),
            'dikembalikan' => $query->where('status', 2), //
            'ditolak' => $query->where('status', 3), //
            default => $query->where('status', 0), //
        };

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

        return view('dashboard.transaksi.index', [
            'transaksi' => $data
        ]);
    }

    public function create()
    {
        return view('dashboard.transaksi.create', [
            'buku' => Buku::all(),
            'user' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user->status_akun == 'nonaktif') {
            return redirect()->route('transaksi.index')->with('error', 'Gagal Menambah Transaksi, Pengguna Sedang Di Non-Aktifkan');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Gagal Menambah Transaksi, Pengguna Masih Pending');
        }

        $validate = $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'user_id' => 'required|exists:user,id_user',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'total_pinjam' => 'required|integer|min:1|max:3',
            'status' => 'required|in:0,1,2,3'
        ]);

        if (Transaksi::where('user_id', $request->user_id)->where('status', 1)->exists() || Transaksi::where('user_id', $request->user_idun)->where('status', 0)->exists()) {
            return redirect()->route('transaksi.index')->with('error', 'Maaf, Anda Masih Memiliki Buku Yang Belum Dikembalikan');
        }

        $buku = Buku::where('id_buku', $request->buku_id)->firstOrFail();

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
            Transaksi::create($validate);
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Transaksi.');
        }
    }

    public function show(string $id)
    {
        return view('dashboard.transaksi.detail', [
            'transaksi' => Transaksi::findOrFail($id)
        ]);
    }

    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->status != 0) {
            abort(403, "Transaksi Ini Statusnya bukan Pending");
        }

        return view('dashboard.transaksi.edit', [
            'buku' => Buku::all(),
            'user' => User::all(),
            'transaksi' => Transaksi::findOrFail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($request->user_id);

        if ($user->status_akun == 'nonaktif') {
            return redirect()->route('transaksi.index')->with('error', 'Gagal Mengubah Transaksi, Pengguna Sedang Di Non-Aktifkan');
        }

        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->status != 0) {
            abort(403, "Transaksi Ini Statusnya bukan Pending");
        }
        $buku = Buku::where('id_buku', $request->buku_id)->firstOrFail();

        $validate = $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'user_id' => 'required|exists:user,id_user',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'total_pinjam' => 'required|integer|min:1|max:3',
            'status' => 'required|in:0,1,2,3'
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

        // if($tanggalKembali->diffInDays($tanggalPinjam) > 1){
        //     return back()->withErrors(['tanggal_kembali' => 'Tanggal Kembali Minimal 1 Hari Dari Tanggal Dipinjam'])->withInput();
        // }

        try {
            $transaksi->update($validate);
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Diedit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Mengedit Data Transaksi.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $delete = Transaksi::findOrFail($id);
            $delete->delete();
            return redirect()->route('transaksi.index')->with('success', 'Berhasil Menghapus Data Transaksi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menghapus Data Transaksi.');
        }
    }

    public function edit_status(Request $request, $id, string $status)
    {
        // dd($request->all(), $id, $status);
        $gagalTransaksi = null;

        try {
            DB::transaction(function () use ($id, $request, $status, &$gagalTransaksi, &$successMessage) {

                // Lock transaksi
                $transaksi = Transaksi::lockForUpdate()->findOrFail($id);

                // Lock buku
                $buku = Buku::lockForUpdate()->findOrFail($transaksi->buku_id);

                $statusQuery = null;

                // Kondisi Status Pending
                if ($transaksi->status == 0) {

                    // Jika tanggal kembali sudah lewat → auto tolak
                    if ($transaksi->tanggal_kembali < Carbon::today()->toDateString()) {
                        $transaksi->update(['status' => 3]);
                        $gagalTransaksi = "Transaksi otomatis diubah ke ditolak karena tanggal kembali sudah lewat";
                        return;
                    }

                    // Kondisi Ketika Disetujui Transaksi
                    if ($status === 'disetujui') {

                        if ($transaksi->user->status_akun == 'nonaktif') {
                            throw new \Exception('NONAKTIF');
                        }

                        if (Transaksi::where('user_id', $transaksi->user_id)->where('status', 1)->exists()) {
                            $transaksi->update(['status' => 3]);
                            $gagalTransaksi = "Maaf, Pengguna Ini Masih Memiliki Buku Yang Belum Dikembalikan";
                            return;
                        }

                        // Cek stok jika stok kurang maka kirim pesan error
                        if ($transaksi->total_pinjam > $buku->stok) {
                            throw new \Exception('STOK_KURANG');
                        }

                        //  Kurangi stok
                        $buku->stok -= $transaksi->total_pinjam - $transaksi->jumlah_dikembalikan;
                        $buku->save();

                        $statusQuery = 1;

                        // Kondisi Ketika Di Tolak
                    } elseif ($status === 'ditolak') {
                        $statusQuery = 3;

                        // Jika Selain Transaksi Diatas Maka Kirimkan Pesan Error Invalid Pending    
                    } else {
                        throw new \Exception('INVALID_STATUS_PENDING');
                    }

                    // Kondisi Ketika Transaksinya Sama Dengan 1 Atau Dipinjamm
                } elseif ($transaksi->status == 1) {

                    // Kondisi Ketika Dia Mau Merubah Status Dikembalikan
                    if ($status === 'dikembalikan') {

                        $jumlahDikembalikan = $request->jumlah_dikembalikan;

                        // Kembalikan stok
                        $buku->stok += $jumlahDikembalikan;
                        $buku->save();

                        $transaksi->jumlah_dikembalikan  += $jumlahDikembalikan;
                        $transaksi->save();

                        if ($transaksi->jumlah_dikembalikan == $transaksi->total_pinjam) {
                            $statusQuery = 2;
                        } else {
                            $statusQuery = 1;
                        }
                        // pesan khusus
                        $successMessage = "Berhasil mengembalikan {$jumlahDikembalikan} buku";

                        // ====================================================
                        // Denda Future

                        $tanggalKembali = Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
                        $hariIni = now()->startOfDay();

                        $hariTelat = 0;
                        $dendaTambahan = 0;

                        if ($hariIni->gt($tanggalKembali)) {

                            $hariTelat = $tanggalKembali->diffInDays($hariIni);

                            $tarif = 2000;

                            // DENDA HANYA UNTUK BUKU YANG DIKEMBALIKAN SEKARANG
                            $dendaTambahan = $hariTelat * $jumlahDikembalikan * $tarif;

                            // tambahkan ke denda sebelumnya
                            $transaksi->denda += $dendaTambahan;
                        }

                        $transaksi->hari_telat = $hariTelat;
                        $transaksi->save();

                        // =============================================


                        // Jika Statusnya Selain Diatas Maka Kirim Pesan Error
                    } elseif ($status === 'dipulihkan') {
                        $buku->stok += $transaksi->total_pinjam - $transaksi->jumlah_dikembalikan;
                        $buku->save();
                        $statusQuery = 0;
                    } else {
                        throw new \Exception('INVALID_STATUS_SETUJU');
                    }

                    // Ketika Transaksinya Status Ditolak
                } elseif ($transaksi->status == 3) {

                    // Ketika Mau Melakukan Pemulihan Tapi Tanggal Kembalinya Sudah Lewat Maka Gagalkan Perubahan Transaksi
                    if ($transaksi->tanggal_kembali <= Carbon::today()->toDateString()) {
                        throw new \Exception('EXPIRED');
                    }

                    // Kondisi Pemulihan Status Dari Tolak Ke Pending
                    if ($status === 'dipulihkan') {
                        $statusQuery = 0;

                        // Jika perubahan status selain diatas maka kembalikan pesan error
                    } else {
                        throw new \Exception('INVALID_STATUS_TOLAK');
                    }

                    // Jika Statusnya selain diatas maka berikan error status tidak diketahui
                } else {
                    throw new \Exception('UNKNOWN_STATUS');
                }

                // 🔄 Update status
                $transaksi->update(['status' => $statusQuery]);
            });

            if (!empty($gagalTransaksi)) {
                return redirect()->back()->with('error', $gagalTransaksi);
            }

            return redirect()->back()->with(
                'success',
                $successMessage ?? 'Status berhasil diperbarui menjadi ' . $status
            );
        } catch (\Exception $e) {

            return redirect()->back()->with('error', match ($e->getMessage()) {
                'INVALID_STATUS_PENDING' => 'Hanya bisa mengajukan Disetujui atau Ditolak',
                'INVALID_STATUS_SETUJU' => 'Hanya bisa mengajukan Dikembalikan',
                'INVALID_STATUS_TOLAK' => 'Hanya bisa mengajukan Dipulihkan',
                'STOK_KURANG' => 'Stok buku tidak mencukupi',
                'AUTO_TOLAK' => 'Transaksi ditolak karena tanggal kembali sudah lewat',
                'UNKNOWN_STATUS' => 'Gagal mengubah status, status tidak diketahui',
                'NONAKTIF' => 'Tidak Dapat Menyetujui, Pengguna Sedang Di Non-Aktifkan',
                default => 'Gagal Mengubah Status, Terjadi Error'
            });
        }
    }
}
