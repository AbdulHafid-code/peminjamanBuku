<header class="navbar-element" data-section-scroll="true">
    <div class="content-nav">
        <div class="image">
            <a href="/" class="text-2xl flex items-center gap-3 font-bold text-blue-500 z-100 transition-all duration-300">
                <i class='bx bx-library text-3xl'></i> TheBooks
            </a>
        </div>
        <ul>
            <li class="link-nav"><a href="#beranda">Beranda</a></li>
            <li class="link-nav"><a href="#buku_populer">Buku Populer</a></li>
            <li class="link-nav"><a href="#kategori_populer">Kategori Populer</a></li>
            <li class="link-nav"><a href="#tentang">Tentang Kami</a></li>
        </ul>
            
        @if (!auth()->check())
            <a href="{{ route('login') }}" class="koleksi_btn"><i class='bx bxs-door-open text-lg'></i> Login</a>
        @else
            @if (auth()->user()->status_akun === 'aktif')
                <a href="{{ route('dashboard') }}" class="hidden xl:flex items-center justify-center text-sm gap-x-2 flex-row-reverse bg-background-secondary px-3 py-1 rounded-full">
                    <img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" class="size-8 rounded-full object-cover" alt=""> {{ mb_strimwidth(auth()->user()->nama, 0, 7) }}
                </a>
            @elseif (auth()->user()->status_akun === 'pending')
                <a href="{{ route('dashboard') }}" class="koleksi_btn flex items-center gap-2 bg-amber-600">
                    <i class="bx bxs-dashboard text-lg"></i>
                    Pending
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="koleksi_btn flex items-center gap-2 bg-red-600">
                    <i class="bx bxs-dashboard text-lg"></i>
                    Non-Aktif
                </a>
            @endif
            </a>
        @endif
            
        <div class="hamburger-navbar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<div class="nav-link-mobile">
    <li class="link-nav"><a href="#beranda">Beranda</a></li>
    <li class="link-nav"><a href="#buku_populer">Buku Populer</a></li>
    <li class="link-nav"><a href="#kategori_populer">Kategori Populer</a></li>
    <li class="link-nav"><a href="#tentang">Tentang Kami</a></li>

    @if (!auth()->check())
        <li class="flex justify-center"><a href="{{route('login')}}" class="koleksi_btn"><i class="bx bxs-door-open text-lg"></i> Login</a></li>
    @else
        <li class="flex justify-center">
            @if (auth()->user()->status_akun === 'aktif')
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center text-sm gap-x-2 flex-row-reverse bg-background-secondary px-3 py-1 rounded-full">
                    <img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" class="size-8 rounded-full object-cover" alt=""> {{ mb_strimwidth(auth()->user()->nama, 0, 7) }}
                </a>
            @elseif (auth()->user()->status_akun === 'pending')
                <a href="{{ route('dashboard') }}" class="koleksi_btn flex items-center gap-2 bg-amber-600">
                    <i class="bx bxs-dashboard text-lg"></i>
                    Pending
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="koleksi_btn flex items-center gap-2 bg-red-600">
                    <i class="bx bxs-dashboard text-lg"></i>
                    Non-Aktif
                </a>
            @endif
        </li>
    @endif

</div>