@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Riwayat Transaksi
@endsection

@section('content')
    <div class="title-container">
        <div>
            <h1 class="title">Riwayat Transaksi</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
                <li><a href="#" class="active">Riwayat</a></li>
            </ul>
        </div>
    </div>

    {{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type="'error'" :session="session('error')"/>

    {{-- filter bar --}}
	<x-filter-bar :searchPlaceholder="'Cari Riwayat Pinjam...'"/> 

    @foreach ($transaksiPerBulan as $transaksi)
        
        {{-- @foreach ($bulan['items'] as $transaksi) --}}
            <div class="relative bg-white dark:bg-gray-800/50 rounded-lg py-5 pl-5 pr-8 md:h-45 lg:h-60 mb-5 flex flex-col md:flex-row justify-start md:items-center shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 gap-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <!-- tombol hapus -->
                {{-- <form action="#" method="post" class="absolute top-0 right-0 bg-violet-600 p-2.5 rounded-tl-lg rounded-br-lg">
                    <button type="submit" class="hapus_koleksi">
                        <i class="bx bxs-trash text-lg md:text-xl text-gray-50"></i>
                    </button>
                </form> --}}

                <!-- sampul buku -->
                <img src="{{ asset('storage/image/sampul/' . $transaksi->buku->sampul) }}" 
                    class="w-20 sm:w-24 md:w-28 lg:w-32 rounded" 
                    alt="Sampul Buku">

                <!-- info buku -->
                <div class="flex flex-col bottom-5 left-5 text-gray-950 dark:text-gray-50 w-full">

                    <h4 class="text-base md:text-lg font-semibold">
                        {{ $transaksi->buku->judul_buku }}
                    </h4>

                    <div class="flex flex-wrap items-center gap-2 mt-1">
                        <span class="inline-block text-xs font-medium bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 px-2 py-1 rounded">
                            {{ $transaksi->buku->kode_buku }}
                        </span>

                        <span class="inline-block text-sm font-medium text-violet-600">
                            {{ $transaksi->buku->kategori->nama_kategori }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 text-xs md:text-base mt-3">
                        <div class="w-full h-20 p-4 bg-gray-100 dark:bg-gray-800 rounded h-fit">
                            <p class="text-gray-600 dark:text-gray-400">Tanggal Pinjam</p>
                            <p class="text-gray-950 dark:text-gray-50">{{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d F Y') }}</p>
                        </div>
                        <div class="w-full h-20 p-4 bg-gray-100 dark:bg-gray-800 rounded h-fit">
                            <p class="text-gray-600 dark:text-gray-400">Tanggal Kembali</p>
                            <p class="text-gray-950 dark:text-gray-50">{{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d F Y') }}</p>
                        </div>
                        <div class="w-full h-20 p-4 bg-gray-100 dark:bg-gray-800 rounded h-fit">
                            <p class="text-gray-600 dark:text-gray-400">Status</p>
                            <p class="text-gray-950 dark:text-gray-50">{{ $transaksi->status_label }}</p>
                        </div>
                        <div class="w-full h-20 p-4 bg-gray-100 dark:bg-gray-800 rounded h-fit">
                            <p class="text-gray-600 dark:text-gray-400">Jumlah</p>
                            <p class="text-gray-950 dark:text-gray-50">{{ $transaksi->total_pinjam }} Buku</p>
                        </div>
                    </div>

                </div>
            </div>
        {{-- @endforeach --}}

    @endforeach

@endsection