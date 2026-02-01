@extends('home.layouts.main')

@section('title')
    Detail {{ $buku->judul_buku ?? 'Buku' }}
@endsection

@section('navbar')
  @include('home.layouts.navbar-page')
@endsection

@section('container')

    <div class="halaman-detail-buku">
        <div class="card-container">

            <!-- DETAIL BUKU -->
            <div class="card-buku">
                <div class="card-content-buku">

                    <div class="main-content-card-buku">
                        <!-- Cover -->
                        <img
                            src="{{ asset('storage/image/sampul/' . $buku->sampul) }}"
                            alt="Cover Buku"
                            class="image-card-buku"
                        />

                        <!-- Info -->
                        <div class="info-card-buku">
                            <h1 class="title-card-buku">{{ $buku->judul_buku }}</h1>
                            <p class="paragraph-card-buku">oleh <b>{{$buku->penulis}}</b></p>

                            <div class="detail-info-card-buku">
                                <p><span>Kategori:</span> {{$buku->kategori->nama_kategori}}</p>
                                <p><span>Kode Buku:</span> {{$buku->kode_buku}}</p>
                                <p><span>Penerbit:</span> {{$buku->penerbit}}</p>
                                <p><span>Tgl. Terbit:</span> {{$buku->tanggal_terbit}}</p>
                                <p class="stok-info-card-buku">
                                    <span>Stok:</span>
                                    <span class="{{$buku->stok > 0 ? 'text-green-600' : 'text-red-600'}}">{{$buku->stok > 0 ? 'Tersedia ( ' . $buku->stok . ')' : 'Habis'}}</span>
                                </p>
                                <form action="{{ route('favorit_toggle', $buku->id_buku) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition cursor-pointer
                                        {{ $isFavorit 
                                            ? 'bg-red-500 hover:bg-red-600 text-white' 
                                            : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                                        <i class="bx {{ false ? 'bxs-heart' : 'bx-heart' }} text-lg"></i>

                                        {{ $isFavorit ? 'Hapus dari Favorit' : 'Tambahkan ke Favorit' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="deskripsi-card-buku">
                        <h2>Deskripsi Buku</h2>
                        <p class="text-justify">{{$buku->deskripsi}}</p>
                    </div>

                </div>
            </div>

            <!-- FORM PEMINJAMAN -->
            <div class="form-peminjaman-buku">
                <div class="card-form-peminjaman-buku">

                    <h2 class="title-form-peminjaman-buku">
                        Form Peminjaman
                    </h2>

                    @if (session()->has('success'))
                        <div class="flex mt-3 items-center gap-3 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
                            <i class='bx bx-check-circle text-lg'></i>
                            <span>{{session('success')}}</span>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <i class='bx bx-x-circle text-lg'></i>
                            <span>
                                {{ session('error') }}
                            </span>
                        </div>
                    @endif

                    <form action="{{ route('transaksi_pinjam')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$buku->id_buku}}" name="buku_id">
                        <!-- Tanggal Pinjam -->
                        <div class="input-container">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" placeholder="Masukkan tanggal pinjam..."/>
                            @error('tanggal_pinjam')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Tanggal Kembali -->
                        <div class="input-container">
                            <label>Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" placeholder="Masukkan tanggal kembali..."/>
                            @error('tanggal_kembali')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Total Buku -->
                        <div class="input-container">
                            <label>Total Buku</label>
                            <input type="number" name="total_pinjam" placeholder="Masukkan jumlah buku..."/>
                            @error('total_pinjam')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div> 


                        <!-- Button -->
                        <button type="submit">
                            Pinjam Buku
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <div class="container-transaksi">
            <h1 class="title-container-transaksi">Peminjam Buku</h1>
    
            <div class="container-card-transaksi">
                @foreach($transaksi as $item)
                    <div class="card-transaksi">
                        <!-- Card User -->
                        <div class="card-transaksi-content">
        
                            <!-- Avatar -->
                            <img
                                 src="{{ $item->user->profil ? asset('storage/image/profil/' . $item->user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $item->user->nama) . '&background=random&length=2'}}"
                                alt="User"
                            />
        
                            <!-- Info -->
                            <div class="info-transaksi">
                                <h3 class="nama-user-transaksi">
									{{ mb_strimwidth($item->user->nama, 0, 17, '...') }}
                                </h3>
        
                                <p class="tanggal-transaksi">
                                    <span>{{ $item->tanggal_pinjam->format('d M Y') }}</span>
                                    —
                                    <span>{{ $item->tanggal_kembali->format('d M Y') }}</span>
                                </p>
        
                                <p class="total-buku-transaksi">
                                    Total Buku:
                                    <span>{{$item->total_pinjam}} Buku</span>
                                </p>
                            </div>
        
                        </div>
        
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    


@endsection