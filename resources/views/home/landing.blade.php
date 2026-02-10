@extends('home.layouts.main')

@section('title')
    Halaman Beranda
@endsection

@section('navbar')
    @include('home.layouts.navbar')
@endsection

@section('container')
    {{-- Heroo --}}
    <section id="beranda" class="pt-20">
      <div class="flex flex-col-reverse min-[990px]:flex-row items-center justify-between gap-x-20">
        <div class="flex-1 mt-15 min-[990px]:mt-0">
          <p class="px-5 inline-block text-[12px] min-[750px]:text-[13px] min-[1040px]:text-[14px] py-2 bg-violet-800/30 text-violet-600 font-semibold rounded-full">Ayo Tingkatkan Literasi</p>
          <h1 class="dark:text-gray-50 text-gray-950 text-[30px] min-[475px]:text-[35px] min-[670px]:text-[30px] min-[750px]:text-[35px] min-[1120px]:text-[43px] min-[1250px]:text-[50px] min-[1270px]:text-[55px] 2xl:text-7xl font-semibold leading-15 min-[1120px]:leading-20 2xl:leading-24 min-[1120px]:mt-2 mb-3 flex items-start min-[670px]:items-center min-[990px]:items-start flex-col min-[670px]:flex-row min-[990px]:flex-col">
            Jelajahi Dunia Membaca Tanpa Batas
          </h1>
        
          <p class="text-base font-normal text-gray-700 dark:text-gray-300">Temukan berbagai koleksi buku, ajukan peminjaman dengan mudah, dan nikmati pengalaman membaca yang nyaman di TheBooks.</p>
          <div class="flex flex-col gap-y-5 min-[510px]:gap-y-0 min-[510px]:flex-row gap-x-8 items-center mt-8 text-gray-800 dark:text-gray-200">
            <a href="{{ route('buku.home') }}" class="linkhoveranimation text-sm filled"><i class='bx bxs-book-alt'></i> Mulai Membacaa</a>
            <a href="#buku_populer" class="linkhoveranimation text-sm">Buku Populer <i class='bx bxs-book-heart'></i></a>
          </div>
          <div class="grid grid-cols-2 min-[560px]:grid-cols-4 mt-10 min-[1040px]:mt-15 gap-x-20 gap-y-10 min-[560px]:gap-y-0">
              <div class="statistikhero">
                  <h1>{{$user}}+</h1>
                  <p>Pengguna Aktif</p>
              </div>
              <div class="statistikhero">
                <h1>{{ $buku }}+</h1>
                <p>Total Buku</p>
              </div>
              <div class="statistikhero">
                <h1>{{ $kategori}}+</h1>
                <p>Kategori Buku</p>
              </div>
              <div class="statistikhero">
                <h1>{{ $transaksi }}+</h1>
                <p>Transaksi</p>
              </div>
            </div>
        </div>
        <div class="w-75 min-[480px]:w-87.5 min-[540px]:w-100 min-[590px]:w-112.5 min-[990px]:w-[320px] min-[1040px]:w-87.5 min-[1090px]:w-100 min-[1170px]:w-105 2xl:w-150 relative font-fredoka">
          <div class="absolute top-1/2 -left-10 size-30 bg-blue-500/20 z-1"></div>
          <div class="absolute top-1/3 -right-10 size-30 bg-blue-500/10 z-1"></div>
          <div class="icontextanimationhero right-[40%] top-14">
            <div class="icon"><i class="bx bx-book-open"></i></div>
            <div class="text">Membaca</div>
          </div>

          <div class="icontextanimationhero left-[20%] top-[40%]">
            <div class="icon"><i class="bx bx-search-alt-2"></i></div>
            <div class="text">Eksplorasi</div>
          </div>

          <div class="icontextanimationhero right-[40%] min-[1040px]:right-[30%] bottom-[30%]">
            <div class="icon"><i class="bx bx-library"></i></div>
            <div class="text">Peminjaman</div>
          </div>
          <img src="{{ asset('images/header.png') }}" class="w-full relative z-5" alt="Hero Section Image" />
        </div>
      </div>
      <div class="md:my-0 my-10 relative">
        <div class="pointer-events-none absolute left-0 top-0 h-full w-5 bg-linear-to-r from-gray-50 via-gray-50/80 to-transparent z-10"></div>
        <div class="pointer-events-none absolute right-0 top-0 h-full w-5 bg-linear-to-l from-gray-50 via-gray-50/80 to-transparent z-10"></div>
      </div>
    </section>

    {{-- Buku --}}
    <section id="buku_populer" class="pt-20">
      <div class="flex flex-col lg:flex-row justify-between gap-3">
        <h4 class="font-semibold text-4xl w-fit text-gray-900 dark:text-gray-100 md:titlePage">Jelajahi Koleksi Buku</h4>
        <a class="rounded-sm bg-violet-600 px-5 py-2 w-fit text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2" href='{{ route("buku.home") }}'>Terus Jelajahi <i class='bx bx-right-arrow-alt'></i></a>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 mt-8">
        @foreach ($bukuPopuler as $item)

          <a href="{{route('buku_detail', $item->id_buku)}}" class="group block w-full rounded-md backdrop-blur bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
      
              <!-- Cover -->
              <div class="relative overflow-hidden rounded-t-md aspect-4/5 p-4">
                  <img
                      src="{{ asset('storage/image/sampul/' . $item->sampul) }}"
                      alt="Cover Buku"
                      class="h-full w-full object-cover rounded-md border border-gray-200 dark:border-gray-800"
                  />
              </div>
      
              <!-- Content -->
              <div class="px-4 pb-4">
                <!-- Status Badge -->
                  <span class="rounded-full {{$item->stok <= 0 ? 'bg-red-500/90' : 'bg-emerald-500/90'}} px-3 py-1 text-xs font-medium text-white shadow">
                    {{$item->stok <= 0 ? 'Habis' : 'Tersedia'}}
                  </span>

                  <h3 class="mt-1 text-base font-semibold text-gray-900 dark:text-gray-100 leading-snug line-clamp-2">
                      {{$item->judul_buku}}
                  </h3>
      
                  <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                      {{$item->penulis}}
                  </p>
      
                  <!-- Footer -->
                  <div class="mt-4 flex items-center justify-between">
                      <span class="text-xs font-medium text-gray-600 dark:text-gray-400">
                          Stok: <span class="font-semibold">{{$item->stok}}</span>
                      </span>
                  </div>
              </div>
          </a>
        @endforeach

      </div>
    </section>

    {{-- kategori --}}
    <section id="kategori_populer" class="pt-20">
      <div class="flex flex-col lg:flex-row justify-between gap-3">
        <h4 class="font-semibold text-4xl w-fit text-gray-900 dark:text-gray-100 md:titlePage">Jelajahi Kategori Buku</h4>
        <a class="rounded-sm bg-violet-600 px-5 py-2 w-fit text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2" href='{{ route("kategori.home") }}'>Terus Jelajahi <i class='bx bx-right-arrow-alt'></i></a>
      </div>

      <div class="mt-10 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse ($kategoriPopuler as $item)
          <a href="{{ route('buku.home') }}?kategori={{ $item->id_kategori }}"
          class="group block rounded-md bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

              <div class="flex items-start justify-between gap-3">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight line-clamp-2">
                      {{ $item->nama_kategori }}
                  </h3>

                  <span class="shrink-0 rounded-full bg-violet-800/20 px-3 py-1 text-xs
                              font-medium text-violet-700 dark:text-violet-600">
                      {{ $item->buku->count() }} Buku
                  </span>
              </div>

              <div class="my-4 h-px bg-gray-200 dark:bg-gray-800"></div>

              <p class="flex items-center justify-between text-xs sm:text-sm text-gray-500 dark:text-gray-400
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