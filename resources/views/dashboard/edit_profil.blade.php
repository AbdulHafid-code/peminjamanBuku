@extends('dashboard.layouts.main')

@section('title') 
  Dashboard | Edit Profil 
@endsection

@section('content')
  <div class="title-container">
        <div>
            <h1 class="title">Edit Profil</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
                <li><a href="#" class="active">Edit Profil</a></li>
            </ul>
        </div>
    </div>

	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

    <div class="flex flex-col md:flex-row gap-5">
        <div class="relative flex w-full md:w-96 flex-col items-center gap-6 h-fit rounded-lg p-6 bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20">
            <!-- Avatar -->
            <div class="relative z-10">
                <div class="flex h-60 w-60 items-center justify-center rounded-full shadow-lg">
                    <img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}"
                        class="h-full w-full rounded-full object-cover bg-white"
                        alt="Profil">
                </div>
            </div>

            <!-- User Info -->
            <div class="relative z-10 flex flex-col items-center gap-2 text-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                    {{auth()->user()->nama}}
                </h2>

                <span class="inline-flex items-center gap-1 rounded-full bg-violet-600/10 px-4 py-1 text-sm font-medium text-violet-600">
                    <i class='bx bx-user'></i>
                    {{auth()->user()->username}}
                </span>
            </div>
        </div>

        <div class="space-y-5 w-full">
            {{-- profil --}}
            <div class="flex flex-col gap-5 rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-6">
                <h2 class="text-gray-600 dark:text-gray-400 font-medium text-2xl">Informasi Pribadi :</h2>
                <form action="{{ route('edit_profil.post') }}" method="POST" class="grid md:grid-cols-2 gap-6 font-medium text-sm" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="hapus_profil" value="false">

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-600 dark:text-gray-400">Nama</label>
                        <input type="text" name="nama" value="{{ $user->nama }}" placeholder="Masukkan Nama Baru" class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md outline-none border border-transparent focus:border-violet-500 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700 transition mb-2">
                        <x-input-error name="nama" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-600 dark:text-gray-400">Username</label>
                        <input type="text" name="username" value="{{ $user->username }}" placeholder="Masukkan Username Baru" class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md outline-none border border-transparent focus:border-violet-500 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700 transition mb-2">
                        <x-input-error name="username" />
                    </div>

                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Hak Akses</p>
                        <p class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md">{{ $user->role->role }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Dibuat</p>
                        <p class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md">
                            {{ $user->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-600 dark:text-gray-400">Foto Profile</label>
                        <div id="avatarWrapper" data-isrequired="false" class="size-12 group rounded-full overflow-hidden relative cursor-pointer">

                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center
                                        opacity-0 group-hover:opacity-100 transition z-100">
                                <i id="avatarIcon" class="bx bxs-pencil text-white text-xl"></i>
                            </div>

                            <input type="file" id="avatarInput" name="profil" accept="image/*" class="hidden">

                            <img id="avatarPreview"
                                data-defaultsrc="https://ui-avatars.com/api/?name={{preg_replace('/\s+/', '', $user->nama)}}&background=random&length=2"
                                src="{{ $user->profil
                                                ? asset('storage/image/profil/' . $user->profil)
                                                : 'https://ui-avatars.com/api/?name=' . urlencode(preg_replace('/\s+/', '', $user->nama)) . '&background=random&length=2'
                                            }}"
                                class="size-full rounded-full object-cover">
                        </div>
                    </div>

                    <div></div>
                    <div></div>

                    <div class="flex justify-end">
                        <x-button-edit :update="true"></x-button-edit>
                    </div>
                </form>
            </div>

            {{-- password --}}
            <div class="flex flex-col gap-5 rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-6">
                <h2 class="text-gray-600 dark:text-gray-400 font-medium text-2xl">Password :</h2>
                <form action="{{ route('edit_password') }}" method="POST" class="grid md:grid-cols-2 gap-6 font-medium text-sm">
                    @method('PUT')
                    @csrf

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-600 dark:text-gray-400">Password Lama</label>
                        <input type="password" name="password_lama" placeholder="Masukkan Password Lama" class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md outline-none border border-transparent focus:border-violet-500 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700 transition mb-2">
                        <x-input-error name="password_lama" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-600 dark:text-gray-400">Password Baru</label>
                        <input type="password" name="password" placeholder="Masukkan Password Baru" class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md outline-none border border-transparent focus:border-violet-500 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700 transition mb-2">
                        <x-input-error name="password" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-600 dark:text-gray-400">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Masukkan Password Baru" class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-50 px-3 py-2 rounded-md outline-none border border-transparent focus:border-violet-500 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700 transition mb-2">
                        <x-input-error name="password_confirmation" />
                    </div>

                    <div></div>
                    <div></div>
                    <div class="flex justify-end">
                        <x-button-edit :update="true"></x-button-edit>
                    </div>
                </form>
            </div>

        </div>
    </div>


    @vite(['resources/js/image_previewer.js', 'resources/js/edit_profil.js'])
@endsection

















{{-- <div class="flex flex-col min-[1000px]:flex-row justify-center my-5 gap-5 h-fit min-352:h-88">
    <div class="bg-gray-50 shadow w-full min-[1000px]:w-[40%] min-w-[300px] flex flex-col items-center p-5 rounded-lg">
        <div id="avatarWrapper" data-isrequired="false" class="size-30 group rounded-full overflow-hidden relative cursor-pointer">

            <div class="absolute inset-0 bg-black/40 flex items-center justify-center
                        opacity-0 group-hover:opacity-100 transition z-100">
                <i id="avatarIcon" class="bx bxs-pencil text-white text-xl"></i>
            </div>

            <input type="file" id="avatarInput" name="profil" accept="image/*" class="hidden">

            <img id="avatarPreview" 
                        data-defaultsrc="https://ui-avatars.com/api/?name={{preg_replace('/\s+/', '', $user->nama)}}&background=random&length=2"                    
                        src="{{ $user->profil
                            ? asset('storage/image/profil/' . $user->profil)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(preg_replace('/\s+/', '', $user->nama)) . '&background=random&length=2'
                        }}"
                class="size-full rounded-full object-cover">
        </div>
        <h1 class="font-bold text-[18px] mt-5">{{$user->nama}}</h1>
        <h3 class="text-md text-gray-400">{{$user->username}}</h3>
    </div>
    <div class="flex-1">
        <div class="w-full shadow flex relative overflow-hidden justify-around p-2 bg-gray-50 rounded-full">
        <button id="informasiPribadiBtn" class="font-semibold tracking-wider text-sm cursor-pointer w-1/2">Informasi Pribadi</button>
        <button id="editPasswordBtn" class="font-semibold tracking-wider text-sm cursor-pointer w-1/2">Edit Password</button>
        <div id="indicator" class="absolute bottom-0 left-0 w-1/2 h-[3px] bg-blue-600 rounded-full transition-all duration-700 {{session()->has('password_edit') ? 'translate-x-full' : 'translate-x-0'}}"></div>
        </div>

        <form action="{{ route('edit_profil.post') }}" id="informasiForm" class="w-full shadow rounded-lg bg-gray-50 flex flex-col mt-5 p-5 gap-y-3 {{session()->has('password_edit') ? 'hidden' : ''}}" method="POST">
            @method('PUT')
            @csrf
        <!-- Input Text -->
        <div class="-mt-1">
            <label class="text-sm font-medium text-gray-700">Nama</label>
            <input type="text" value="{{old('nama', $user->nama)}}" name="nama" placeholder="Masukkan nama..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
            @error('nama')
                <p class="text-red-500 my-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Username</label>
            <input type="text" value="{{old('username', $user->username)}}" name="username" placeholder="Masukkan username" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('username')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bxs-pencil' ></i> Edit Profil
            </button>
        </div>
        </form>

        <form action="{{ route('edit_password') }}" id="passwordForm" class="w-full shadow rounded-lg bg-gray-50 flex flex-col mt-5 p-5 gap-y-3 {{session()->has('password_edit') ? '' : 'hidden'}}" method="POST">
            @method('PUT')
            @csrf
        <!-- Input Text -->
        <div class="-mt-1">
            <label class="text-sm font-medium text-gray-700">Password Lama</label>
            <input type="password" name="password_lama" placeholder="Masukkan password lama..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('password_lama')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Password Baru</label>
            <input type="password" name="password" placeholder="Masukkan password baru..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('password')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Masukkan konfirmasi password..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('password_confirmation')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror
        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-key' ></i> Edit Password
            </button>
        </div>
        </form>

    </div>
</div> --}}

{{-- <h2 class="text-gray-600 font-medium text-2xl">Informasi Lainnya :</h2>

<div class="grid grid-cols-2 gap-y-3">
    <div>
        <p class="font-medium text-sm text-gray-600"><i class='bx bx-book-heart'></i> Buku Favorit</p>
        <p class="font-semibold">12</p>
    </div>
    <div>
        <p class="font-medium text-sm text-gray-600"><i class='bx bx-transfer-alt'></i> Riwayat Transaksi</p>
        <p class="font-semibold">34</p>
    </div>
    <div>
        <p class="font-medium text-sm text-gray-600"><i class='bx bx-book-heart'></i> Buku Favorit</p>
        <p class="font-semibold">12</p>
    </div>
    <div>
        <p class="font-medium text-sm text-gray-600"><i class='bx bx-transfer-alt'></i> Riwayat Transaksi</p>
        <p class="font-semibold">34</p>
    </div>
</div> --}}