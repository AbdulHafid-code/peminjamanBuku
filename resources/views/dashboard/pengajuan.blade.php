@extends('dashboard.layouts.main')

@section('title') 
  Dashboard | Pengajuan Pengembalian
@endsection

@section('content')
    <div class="title-container">
        <div>
            <h1 class="title">Pengajuan Pengembalian</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
                <li><a href="#" class="active">Pengajuan</a></li>
            </ul>
        </div>
    </div>

    {{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>


    {{-- filter bar --}}
	<x-filter-bar :searchPlaceholder="'Cari Pengajuan Kembali...'"/> 


    {{-- tabel --}}
    <div class="relative w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
		<table class="border-collapse w-full table-auto divide-y divide-gray-300 dark:divide-gray-700 text-sm">
			<thead class="text-sm text-gray-600 dark:text-gray-400">
				<tr>
					<th class="text-left px-1.5 sm:px-4 py-2">No</th>
					<th class="text-left px-1.5 sm:px-4 py-2">Buku</th>
					<th class="text-center px-1.5 sm:px-4 py-2">User</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Jumlah Pengajuan</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Jumlah Dipinjam</th>
					<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
				</tr>
			</thead>
			<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
				@forelse ($transaksi as $item)
					<tr>
						<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
						<td class="pl-1.5 sm:pl-4 py-2 gap-2 whitespace-nowrap">
							<img src="{{ asset('storage/image/sampul/' . $item->buku->sampul) }}" class="w-17.5 h-25 shrink-0 hidden md:block rounded-sm object-cover"/>
							<div class="flex flex-col gap-1">
								<span class="line-clamp-2">
									{{ mb_strimwidth($item->buku->judul_buku, 0, 15, '...') }}
								</span>
							</div>
						</td>
						<td class="pr-1.5 sm:pr-4 py-2 ">
							<div class="flex items-center flex-col gap-2 ">
								<img src="{{ $item->user->profil ? asset('storage/image/profil/' . $item->user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $item->user->nama) . '&background=random&length=2'}}" class="hidden md:block size-12 rounded-full object-cover">
								<span class="line-clamp-2">
									{{ mb_strimwidth($item->user->nama, 0, 15, '...') }}
								</span>
							</div>
						</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell"> {{ $item->pengajuan_kembali}} Buku</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->total_pinjam - $item->jumlah_dikembalikan}} Buku</td>						
                        <td class="px-1.5 sm:px-4 py-2 align-middle">
							<div class="flex justify-center gap-2 font-normal text-sm">
								<form action="{{ route('menerima', $item->id_transaksi) }}" method="POST">
									@csrf
									<button id="btn-delete" data-pesan="okhhhh" type="submit" class="rounded-sm bg-green-500 px-2 md:px-5 py-2 text-sm font-medium text-white hover:bg-green-600 flex items-center gap-2">
										<i class='bx bx-check' ></i> <span class="hidden md:block">Setuju</span>
									</button>
								</form>
								<form action="{{ route('membatalkan', $item->id_transaksi ) }}" method="POST">
									@csrf
									<button id="btn-delete" data-pesan="okhhhh" type="submit" class="rounded-sm bg-red-500 px-2 md:px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
										<i class='bx bx-x' ></i> <span class="hidden md:block">Setuju</span>
									</button>
								</form>
							</div>
						</td>
					</tr>
				@empty
					<tr>
                        <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                            Data Pengajuan Tidak Tersedia.
                        </td>
                    </tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection