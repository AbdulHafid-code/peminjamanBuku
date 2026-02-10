<header class="navbar-element" data-section-scroll="true">
    <div class="content-nav">
        <div class="image">
            <a href="/" class="text-2xl flex items-center gap-3 font-bold text-violet-600 z-100 transition-all duration-300">
                <i class='bx bx-library text-3xl'></i> TheBooks
            </a>
        </div>
        <ul>
            <li class="link-nav {{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="link-nav {{ request()->routeIs('buku.home') || request()->routeIs('buku_detail') ? 'active' : '' }}"><a href="{{ route('buku.home') }}">Buku Populer</a></li>
            <li class="link-nav {{ request()->routeIs('kategori.home') ? 'active' : '' }}"><a href="{{ route('kategori.home') }}">Kategori Populer</a></li>
            {{-- <li class="link-nav"><a href="#tentang">Tentang Kami</a></li> --}}
        </ul>
            
        @if (!auth()->check())
            <a href="{{ route('login') }}" class="btnLogin"><i class='bx bxs-door-open text-lg'></i> Login</a>
        @else
            <a href="{{ route('dashboard') }}" class="hidden xl:flex items-center justify-center text-sm gap-x-2 flex-row-reverse bg-background-secondary px-3 py-1 rounded-full">
                <img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" class="size-10 rounded-full object-cover" alt=""> 
                <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ mb_strimwidth(auth()->user()->nama, 0, 7) }}</span>
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
    <li class="link-nav {{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Beranda</a></li>
    <li class="link-nav {{ request()->routeIs('buku.home') || request()->routeIs('buku_detail') ? 'active' : '' }}"><a href="{{ route('buku.home') }}">Buku Populer</a></li>
    <li class="link-nav {{ request()->routeIs('kategori.home') ? 'active' : '' }}"><a href="{{ route('kategori.home') }}">Kategori Populer</a></li>
    {{-- <li class="link-nav"><a href="#tentang">Tentang Kami</a></li> --}}

    @if (!auth()->check())
        <li class="flex justify-center"><a href="{{route('login')}}" class="btnLogin"><i class="bx bxs-door-open text-lg"></i> Login</a></li>
    @else
        <li class="flex justify-center">
            <a href="{{ route('dashboard') }}" class="flex xl:hidden items-center justify-center text-sm gap-x-2 flex-row-reverse bg-background-secondary px-3 py-1 rounded-full text-gray-900 dark:text-gray-100">
                <img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" class="size-8 rounded-full object-cover" alt=""> {{ mb_strimwidth(auth()->user()->nama, 0, 7) }}
            </a>
        </li>
    @endif

</div>