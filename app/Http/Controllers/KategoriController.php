<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->filled('search')) {
            $query->where('nama_kategori', 'like', "%{$request->search}%");
        }

        if($request->filled('reset')){
            return redirect()->route('kategori.index');
        }

        match($request->order){
            'asc' => $query->orderBy('nama_kategori', 'asc'),
            'desc' => $query->orderBy('nama_kategori', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('nama_kategori', 'asc'),
        };

        $data = $query->get();

        return view('dashboard.kategori.index', [
            'kategori' => $data
        ]);
    }

    public function create()
    {
        return view('dashboard.kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|min:3|unique:kategori,nama_kategori',
        ]);

        try {
            $createData = Kategori::create($validatedData);
            return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Kategori.');
        }
    }

    public function show(string $id)
    {
        return view('dashboard.kategori.detail', [
            'kategori' => Kategori::findOrFail($id)
        ]);
    }

    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('dashboard.kategori.edit', [
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|min:3|unique:kategori,nama_kategori,'. $id . ',id_kategori',
        ]);

        try {
            $updateData = Kategori::findOrFail($id);
            $updateData->update($validatedData);
            return redirect()->route('kategori.index')->with('success', 'Berhasil Mengedit Data Kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan Saat Mengedit Data Kategori.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $delete = Kategori::findOrFail($id);
            $delete->delete();
            return redirect()->route('kategori.index')->with('success', 'Berhasil Menghapus Data Kategori');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menghapus Data Kategori.');
        }
    }
}
