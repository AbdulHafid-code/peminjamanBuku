@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Data Buku
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Buku</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a class="active">Buku</a></li>
			</ul>
		</div>

		{{-- btn create --}}
		<x-button-create :href="route('buku.create')"> Tambah Buku </x-button-create>
	</div>
	
	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type="'error'" :session="session('error')"/>

	{{-- filter bar --}}
    <x-filter-bar 
		:searchPlaceholder="'Cari Judul / Kode Buku...'"
		:showKategori="true"
		:kategori="$kategori"/>

    <div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
		<table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
			<thead class="text-sm text-gray-600 dark:text-gray-400">
				<tr>
					<th class="text-left px-1.5 sm:px-4 py-2">No</th>
					<th class="text-left px-1.5 sm:px-4 py-2">Buku</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden lg:table-cell">Kategori</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Stok</th>
					<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
				</tr>
			</thead>
			<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
				@forelse ($books as $item)
					<tr>
						<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
						<td class="flex items-center px-1.5 sm:px-4 py-2 gap-2 ">
							<img src="{{ asset('storage/image/sampul/' . $item->sampul) }}" class="w-17.5 h-25 shrink-0 hidden md:block rounded-sm object-cover"/>
							<div class="flex flex-col gap-1">
								<span class="line-clamp-2">
									{{ mb_strimwidth($item->judul_buku, 0, 40, '...') }}
								</span>
								<span class="px-2 py-0.5 rounded font-semibold text-xs bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 w-fit">{{$item->kode_buku}}</span>
							</div>
						</td>
						<td class="px-1.5 sm:px-4 py-2 hidden lg:table-cell"> {{$item->kategori->nama_kategori}}</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->stok}}</td>
						<td class="px-1.5 sm:px-4 py-2 align-middle">
							<div class="flex justify-center gap-2 font-normal text-sm">
								<x-button-detail :href="route('buku.show', $item->id_buku)"></x-button-detail>
								<x-button-edit :href="route('buku.edit', $item->id_buku)" :edit='true'></x-button-edit>
                                <x-button-delete :action="route('buku.destroy', $item->id_buku)" :trash="true" dataPesan="Apakah Anda Yakin Ingin Menghapus Data Buku {{$item->judul_buku}}"></x-button-delete>
							</div>
						</td>
					</tr>
				@empty
					<tr>
                        <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                            Data Buku Kosong
                        </td>
                    </tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection