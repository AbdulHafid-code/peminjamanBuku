@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Koleksi Buku
@endsection

@section('content')
    <div class="title-container">
        <div>
            <h1 class="title">Koleksi Buku</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
                <li><a href="#" class="active">Koleksi</a></li>
            </ul>
        </div>
    </div>

    {{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

    {{-- filter bar --}}
	<x-filter-bar :searchPlaceholder="'Cari Nama Buku Favorit...'"/> 

    <div class="grid grid-cols-1 lg:grid-cols-2 mt-5 gap-5 w-full">
        @foreach($bukuFavorit as $item)
            <a href="{{ route('buku_detail', $item->id_buku) }}" class="relative bg-white dark:bg-gray-800/50 rounded-lg py-5 pl-5 pr-8 md:h-45 lg:h-60 flex justify-start items-center shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 gap-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <form action="{{ route('favorit_delete', $item->id_favorit) }}" method="post" class="absolute top-0 right-0 bg-violet-600 p-2.5 rounded-tl-lg rounded-br-lg">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="hapus_koleksi" id="btn-delete" data-pesan="Anda Yakin Ingin Menghapus Koleksi Ini ?"><i class="bx bxs-trash text-lg md:text-xl text-gray-50 "></i></button>
                </form>
                <img src="{{ asset('storage/image/sampul/' . $item->buku->sampul) }}" class="w-20 sm:w-24 md:w-28 lg:w-32 rounded" alt="">
                <div class="flex flex-col bottom-5 left-5 text-gray-950 dark:text-gray-50">
                    <h4 class="text-base md:text-lg font-semibold">{{ $item->buku->judul_buku }}</h4>
                    <div class=" flex-wrap items-center gap-2 mt-1">
                        <span class="inline-block text-xs font-medium bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 px-2 py-1 rounded">
                            {{ $item->buku->kode_buku }}
                        </span>
                        <span class="inline-block text-sm font-medium text-violet-600">
                            {{ $item->buku->kategori->nama_kategori }}
                        </span>
                    </div>

                    <div class="mt-3 text-sm hidden xl:block">
                        <p class="text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Penulis:</span> 
                            {{ $item->buku->penulis }}
                        </p>

                        <p class="text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Terbit:</span> 
                            {{ \Carbon\Carbon::parse($item->buku->tanggal_terbit)->translatedFormat('Y') }}
                        </p>

                        <p class="text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Penerbit:</span> 
                            {{ $item->buku->penerbit }}
                        </p>
                    </div>

                </div>
            </a>
        @endforeach

    </div>

@endsection
