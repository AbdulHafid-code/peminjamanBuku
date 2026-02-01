@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | User Create
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Edit Data Pengguna</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('user.index') }}">Pengguna</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Edit</a></li>
			</ul>
		</div>
	</div>

    	<x-alert-success-error type="'error'" :session="session('error')"/>


    <form method="POST" action="{{ route('user.update', $user->id_user)}}" class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6 space-y-4 text-gray-600 dark:text-gray-400" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium">Nama User</label>
            <input type="text" value="{{old('nama', $user->nama)}}" name="nama" placeholder="Masukkan Nama User" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        @error('nama')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        {{-- input username --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Username</label>
            <input type="text" value="{{old('username', $user->username)}}" name="username" placeholder="Masukkan Username" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        @error('username')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        {{-- input role --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Hak Akses</label>
            <select name="role_id" class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500">
                @foreach ($roles as $role)
                    <option value="{{ $role->id_role }}" {{old('role_id', $user->role_id) == $role->id_role ? 'selected' : ''}}>
                        {{ $role->role }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-input-error name="role_id" />

        {{-- input profil --}}
        <label class="text-sm font-medium mt-5">Pilih Foto Profile</label>
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
        <x-input-error name="profil" />
         <x-input-error name="inputHapus" />

        <!-- Button (Left) -->
        <div class="flex justify-end items-center">
            <x-button-edit :update="true"></x-button-edit>
        </div>

    </form>

    @vite('resources/js/image_previewer.js')
    
@endsection