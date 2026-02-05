@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Data Hak Akses
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Hak Akses</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Hak Akses</a></li>
			</ul>
		</div>

		{{-- btn create --}}
		{{-- <x-button-create :href="route('role.create')">Tambah Hak Akses</x-button-create> --}}
	</div>

	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

	{{-- filter bar --}}
	<x-filter-bar :searchPlaceholder="'Cari Nama Kategori...'"/> 


	<div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
		<table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
			<thead class="text-sm text-gray-600 dark:text-gray-400">
				<tr>
					<th class="text-left px-1.5 sm:px-4 py-2">No</th>
					<th class="text-left px-1.5 sm:px-4 py-2">Hak Akses</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Total User</th>
					<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
				</tr>
			</thead>
			<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
				@forelse ($roles as $item)
					<tr>
						<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
						<td class="px-1.5 sm:px-4 py-2">{{$item->role}}</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->user->count()}}</td>
						<td class="px-1.5 sm:px-4 py-2 align-middle">
							<div class="flex justify-center gap-2 font-normal text-sm">
								<x-button-detail :href="route('role.show', $item->id_role)"></x-button-detail>
								<x-button-edit :href="route('role.edit', $item->id_role)" :edit='true'></x-button-edit>
                                <x-button-delete :action="route('role.destroy', $item->id_role)" :trash="true" dataPesan="Apakah Anda Yakin Ingin Menghapus Data Role {{$item->role}}"></x-button-delete>
							</div>
						</td>
					</tr>
				@empty
					<tr>
                        <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                            Data Hak Akses Kosong
                        </td>
                    </tr>
				@endforelse
			</tbody>
		</table>
	</div>
	
@endsection