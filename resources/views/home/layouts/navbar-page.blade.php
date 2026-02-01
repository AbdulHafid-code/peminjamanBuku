<header class="navbar-element">
    <div class="content-nav">
        <div class="image">
            <a href="/" class="text-2xl flex items-center gap-3 font-bold text-blue-500 z-100 transition-all duration-300">
                <i class='bx bx-library text-3xl'></i> TheBooks
            </a>
        </div>
        <ul>
            <li class="link-nav"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="link-nav"><a href="{{ route('buku.home') }}">Buku Populer</a></li>
            <li class="link-nav"><a href="{{ route('kategori.home') }}">Kategori Populer</a></li>
        </ul>
            
        @if (!auth()->check())
            <a href="{{ route('login') }}" class="koleksi_btn"><i class='bx bxs-door-open text-lg'></i> Login</a>
        @else
            <a href="{{ route('dashboard') }}" class="koleksi_btn"><i class="bx bxs-dashboard text-lg"></i> {{ auth()->user()->username }}</a>
        @endif

        <div class="hamburger-navbar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>
<div class="nav-link-mobile">
    <li class="link-nav"><a href="{{ route('home') }}">Beranda</a></li>
    <li class="link-nav"><a href="{{ route('buku.home') }}">Buku Populer</a></li>
    <li class="link-nav"><a href="{{ route('kategori.home') }}">Kategori Populer</a></li>
    
    @if (!auth()->check())
        <li class="flex justify-center"><a href="{{route('login')}}" class="koleksi_btn"><i class="bx bxs-door-open text-lg"></i> Login</a></li>
    @else
        <li class="flex justify-center"><a href="{{route('dashboard')}}" class="koleksi_btn"><i class="bx bxs-dashboard text-lg"></i> {{auth()->user()->nama}}</a></li>
    @endif
</div>