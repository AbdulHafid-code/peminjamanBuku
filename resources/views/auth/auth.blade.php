<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Fonts & Icons --}}
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/auth.css', 'resources/js/auth.js'])

    <title>TheBooks | Auth</title>

</head>

<body class="flex justify-center items-center min-h-screen bg-gray-200 font-Outfit">

    <div class="container {{ session()->has('halaman_register') ? 'active' : ''}} relative w-[850px] h-[550px] bg-gray-50 rounded-[30px] shadow-[0_0_30px_rgba(0,0,0,.2)] overflow-hidden m-5">
        {{-- login --}}
        <div class="form-box login absolute right-0 w-1/2 h-full bg-gray-50 flex items-center justify-center text-center p-10 z-1">
            <form action="{{ route('login.post') }}" method="POST" class="w-full space-y-6">
                @csrf

                <h1 class="text-4xl font-bold text-gray-800 text-center mb-2">Login</h1>

                {{-- alert --}}
                <x-alert-success-error type='success' :session="session('success')"/>
                <x-alert-success-error type='error' :session="session('error')"/>

                {{-- usename --}}
                <div class="space-y-1">
                    <div class="relative">
                        <input type="text" name="username_login" value="{{ old('username_login') }}" placeholder="Masukkan username"
                            class="w-full px-4 py-3 pr-11 rounded-lg bg-gray-100 text-gray-800 text-sm outline-none transition focus:ring-2 focus:ring-violet-400" >
                        <i class="bx bxs-user absolute right-4 top-1/2 -translate-y-1/2 text-lg text-gray-400"></i>
                    </div>
                    @error('username_login')
                        <p class="text-sm text-red-500"> {{ $message }} </p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="space-y-1">
                    <div class="relative input-box">
                        <input type="password" name="password_login" placeholder="Masukkan password"
                            class="show-password-input w-full px-4 py-3 pr-11 rounded-lg bg-gray-100 text-gray-800 text-sm outline-none transition focus:ring-2 focus:ring-violet-400">
                        <i class="bx bxs-show show-password-btn absolute right-4 top-1/2 -translate-y-1/2 text-lg text-gray-400 cursor-pointer"></i>
                    </div>

                    @error('password_login')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="w-full h-12 rounded-lg bg-violet-500 text-white font-semibold
                        hover:bg-violet-600 active:scale-[0.98]
                        transition-all duration-200 shadow-md shadow-violet-500/30"
                >
                    Login
                </button>
            </form>
        </div>

        {{-- register --}}
        <div class="form-box register absolute right-0 w-1/2 h-full bg-gray-50 flex items-center justify-center text-center p-10 z-1">
            <form  action="{{ route('register.post') }}" method="POST" class="w-full space-y-6">
                @csrf
                <h1 class="text-4xl font-bold mb-2">Daftar</h1>

                <div class="space-y-1">
                    <div class="relative">
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama"
                            class="w-full px-4 py-3 pr-11 rounded-lg bg-gray-100 text-gray-800 text-sm outline-none transition focus:ring-2 focus:ring-violet-400" >
                        <i class="bx bxs-user absolute right-4 top-1/2 -translate-y-1/2 text-lg text-gray-400"></i>
                    </div>
                    @error('nama')
                        <p class="text-sm text-red-500"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <div class="relative">
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan Username"
                            class="w-full px-4 py-3 pr-11 rounded-lg bg-gray-100 text-gray-800 text-sm outline-none transition focus:ring-2 focus:ring-violet-400" >
                        <i class="bx bxs-user absolute right-4 top-1/2 -translate-y-1/2 text-lg text-gray-400"></i>
                    </div>
                    @error('username')
                        <p class="text-sm text-red-500"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <div class="relative input-box">
                        <input type="password" name="password" placeholder="Masukkan password"
                            class="show-password-input w-full px-4 py-3 pr-11 rounded-lg bg-gray-100 text-gray-800 text-sm outline-none transition focus:ring-2 focus:ring-violet-400">
                        <i class="bx bxs-show show-password-btn absolute right-4 top-1/2 -translate-y-1/2 text-lg text-gray-400 cursor-pointer"></i>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1">
                    <div class="relative input-box">
                        <input type="password" name="password_confirmation" placeholder="Masukkan password"
                            class="show-password-input w-full px-4 py-3 pr-11 rounded-lg bg-gray-100 text-gray-800 text-sm outline-none transition focus:ring-2 focus:ring-violet-400">
                        <i class="bx bxs-show show-password-btn absolute right-4 top-1/2 -translate-y-1/2 text-lg text-gray-400 cursor-pointer"></i>
                    </div>
                    @error('password_confirmation')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button class="w-full h-10 bg-violet-400 rounded-lg text-white font-semibold">
                    Daftar
                </button>
            </form>
        </div>

        {{-- btn pindah form --}}
        <div class="toggle-box absolute w-full h-full">
            <div class="toggle-panel toggle-left text-white">
                <h1 class="text-3xl font-bold">Selamat Datang</h1>
                <p class="my-4">Belum punya akun?</p>
                <button class="register-move-btn w-40 h-11 border-2 border-white rounded-lg">Daftar</button>
            </div>

            <div class="toggle-panel toggle-right text-white">
                <h1 class="text-3xl font-bold">Kembali</h1>
                <p class="my-4">Sudah punya akun?</p>
                <button class="login-move-btn w-40 h-11 border-2 border-white rounded-lg">Masuk</button>
            </div>
        </div>

    </div>

</body>
</html>
