@extends('home.layouts.main')

@section('title')
    Halaman Buku
@endsection

@section('container')

    <section id="materi" class="pt-30">
        <div class="flex items-center flex-col text-center">
            <h1 class="text-2xl min-[420px]:text-3xl md:text-4xl font-semibold text-gray-900 dark:text-gray-100">
                Cari Buku Yang Mau Dibaca
            </h1>
            <p class="text-[12px] min-[420px]:text-[13px] md:text-[15px] mt-2 text-gray-700 dark:text-gray-300">
                Temukan dan pinjam buku sesuai minatmu dengan mudah, lalu nikmati pengalaman membaca yang nyaman dan teratur.
            </p>

            {{-- search --}}
            <form action="" method="GET" id="form_search_buku" class="mt-6 w-2/3">
                <div class="flex items-center gap-2 bg-white/80 dark:bg-gray-800 backdrop-blur rounded-full px-4 py-2 shadow-md transition-all duration-300 focus-within:ring-2 focus-within:ring-violet-400">

                    <div class="relative flex items-center w-full">
                        <i class='bx bx-search-alt-2 absolute left-3 text-gray-400 text-lg'></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari Buku Berdasarkan Nama..."
                            class="w-full bg-transparent pl-10 pr-4 py-2 text-sm md:text-base
                                outline-none text-gray-800 placeholder-gray-400"
                        >
                    </div>

                    {{-- dekstop --}}
                    <button type="submit" class="hidden md:flex items-center justify-center px-6 py-2 rounded-full bg-violet-600 text-white font-medium hover:bg-violet-700 transition">
                        Cari
                    </button>
                </div>

                <input type="hidden" name="kategori" id="kategori_input" value="{{ request('kategori') }}">

            </form>

            {{-- kategori --}}
            <div class="mt-4 w-2/3 flex flex-wrap items-center gap-3
                        bg-white/70 dark:bg-gray-800 backdrop-blur px-4 py-3 rounded-xl shadow-sm">

                <button id="plus_kategori"
                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs md:text-sm
                        rounded-full bg-violet-600 text-white hover:bg-violet-700 transition">
                    <i class="bx bx-plus"></i>
                </button>

                <div id="kategori_search_konten" class="text-xs md:text-sm text-gray-600">
                    Belum Ada Kategori Dipilih
                </div>

                <button id="delete_all_kategori"
                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs md:text-sm
                        rounded-full bg-red-500 text-white hover:bg-red-600 transition ml-auto">
                    <i class='bx bxs-trash'></i>
                    <span>Hapus</span>
                </button>
            </div>

            {{-- btn mobile --}}
            <div class="mt-5 flex justify-center md:hidden">
                <button
                    type="submit"
                    form="form_search_buku"
                    class="px-10 py-2.5 rounded-full bg-violet-600 text-white font-medium
                        shadow-md hover:bg-violet-700 transition">
                    Cari Buku
                </button>
            </div>
        </div>

        {{-- card bukunya --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 mt-8">
            @foreach ($buku as $item)
                <a href="{{route('buku_detail', $item->id_buku)}}" class="group block w-full rounded-md backdrop-blur bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            
                    {{-- sampul --}}
                    <div class="relative overflow-hidden rounded-t-md aspect-4/5 p-4">
                        <img
                            src="{{ asset('storage/image/sampul/' . $item->sampul) }}"
                            alt="Cover Buku"
                            class="h-full w-full object-cover rounded-md border border-gray-200 dark:border-gray-800"
                        />
                    </div>
            
                    {{-- detail --}}
                    <div class="px-4 pb-4">
                        {{-- status --}}
                        <span class="rounded-full {{$item->stok <= 0 ? 'bg-red-500/90' : 'bg-emerald-500/90'}} px-3 py-1 text-xs font-medium text-white shadow">
                            {{$item->stok <= 0 ? 'Habis' : 'Tersedia'}}
                        </span>

                        <h3 class="mt-1 text-base font-semibold text-gray-900 dark:text-gray-100 leading-snug line-clamp-2">
                            {{$item->judul_buku}}
                        </h3>
            
                        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                            {{$item->penulis}}
                        </p>
            
                            {{-- stok --}}
                            <div class="mt-4 flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                Stok: <span class="font-semibold">{{$item->stok}}</span>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- modal kategori --}}
    <div id="modalKategori"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="bg-white dark:bg-gray-800 rounded-xl w-[90%] max-w-md p-5 animate-scaleIn">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    Pilih Kategori
                </h3>
                <button id="closeModalKategori"
                    class="text-gray-400 hover:text-gray-700 text-xl">
                    <i class="bx bx-x"></i>
                </button>
            </div>

            <div class="flex flex-wrap gap-2 max-h-[300px] overflow-y-auto">
               @foreach ($kategori as $item)
                    <button
                        type="button"
                        data-id="{{ $item->id_kategori }}"
                        class="kategori-chip px-4 py-1.5 rounded-full text-xs md:text-sm
                        bg-violet-100 text-violet-700
                        hover:bg-violet-600 hover:text-white
                        dark:bg-violet-900/40 dark:text-violet-200
                        dark:hover:bg-violet-600 dark:hover:text-white
                        transition">
                        {{ $item->nama_kategori }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- script kategori single --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const kategoriButtons = document.querySelectorAll('.kategori-chip');
            const kategoriInput   = document.getElementById('kategori_input');
            const kategoriKonten  = document.getElementById('kategori_search_konten');
            const formSearch      = document.querySelector('form'); // form search

            // ===== MODAL =====
            const modal        = document.getElementById('modalKategori');
            const btnPlus      = document.getElementById('plus_kategori');
            const btnClose     = document.getElementById('closeModalKategori');
            const btnDeleteAll = document.getElementById('delete_all_kategori');

            /* =========================
            OPEN / CLOSE MODAL
            ========================== */
            btnPlus?.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

            btnClose?.addEventListener('click', () => {
                closeModal();
            });

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            /* =========================
            PILIH KATEGORI (SINGLE)
            ========================== */
            kategoriButtons.forEach(btn => {
                btn.addEventListener('click', () => {

                    // reset semua kategori
                    kategoriButtons.forEach(b => {
                        b.classList.remove('bg-violet-600', 'text-white');
                        b.classList.add('bg-gray-200', 'text-gray-700');
                    });

                    // aktifkan kategori terpilih
                    btn.classList.remove('bg-gray-200', 'text-gray-700');
                    btn.classList.add('bg-violet-600', 'text-white');

                    // set hidden input
                    kategoriInput.value = btn.dataset.id;

                    // tampilkan kategori terpilih
                    kategoriKonten.innerHTML = `
                        <span class="px-3 py-1 rounded-full bg-violet-100 text-violet-700">
                            ${btn.innerText}
                        </span>
                    `;

                    // tutup modal
                    closeModal();

                    // ===== AUTO SUBMIT (OPSIONAL) =====
                    // kalau mau langsung search setelah pilih kategori
                    formSearch.submit();
                });
            });

            /* =========================
            HAPUS KATEGORI
            ========================== */
            btnDeleteAll?.addEventListener('click', () => {
                kategoriButtons.forEach(b => {
                    b.classList.remove('bg-violet-600', 'text-white');
                    b.classList.add('bg-gray-200', 'text-gray-700');
                });

                kategoriInput.value = '';
                kategoriKonten.innerHTML = 'Belum Ada Kategori Dipilih';

                // submit ulang tanpa kategori (opsional)
                formSearch.submit();
            });

            /* =========================
            PERSIST KATEGORI (RELOAD)
            ========================== */
            const selectedKategori = "{{ request('kategori') }}";

            if (selectedKategori) {
                kategoriButtons.forEach(btn => {
                    if (btn.dataset.id === selectedKategori) {
                        btn.classList.remove('bg-gray-200', 'text-gray-700');
                        btn.classList.add('bg-violet-600', 'text-white');

                        kategoriKonten.innerHTML = `
                            <span class="px-3 py-1 rounded-full bg-violet-100 text-violet-700">
                                ${btn.innerText}
                            </span>
                        `;
                    }
                });

                // pastikan input hidden tetap keisi
                kategoriInput.value = selectedKategori;
            }

        });
        </script>




@endsection