@extends('dashboard.layouts.main')

@section('title')
	Dashboard | Tambah Buku
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Buat Data Buku Baru</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('buku.index') }}">Buku</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Tambah</a></li>
			</ul>
		</div>
	</div>

    {{-- error alert --}}
	<x-alert-success-error type='error' :session="session('error')"/>


    <form method="POST" action="{{ route('buku.store')}}" class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6 space-y-4 text-gray-600 dark:text-gray-400" enctype="multipart/form-data">
        @csrf
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium">Judul Buku</label>
            <input type="text" value="{{old('judul_buku')}}" name="judul_buku" placeholder="Masukkan Judul Buku" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="judul_buku" />

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium">Kode Buku</label>
            <input type="text" value="{{old('kode_buku')}}" name="kode_buku" placeholder="Masukkan Kode Buku" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="kode_buku" />

        {{-- input penulis --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Penulis</label>
            <input type="text" value="{{old('penulis')}}" name="penulis" placeholder="Masukkan Penulis" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="penulis" />

        {{-- input penerbit --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Penerbit</label>
            <input type="text" value="{{old('penerbit')}}" name="penerbit" placeholder="Masukkan Penerbit" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="penerbit" />

        {{-- input tanggal_terbit --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Tanggal Terbit</label>
            <input type="date" value="{{old('tanggal_terbit')}}" name="tanggal_terbit" placeholder="Masukkan Tanggal Terbit" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="tanggal_terbit" />

        {{-- input kategori --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Kategori</label>
            <select name="kategori_id" class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500">
                @foreach ($kategori as $item)
                    <option value="{{ $item->id_kategori }}" {{old('kategori_id') == $item->id_kategori ? 'selected' : ''}}>
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-input-error name="kategori_id" />
        
        {{-- input stok --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Stok</label>
            <input type="number" value="{{old('stok')}}" name="stok" placeholder="Masukkan Stok" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="stok" />
    
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium">Deskripsi Singkat</label>
            <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Buku" cols="30" rows="10" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500">{{old('deskripsi')}}</textarea>
        </div>
        <x-input-error name="deskripsi" />

        <div class="space-y-2">
            <label class="text-sm font-medium">
                Sampul Buku
            </label>
            <label
                for="sampul"
                class="relative flex flex-col items-center justify-center h-72 w-52 cursor-pointer
                    rounded-lg border-2 border-dashed border-gray-300
                     hover:bg-gray-100 dark:hover:bg-gray-900 transition">

                <img id="preview-image"
                src=""
                    class="hidden absolute inset-0 h-full w-full rounded-lg object-cover"
                    alt="Preview">

                <!-- Placeholder -->
                <div id="upload-placeholder" class="flex flex-col items-center text-gray-400">
                    <i class='bx bx-cloud-upload text-7xl'></i>
                    <span class="text-sm text-center">
                        Upload Sampul
                    </span>
                </div>

                <!-- Input File (Hidden) -->
                <input
                    id="sampul"
                    type="file"
                    name="sampul"
                    accept="image/*"
                    onchange="previewImage(event)"
                    class="hidden">
            </label>
        </div>
        <x-input-error name="sampul" />

        <!-- Button (Left) -->
        <div class="flex justify-end items-center">
            <x-button-create :store="true"></x-button-create>
        </div>

    </form>


@endsection