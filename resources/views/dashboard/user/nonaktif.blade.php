@extends('dashboard.layouts.main')

@section('title')
	Dashboard | Akun Non-Aktif
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Pengguna Di Non-Aktifkan</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard')}}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="#" class="active">Non-Aktif</a></li>
			</ul>
		</div>

		{{-- btn create --}}
		{{-- <x-button-create :href="route('user.create')">Tambah Pengguna</x-button-create> --}}
	</div>

	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

	{{-- filter bar --}}
	<x-filter-bar 
		:searchPlaceholder="'Cari Nama Pengguna...'"
		:showRole="true"
		:statusAkun="true"
		:role="$role"/>

	<div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
		<table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
			<thead class="text-sm text-gray-600 dark:text-gray-400">
				<tr>
					<th class="text-left px-1.5 sm:px-4 py-2">No</th>
					<th class="text-left px-1.5 sm:px-4 py-2">Nama</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden lg:table-cell">Username</th>
					<th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Hak Akses</th>
					<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
				</tr>
			</thead>
			<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
				@forelse ($users as $item)
					<tr>
						<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
						<td class="flex items-center px-1.5 sm:px-4 py-2 gap-2 ">
							<img src="{{ $item->profil ? asset('storage/image/profil/' . $item->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $item->nama) . '&background=random&length=2'}}" class="size-12 rounded-full object-cover">
							<div class="flex flex-col gap-1">
								<span class="line-clamp-2">
									{{ mb_strimwidth($item->nama, 0, 17, '...') }}
								</span>
							</div>
						</td>
						<td class="px-1.5 sm:px-4 py-2 hidden lg:table-cell">{{$item->username}}</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->role->role}}</td>
						<td class="px-1.5 sm:px-4 py-2 align-middle">
							<div class="flex justify-center gap-2 font-normal text-sm">
								<x-button-detail :href="route('user.show', $item->id_user)"></x-button-detail>
								<x-button-edit :href="route('user.edit', $item->id_user)" :edit='true'></x-button-edit>
								
                                <form action="{{ route('status', $item->id_user) }}" method="POST">
                                    @csrf
                                    <button id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mengaktifkan {{$item->nama}}" type="submit" class="rounded-sm bg-amber-500 px-5 py-1.5 text-sm font-medium text-white hover:bg-amber-600 flex items-center gap-2">
                                        <i class='bx bxs-check-circle text-xl' ></i> <span class="hidden sm:block">Aktif</span>
                                    </button>
                                </form>	
                                
								<x-button-delete :action="route('user.destroy', $item->id_user)" :trash="true" dataPesan="Apakah Anda Yakin Ingin Menghapus Data User {{$item->nama}}"></x-button-delete>
							</div>
						</td>
					</tr>
				@empty
					<tr>
                        <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                            Data Pengguna Kosong
                        </td>
                    </tr>
				@endforelse
			</tbody>
		</table>
	</div>
	
@endsection
