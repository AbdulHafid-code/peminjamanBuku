@props([
    'searchPlaceholder' => 'Cari Data...',
    'showKategori' => false,
    'kategori' => [],
    'showRole' => false,
    'role' => [],
    'showTransaksi' => false,
])

    <div class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-4 mb-4">
		<form action="" method="GET" class="flex flex-col sm:flex-row justify-between items-center gap-2">

        {{-- sort jumlah --}}
        <div class="hidden relative flex items-center text-gray-600 dark:text-gray-400">
            <h3>Sort:</h3>
            <select class="bg-gray-200/60 dark:bg-gray-900 text-gray-950 dark:text-gray-50 py-2 px-6 rounded mx-1 focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-600 outline-none">
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>30</option>
            </select>
            <h3>Data</h3>
        </div>
        <div></div>

        <div class="flex flex-col md:flex-row sm:flex-wrap gap-2 justify-end items-center">

            {{-- search --}}
            <div class="relative flex items-center">
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ $searchPlaceholder }}"
                    class="bg-gray-200/60 dark:bg-gray-900 dark:text-white py-2 pl-10 rounded focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-600 outline-none"
                >
                <button class="absolute left-0 p-3 text-lg text-gray-600 dark:text-gray-400">
                    <i class='bx bx-search'></i>
                </button>
            </div>

            <div class="flex gap-3 items-center">

                {{-- kategori (optional) --}}
                @if($showKategori)
                    <div class="relative text-gray-600 dark:text-gray-400">
                        <select name="kategori" onchange="this.form.submit()"
                            class="py-2 bg-gray-200/60 dark:bg-gray-900 dark:text-gray-50 pl-7 pr-10 rounded outline-none appearance-none focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700">
                            <option value="">Semua</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}"
                                    {{ request('kategori') == $item->id_kategori ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <i class='bx bx-filter-alt absolute right-3 bottom-1.5 text-2xl'></i>
                    </div>
                @elseif ($showRole)
                    <div class="relative w-fit text-gray-600 dark:text-gray-400">
						<select name="role" id="role" onchange="this.form.submit()" class="py-2 bg-gray-200/60 dark:bg-gray-900 dark:text-gray-50 text-gray-950 pl-7 pr-10 rounded appearance-none outline-none focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700">
							<option value="">Semua</option>
							@foreach ($role as $item)
								<option value="{{$item->id_role}}" {{request('role') == $item->id_role ? 'selected' : '' }}>{{$item->role}}</option>
							@endforeach
						</select>
						<i class='bx bx-filter-alt absolute right-3 bottom-1.5 text-2xl'></i>
					</div>
                @elseif($showTransaksi)
                    <div class="relative w-fit text-gray-600 dark:text-gray-400">
						<select name="status_filter" id="status_filter" onchange="this.form.submit()" class="py-2 bg-gray-200/60 dark:bg-gray-900 dark:text-gray-50 text-gray-950 pl-7 pr-10 rounded appearance-none outline-none focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-700">
							<option  value="">Semua</option>
							<option  value="tunggu" {{request('status_filter') == 'tunggu' ? 'selected' : '' }}>Tunggu</option>
							<option  value="dipinjam" {{request('status_filter') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
							<option  value="terlambat" {{request('status_filter') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
							<option  value="dikembalikan" {{request('status_filter') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
							<option  value="ditolak" {{request('status_filter') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
						</select>
						<i class='bx bx-filter-alt absolute right-3 bottom-1.5 text-2xl'></i>
					</div>
                @endif

                {{-- reset --}}
                <div class="relative hidden lg:flex justify-center items-center bg-gray-200/60 dark:bg-gray-900 p-3 rounded cursor-pointer">
                    <button type="submit" name="reset" value="1">
                        <i class="bx bx-refresh text-2xl text-gray-950 dark:text-gray-50"></i>
                    </button>
                </div>

                {{-- order --}}
                <div class="relative text-gray-600 dark:text-gray-400">
                    <select name="order" onchange="this.form.submit()"
                        class="py-2 bg-gray-200/60 dark:bg-gray-900 dark:text-gray-50 px-5 rounded outline-none focus:ring-2 focus:ring-violet-300 dark:focus:ring-violet-600">
                        <option value="asc" {{request('order') == 'asc' ? 'selected' : '' }}>A - Z</option>
                        <option value="desc" {{request('order') == 'desc' ? 'selected' : '' }}>Z - A</option>
                        <option value="newest" {{request('order') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{request('order') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>

            </div>
        </div>
    </form>
</div>
