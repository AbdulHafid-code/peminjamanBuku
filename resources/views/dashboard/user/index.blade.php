@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Pengguna
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Pengguna</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard')}}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="#" class="active">Pengguna</a></li>
			</ul>
		</div>

		{{-- btn create --}}
		<x-button-create :href="route('user.create')">Tambah Pengguna</x-button-create>
	</div>

	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type="'error'" :session="session('error')"/>

	{{-- filter bar --}}
	<x-filter-bar 
		:searchPlaceholder="'Cari Nama Pengguna...'"
		:showRole="true"
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
									{{-- {{$item->nama}} --}}
								</span>
							</div>
						</td>
						<td class="px-1.5 sm:px-4 py-2 hidden lg:table-cell">{{$item->username}}</td>
						<td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->role->role}}</td>
						<td class="px-1.5 sm:px-4 py-2 align-middle">
							<div class="flex justify-center gap-2 font-normal text-sm">
								<x-button-detail :href="route('user.show', $item->id_user)"></x-button-detail>
								<x-button-edit :href="route('user.edit', $item->id_user)" :edit='true'></x-button-edit>
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
















{{-- <div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-4 mb-4">
	<form action="" method="GET" class="flex flex-col sm:flex-row justify-between items-center gap-2">
		<div class="relative flex justify-center items-center w-fit text-gray-600 dark:text-gray-400 left-0">
			<h3>Sort: </h3>
			<select name="" id="" class="bg-gray-200/60 dark:bg-gray-900 text-gray-950 dark:text-gray-50 py-2 px-6 rounded mx-1 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-600 outline-none">
				<option value="">10</option>
				<option value="">15</option>
				<option value="">20</option>
				<option value="">25</option>
				<option value="">30</option>
			</select>
			<h3>Data</h3>
		</div>

		<div class="flex flex-col md:flex-row sm:flex-wrap justify-end gap-2 items-center">
			<div class="relative flex justify-center items-center">
				<input type="text" value='{{request('search')}}' name="search" placeholder="Cari Data Pengguna..." class="bg-gray-200/60 dark:bg-gray-900 dark:text-white w-auto py-2 pl-10 rounded focus:ring-2 focus-within:ring-violet-300 dark:focus:ring-violet-600 outline-none">
				<button class="absolute left-0 p-3 text-lg text-gray-600 dark:text-gray-400">
					<i class='bx bx-search'></i>
				</button>
			</div>

			<div class="flex gap-3 sm:gap-2 items-center">
				<div class="relative w-fit text-gray-600 dark:text-gray-400">
					<select name="role" id="role" onchange="this.form.submit()" class="py-2 bg-gray-200/60 dark:bg-gray-900 dark:text-gray-50 text-gray-950 pl-7 pr-10 rounded appearance-none outline-none focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700">
						<option value="semua" {{request('role') == 'semua' ? 'selected' : '' }}>Semua</option>
						@foreach ($role as $item)
							<option value="{{$item->id_role}}" {{request('role') == $item->id_role ? 'selected' : '' }}>{{$item->role}}</option>
						@endforeach
					</select>
					<i class='bx bx-filter-alt absolute right-3 bottom-1.5 text-2xl'></i>
				</div>

				<div id="refres" class="relative hidden lg:flex justify-center items-center bg-gray-200/60 dark:bg-gray-900 p-3 rounded cursor-pointer">
					<button type="submit" name="reset" value="1">
						<i class="bx bx-refresh text-2xl text-gray-950 dark:text-gray-50"></i>
					</button>
				</div>

				<div class="relative w-fit text-gray-600 dark:text-gray-400">
					<select name="order" onchange="this.form.submit()" class="py-2 bg-gray-200/60 dark:bg-gray-900 dark:text-gray-50 text-gray-950 px-5 rounded outline-none focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-600">
						<option value="asc" {{request('order') == 'asc' ? 'selected' : '' }}>A - Z</option>
						<option value="desc" {{request('order') == 'desc' ? 'selected' : '' }}>Z - A</option>
						<option value="newest" {{request('order') == 'newest' ? 'selected' : '' }}>Terbaru</option>
						<option value="oldest" {{request('order') == 'oldest' ? 'selected' : '' }}>Terlama</option>
					</select>
				</div>
			</div>

		</div>
	</form>
</div> --}}