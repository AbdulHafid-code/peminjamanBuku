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

    // public function login(Request $request)
    // {
    //     try {
    //         $validate = $request->validate([
    //             'username_login' => 'required',
    //             'password_login' => 'required'
    //         ]);

    //         $credentials = [
    //             'username' => $validate['username_login'],
    //             'password' => $validate['password_login']
    //         ];

    //         if (!Auth::attempt($credentials)) {
    //             return redirect()->back()->with('error', 'Login Gagal, Periksa kembali username dan password anda!');
    //         }

    //         $request->session()->regenerate();

    //         return redirect()->route('dashboard');
    //     } catch (\Throwable $e) {
    //         return redirect()->back()->with('error', 'Gagal Melakukan Login');
    //     }
    // }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'username_login' => 'required',
            'password_login' => 'required'
        ]);

        $credentials = [
            'username' => $validate['username_login'],
            'password' => $validate['password_login']
        ];

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->with('error', 'Username / Password Salah');
        }

        if ($user->status_akun === 'pending' || $user->status_akun === 'nonaktif') {
            return back()->with('error', 'Akun Belum Aktif');
        }

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Login gagal, periksa kembali data anda');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
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

    // public function register(Request $request)
    // {

    //     $request->session()->flash('halaman_register', true);

    //     $validate = $request->validate([
    //         'nama' => 'required|min:3',
    //         'username' => 'required|min:3|unique:user,username',
    //         'password' => [
    //             'required',
    //             'min:5', // minimal 8 karakter
    //             'confirmed',
    //             'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/'
    //         ],
    //     ], [
    //         'password.regex' => 'Password harus mengandung huruf, angka, dan minimal satu karakter spesial (#, @, !, dll).',
    //         'password.min' => 'Password minimal 5 karakter.',
    //     ]);

    //     try {

    //         $validate['password'] = Hash::make($validate['password']);
    //         $validate['role_id'] = 2;
    //         $validate['status_akun'] = 'pending';

    //         User::create($validate);

    //         Auth::attempt($request->only('username', 'password'));

    //         return redirect()->route('home');
    //     } catch (\Throwable $e) {
    //         return redirect()->back()->with('error', 'Gagal Melakukan Register')->with('halaman_register', true);
    //     }
    // }

    public function register(Request $request)
    {
        $request->session()->flash('halaman_register', true);

        $validate = $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3|unique:user,username',
            'password' => [
                'required',
                'min:5',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/'
            ],
        ], [
            'password.regex' => 'Password harus mengandung huruf, angka, dan minimal satu karakter spesial (#, @, !, dll).',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        try {

            $validate['password'] = Hash::make($validate['password']);
            $validate['role_id'] = 2;
            $validate['status_akun'] = 'pending';

            User::create($validate);

            $request->session()->forget('halaman_register');

            return redirect()->route('login')->with('success', 'Akun Anda Sedang Di Aktivasi');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal Melakukan Register')->with('halaman_register', true);
        }
    }
}
