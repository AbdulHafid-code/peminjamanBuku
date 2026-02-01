@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Detail Kategori
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Detail Kategori</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('kategori.index') }}">Kategori</a></li>
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
            <span class="font-semibold text-3xl text-gray-950 dark:text-gray-50"> {{$kategori->nama_kategori}}</span>
        </div>

        <div class="space-y-3">
            <div class="flex flec gap-2">
                <span class="font-medium text-gray-600 dark:text-gray-400">Buku Terkait</span>
                <span class="hidden sm:block text-gray-600 dark:text-gray-400">:</span>
            </div>
            <div class="grid grid-cols-[repeat(auto-fill,minmax(160px,1fr))] gap-4 mt-2 w-full">
                @forelse ($kategori->buku as $item)
                    <a href="{{ route('buku.show', $item->id_buku) }}" class="group bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-700/50 transition cursor-pointer flex items-center rounded-lg shadow justify-center p-3 flex-col w-full gap-3">
                        <img src="{{ asset('storage/image/sampul/' . $item->sampul) }}" class="w-full h-56 hidden min-[550px]:block rounded-sm object-cover"/>
                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 font-semibold group-hover:text-violet-600 group-hover:underline transition">{{ mb_strimwidth($item->judul_buku, 0, 20, '...') }}</span>
                    </a>
                @empty
                    <p class="font-semibold text-gray-700 dark:text-gray-300">Buku Terkait Tidak Ada</p>
                @endforelse
            </div>
        </div>
        
        <div class="flex justify-end items-center gap-3">
            <x-button-edit :href="route('kategori.edit', $kategori->id_kategori)">
            </x-button-edit>
            
            <x-button-delete :action="route('kategori.destroy', $kategori->id_kategori)">
            </x-button-delete>
        </div>
    </div>

@endsection