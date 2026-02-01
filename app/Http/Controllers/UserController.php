<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Buku_Favorit;
use App\Models\Transaksi;

class UserController extends Controller
{

    protected $imageHelper;
    protected $profilPath = 'image/profil/';
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    
    public function index(Request $request)
    {
        $query = User::query();

        // filter reset
        if ($request->filled('reset')) {
            return redirect()->route('user.index');
        }

        // filter role
        if ($request->filled('role')) {
            $query->where('role_id', $request->role);
        }

        // filter search
        if ($request->filled('search')) {
            $query->where('nama', 'like', "%{$request->search}%")
                ->orWhere('username', 'like', "%{$request->search}%");
        }

        // filter waktu
        match ($request->order) {
            'asc' => $query->orderBy('nama', 'asc'),
            'desc' => $query->orderBy('nama', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('nama', 'asc'),
        };

        $data = $query->get();

        return view('dashboard.user.index', [
            'users' => $data,
            'role' => Role::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.user.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $validateUser = $request->validate([
            'nama' => 'required|min:2',
            'username' => 'required|min:3|unique:user,username',
            'password' => 'required|min:5|confirmed',
            'role_id' => 'required|exists:role,id_role',
            'profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',

        ]);

        try {
            $file = $request->file('profil');
            if ($request->hasFile('profil')) {
                $file = $request->file('profil');
                $file = $this->imageHelper->uploadImage($file, $this->profilPath);
            }

            $validateUser['profil'] = $file;
            $validateUser['password'] = Hash::make($validateUser['password']);

            User::create($validateUser);
            return redirect()->route('user.index')->with('success', 'Pengguna Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menyimpan Data Pengguna.');
        }
    }

    public function show(string $id)
    {
        return view('dashboard.user.detail', [
            'user' => User::findOrFail($id),
            'bukuFavorit' => Buku_Favorit::where('user_id', $id)->get(),
            'transaksi' => Transaksi::where('user_id', $id)->get(),
        ]);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.user.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validateUser = $request->validate([
            'nama' => 'required|min:2',
            'username' => "required|min:3|unique:user,username,$id,id_user",
            'role_id' => 'required|exists:role,id_role',
            'profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'inputHapus' => 'required|in:true,false'
        ]);

        try {
            $user = User::findOrFail($id);
            $profil = $user->profil;

            if ($validateUser['inputHapus'] == 'true') {
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
            $validateUser['profil'] = $profil;

            $user->update($validateUser);
            return redirect()->route('user.index')->with('success', 'Pengguna Berhasil Diedit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Mengedit Data Pengguna.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $deleteData = User::findOrFail($id);

            if ($deleteData->profil != null) {
                $imageLama = $this->profilPath . $deleteData->profil;
                $this->imageHelper->deleteImage($imageLama);
            }

            $deleteData->delete();
            return redirect()->route('user.index')->with('success', 'Pengguna Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan Saat Menghapus Data Pengguna.');
        }
    }
}
