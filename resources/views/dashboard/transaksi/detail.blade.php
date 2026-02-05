@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Detail Transaksi
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Detail Transaksi Peminjaman Buku</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Detail</a></li>
			</ul>
		</div>
	</div>

    <div class="flex flex-col gap-6 w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
        <span class="font-medium text-lg text-gray-600 dark:text-gray-400">Informasi Detail Transaksi :</span>

        <div class="flex flex-col md:flex-row gap-5 w-full">
            {{-- profil --}}
            <div class="flex items-center p-4 rounded-lg gap-5 bg-gray-100 dark:bg-gray-800 w-full md:w-3/5 h-55">
                <img src="{{ $transaksi->user->profil ? asset('storage/image/profil/' . $transaksi->user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $transaksi->user->nama) . '&background=random&length=2'}}" alt="" class="size-30 rounded-full object-cover">
                <div class="block">
                    <p class="font-medium text-sm text-gray-600 dark:text-gray-400">Pengguna Yang Peminjam</p>
                    <a href="" class="group flex flex-col md:flex-row gap-1.5 items-center transition rounded-full py-1 cursor-pointer">
                        <span class="text-2xl font-semibold text-gray-950 dark:text-gray-50 group-hover:text-violet-600 group-hover:underline transition">{{ mb_strimwidth($transaksi->user->nama, 0, 20, '...') }}</span>
                    </a>
                </div>
            </div>
            {{-- buku --}}
            <div class="relative flex p-4 rounded-lg gap-5 bg-gray-100 dark:bg-gray-800 w-full h-55">

                <img src="{{ asset('storage/image/sampul/' . $transaksi->buku->sampul) }}" class="w-30 h-ful hidden sm:block rounded-sm object-cover"/>

                <div class="flex flex-col justify-center gap-1">

                    <h2 class="font-semibold text-2xl mb-2 text-gray-950 dark:text-gray-50">{{$transaksi->buku->judul_buku}}</h2>

                    <div class="flex gap-2">
                        <span class="text-base font-semibold bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 px-2 py-0.5 rounded">{{$transaksi->buku->kode_buku}}</span>
                        <span class="text-lg font-semibold text-violet-600 px-2 rounded ">{{$transaksi->buku->kategori->nama_kategori}}</span>
                    </div>

                    <span class="font-medium text-sm text-gray-600 dark:text-gray-400">Jumlah Buku Sedang Dipinjam: {{ $transaksi->total_pinjam - $transaksi->jumlah_dikembalikan}}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3 text-xs md:text-sm">
            <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                <p class="text-gray-600 dark:text-gray-400">Tanggal Pinjam</p>
                <p class="text-gray-950 dark:text-gray-50">
                    {{ $transaksi->tanggal_pinjam->translatedFormat('d F Y') }}
                </p>
            </div>
            <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                <p class="text-gray-600 dark:text-gray-400">Tanggal Kembali</p>
                <p class="text-gray-950 dark:text-gray-50">
                    {{ $transaksi->tanggal_kembali->translatedFormat('d F Y') }}
                </p>
            </div>
            <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                <p class="text-gray-600 dark:text-gray-400">Status</p>
                <p class="font-bold text-violet-700 dark:text-violet-600">{{$transaksi->status_label}}</p>
            </div>
            <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                <p class="text-gray-600 dark:text-gray-400">Total Pinjam</p></p>
                <p class="text-gray-950 dark:text-gray-50">{{$transaksi->total_pinjam}} Buku</p>
            </div>
            <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                <p class="text-gray-600 dark:text-gray-400">Total Kembali</p>
                <p class="text-gray-950 dark:text-gray-50">{{$transaksi->jumlah_dikembalikan ?? '0'}} Buku</p>
            </div>
        </div>

        <div class="flex justify-end items-center gap-3 border-t py-4 border-gray-400 dark:border-gray-700">

            @if($transaksi->status == 0)
                <x-button-edit :href="route('transaksi.edit', $transaksi->id_transaksi)"></x-button-edit>
            @endif

            {{-- hapus --}}
            @if($transaksi->status == 3)
                <form action="{{route('transaksi.destroy', $transaksi->id_transaksi)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menghapus Data Transaksi ini" class="rounded-sm bg-red-500 text-sm px-2 py-2 font-medium text-white hover:bg-red-600 flex items-center gap-2">
                        <i class='bx bx-trash' ></i> Hapus
                    </button>
                </form>
            @endif 
            
            @if ($transaksi->status == 0)

                <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'disetujui'] ) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Meenyetujui Data Transaksi ini" class="items-center justify-center px-2 py-1.5 gap-2 rounded-sm text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600">
                        <i class='bx bx-check' ></i> Setuju
                    </button>
                </form>

                <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'ditolak'] ) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Transaksi ini" class="items-center justify-center px-2 py-1 gap-2 rounded-sm text-white bg-red-500 transition-all duration-300 hover:bg-red-600">
                        <i class='bx bx-x' ></i> Tolak
                    </button>
                </form>

            @elseif($transaksi->status == 1)

                @if($transaksi->tanggal_kembali > now())
                    <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'dipulihkan'] ) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mengembalikan Data ini" class="flex items-center justify-center px-2 py-2 gap-2 rounded-md text-white bg-green-500 transition-all duration-300 hover:bg-green-600"><i class='bx bx-revision'></i> Pulihkan </button>
                    </form>
                @endif

                <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'dikembalikan'] ) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Transaksi ini" class="items-center justify-center px-2 py-1.5 gap-2 rounded-md bg-sky-200 border border-sky-600 text-sky-800 transition-all duration-300 hover:bg-sky-600 hover:text-white">
                        <i class='bx bx-check' ></i> Dikembalikan
                    </button>
                </form>

            @elseif($transaksi->status == 3)

                <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'dipulihkan'] ) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Transaksi ini" class="items-center justify-center px-2 py-1.5 gap-2 rounded-md bg-green-200 border border-green-600 text-green-800 transition-all duration-300 hover:bg-green-600 hover:text-white">
                        <i class='bx bx-revision' ></i> Pulihkan
                    </button>
                </form>

                <form action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menghapus Data Buku" class="items-center justify-center px-2 py-1 gap-2 rounded-md bg-red-200 border border-red-600 text-red-800 transition-all duration-300 hover:bg-red-600 hover:text-white" ><i class='bx bx-trash text-xl' ></i></button>
                </form>
            @endif
        </div>
    </div>


@endsection




<div class="hidden flex justify-end items-center gap-3">

    @if($transaksi->status == 0)
        <a href="{{route('transaksi.edit', $transaksi->id_transaksi)}}" class="rounded-sm bg-violet-500 px-5 py-1.5 text-sm font-medium text-white hover:bg-violet-600 flex items-center gap-2">
        <i class='bx bxs-pencil' ></i> Edit
    </a>
    @endif

    {{-- hapus --}}
    <form action="{{route('transaksi.destroy', $transaksi->id_transaksi)}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menghapus Data Transaksi ini" class="rounded-sm bg-red-500 text-sm px-2 py-1.5 font-medium text-white hover:bg-red-600 flex items-center gap-2">
            <i class='bx bx-trash' ></i> Hapus
        </button>
    </form>
    
    @if ($transaksi->status == 0)

        <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'disetujui'] ) }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Meenyetujui Data Transaksi ini" class="hidden md:flex items-center justify-center px-2 py-1.5 gap-2 rounded-md text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600">
                <i class='bx bx-check' ></i> Setuju
            </button>
        </form>

        <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'ditolak'] ) }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Transaksi ini" class="hidden md:flex items-center justify-center px-2 py-1.5 gap-2 rounded-md text-white bg-red-500 transition-all duration-300 hover:bg-red-600">
                <i class='bx bx-x' ></i> Tolak
            </button>
        </form>

    @elseif($transaksi->status == 1)

        <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'dikembalikan'] ) }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Transaksi ini" class="hidden md:flex items-center justify-center px-2 py-1.5 gap-2 rounded-md bg-sky-200 border border-sky-600 text-sky-800 transition-all duration-300 hover:bg-sky-600 hover:text-white">
                <i class='bx bx-check' ></i> Dikembalikan
            </button>
        </form>

    @elseif($transaksi->status == 3)

        <form action="{{ route('edit_status_transaksi', [$transaksi->id_transaksi, 'dipulihkan'] ) }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Transaksi ini" class="hidden md:flex items-center justify-center px-2 py-1.5 gap-2 rounded-md bg-green-200 border border-green-600 text-green-800 transition-all duration-300 hover:bg-green-600 hover:text-white">
                <i class='bx bx-revision' ></i> Pulihkan
            </button>
        </form>

        <form action="" class="hidden md:flex" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menghapus Data Buku" class="items-center justify-center px-2 py-1 gap-2 rounded-md bg-red-200 border border-red-600 text-red-800 transition-all duration-300 hover:bg-red-600 hover:text-white" ><i class='bx bx-trash text-xl' ></i></button>
        </form>
    @endif

</div>

<div class="hidden flex justify-end items-center gap-3">
                        {{-- <x-button-edit :href="route('buku.edit', $transaksi->id_buku)"></x-button-edit>
                        <x-button-delete :action="route('buku.destroy', $transaksi->id_buku)"></x-button-delete> --}}
                    </div>