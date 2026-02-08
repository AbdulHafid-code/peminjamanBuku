@extends('home.layouts.main')

@section('title')
    Halaman Kategori
@endsection

@section('container')

    <section id="materi" class="pt-24">
        {{-- header --}}
        <div class="flex flex-col items-center text-center px-4">
            <h1 class="text-2xl min-[420px]:text-3xl md:text-4xl
                    font-fredoka font-semibold text-gray-900">
                Cari Kategori Buku Favoritmu
            </h1>

            <p class="mt-2 max-w-xl text-[12px] min-[420px]:text-sm md:text-[15px]
                    text-gray-600">
                Pilih kategori buku yang kamu minati, ajukan peminjaman dengan mudah,
                dan nikmati pengalaman membaca yang nyaman.
            </p>

            {{-- search --}}
            <form method="GET" class="mt-6 w-2/3">
                <div class="flex items-center gap-2 rounded-full bg-white/80 backdrop-blur
                            px-4 py-2 shadow-md
                            transition focus-within:ring-2 focus-within:ring-violet-400">

                    <i class='bx bx-search-alt-2 text-gray-400 text-lg'></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari Kategori Berdasarkan Nama..."
                        class="w-full bg-transparent text-sm md:text-base
                            outline-none text-gray-800 placeholder-gray-400"
                    >

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-full bg-violet-600 text-white text-sm
                            font-medium hover:bg-violet-700 transition">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- card kategoori --}}
        <div class="mt-10 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($kategori as $item)
                <a href="{{ route('buku.home') }}?kategori={{ $item->id_kategori }}"
                class="group block rounded-xl border border-gray-200
                        bg-white/80 backdrop-blur p-5
                        transition-all duration-300
                        hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-lg font-semibold text-gray-800 leading-tight line-clamp-2">
                            {{ $item->nama_kategori }}
                        </h3>

                        <span class="shrink-0 rounded-full bg-violet-100 px-3 py-1 text-xs
                                    font-medium text-violet-700">
                            {{ $item->buku->count() }} Buku
                        </span>
                    </div>

                    <div class="my-4 h-px bg-gray-100"></div>

                    <p class="flex items-center justify-between text-xs sm:text-sm text-gray-500
                            group-hover:text-violet-600 transition">
                        Lihat buku <i class='bx bx-right-arrow-alt text-2xl'></i>
                    </p>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-500 text-sm">
                    Kategori tidak ditemukan
                </div>
            @endforelse
        </div>
    </section>

@endsection
