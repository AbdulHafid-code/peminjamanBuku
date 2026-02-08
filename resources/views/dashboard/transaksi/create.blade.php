@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Tambah Transaksi
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Buat Transaksi Peminjaman Buku Baru</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Tambah</a></li>
			</ul>
		</div>
	</div>

    {{-- error alert --}}
	<x-alert-success-error type='error' :session="session('error')"/>


    <form method="POST" action="{{ route('transaksi.store')}}" class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6 space-y-4 text-gray-600 dark:text-gray-400">
        @csrf

        {{-- input buku --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Pilih Buku</label>
            <select id="bukuSelect" name="buku_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500">
                @foreach ($buku as $item)
                    <option value="{{ $item->id_buku }}" data-stok="{{ $item->stok }}" {{ old('buku_id') == $item->id_buku ? 'selected' : '' }}>
                        {{ $item->kode_buku }} - {{ $item->judul_buku }} - {{ $item->stok }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-input-error name="buku_id" />

        {{-- input user --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Pilih User</label>
            <select name="user_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500">
                @foreach ($user as $item)
                    <option value="{{ $item->id_user }}"  {{ old('user_id') == $item->id_user ? 'selected' : '' }}>
                        {{ $item->nama }} - {{ $item->username }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-input-error name="user_id" />
        
        {{-- input tanggal_pinjam --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Tanggal Pinjam</label>
            <input type="date" value="{{old('tanggal_pinjam')}}" name="tanggal_pinjam" placeholder="Masukkan Tanggal Pinjam" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="tanggal_pinjam" />

        {{-- input tanggal_kembali --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Tanggal Kembali</label>
            <input type="date" value="{{old('tanggal_kembali')}}" name="tanggal_kembali" placeholder="Masukkan Tanggal Kembali..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="tanggal_kembali" />

        <!-- Input total -->
        <div class="space-y-1">
            <label class="text-sm font-medium">Jumlah Buku</label>
            <input
                type="number"
                id="jumlahInput"
                name="total_pinjam"
                value="{{ old('total_pinjam') }}"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"
                placeholder="Masukkan jumlah buku"
            />

        </div>
        <x-input-error name="total_pinjam" />

        {{-- input status --}}
        <div class="space-y-1">
            <label class="text-sm font-medium">Status</label>
            <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500">
                <option value="0" {{old('status') == "0" ? "selected" : ''}}>Ditunggu</option>
                <option value="1" {{old('status') == "1" ? "selected" : ''}}>Disetujui</option>
                <option value="2" {{old('status') == "2" ? "selected" : ''}}>Dikembalikan</option>
                <option value="3" {{old('status') == "3" ? "selected" : ''}}>Ditolak</option>
            </select>
        </div>
        <x-input-error name="status" />

        <!-- Button (Left) -->
        <div class="flex justify-end items-center">
            <x-button-create :store="true"></x-button-create>
        </div>

    </form>

@endsection