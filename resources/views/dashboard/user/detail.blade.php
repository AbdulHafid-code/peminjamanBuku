@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Detail Pengguna
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Detail Pengguna</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('user.index') }}">Pengguna</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Detail</a></li>
			</ul>
		</div>
	</div>

    <div class="w-full rounded-xl bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-4 sm:p-7 flex flex-col gap-6">

        <h2 class="font-semibold text-lg text-gray-600 dark:text-gray-400">
            Informasi Detail Pengguna :
        </h2>

        <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start">

            {{-- pp --}}
            <div class="relative">
                <div class="w-36 h-36 rounded-full overflow-hidden shadow-lg">
                    <img
                        src="{{ $user->profil 
                            ? asset('storage/image/profil/' . $user->profil) 
                            : 'https://ui-avatars.com/api/?name='. urlencode(preg_replace('/\s+/', '', $user->nama)) .'&background=random&length=2' }}"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>

            <div class="flex-1 space-y-2 text-center sm:text-left">
                <h1 class="text-3xl font-bold text-gray-950 dark:text-gray-50">
                    {{ $user->nama }}
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 justify-center gap-y-3 font-medium text-sm">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Username</p>
                        <p class="text-gray-950 dark:text-gray-50">{{$user->username}}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Hak Akses</p>
                        <p class="text-gray-950 dark:text-gray-50">{{ $user->role->role }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Tanggal Dibuat</p>
                        <p class="text-gray-950 dark:text-gray-50">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="flex gap-3">
                <x-button-edit :href="route('user.edit', $user->id_user)" />
                <x-button-delete :action="route('user.destroy', $user->id_user)" />
            </div>
        </div>

        <!-- INFO CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="rounded-lg bg-gray-100 dark:bg-gray-700/40 p-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">Buku Favorit</p>
                <p class="font-semibold text-gray-950 dark:text-gray-50">
                    {{ $bukuFavorit->count() }}
                </p>
            </div>
            <div class="rounded-lg bg-gray-100 dark:bg-gray-700/40 p-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">Riwayat</p>
                <p class="font-semibold text-gray-950 dark:text-gray-50">
                    {{ $transaksi->count()}}
                </p>
            </div>
            <div class="rounded-lg bg-gray-100 dark:bg-gray-700/40 p-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">Sedang Dipinjam</p>
                <p class="font-semibold text-gray-950 dark:text-gray-50">
                    {{ $transaksi->where('status', 1)->count() }}
                </p>
            </div>


        </div>

    </div>

@endsection