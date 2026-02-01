<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/auth.css', 'resources/js/auth.js', 'resources/css/app.css', 'resources/js/app.js'])
        <title>TheBooks | Halaman Authentikasi</title>
    </head>

    <body>

        <div class="container {{ session()->has('halaman_register') ? 'active' : ''}}">

            <div class="form-box login">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <h1>Login</h1>

                    {{-- alert --}}
                    <x-alert-success-error :session="session('success')"/>
                    <x-alert-success-error type="'error'" :session="session('error')"/>
                    
                    <div class="input-container">
                        <div class="input-box">
                            <input type="text" name="username_login" placeholder="Username...">
                            <i class='bx bxs-user'></i>
                        </div>
                        <x-input-error name="username_login" />
                    </div>

                    <div class="input-container">
                        <div class="input-box">
                            <input type="password" name="password_login" class="show-password-input" placeholder="Password...">
                            <i class='bx bxs-show show-password-btn'></i>
                        </div>
                        <x-input-error name="password_login" />
                    </div>

                    <button type="submit" class="btn">Login</button>
                </form>
            </div>

            <div class="form-box register">
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <h1>Daftar Akun</h1>

                    {{-- alert --}}
	                <x-alert-success-error type="'error'" :session="session('error')"/>
                    
                    <div class="input-container">
                        <div class="input-box">
                            <input type="text" name="nama" placeholder="Nama...">
                            <i class='bx bxs-user'></i>
                            <x-input-error name="nama" />
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-box">
                            <input type="text" name="username" placeholder="Username...">
                            <i class='bx bxs-user'></i>
                            <x-input-error name="username" />
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-box">
                            <input type="password" name="password" class="show-password-input" placeholder="Password...">
                            <i class='bx bxs-show show-password-btn'></i>
                            <x-input-error name="password" />
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-box">
                            <input type="password" name="password_confirmation" class="show-password-input" placeholder="Konfirmasi Password...">
                            <i class='bx bxs-show show-password-btn'></i>
                            <x-input-error name="password_confirmation" />
                        </div>
                    </div>

                    <button type="submit" class="btn">Daftar</button>
                </form>
            </div>

            <div class="toggle-box">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang</h1>
                    <p>Kamu tidak punya akun ?</p>
                    <button class="btn register-move-btn">Daftar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Kembali Membaca</h1>
                    <p>kamu sudah punya akun ?</p>
                    <button class="btn login-move-btn">Masuk</button>
                </div>
            </div>
        </div>

    </body>

</html>