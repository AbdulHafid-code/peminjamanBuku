<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.auth');
    }

    public function login(Request $request)
    {
        try {
            $validate = $request->validate([
                'username_login' => 'required',
                'password_login' => 'required'
            ]);

            $credentials = [
                'username' => $validate['username_login'],
                'password' => $validate['password_login']
            ];

            if (!Auth::attempt($credentials)) {
                return redirect()->back()->with('success', 'Login Gagal, Periksa kembali username dan password anda!');
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal Melakukan Login');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        } catch (\Throwable $e) {

            return redirect()->route('dashboard')->with('error', 'Gagal Melakukan Logout');
        }
    }

    public function register(Request $request)
    {

        $request->session()->flash('halaman_register', true);

        $validate = $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3|unique:user,username',
            'password' => 'required|min:5|confirmed',
        ]);

        try {

            $validate['password'] = Hash::make($validate['password']);
            $validate['role_id'] = 2;

            User::create($validate);

            Auth::attempt($request->only('username', 'password'));

            return redirect()->route('dashboard');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal Melakukan Register')->with('halaman_register', true);
        }
    }

}
