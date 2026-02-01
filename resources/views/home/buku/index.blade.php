@extends('home.layouts.main')

@section('title')
    Halaman Buku
@endsection

@section('navbar')
  @include('home.layouts.navbar-page')
@endsection

@section('container')


    <!-- MATERI SECTION -->
    <section id="materi" class="pt-30">
      <div class="flex items-center flex-col">
            <h1 class="text-2xl min-[420px]:text-3xl min-[570px]:text-3xl md:text-4xl font-fredoka font-semibold text-center">
                Cari Buku Yang Mau Dibaca
            </h1>
            <p class="text-[12px] min-[420px]:text-[13px] min-[570px]:text-sm md:text-[15px] text-center mt-2">
                Temukan dan pinjam buku sesuai minatmu dengan mudah, lalu nikmati pengalaman membaca yang nyaman dan teratur.
            </p>

            <form action="" id="form_search_buku" class="searchingtext kategoripage">
                <div>
                    <i class='bx bx-search-alt-2' ></i>
                    <input type="text" value="{{Request('search')}}" name="search" placeholder="Cari Buku Berdasarkan Nama...">
                </div>
                <input type="hidden" id="kategori_input" name="kategori">
                <button id="btn_pencarian">Cari Buku</button>
            </form>
            <div class="searchingkategori">
                <button id="plus_kategori"><i class="bx bx-plus"></i></button>
                <div id="kategori_search_konten">
                    <p>Belum Ada Kategori Dipilih</p>
                </div>
                <button id="delete_all_kategori"><i class='bx bxs-trash'></i> <span>Hapus</span></button>
            </div>
        </div>
        <div class="btn_pencarian_bawah">
            <button id="btn_pencarian">Cari Buku</button>
        </div>

      <div class="flex flex-wrap mt-8 gap-5 items-center justify-center">
        @foreach ($buku as $buku)
        
          <a href="{{ route('buku_detail', $buku->id_buku) }}" class="group block w-[280px] rounded-2xl bg-white/80 backdrop-blur shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
      
              <!-- Cover -->
              <div class="relative overflow-hidden rounded-t-2xl aspect-[4/5] bg-gray-100">
                  <img
                      src="{{ asset('storage/image/sampul/' . $buku->sampul) }}"
                      alt="Cover Buku"
                      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                  />
      
                  <!-- Status Badge -->
                  <span class="absolute top-3 right-3 rounded-full {{ $buku->stok <= 0 ? 'bg-red-500/90' : 'bg-emerald-500/90' }} 
                              px-3 py-1 text-xs font-medium text-white shadow">
                      {{ $buku->stok <= 0 ? 'Tidak Tersedia' : 'Tersedia' }}
                  </span>
              </div>
      
              <!-- Content -->
              <div class="p-4">
                  <h3 class="text-[15px] font-semibold text-gray-900 leading-snug line-clamp-2">
                      {{ $buku->judul_buku }}
                  </h3>
      
                  <p class="mt-1 text-xs text-gray-500">
                      {{ $buku->penulis }}
                  </p>
      
                  <!-- Footer -->
                  <div class="mt-4 flex items-center justify-between">
                      <span class="text-xs font-medium text-gray-600">
                          Stok: <span class="text-gray-900 font-semibold">{{ $buku->stok }}</span>
                      </span>
                  </div>
              </div>
          </a>
        @endforeach
      </div>
    </section>

    <div class="search_kategori_modal">
        <button type="button" id="tutup_kategori_modal"><i class="bx bx-x text-3xl"></i></button>
        <h3>Cari Kategori Buku</h3>
        <p>Klik Untuk Memilih Kategori Buku</p>
        <p class="text-error-modal-kategori hidden">Sudah Terdapat Kategori</p>

        <form class="search_modal">
            <div>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari Kategori Berdasarkan Nama...">
            </div>
            <button>Cari Kategori</button>
        </form>
        
        <ul id="list_kategori_content">
        </ul>
    </div>
    <div class="bgblur"></div>

    <script>
        window.allKategori = @json($kategori ?? []);
        const bgblur = document.querySelector(".bgblur");
        const kategori_modal = document.querySelector(".search_kategori_modal");
        const tutup_kategori_modal = document.querySelector("#tutup_kategori_modal");
        const plusKategori = document.querySelector("#plus_kategori");
        const kategoriItems = document.querySelectorAll(".search_kategori_modal ul li");
        const delete_all_kategori = document.querySelector("#delete_all_kategori");
        const text_error_modal_kategori = document.querySelector(".text-error-modal-kategori");
        const kategoriContainer = document.querySelector("#kategori_search_konten");
        const kategoriInput = document.querySelector("#kategori_input");
        const list_kategori_content = document.querySelector('#list_kategori_content');
        const btn_pencarian = document.querySelectorAll('#btn_pencarian');
        const MAX_KATEGORI = 1;
        let selectedKategories = [];

        btn_pencarian.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault;
                document.querySelector("#form_search_buku").submit();
            });
        });

        window.allKategori.forEach((kategori) => {
            list_kategori_content.innerHTML += `<li data-id="${kategori.id_kategori}">
                <h5>${kategori.nama_kategori}</h5>
                <p>Jumlah Buku : <span>${kategori.buku_count}</span></p>
            </li>`;
        })

        // Tangkap Params Kategori
        const params = new URLSearchParams(window.location.search);
        const kategoriParam = params.get("kategori");

        // KATEGORI SEARCH
        plusKategori.addEventListener("click", () => {
            text_error_modal_kategori.classList.add("hidden");
            bgblur.classList.add("active");
            kategori_modal.classList.add("active");
        })
        tutup_kategori_modal.addEventListener("click", () => {
            kategori_modal.classList.remove("active");
            setTimeout(() => {
                bgblur.classList.remove("active");
            }, 500);
        })

        function renderKategori() {
            kategoriContainer.innerHTML = "";

            if(selectedKategories.length === 0) {
                kategoriContainer.innerHTML = "<p>Belum Ada Kategori Dipilih</p>"
            } else {
                selectedKategories.forEach((k, i) => {
                    const wrap = document.createElement("div");
                    wrap.innerHTML = `<span>${k.nama}</span>
                        <i class="bx bx-x hapus_kategori"></i>`;
            
                    wrap.querySelector(".hapus_kategori").addEventListener("click", () => {
                        selectedKategories.splice(i, 1);
                        renderKategori();
                    });
            
                    kategoriContainer.appendChild(wrap);
                });
            }

            // UPDATE hidden input → 1,2,3
            kategoriInput.value = selectedKategories
                                    .map(k => k.id)
                                    .join(",");


            if (selectedKategories.length >= MAX_KATEGORI) {
                plusKategori.setAttribute("disabled", true);
                plusKategori.classList.add("disabled");
            } else {
                plusKategori.removeAttribute("disabled");
                plusKategori.classList.remove("disabled");
            }
        }

        if(kategoriParam) {
            console.log(window.allKategori);
            const ids = kategoriParam.split(",").map(Number);

            ids.forEach(id => {
                const found = window.allKategori.find(k => k.id_kategori == id);

                if(found) {
                    selectedKategories.push({
                        id: found.id_kategori,
                        nama: found.nama_kategori
                    });
                }
            });

            renderKategori();
        }

        // EVENT Ketika LI diklik
        list_kategori_content.addEventListener('click', (e) => {
            const items = e.target.closest("li");
            if (!items) return;
            
            const namaKategori = items.querySelector("h5").innerText;
            const idKategori = items.dataset.id;

            // Cek Duplicate
            if(selectedKategories.some(k => k.id == idKategori)) {
                text_error_modal_kategori.innerText = "Kategori Sudah Dipilih";
                text_error_modal_kategori.classList.remove("hidden");
                return;
            }

            // Maksimal 3 Kategori
            if(selectedKategories.length > MAX_KATEGORI) {
                text_error_modal_kategori.innerText = "Sudah Terdapat 1 Kategori";
                text_error_modal_kategori.classList.remove("hidden");
                return;
            }

            selectedKategories.push({
                id: Number(idKategori),
                nama: namaKategori
            });

            renderKategori();
            kategori_modal.classList.remove("active");
            setTimeout(() => {
                bgblur.classList.remove("active");
            }, 500);
            
        })

        // kategoriItems.forEach(items => {
        //     items.addEventListener("click", () => {
                
        //     })
        // })

        delete_all_kategori.addEventListener("click", () => {
            selectedKategories = [];
            renderKategori();
        });
    </script>
@endsection