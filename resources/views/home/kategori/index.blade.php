@extends('home.layouts.main')

@section('title')
    Halaman Kategori
@endsection

@section('navbar')
    @include('home.layouts.navbar-page')
@endsection

@section('container')

    <!-- MATERI SECTION -->
    <section id="materi" class="pt-30">
      <div class="flex items-center flex-col">
            <h1 class="text-2xl min-[420px]:text-3xl min-[570px]:text-3xl md:text-4xl font-fredoka font-semibold text-center">
                Cari Kategori Buku Favoritmu
            </h1>
            <p class="text-[12px] min-[420px]:text-[13px] min-[570px]:text-sm md:text-[15px] text-center mt-2">
                Pilih kategori buku yang kamu minati, ajukan peminjaman dengan mudah, dan nikmati pengalaman membaca yang nyaman.
            </p>


            <form class="searchingtext kategoripage">
                <div>
                    <i class='bx bx-search-alt-2' ></i>
                    <input type="text" value="{{Request('search')}}" name="search" placeholder="Cari Kategori Berdasarkan Nama...">
                </div>
                <button>Cari <span>Kategori</span></button>
            </form>
        </div>

      <div class="flex flex-wrap mt-10 gap-5 items-center justify-center">
        @foreach ($kategori as $item)
          <a href="{{ route('buku.home') }}?kategori_id={{ $item->id_kategori }}" class="group block rounded-xl max-w-96.25 border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:shadow-lg">

              <!-- Header -->
              <div class="flex items-start justify-between gap-3">
                  <h3 class="text-lg font-semibold text-gray-800 leading-tight line-clamp-2">
                      {{ $item->nama_kategori   }}
                  </h3>

                  <!-- Badge total buku -->
                  <span class="shrink-0 rounded-full bg-blue-100 px-3 py-1 text-xs
                              font-medium text-blue-700">
                      {{ $item->buku->count() }} Buku
                  </span>
              </div>

              <!-- Divider -->
              <div class="my-4 h-px bg-gray-100"></div>

              <!-- Footer info -->
              <p class="text-xs min-[430px]:text-sm text-gray-500 group-hover:text-gray-700 transition">
                  Lihat buku →
              </p>
          </a>

        @endforeach
      </div>
    </section>

@endsection