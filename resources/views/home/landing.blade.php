@extends('home.layouts.main')

@section('title')
    Halaman Beranda
@endsection

@section('navbar')
    @include('home.layouts.navbar')
@endsection

@section('container')
    <!-- HERO SECTION -->
    <section id="beranda" class="pt-30">
      <div class="flex flex-col-reverse min-[990px]:flex-row items-center justify-between gap-x-20">
        <div class="flex-1 mt-15 min-[990px]:mt-0">
          <p class="px-5 inline-block text-[12px] min-[750px]:text-[13px] min-[1040px]:text-[14px] py-2 bg-gray-200 text-blue-600 font-semibold rounded-full">Ayo Tingkatkan Literasi</p>
          <h1 class="font-fredoka text-[30px] min-[475px]:text-[35px] min-[670px]:text-[30px] min-[750px]:text-[35px] min-[1120px]:text-[43px] min-[1250px]:text-[50px] min-[1270px]:text-[55px] 2xl:text-7xl font-semibold leading-15 min-[1120px]:leading-20 2xl:leading-24 min-[1120px]:mt-2 mb-3 flex items-start min-[670px]:items-center min-[990px]:items-start flex-col min-[670px]:flex-row min-[990px]:flex-col">
            Jelajahi Dunia Membaca Tanpa Batas
          </h1>
        
          <p class="text-sm min-[1120px]:text-[15px] min-[1270px]:text-[16px]">Temukan berbagai koleksi buku, ajukan peminjaman dengan mudah, dan nikmati pengalaman membaca yang nyaman di TheBooks.</p>
          <div class="flex flex-col gap-y-5 min-[510px]:gap-y-0 min-[510px]:flex-row gap-x-8 items-center mt-8">
            <a href="#terdekat" class="linkhoveranimation text-[13px] min-[1030px]:text-sm min-[1120px]:text-[15px] filled"><i class='bx bxs-book-alt'></i> Mulai Membacaa</a>
            <a href="#populer" class="linkhoveranimation text-[13px] min-[1030px]:text-sm min-[1120px]:text-[15px]">Buku Populer <i class='bx bxs-book-heart'></i></a>
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
        <div class="w-[300px] min-[480px]:w-[350px] min-[540px]:w-[400px] min-[590px]:w-[450px] min-[990px]:w-[320px] min-[1040px]:w-[350px] min-[1090px]:w-[400px] min-[1170px]:w-[420px] 2xl:w-[600px] relative font-fredoka">
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
        
        <div class="w-full overflow-hidden relative h-20">
          <div class="supportinglogomarqueehero">
            @for ($i = 0; $i < 15; $i++)
              @foreach($kategoriPopuler as $item)
                <a class="bg-gray-100 px-3 py-2 rounded-[8px] text-gray-400 border-[.5px] border-gray-500 text-sm hover:bg-gray-200 hover:text-blue-400 transition-all duration-500 hover:border-blue-500 hover:shadow-sm hover:shadow-blue-500 text-wrap">
                  {{ $item->nama_kategori }}
                </a>
              @endforeach
            @endfor

          </div>
        </div>
      </div>
    </section>
    
    <!-- BUKU SECTION -->
    <section id="buku_populer" class="pt-10">
      <div class="titleSectionHome">
        <div>
            <h4 class="font-latin subtitle">Pinjam & Baca Buku</h4>
            <h2 class="font-fredoka title">Pinjam Top 8 Buku Populer</h2>
        </div>
        <a class="link linkhoveranimation" href='{{ route("buku.home") }}'>Terus Jelajahi <i class='bx bx-right-arrow-alt'></i></a>
      </div>

      <div class="flex flex-wrap mt-8 gap-5 items-center justify-center">
        @foreach ($bukuPopuler as $item)

          <a href="{{route('buku_detail', $item->id_buku)}}" class="group block w-70 rounded-2xl bg-white/80 backdrop-blur shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
      
              <!-- Cover -->
              <div class="relative overflow-hidden rounded-t-2xl aspect-4/5 bg-gray-100">
                  <img
                      src="{{ asset('storage/image/sampul/' . $item->sampul) }}"
                      alt="Cover Buku"
                      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                  />
      
                  <!-- Status Badge -->
                  <span class="absolute top-3 right-3 rounded-full {{$item->stok <= 0 ? 'bg-red-500/90' : 'bg-emerald-500/90'}} px-3 py-1 text-xs font-medium text-white shadow">
                    {{$item->stok <= 0 ? 'Habis' : 'Tersedia'}}
                  </span>
              </div>
      
              <!-- Content -->
              <div class="p-4">
                  <h3 class="text-[15px] font-semibold text-gray-900 leading-snug line-clamp-2">
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
          
    <!-- KATEGORI SECTION -->
    <section id="kategori_populer" class="pt-30">
      <div class="titleSectionHome">
        <div>
          <h4 class="font-latin subtitle">Pilih Buku Berdasarkan Kategori</h4>
          <h2 class="font-fredoka title">Pilih Top 6 Kategori Buku Populer</h2>
        </div>
        <a class="link linkhoveranimation text-[15px]" href="{{ route('kategori.home') }}">Terus Jelajahi <i class='bx bx-right-arrow-alt'></i></a>
      </div>
            
      <div class="flex flex-wrap mt-8 gap-5 items-center justify-center">
        @foreach ($kategoriPopuler as $item)

          <a href="{{ route('buku.home') }}?kategori={{ $item->id_kategori }}" class="group block rounded-xl max-w-[385px] border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:shadow-lg">

              <!-- Header -->
              <div class="flex items-start justify-between gap-3">
                  <h3 class="text-lg font-semibold text-gray-800 leading-tight line-clamp-2">
                    {{$item->nama_kategori}}
                  </h3>

                  <!-- Badge total buku -->
                  <span class="shrink-0 rounded-full bg-blue-100 px-3 py-1 text-xs
                              font-medium text-blue-700">
                      {{$item->buku->count()}} Buku
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
    
    <!-- TENTANG KAMI SECTION -->
    <section id="tentang" class="pt-30">
      <div class="flex flex-col min-[901px]:flex-row justify-between gap-7 min-[950px]:gap-15 2xl:gap-25 items-center">
        <div class="grid grid-cols-2 gap-2 min-[370px]:h-[250px] h-[300px] min-[485px]:h-[350px] min-[600px]:h-[450px] min-[901px]:h-[350px] min-[1060px]:h-[450px] 2xl:h-[550px] items-center justify-items-center">
          <div>
            <div class="w-[150px] h-[200px] min-[370px]:h-[230px] min-[404px]:w-[180px] min-[404px]:h-[250px] min-[485px]:w-[200px] min-[485px]:h-[300px] min-[600px]:w-[250px] min-[600px]:h-[360px] min-[901px]:w-[200px] min-[901px]:h-[300px] min-[1060px]:w-[250px] min-[1060px]:h-[360px] 2xl:w-[300px] 2xl:h-[400px] rounded-2xl shadow-xl overflow-hidden">
              <img src="{{ asset('images/about1.jpg') }}"  alt="Image About 1" class="w-full h-full object-cover"/>
            </div>
          </div>
          <div class="flex flex-col gap-5 justify-center">
            <div class="w-[120px] h-[100px] min-[370px]:w-[135px] min-[370px]:h-[120px] min-[404px]:w-[150px] min-[404px]:h-[130px] min-[485px]:w-[180px] min-[485px]:h-[180px] min-[600px]:w-[230px] min-[600px]:h-[230px] min-[901px]:w-[180px] min-[901px]:h-[180px] min-[1060px]:w-[230px] min-[1060px]:h-[230px] 2xl:w-[350px] 2xl:h-[250px] rounded-2xl shadow-xl overflow-hidden">
              <img src="{{ asset('images/about2.jpg') }}"  alt="Image About 2" class="w-full h-full object-cover"/>
            </div>
            <div class="w-[90px] h-20 min-[370px]:w-[100px] min-[370px]:h-[90px] min-[404px]:w-[120px] min-[404px]:h-[90px] min-[485px]:w-[180px] min-[485px]:h-[150px] 2xl:w-[280px] 2xl:h-60 rounded-2xl shadow-xl overflow-hidden">
              <img src="{{ asset('images/about3.jpg') }}"  alt="Image About 3" class="w-full h-full object-cover"/>
            </div>
          </div>
        </div>
        <div class="flex-1">
          <h3 class="font-latin text-blue-400 text-[25px] xl:text-3xl 2xl:text-4xl -mb-3">Ayo Tingkatkan Literasi</h3>
          <h1 class="font-fredoka text-2xl xl:text-3xl 2xl:text-4xl font-semibold">Kami Hadir Untuk Memudahkan Peminjaman Buku Anda</h1>
          <p class="mt-5 text-sm xl:text-[15px] 2xl:text-[16px]">TheBooks adalah platform peminjaman buku yang memudahkan pengguna mengakses dan meminjam koleksi bacaan secara praktis. Kami berkomitmen menghadirkan layanan peminjaman yang tertata, informatif, dan nyaman, mulai dari pengelolaan data buku, proses peminjaman, hingga pengembalian yang terjadwal dengan jelas.</p>
          <p class="mt-3 text-sm xl:text-[15px] 2xl:text-[16px]">Melalui TheBooks, pengguna dapat melihat ketersediaan buku secara real-time, mengajukan peminjaman dengan mudah, serta memantau status peminjaman dan tenggat pengembalian. Sistem kami dirancang untuk mendukung kebiasaan membaca yang lebih teratur sekaligus membantu pengelolaan koleksi buku agar lebih efisien dan terkontrol.</p>
          
            <div class="visimisiswapperabout hidden xl:block">
              <div class="button-container">
                <button id="visibtn">VISI</button>
                <button id="misibtn">MISI</button>
                <div id="visimisiindicator"></div>
              </div>
              <div class="content-text">
                <div id="contentBoxVisiMisi">
                  <p id="visicontent">Menjadi platform peminjaman buku yang andal, mudah diakses, dan berkelanjutan dalam mendukung budaya membaca serta peningkatan literasi di era digital.</p>
                  <ol id="misicontent">
                    <li>Menyediakan layanan peminjaman buku yang sederhana, teratur, dan transparan.</li>
                    <li>Memudahkan pengguna dalam mengakses informasi ketersediaan buku dan status peminjaman.</li>
                    <li>Membantu pengelolaan koleksi buku agar lebih rapi dan terkontrol.</li>
                  </ol>
                  </div>
                </div>
              </div>
            </div>
        </div>

      <div class="visimisiswapperabout block xl:hidden">
        <div class="button-container">
          <button id="visibtn">VISI</button>
          <button id="misibtn">MISI</button>
          <div id="visimisiindicator"></div>
        </div>
        <div class="content-text">
          <div id="contentBoxVisiMisi">
            <p id="visicontent">Menjadi platform informasi wisata terdepan di Indonesia yang menginspirasi jutaan traveler untuk menjelajahi keindahan negeri, memperkenalkan pesona budaya lokal, serta mendukung pertumbuhan pariwisata berkelanjutan di seluruh nusantara.</p>
            <ol id="misicontent">
              <li>Menyediakan informasi destinasi dan penginapan yang akurat, menarik, dan mudah diakses.</li>
              <li>Mendukung pariwisata lokal dengan menampilkan potensi terbaik dari setiap daerah.</li>
              <li>Menghadirkan pengalaman digital yang modern dan menyenangkan bagi setiap pengguna.</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

@endsection