<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Buku_Favorit;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        $bukuPopuler = Buku::withCount([
            'transaksi as total_pinjam' => function ($query) {
                $query->where('status', 1);
            }
        ])->orderByDesc('total_pinjam')->limit(8)->get();

        $kategori = Kategori::withCount('buku')->orderByDesc('buku_count');

        $kategoriPopulerTotal = $kategori->limit(30);
        $kategoriPopuler = $kategori->limit(6)->get();

        return view('home.landing', [
            'buku' => Buku::count(),
            'kategori' => Kategori::count(),
            'transaksi' => Transaksi::count(),
            'user' => User::count(),
            'bukuPopuler' => $bukuPopuler,
            'kategoriPopuler' => $kategoriPopuler,
            'kategoriPopulerTotal' => $kategoriPopulerTotal,
        ]);
    }

    public function kategori(Request $request)
    {
        $query = Kategori::query();

        if ($request->has('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $data =  $query->get();

        return view('home.kategori.index', [
            'kategori' => $data
        ]);
    }

    public function buku(Request $request)
    {

        $query = Buku::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul_buku', 'like', "%$request->search%")
                    ->orWhere('kode_buku', 'like', "%$request->search%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $data =  $query->get();
        $kategori = Kategori::withCount('buku')->get();

        return view('home.buku.index', [
            'buku' => $data,
            'kategori' => $kategori,
        ]);
    }

    public function buku_detail(string $id)
    {
        $buku = Buku::findOrFail($id);

        $isFavorit = false;

        if (auth()->check()) {
            $isFavorit = Buku_Favorit::where('user_id', auth()->user()->id_user)
                ->where('buku_id', $buku->id_buku)
                ->exists();
        }

        return view('home.buku.detail', [
            'buku' => $buku,
            'transaksi' => Transaksi::where('buku_id', $id)
                ->where('status', 1)
                ->get(),
            'isFavorit' => $isFavorit,
            'bukuLainnya' => Buku::limit(4)->get()
        ]);
    }
}