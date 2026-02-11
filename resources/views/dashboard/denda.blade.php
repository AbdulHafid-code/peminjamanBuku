@extends('dashboard.layouts.main')

@section('title') 
  Dashboard | Denda Terlambat
@endsection

@section('content')
    <div class="title-container">
        <div>
            <h1 class="title">Denda Terlambat</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
                <li><a href="#" class="active">Denda</a></li>
            </ul>
        </div>
    </div>

    {{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

    {{-- filter bar --}}
	<x-filter-bar :searchPlaceholder="'Cari Denda Terlambat...'"/> 

    @can('admin')
        <div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
            <table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="text-sm text-gray-600 dark:text-gray-400">
                    <tr>
                        <th class="text-left px-1.5 sm:px-4 py-2">No</th>
                        <th class="text-left px-1.5 sm:px-4 py-2">Buku</th>
                        <th class="text-center px-1.5 sm:px-4 py-2">Pengguna</th>
                        <th class="text-left px-1.5 sm:px-4 py-2 hidden lg:table-cell">Total Denda</th>
                        <th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Total Bayar</th>
                        <th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Status Denda</th>
                        <th class="text-center px-1.5 sm:px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
                    @forelse ($semuaDenda as $item)
                        <tr>
                            <td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
                            <td class="flex items-center px-1.5 sm:px-4 py-2 gap-2 ">
                                <img src="{{ asset('storage/image/sampul/' . $item->transaksi->buku->sampul) }}" class="w-17.5 h-25 shrink-0 hidden md:block rounded-sm object-cover"/>
                                <div class="flex flex-col gap-1">
                                    <span class="line-clamp-2">
                                        {{ mb_strimwidth($item->transaksi->buku->judul_buku, 0, 40, '...') }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded font-semibold text-xs bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 w-fit">{{$item->transaksi->buku->kode_buku}}</span>
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
                            <td class="px-1.5 sm:px-4 py-2 hidden lg:table-cell">Rp. {{$item->total_denda - $item->total_dibayar}}</td>
                            <td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">Rp. {{$item->total_dibayar ?? '0'}}</td>
                            <td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->status_denda}}</td>
                            <td class="px-1.5 sm:px-4 py-2 align-middle">
                                <div class="flex justify-center gap-2 font-normal text-sm">
                                    <button 
                                        type="button"
                                        onclick='openReturnModal(
                                            {{ $item->id_pembayaran_denda }},
                                            {{ $item->total_denda - ($item->total_dibayar ?? 0) }}
                                        )'
                                        class="rounded-sm bg-violet-600 px-5 py-2 text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2">
                                        <i class='bx bx-money'></i> Bayar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                                Data Denda Kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>  
    @endcan

    @can('user')
        <div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6">
            <table class="border-collapse w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="text-sm text-gray-600 dark:text-gray-400">
                    <tr>
                        <th class="text-left px-1.5 sm:px-4 py-2">No</th>
                        <th class="text-left px-1.5 sm:px-4 py-2">Buku</th>
                        <th class="text-left px-1.5 sm:px-4 py-2 hidden lg:table-cell">Total Denda</th>
                        <th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Total Bayar</th>
                        <th class="text-left px-1.5 sm:px-4 py-2 hidden md:table-cell">Status Denda</th>
                        {{-- <th class="text-center px-1.5 sm:px-4 py-2">Bayar</th> --}}
                    </tr>
                </thead>
                <tbody class="text-sm sm:text-base font-medium divide-y divide-gray-300 dark:divide-gray-700 text-gray-950 dark:text-gray-50">
                    @forelse ($denda as $item)
                        <tr>
                            <td class="px-1.5 sm:px-4 py-2">{{$loop->iteration}}.</td>
                            <td class="flex items-center px-1.5 sm:px-4 py-2 gap-2 ">
                                <img src="{{ asset('storage/image/sampul/' . $item->transaksi->buku->sampul) }}" class="w-17.5 h-25 shrink-0 hidden md:block rounded-sm object-cover"/>
                                <div class="flex flex-col gap-1">
                                    <span class="line-clamp-2">
                                        {{ mb_strimwidth($item->transaksi->buku->judul_buku, 0, 40, '...') }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded font-semibold text-xs bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 w-fit">{{$item->transaksi->buku->kode_buku}}</span>
                                </div>
                            </td>
                            <td class="px-1.5 sm:px-4 py-2 hidden lg:table-cell">Rp. {{$item->total_denda}}</td>
                            <td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">Rp. {{$item->total_bayar ?? '0'}}</td>
                            <td class="px-1.5 sm:px-4 py-2 hidden md:table-cell">{{$item->status_denda}}</td>
                            {{-- <td class="px-1.5 sm:px-4 py-2 align-middle">
                                <div class="flex justify-center gap-2 font-normal text-sm">
                                    <x-button-detail :href=""></x-button-detail>
                                    <x-button-edit :href="" :edit='true'></x-button-edit>
                                    <x-button-delete :action="" :trash="true" dataPesan="Apakah Anda Yakin Ingin Menghapus Data Buku {{$item->judul_buku}}"></x-button-delete>
                                </div>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="py-3 text-gray-600 dark:text-gray-400 text-center">
                                Data Denda Kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>  
    @endcan




    {{-- modalll --}}
    <div id="returnModal"
        class="fixed inset-0 z-50 flex items-center justify-center pl-17 pr-2 sm:px-4
            bg-black/20 backdrop-blur-sm
            opacity-0 pointer-events-none
            transition-opacity duration-300 ease-out">

        <div id="modalBox"
            class="w-full max-w-md bg-gray-50 dark:bg-gray-800 rounded-xl shadow-2xl 
                p-6 sm:p-8 relative
                scale-95 translate-y-6
                transition-all duration-300 ease-out">

            {{-- close  --}}
            <button onclick="closeReturnModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <i class='bx bx-x text-2xl'></i>
            </button>

            {{-- close  --}}
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Bayar Denda
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">Masukkan Jumlah Pembayaran Sebagai Kompensasi Terlambat Mengembalikan</p>
            </div>

            <form id="returnForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <input type="hidden" name="transaksi_id" id="transaksi_id">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                        Jumlah Pembayaran
                    </label>
                    <input
                        type="number"
                        id="pembayaran"
                        name="pembayaran"
                        min="1"
                        class="w-full rounded-xl border text-gray-900 dark:text-gray-50 border-gray-300 px-4 py-2.5
                            focus:ring-2 focus:ring-sky-400 focus:border-sky-400
                            transition outline-none">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="submit" class="rounded-sm bg-violet-600 px-5 py-2 text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2">
                        <i class='bx bx-paper-plane'></i> Kirim
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openReturnModal(transaksiId, totalDenda) {
            const modal = document.getElementById('returnModal');
            const box = document.getElementById('modalBox');
            const form = document.getElementById('returnForm');
            const pembayaran = document.getElementById('pembayaran');
            const transaksiInput = document.getElementById('transaksi_id');

            transaksiInput.value = transaksiId;
            pembayaran.value = totalDenda;
            pembayaran.max = totalDenda;

            form.action = `/dashboard/denda/${transaksiId}`;

            modal.classList.remove('opacity-0','pointer-events-none');
            box.classList.remove('scale-95','translate-y-6');
        }

        function closeReturnModal() {
            const modal = document.getElementById('returnModal');
            const box = document.getElementById('modalBox');

            modal.classList.add('opacity-0','pointer-events-none');
            box.classList.add('scale-95','translate-y-6');
        }
    </script>


@endsection