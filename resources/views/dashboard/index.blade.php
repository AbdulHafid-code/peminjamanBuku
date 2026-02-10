@extends('dashboard.layouts.main')

@section('title')
	Dashboard | Dashboard Buku
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Hai {{auth()->user()->nama}}, Selamat Datang</h1>
			<ul class="breadcrumbs">
				@can('admin')
				<li><a href="#" class="active">Siapkan Diri Anda Untuk Bertugas Hari Ini, Terima Kasih</a></li>
				@endcan
				@can('user')
				<li><a href="#" class="active">Buku Yang Kamu Pinjam Adalah Jendela Dunia</a></li>
				@endcan
			</ul>
		</div>
	</div>

	{{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

	@can('admin')
		{{-- card --}}
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full mb-5">
			<a href="{{ route('buku.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed mb-4 pb-4 ">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600"><i class='bx bx-book'></i></div>
					<div class="block">
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">{{$buku->count()}}</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">Total Buku</p>
					</div>
				</div>
				<div class="flex justify-between items-center text-gray-600 dark:text-gray-400">
					<span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Lebih Detail</span>
					<i class='bx bx-arrow-back rotate-180 text-xl '></i>
				</div>
			</a>
			
			<a href="{{ route('kategori.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed mb-4 pb-4 ">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600"><i class='bx bx-category-alt'></i></div>
					<div class="block">
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">{{$kategori->count()}}</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">Kategori Buku</p>
					</div>
				</div>
				<div class="flex justify-between items-center text-gray-600 dark:text-gray-400">
					<span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Lebih Detail</span>
					<i class='bx bx-arrow-back rotate-180 text-xl'></i>
				</div>
			</a>
			
			<a href="{{ route('user.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed mb-4 pb-4 ">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600"><i class='bx bx-user'></i></div>
					<div class="block">
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">{{$user->count()}}</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">User</p>
					</div>
				</div>
				<div class="flex justify-between items-center text-gray-600 dark:text-gray-400">
					<span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Lebih Detail</span>
					<i class='bx bx-arrow-back rotate-180 text-xl'></i>
				</div>
			</a>
			
			<a href="{{ route('transaksi.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed mb-4 pb-4 ">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600"><i class='bx bx-receipt'></i></div>
					<div class="block">
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">{{$transaksi->count()}}</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">Total Transaksi</p>
					</div>
				</div>
				<div class="flex justify-between items-center text-gray-600 dark:text-gray-400">
					<span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Lebih Detail</span>
					<i class='bx bx-arrow-back rotate-180 text-xl'></i>
				</div>
			</a>
			
		</div>

		{{-- chart --}}
		<div class="rounded-lg bg-white dark:bg-gray-800 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6 mb-5">
			<div id="chartTraffic" class="min-w-150"></div>
		</div>

		<div class="space-y-5">

			{{-- Buku Hampir Habis --}}
			<div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
				<h3 class="font-semibold text-xl mb-3 text-gray-800 dark:text-gray-200">Stok Buku Hampir Habis</h3>
				<table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
					<thead class="text-sm text-gray-600 dark:text-gray-400">
						<tr>
							<th class="text-left px-1.5 sm:px-4 py-2">No</th>
							<th class="text-left px-1.5 sm:px-4 py-2">Buku</th>
							<th class="text-left px-1.5 sm:px-4 py-2">Total Buku</th>
							<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
						</tr>
					</thead>
					<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
						@forelse ($bukuHabis as $item)
							<tr>
								<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
								<td class="flex items-center px-1.5 sm:px-4 py-2 gap-2 ">
									{{ mb_strimwidth($item->judul_buku, 0, 40, '...') }}
								</td>
								<td class="px-1.5 sm:px-4 py-2">{{$item->stok}} <span class="hidden md:inline">Buku</span></td>
								<td class="px-1.5 sm:px-4 py-2 align-middle">
									<div class="flex justify-center gap-2 font-normal text-sm">
										<x-button-detail :href="route('buku.show', $item->id_buku)"></x-button-detail>
										<x-button-edit :href="route('buku.edit', $item->id_buku)" :edit='true'></x-button-edit>
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

			{{-- User Terlambat --}}
			<div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
				<h3 class="font-semibold text-xl mb-3 text-gray-800 dark:text-gray-200">Pengguna Terlambat Mengembalikan</h3>
				<table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
					<thead class="text-sm text-gray-600 dark:text-gray-400">
						<tr>
							<th class="text-left px-1.5 sm:px-4 py-2">No</th>
							<th class="text-left px-1.5 sm:px-4 py-2">Pengguna</th>
							<th class="text-left px-1.5 sm:px-4 py-2 hidden sm:table-cell">Buku</th>
							<th class="text-left px-1.5 sm:px-4 py-2">Total Pinjam</th>
							<th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
						</tr>
					</thead>
					<tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
						@forelse ($userTerlambat as $item)
							<tr>
								<td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
								<td class="px-1.5 sm:px-4 py-2 ">
									{{ mb_strimwidth($item->user->nama, 0, 17, '...') }}
								</td>
								<td class="px-1.5 sm:px-4 py-2 gap-2 hidden sm:block">
									{{ mb_strimwidth($item->buku->judul_buku, 0, 17, '...') }}
								</td>
								<td class="px-1.5 sm:px-4 py-2">{{$item->total_pinjam - $item->jumlah_dikembalikan }} <span class="hidden md:inline">Buku</span></td>
								<td class="px-1.5 sm:px-4 py-2 align-middle">
									<div class="flex justify-center gap-2 font-normal text-sm">
										<x-button-detail :href="route('buku.show', $item->buku->id_buku)"></x-button-detail>
										<form action="{{ route('status', $item->user->id_user) }}" method="POST">
											@csrf
											<button id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mengnonaktifkan {{$item->nama}}" type="submit" class="rounded-sm bg-red-500 px-2 md:px-5 py-1.5 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
												<i class='bx bx-x text-xl' ></i> <span class="hidden md:block"> Non Aktif</span>
											</button>
										</form>
									</div>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
									Data Transaksi Kosong
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	@endcan

	@can('user')
		{{-- card --}}
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full mb-5">

			<!-- Buku Favorit -->
			<div class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed pb-4">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600">
						<i class='bx bx-bookmark-heart'></i>
					</div>
					<div>
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">
							{{$bukuFavorit->count()}}
						</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">
							Buku Favorit
						</p>
					</div>
				</div>
			</div>

			<!-- Riwayat Transaksi -->
			<div class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed pb-4">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600">
						<i class='bx bx-receipt'></i>
					</div>
					<div>
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">
							{{$riwayatTransaksi->count()}}
						</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">
							Riwayat Transaksi
						</p>
					</div>
				</div>
			</div>

			<!-- Sedang Dipinjam -->
			<div class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed pb-4">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600">
						<i class='bx bx-book-open'></i>
					</div>
					<div>
						<h3 class="font-bold text-4xl text-gray-950 dark:text-white">
							{{$dipinjam}}
						</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">
							Sedang Dipinjam
						</p>
					</div>
				</div>
			</div>

			<!-- Denda -->
			<div class="bg-white dark:bg-gray-800 p-4 rounded-lg h-full shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
				<div class="flex gap-4 items-center border-b-2 border-gray-300 dark:border-gray-700 border-dashed pb-4">
					<div class="flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-3xl text-violet-600">
						<i class='bx bx-money'></i>
					</div>
					<div>
						<h3 class="font-bold text-3xl text-gray-950 dark:text-white">
							{{$denda}}
						</h3>
						<p class="font-medium text-lg text-gray-600 dark:text-gray-400">
							Total Denda
						</p>
					</div>
				</div>
			</div>
		</div>

		{{-- aktivitas terakhir --}}
		<div class="bg-white dark:bg-gray-800/50 rounded-lg p-6 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20">
			<h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">
				Aktivitas Terakhir
			</h2>

			<div class="space-y-4">
				@forelse ($aktivitas as $item)
					<div class="flex items-start gap-3">

						{{-- ikon --}}
						<div class="flex items-center justify-center w-9 h-9 rounded-full bg-violet-500/20 text-violet-600">

							@if($item['type'] === 'favorit')
								<i class='bx bx-bookmark-heart'></i>
							@else
								@if($item['aksi'] == 1)
									<i class='bx bx-book-open'></i>
								@elseif($item['aksi'] == 2)
									<i class='bx bx-check-circle'></i>
								@elseif($item['aksi'] == 3)
									<i class='bx bx-x-circle'></i>
								@else
									<i class='bx bx-time'></i>
								@endif
							@endif

						</div>

						{{-- text --}}
						<div class="flex-1">
							<p class="text-sm text-gray-800 dark:text-gray-200 font-medium">

								@if($item['type'] === 'favorit')
									Menambahkan ke buku favorit
								@else
									@if($item['aksi'] == 0)
										Menunggu persetujuan peminjaman
									@elseif($item['aksi'] == 1)
										Berhasil meminjam buku
									@elseif($item['aksi'] == 2)
										Telah mengembalikan buku
									@elseif($item['aksi'] == 3)
										Peminjaman ditolak
									@endif
								@endif

								<span class="font-semibold">
									{{ $item['buku'] }}
								</span>
							</p>

							<span class="text-xs text-gray-500">
								{{ $item['waktu']->diffForHumans() }}
							</span>
						</div>

					</div>
				@empty
				<p class="text-sm text-gray-500 italic">Belum ada aktivitas</p>
				@endforelse
			</div>
		</div>

	@endcan

	

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script>
		var options = {
          series: [
			{
			name: 'Ditunda',
			data: {{json_encode($bulanTransaksi['Ditunda'])}}
			}, 
			{
			name: 'Dipinjam',
			data: {{json_encode($bulanTransaksi['Dipinjam'])}}
			}, 
			{
			name: 'Telat',
			data: {{json_encode($bulanTransaksi['Telat'])}}
			},
			{
			name: 'Kembali',
			data: {{json_encode($bulanTransaksi['Kembali'])}}
			},
			{
			name: 'Ditolak',
			data: {{json_encode($bulanTransaksi['Ditolak'])}}
			}
		  ],
          chart: {
          height: 350,
          type: 'area',
		  toolbar: {
				tools: {
					zoom: false,
					zoomin: false,
					zoomout: false,
					pan: false,
					reset: false,
					download: true   // ini hamburger menu
				}
			}
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
        },
		yaxis: {
			title: {
			text: 'Transaksi Peminjaman'
			}
		},
        tooltip: {
			y: {
			formatter: function (val) {
				return val + " Transaksi"
			}
			}
		},
		responsive: [
			{
			breakpoint: 500,
			options: {
				chart: {
				height: 300
				}
			}
			}
		]
        };

        var chart = new ApexCharts(document.querySelector("#chartTraffic"), options);
        chart.render();
	</script>
	
@endsection


























{{-- <div class="hidden flex gap-4 ">

		<div class="space-y-5 w-full md:w-3/5">
			<div class="flex gap-3">
				<div class="relative overflow-hidden p-3 bg-white dark:bg-gray-800 w-1/3 h-73 rounded-md">
					<div class="absolute -bottom-16 z-0 flex justify-center items-center bg-violet-50 dark:bg-violet-400/10 w-80 h-80 rounded-full">
						<div class="bg-violet-100 dark:bg-violet-500/15 w-52 h-52 rounded-full"></div>
					</div>

					<div class="relative z-10 flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-4xl text-violet-600">
						<i class='bx bx-book'></i>
					</div>

					<h3 class="relative text-gray-950 dark:text-white z-10 font-semibold text-8xl">5</h3>
					<h3 class="relative z-10 font-semibold text-lg text-gray-800 dark:text-gray-200
					">Buku Terlambat Dikembalikan</h3>

					<a href="{{ route('transaksi.index', ['search' => '', 'status_filter' => 'terlambat', 'order' => 'newest']) }}" class="absolute bottom-3 right-3 z-10 flex items-center gap-1 
							rounded-md bg-violet-200 px-3 py-1.5 text-sm font-medium 
							text-violet-600 hover:bg-violet-300 transition">
						Lebih Detail
						<i class='bx bx-arrow-back rotate-180 text-base'></i>
					</a>
				</div>

				<div class="relative overflow-hidden p-3 bg-white dark:bg-gray-800 w-1/3 h-73 rounded-md">

					<div class="absolute -bottom-18 -left-48 z-0 flex justify-center items-center bg-violet-50 dark:bg-violet-400/10 w-80 h-80 rounded-full">
						<div class="bg-violet-100 dark:bg-violet-500/15 w-52 h-52 rounded-full"></div>
					</div>

					<div class="relative z-10 flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-4xl text-violet-600">
						<i class='bx bx-user-voice'></i>
					</div>

					<h3 class="relative text-gray-950 dark:text-white z-10 font-semibold text-8xl">8</h3>
					<h3 class="relative z-10 font-semibold text-lg text-gray-800 dark:text-gray-200
					">Peminjam Masih Menunggu</h3>

					<a href="{{ route('transaksi.index', ['search' => '', 'status_filter' => 'tunggu', 'order' => 'newest']) }}" class="absolute bottom-3 right-3 z-10 flex items-center gap-1 
							rounded-md bg-violet-200 px-3 py-1.5 text-sm font-medium 
							text-violet-600 hover:bg-violet-300 transition">
						Lebih Detail
						<i class='bx bx-arrow-back rotate-180 text-base'></i>
					</a>
				</div>

				<div class="relative overflow-hidden p-3 bg-white dark:bg-gray-800 w-1/3 h-73 rounded-md">
					<div class="absolute -bottom-32 left-0 z-0 flex justify-center items-center bg-violet-50 dark:bg-violet-400/10 w-80 h-80 rounded-full">
						<div class="bg-violet-100 dark:bg-violet-500/15 w-52 h-52 rounded-full"></div>
					</div>

					<div class="relative z-10 flex justify-center items-center bg-violet-500/30 rounded-lg w-15 h-15 text-4xl text-violet-600">
						<i class='bx bx-trending-down'></i>
					</div>

					<h3 class="relative text-gray-950 dark:text-white z-10 font-semibold text-8xl">7</h3>
					<h3 class="relative z-10 font-semibold text-lg text-gray-800 dark:text-gray-200
					">Buku Hampir Habis</h3>

					<a href="" class="absolute bottom-3 right-3 z-10 flex items-center gap-1 
							rounded-md bg-violet-200 px-3 py-1.5 text-sm font-medium 
							text-violet-600 hover:bg-violet-300 transition">
						Lebih Detail
						<i class='bx bx-arrow-back rotate-180 text-base'></i>
					</a>

				</div>
			</div>

			<div class="w-full rounded-lg bg-white dark:bg-gray-800 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
				<h2 class="font-semibold text-xl mb-5 text-gray-800 dark:text-gray-200">Buku Paling Banyak Dipinjam</h2>
				<div class="overflow-x-auto w-full">
					<div class="flex gap-3">
						<div class="w-32 shrink-0">
							<img src="/storage/image/sampul/seraph_26.jpg" class="w-full rounded" alt="">
							<span class="font-semibold text-sm text-gray-600 dark:text-gray-300">Seraph of Reight...</span>
						</div>
						<div class="w-32 shrink-0">
							<img src="/storage/image/sampul/seraph_26.jpg" class="w-full rounded" alt="">
							<span class="font-semibold text-sm text-gray-600 dark:text-gray-300">Seraph of Reight...</span>
						</div>
						<div class="w-32 shrink-0">
							<img src="/storage/image/sampul/seraph_26.jpg" class="w-full rounded" alt="">
							<span class="font-semibold text-sm text-gray-600 dark:text-gray-300">Seraph of Reight...</span>
						</div>
						<div class="w-32 shrink-0">
							<img src="/storage/image/sampul/seraph_26.jpg" class="w-full rounded" alt="">
							<span class="font-semibold text-sm text-gray-600 dark:text-gray-300">Seraph of Reight...</span>
						</div>
						<div class="w-32 shrink-0">
							<img src="/storage/image/sampul/seraph_26.jpg" class="w-full rounded" alt="">
							<span class="font-semibold text-sm text-gray-600 dark:text-gray-300">Seraph of Reight...</span>
						</div>
						<div class="w-32 shrink-0">
							<img src="/storage/image/sampul/seraph_26.jpg" class="w-full rounded" alt="">
							<span class="font-semibold text-sm text-gray-600 dark:text-gray-300">Seraph of Reight...</span>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="w-full md:w-2/5 rounded-lg bg-white dark:bg-gray-800 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20  p-3 sm:p-6">
			<h2 class="font-semibold text-xl mb-3 text-gray-800 dark:text-gray-200">Buku Populer</h2>
			
			<div class="block">
				@foreach ($bukuPopuler as $item)
					<div class="flex gap-2 border-b border-gray-600 p-2 h-full">
						<img src="{{ asset('/storage/image/sampul/' . $item->sampul) }}" class="w-20 rounded-sm" alt="">
						<div class="relative flex flex-col justify-center gap-1">
							<h3 class="font-medium text-gray-800 dark:text-gray-200
							 text-md">{{$item->judul_buku}}</h3>
							<span class="px-2 py-0.5 rounded font-semibold text-xs bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 w-fit">{{$item->kode_buku}}</span>
							<span class="font-medium text-xs text-gray-600 dark:text-gray-400">Stok: {{$item->stok}}</span>
							<a href="{{ route('buku.show', $item->id_buku) }}" class="absolute bottom-0 right-0
							flex gap-1 text-gray-600 dark:text-gray-400">
								<span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Lebih Detail</span>
								<i class='bx bx-arrow-back rotate-180 text-xl'></i>
							</a>
						</div>
					</div>
				@endforeach
				
			</div>
		</div>
	</div> --}}