@extends('home.layouts.main')

@section('title')
    Detail {{ $buku->judul_buku }}
@endsection

@section('container')

<section class="pt-30">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- sampuk --}}
        <div class="flex justify-center">
            <img
                src="{{ asset('storage/image/sampul/' . $buku->sampul) }}"
                alt="Cover Buku"
                class="w-64 h-[380px] object-cover rounded-xl shadow-lg"
            />
        </div>

        {{-- info --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">

            {{-- judul buku --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                    {{ $buku->judul_buku }}
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kode Buku:
                    <span class="font-medium text-gray-700">
                        {{ $buku->kode_buku }}
                    </span>
                </p>
            </div>

            {{-- detail info --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                <p class="text-gray-600">
                    <span class="font-medium text-gray-800">Kategori:</span>
                    {{ $buku->kategori->nama_kategori }}
                </p>

                <p class="text-gray-600">
                    <span class="font-medium text-gray-800">Penulis:</span>
                    {{ $buku->penulis }}
                </p>

                <p class="text-gray-600">
                    <span class="font-medium text-gray-800">Penerbit:</span>
                    {{ $buku->penerbit }}
                </p>

                <p class="text-gray-600 flex items-center gap-2">
                    <span class="font-medium text-gray-800">Stok:</span>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $buku->stok > 0
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">
                        {{ $buku->stok > 0 ? 'Tersedia (' . $buku->stok . ')' : 'Habis' }}
                    </span>
                </p>
            </div>

            {{-- favorit --}}
            <div class="flex items-center gap-3">
                @if (auth()->check() && auth()->user()->status_akun === 'aktif')
                    <form action="{{ route('favorit_toggle', $buku->id_buku) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium transition
                            {{ $isFavorit
                                ? 'bg-red-500 hover:bg-red-600 text-white'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
                            
                            <i class="bx {{ $isFavorit ? 'bxs-heart' : 'bx-heart' }} text-lg"></i>
                            {{ $isFavorit ? 'Hapus Favorit' : 'Tambah Favorit' }}
                        </button>
                    </form>
                @else
                    <div>
                        <button
                            disabled
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium
                                bg-gray-200 text-gray-500 cursor-not-allowed">

                            <i class="bx bx-lock text-lg"></i>
                            Tambah Favorit
                        </button>

                        <p class="text-xs text-gray-500 mt-1">
                            Login & akun aktif untuk menambah favorit
                        </p>
                    </div>
                @endif
            </div>

            {{-- difider --}}
            <div class="border-t border-gray-200"></div>

            {{-- deskripsi buku --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">
                    Deskripsi Buku
                </h2>

                <p class="text-gray-600 leading-relaxed text-justify">
                    {{ $buku->deskripsi }}
                </p>
            </div>

        </div>
    </div>

    {{-- content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

        {{-- left --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold mb-6">Form Peminjaman</h2>
                {{-- alert --}}
                <x-alert-success-error :session="session('success')"/>
                <x-alert-success-error type='error' :session="session('error')"/>

                <form action="{{ route('transaksi_pinjam') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->id_buku }}">

                    {{-- tanggal pinjam --}}
                    <div class="space-y-1">
                        <label class="text-sm font-medium">Tanggal Pinjam</label>
                        <input
                            type="date"
                            name="tanggal_pinjam"
                            value="{{ old('tanggal_pinjam') }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"
                        />
                    </div>
                    <x-input-error name="tanggal_pinjam" />

                    {{-- tanggal kembali --}}
                    <div class="space-y-1">
                        <label class="text-sm font-medium">Tanggal Kembali</label>
                        <input
                            type="date"
                            name="tanggal_kembali"
                            value="{{ old('tanggal_kembali') }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"
                        />
                    </div>
                    <x-input-error name="tanggal_kembali" />

                    {{-- total buku --}}
                    <div class="space-y-1">
                        <label class="text-sm font-medium">Total Buku</label>
                        <input
                            type="number"
                            name="total_pinjam"
                            value="{{ old('total_pinjam') }}"
                            placeholder="Masukkan jumlah buku"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                                focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"
                        />
                    </div>
                    <x-input-error name="total_pinjam" />

                    {{-- button --}}
                    <button
                        type="submit"
                        class="mt-3 w-full py-3 rounded-lg bg-violet-600 text-white font-semibold
                            hover:bg-violet-700 transition">
                        Pinjam Buku
                    </button>
                </form>
            </div>
        </div>

        {{-- peminjam --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Peminjam Buku</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                    @forelse($transaksi as $item)
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                            <img
                                src="{{ $item->user->profil
                                    ? asset('storage/image/profil/' . $item->user->profil)
                                    : 'https://ui-avatars.com/api/?name='.preg_replace('/\s+/', '', $item->user->nama) }}"
                                class="w-10 h-10 rounded-full object-cover"
                            />

                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ mb_strimwidth($item->user->nama, 0, 18, '...') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $item->tanggal_pinjam->format('d M Y') }}
                                    →
                                    {{ $item->tanggal_kembali->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center">
                            Belum ada peminjam
                        </p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</section>

<section class="pt-20">
    <div class="flex justify-between">
    <h4 class="font-semibold text-4xl titlePage">Koleksi Buku Lainnya</h4>
    {{-- <a class="rounded-sm bg-violet-600 px-5 py-2 text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2" href='{{ route("buku.home") }}'>Terus Jelajahi <i class='bx bx-right-arrow-alt'></i></a> --}}
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 mt-8">
    @foreach ($bukuLainnya as $item)

        <a href="{{route('buku_detail', $item->id_buku)}}" class="group block w-full rounded-md bg-white/80 backdrop-blur shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
    
            <!-- Cover -->
            <div class="relative overflow-hidden rounded-t-md aspect-4/5 p-4">
                <img
                    src="{{ asset('storage/image/sampul/' . $item->sampul) }}"
                    alt="Cover Buku"
                    class="h-full w-full object-cover rounded-md border border-gray-200"
                />
            </div>
    
            <!-- Content -->
            <div class="p-4">
            <!-- Status Badge -->
                <span class="rounded-full {{$item->stok <= 0 ? 'bg-red-500/90' : 'bg-emerald-500/90'}} px-3 py-1 text-xs font-medium text-white shadow">
                {{$item->stok <= 0 ? 'Habis' : 'Tersedia'}}
                </span>

                <h3 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2">
                    {{$item->judul_buku}}
                </h3>
    
                <p class="mt-1 text-xs text-gray-500">
                    {{$item->penulis}}
                </p>
    
                <!-- Footer -->
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-xs font-medium text-gray-600">
                        Stok: <span class="text-gray-900 font-semibold">{{$item->stok}}</span>
                    </span>
                </div>
            </div>
        </a>
    @endforeach

    </div>
</section>

@endsection
