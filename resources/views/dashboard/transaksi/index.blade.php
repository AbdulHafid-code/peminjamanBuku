@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Data Transaksi
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Transaksi</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a class="active">Transaksi</a></li>
			</ul>
		</div>

		{{-- btn create --}}
		<x-button-create :href="route('transaksi.create')">Tambah Transaksi</x-button-create>
	</div>

	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type="'error'" :session="session('error')"/>

	{{-- filter bar --}}
	<x-filter-bar 
		:searchPlaceholder="'Cari Nama Pengguna...'"
		:showTransaksi="true"/>

    <div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
		<table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700 text-sm">
			<thead class="text-sm text-gray-600 dark:text-gray-400">
				<tr>
					<th class="text-left px-1.5 sm:px-4 py-2">No</th>
					<th class="text-left px-1.5 sm:px-4 py-2">Buku</th>
					<th class="text-center px-1.5 sm:px-4 py-2">User</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Tanggal Pinjam</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Tanggal Kembali</th>
					<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
				</tr>
			</thead>
			<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
				@forelse ($transaksi as $item)
					<tr>
						<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
						<td class="px-1.5 sm:px-4 py-2 gap-2 ">
							<img src="{{ asset('storage/image/sampul/' . $item->buku->sampul) }}" class="w-17.5 h-25 shrink-0 hidden md:block rounded-sm object-cover"/>
							<div class="flex flex-col gap-1">
								<span class="line-clamp-2">
									{{ mb_strimwidth($item->buku->judul_buku, 0, 17, '...') }}
								</span>
							</div>
						</td>
						<td class="px-1.5 sm:px-4 py-2 ">
							<div class="flex items-center flex-col gap-2 ">
								<img src="{{ $item->user->profil ? asset('storage/image/profil/' . $item->user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $item->user->nama) . '&background=random&length=2'}}" class="hidden md:block size-12 rounded-full object-cover">
								<span class="line-clamp-2">
									{{ mb_strimwidth($item->user->nama, 0, 17, '...') }}
								</span>
							</div>
						</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell"> {{ $item->tanggal_pinjam->translatedFormat('d F Y') }} </td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->tanggal_kembali->translatedFormat('d F Y')}} </td>
						<td class="px-1.5 sm:px-4 py-2 align-middle">
							<div class="flex justify-center gap-2 font-normal text-sm">

								<x-button-detail :href="route('transaksi.show', $item->id_transaksi)"></x-button-detail>
								
								@if ($item->status == 0)
									<form action="{{ route('edit_status_transaksi', [$item->id_transaksi, 'disetujui'] ) }}" class="hidden md:flex" method="POST">
										@method('PUT')
										@csrf
										<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menyetujui Data Ini" class="flex items-center justify-center px-2 py-2 gap-2 rounded-md text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600"><i class='bx bx-check'></i> Setuju </button>
									</form>

									<form action="{{ route('edit_status_transaksi', [$item->id_transaksi, 'ditolak'] ) }}" class="hidden md:flex" method="POST">
										@method('PUT')
										@csrf
										<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Ini" class="flex items-center justify-center px-2 py-2 gap-2 rounded-md text-white bg-slate-500 transition-all duration-300 hover:bg-slate-600"><i class='bx bx-x'></i> Tolak </button>
									</form>
								@elseif($item->status == 1)

									<form action="{{ route('edit_status_transaksi', [$item->id_transaksi, 'dikembalikan'] ) }}" class="hidden md:flex" method="POST">
										@method('PUT')
										@csrf
										<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Data Ini Sudah Dikembalikan" class="hidden md:flex items-center justify-center px-2 py-2 gap-2 rounded-md bg-sky-200 border border-sky-600 text-sky-800 transition-all duration-300 hover:bg-sky-600 hover:text-white "><i class='bx bx-check'></i> Dikembalikan </button>
									</form>

								@elseif($item->status == 3)

									<form action="{{ route('edit_status_transaksi', [$item->id_transaksi, 'dipulihkan'] ) }}" class="hidden md:flex" method="POST">
										@method('PUT')
										@csrf
										<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mengembalikan Data ini" class="flex items-center justify-center px-2 py-2 gap-2 rounded-md text-white bg-green-500 transition-all duration-300 hover:bg-green-600"><i class='bx bx-revision'></i> Pulihkan </button>
									</form>

								@endif
							</div>
						</td>
					</tr>
				@empty
					<tr>
                        <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                            Data Transaksi Tidak Tersedia.
                        </td>
                    </tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection