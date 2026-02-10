@extends('dashboard.layouts.main')

@section('title')
	Dashboard | Detail Buku
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Detail Buku</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('buku.index') }}">Buku</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Detail</a></li>
			</ul>
		</div>
	</div>

    <div class="flex flex-col gap-6 w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
        <span class="font-medium text-lg text-gray-600 dark:text-gray-400">Informasi Detail Buku :</span>

        <div class="flex flex-col sm:flex-row gap-6 sm:gap-8">
            <div class="w-60 h-78 rounded overflow-hidden shadow">
                <img src="{{asset('storage/image/sampul/' . $buku->sampul)}}" alt="" class="h-full w-full object-cover">
            </div>

            <div class="flex-1 flex flex-col gap-5 justify-center">
                <div class="block">
                    <h2 class="font-bold text-3xl mb-2 text-gray-950 dark:text-gray-50">{{$buku->judul_buku}} </h2>
                    <div class="flex gap-2">
                        <span class="text-base font-semibold bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 px-2 py-0.5 rounded">{{$buku->kode_buku}}</span>
                        <span class="text-lg font-semibold text-violet-600 px-2 rounded ">{{$buku->kategori->nama_kategori}}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="grid md:grid-cols-2 gap-y-3 font-medium text-sm">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Penulis</p>
                            <p class="text-gray-950 dark:text-gray-50">{{$buku->penulis}}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Penerbit</p>
                            <p class="text-gray-950 dark:text-gray-50">{{$buku->penerbit}}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Terbit</p>
                            <p class="text-gray-950 dark:text-gray-50">{{$buku->tanggal_terbit}}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Stok</p>
                            <p class="text-gray-950 dark:text-gray-50">{{$buku->stok}}</p>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-sm text-gray-600 dark:text-gray-400">Deskripsi</p>
                        <div class="bg-gray-200 dark:bg-gray-700 p-3 rounded-lg text-justify">
                            <p class="font-normal text-gray-600 dark:text-gray-400">{{$buku->deskripsi}}</p>
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-3">
                        <x-button-edit :href="route('buku.edit', $buku->id_buku)"></x-button-edit>
                        <x-button-delete :action="route('buku.destroy', $buku->id_buku)"></x-button-delete>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection