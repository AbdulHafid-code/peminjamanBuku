<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $query = Role::query();

        if ($request->filled('search')) {
            $query->where('role', 'like', '%' . $request->search . '%');
        }

        if($request->filled('reset')){
            return redirect()->route('role.index');
        }

        match ($request->order) {
            'asc' => $query->orderBy('role', 'asc'),
            'desc' => $query->orderBy('role', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('role', 'asc'),
        };

        $data = $query->get();
        return view('dashboard.role.index', [
            'roles' => $data
        ]);
    }

    public function create()
    {
        return view('dashboard.role.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'role' => 'required|min:3|unique:role,role',
        ]);

        try {
            $createdRole = Role::create($validate);
            return redirect()->route('role.index')->with('success', 'Hak Akses Berhasil Ditambah');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Hak Akses');
        }
    }

    public function show(string $id)
    {
        return view('dashboard.role.detail', [
            'role' => Role::findOrFail($id),
        ]);
    }

    public function edit(string $id)
    {
        return view('dashboard.role.edit', [
            'role' => Role::findOrFail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'role' => 'required|min:3|unique:role,role,' . $id . ',id_role',
        ]);

        try {
            Role::findOrFail($id)->update($validate);
            return redirect()->route('role.index')->with('success', 'Hak Akses Berhasil Diedit');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Mengedit Data Hak Akses');
        }
    }

    public function destroy(string $id)
    {
        try {
            Role::findOrFail($id)->delete();
            return redirect()->route('role.index')->with('success', 'Hak Akses Berhasil Dihapus');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menghapus Data Hak Akses');
        }
    }
}
