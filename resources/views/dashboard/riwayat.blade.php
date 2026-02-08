@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Riwayat Transaksi
@endsection

@section('content')
    <div class="title-container">
        <div>
            <h1 class="title">Riwayat Transaksi</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
                <li><a href="#" class="active">Riwayat</a></li>
            </ul>
        </div>
    </div>

    {{-- alert --}}
	<x-alert-success-error :session="session('success')"/>
	<x-alert-success-error type='error' :session="session('error')"/>

    {{-- filter bar --}}
	<x-filter-bar :searchPlaceholder="'Cari Riwayat Pinjam...'"/> 

    @foreach ($transaksi as $transaksi)
        <div class="relative bg-white dark:bg-gray-800/50 rounded-lg py-5 pl-5 pr-8 mb-5 flex flex-col md:flex-row justify-start md:items-center shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 gap-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            
            @php
                $sisa = $transaksi->total_pinjam - $transaksi->jumlah_dikembalikan;
            @endphp

            {{-- ketika selesai --}}
            @if($sisa <= 0 || in_array($transaksi->status, [3,2]))
                <span class="absolute flex items-center gap-2 top-0 right-0 bg-green-500 p-2.5 rounded-tl-lg rounded-br-lg text-white font-semibold">
                    <i class="bx bx-check-circle"></i> <span class="hidden sm:block">Selesai</span>
                </span>
            {{-- masih pending --}}
            @elseif($transaksi->status == 0) 
                <span class="absolute flex items-center gap-2 top-0 right-0 bg-violet-600 p-2.5 rounded-tl-lg rounded-br-lg text-white font-semibold">
                    <i class="bx bx-check-circle"></i> <span class="hidden sm:block">Proses</span>
                </span>
            {{-- membatalkan --}}
            @elseif(($sisa === 1 && !is_null($transaksi->pengajuan_kembali) || ($sisa - $transaksi->pengajuan_kembali === 0)))
                <form action="{{ route('membatalkan', $transaksi->id_transaksi) }}" method="POST"
                    class="absolute top-0 right-0 bg-red-500 p-2.5 rounded-tl-lg rounded-br-lg">
                    @csrf
                    <button type="submit" class="text-base font-semibold text-white flex items-center gap-2 ">
                        <i class="bx bx-x-circle"></i> <span class="hidden sm:block">Batalkan</span>
                    </button>
                </form>

            {{-- menunggu --}}
            @elseif(!is_null($transaksi->pengajuan_kembali))
                <button type="button"
                    class="absolute flex items-center gap-2 top-0 right-0 bg-slate-400 p-2.5 rounded-tl-lg rounded-br-lg text-base font-semibold text-violet-800 cursor-not-allowed"
                    onclick="openReturnModal(
                        {{ $transaksi->id_transaksi }},
                        {{ $transaksi->total_pinjam }},
                        {{ $transaksi->jumlah_dikembalikan }},
                        {{ $transaksi->pengajuan_kembali }}
                    )">
                    <i class="bx bx-time"></i> <span class="hidden sm:block">Tunggu</span>
                </button>

            {{-- jika masih banyak --}}
            @elseif($sisa > 1)
                <button type="button"
                    class="absolute flex items-center gap-2 top-0 right-0 bg-violet-600 p-2.5 rounded-tl-lg rounded-br-lg text-base font-semibold text-gray-50"
                    onclick="openReturnModal(
                        {{ $transaksi->id_transaksi }},
                        {{ $transaksi->total_pinjam }},
                        {{ $transaksi->jumlah_dikembalikan ?? 0 }},
                        0
                    )">
                    <i class="bx bx-paper-plane"></i> <span class="hidden sm:block">Kembalikan</span>
                </button>
            {{-- SISA 1 → LANGSUNG KIRIM --}}
            @elseif($sisa === 1)
                <form action="{{ route('mengajukan', $transaksi->id_transaksi) }}" method="POST"
                    class="absolute top-0 right-0 bg-violet-600 p-2.5 rounded-tl-lg rounded-br-lg">
                    @csrf
                    <input type="hidden" name="pengajuan_kembali" value="1">
                    <button type="submit" class="text-base font-semibold text-gray-50 flex items-center gap-2 ">
                        <i class="bx bx-paper-plane"></i> <span class="hidden sm:block">Kembalikan</span>
                    </button>
                </form>
            @elseif($transaksi->status != 3)
                <span class="absolute flex items-center gap-2 top-0 right-0 bg-green-500 p-2.5 rounded-tl-lg rounded-br-lg text-white font-semibold">
                    <i class="bx bx-check-circle"></i> <span class="hidden sm:block">Selesai</span>
                </span>
            @endif    

            <!-- sampul buku -->
            <img src="{{ asset('storage/image/sampul/' . $transaksi->buku->sampul) }}" 
                class="w-20 sm:w-24 md:w-28 lg:w-32 rounded" 
                alt="Sampul Buku">

            <!-- info buku -->
            <div class="flex flex-col bottom-5 left-5 text-gray-950 dark:text-gray-50 w-full">

                <h4 class="text-base md:text-lg font-semibold">
                    {{ $transaksi->buku->judul_buku }}
                </h4>

                <div class="flex flex-wrap items-center gap-2 mt-1">
                    <span class="inline-block text-xs font-medium bg-violet-100 text-violet-600 dark:bg-violet-900/45 dark:text-violet-400 px-2 py-1 rounded">
                        {{ $transaksi->buku->kode_buku }}
                    </span>

                    <span class="inline-block text-sm font-medium text-violet-600">
                        {{ $transaksi->buku->kategori->nama_kategori }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3 mt-3 text-xs md:text-sm">
                    <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                        <p class="text-gray-500">Tgl Pinjam</p>
                        <p class="font-medium text-gray-900 dark:text-gray-50">
                            {{ $transaksi->tanggal_pinjam->translatedFormat('d M Y') }}
                        </p>
                    </div>

                    <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                        <p class="text-gray-500">Tgl Kembali</p>
                        <p class="font-medium text-gray-900 dark:text-gray-50">
                            {{ $transaksi->tanggal_kembali->translatedFormat('d M Y') }}
                        </p>
                    </div>

                    <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                        <p class="text-gray-500">Status</p>
                        <p class="font-bold text-violet-700 dark:text-violet-600">
                            {{ $transaksi->status_label }}
                        </p>
                    </div>

                    <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                        <p class="text-gray-500">Jumlah</p>
                        <p class="font-medium text-gray-900 dark:text-gray-50">
                            {{ $transaksi->total_pinjam }} Buku
                        </p>
                    </div>

                    <!-- card tambahan -->
                    <div class="w-full p-4 bg-gray-100 dark:bg-gray-800 rounded">
                        <p class="text-gray-500">Dikembalikan</p>
                        <p class="font-medium text-gray-900 dark:text-gray-50">
                            {{$transaksi->jumlah_dikembalikan ?? '0'}} Buku
                        </p>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

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

            <!-- close -->
            <button onclick="closeReturnModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <i class='bx bx-x text-2xl'></i>
            </button>

            <!-- header -->
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Kembalikan Buku
                </h2>
                <p id="desc" class="text-sm text-gray-500 dark:text-gray-300 mt-1"></p>
            </div>

            <form id="returnForm" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                        Jumlah dikembalikan
                    </label>
                    <input
                        type="number"
                        id="pengajuan_kembali"
                        name="pengajuan_kembali"
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
        function openReturnModal(transaksiId, totalPinjam, jumlahDikembalikan, pengajuanKembali) {
            const modal = document.getElementById('returnModal');
            const box = document.getElementById('modalBox');
            const form = document.getElementById('returnForm');
            const input = document.getElementById('pengajuan_kembali');
            const desc = document.getElementById('desc');

            // Set action form sesuai transaksi
            form.action = `/dashboard/pengajuan_kembali/${transaksiId}`;
            
            if (pengajuanKembali && pengajuanKembali > 0) {
                desc.innerText = `Sedang mengajukan ${pengajuanKembali} pengembalian buku`;
            } else {
                desc.innerText = 'Masukkan jumlah buku yang ingin dikembalikan';
            }

            input.max = totalPinjam;
            if (!jumlahDikembalikan) {
                input.value = totalPinjam;
            } else {
                input.value = totalPinjam - jumlahDikembalikan; // default semua dikembalikan
                // if (!pengajuanKembali) {
                //     // input.max = totalPinjam - jumlahDikembalikan;
                //     input.value = totalPinjam - jumlahDikembalikan; // default semua dikembalikan
                // } else {
                //     // input.max = totalPinjam - jumlahDikembalikan - pengajuanKembali;
                //     input.value = totalPinjam - jumlahDikembalikan - pengajuanKembali;
                // }
            }

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