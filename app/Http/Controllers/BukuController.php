<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{

    protected $imageHelper;
    protected $sampulPath = 'image/sampul/';
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }
    

    public function index(Request $request)
    {
        $query = Buku::query();

        // Reset filters
        if ($request->filled('reset')) {
            return redirect()->route('buku.index');
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // filter search
        if ($request->filled('search')) {
            $query->where('judul_buku', 'like', "%{$request->search}%")
                ->orWhere('kode_buku', 'like', "%{$request->search}%");
        }
        
        // filter waktu
        match($request->order){
            'asc' => $query->orderBy('judul_buku', 'asc'),
            'desc' => $query->orderBy('judul_buku', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('judul_buku', 'asc'),
        };

        $data = $query->get();

        return view('dashboard.buku.index', [
            'books' => $data,
            'kategori' => Kategori::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.buku.create', [
            'kategori' => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validateImg = $request->validate([
            'judul_buku'     => 'required|min:3|max:255',
            'kode_buku'      => 'required|min:3|unique:buku,kode_buku',
            'penulis'        => 'required|min:3',
            'penerbit'       => 'required|min:3',
            'tanggal_terbit' => 'required|date',
            'stok'           => 'required|integer|min:0',
            'kategori_id'    => 'required|exists:kategori,id_kategori',
            'sampul'         => 'required|image|mimes:jpg,jpeg,png,webp|max:3048',
            'deskripsi'      => 'required|min:3',
        ]);

        // $file = $request->file('sampul');
        // $judul = Str::slug($request->judul_buku, '_'); // spasi -> _
        // $fileName = date('Y-m-d_His') . '_' . $judul . '.' . $file->extension();
        // $path = $file->storeAs('', $fileName, 'public');
        // $validateImg['sampul'] = $path;

        try {
            $file = $request->file('sampul');
            if ($request->hasFile('sampul')) {
                $file = $request->file('sampul');
                $file = $this->imageHelper->uploadImage($file, $this->sampulPath);
            }
            $validateImg['sampul'] = $file;

            Buku::create($validateImg);
            return redirect()->route('buku.index')->with('success', 'Buku berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Buku.');
        }
    }

    public function show(string $id)
    {
        return view('dashboard.buku.detail', [
            'buku' => Buku::findOrFail($id)
        ]);
    }

    public function edit(string $id)
    {
        $data = Buku::findOrFail($id);
        return view('dashboard.buku.edit', [
            'buku' => $data,
            'kategori' => Kategori::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validateImg = $request->validate([
            'judul_buku'     => 'required|min:3|max:255',
            'kode_buku'      => "required|min:3|unique:buku,kode_buku,$id,id_buku",
            'penulis'        => 'required|min:3',
            'penerbit'       => 'required|min:3',
            'tanggal_terbit' => 'required|date',
            'stok'           => 'required|integer|min:0',
            'kategori_id'    => 'required|exists:kategori,id_kategori',
            'sampul'         => 'sometimes|required|image|mimes:jpg,jpeg,png,webp|max:3048',
            'deskripsi'      => 'required|min:3',
        ]);

        // if ($request->hasFile('sampul')) {

        //     // hapus gambar lama jika ada
        //     $buku = Buku::findOrFail($id);
        //     if ($buku->sampul && Storage::disk('public')->exists($buku->sampul)) {
        //         Storage::disk('public')->delete($buku->sampul);
        //     }

        //     $file = $request->file('sampul');
        //     $judul = Str::slug($request->judul_buku, '_'); // spasi -> _
        //     $fileName = date('Y-m-d_His') . '_' . $judul . '.' . $file->extension();
        //     $path = $file->storeAs('', $fileName, 'public');
        //     $validateImg['sampul'] = $path;
        // }


        try {
            $buku = Buku::findOrFail($id);
            $sampul = $buku->sampul;

            if ($request->hasFile('sampul')) {
                $file = $request->file('sampul');

                if ($sampul != null) {
                    $sampul = $this->imageHelper->uploadImage($file, $this->sampulPath, $sampul);
                } else {
                    $sampul = $this->imageHelper->uploadImage($file, $this->sampulPath);
                }
            }
            $validateImg['sampul'] = $sampul;

            $buku->update($validateImg);
            return redirect()->route('buku.index')->with('success', 'Buku Berhasil Diedit');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi Kesalahan Saat Mengedit Data Buku.');
        }
    }

    public function destroy(string $id)
    {
        try {

            $buku = Buku::findOrFail($id);
            // if ($buku->sampul && Storage::disk('public')->exists($buku->sampul)) {
            //     Storage::disk('public')->delete($buku->sampul);
            // }
             if ($buku->sampul != null) {
                $imageLama = $this->sampulPath . $buku->sampul;
                $this->imageHelper->deleteImage($imageLama);
            }

            $buku->delete();
            return redirect()->route('buku.index')->with('success', 'Buku Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menghapus Data Buku.');
        }
    }
}
