@extends('dashboard.layouts.main')

@section('title')
	Dashboard | Detail Hak Akses
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Detail Hak Akses</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('role.index') }}">Hak Akses</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Detail</a></li>
			</ul>
		</div>
	</div>

    <div class="space-y-6 text-base w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
        <div>
            <div class="flex gap-2">
                <span class="font-medium text-gray-600 dark:text-gray-400">Nama</span>
                <span class="hidden sm:block text-gray-600 dark:text-gray-400">:</span>
            </div>
            <span class="font-semibold text-3xl text-gray-950 dark:text-gray-50">{{$role->role}}</span>
        </div>

        <div class="flex flex-col gap-1">
            <div class="flex gap-2">
                <span class="font-medium text-gray-600 dark:text-gray-400">Hak Akses Terkait</span>
                <span class="hidden sm:block text-gray-600 dark:text-gray-400">:</span>
            </div>
            <div class="flex flex-wrap mt-2 gap-3">
                @forelse ($role->user as $item)
                    <a href="{{ route('user.show', $item->id_user) }}" class="group flex gap-1.5 items-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-700/50 transition rounded-full px-2.5 py-1 cursor-pointer">
                        <img src="{{ $item->profil ? asset('storage/image/profil/' . $item->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $item->nama) . '&background=random&length=2'}}" class="size-11 rounded-full object-cover" alt="">
                        <span class="text-xs sm:text-sm font-semibold text-gray-600 dark:text-gray-400 group-hover:text-violet-600 group-hover:underline transition">{{ mb_strimwidth($item->nama, 0, 8, '...') }}</span>
                    </a>    
                @empty
                    <p class="font-semibold">Pengguna Tidak Ada</p>
                @endforelse
            </div>
        </div>
        
        <div class="flex justify-end items-center gap-3">
            <x-button-edit :href="route('role.edit', $role->id_role)"></x-button-edit>
            <x-button-delete :action="route('role.destroy', $role->id_role)"></x-button-delete>
        </div>
    </div>
@endsection