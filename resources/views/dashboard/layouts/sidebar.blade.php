<section id="sidebar">
	<a href="{{ route('dashboard') }}" class="brand"><i class='bx bx-library icon'></i> TheBooks</a>
	<ul class="side-menu">
		<li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : ''}}"><i class='bx bx-qr icon'></i> Dashboard</a></li>
		<li><a href="{{ route('edit_profil') }}" class="{{ request()->is('dashboard/editprofil') ? 'active' : ''}}"><i class='bx bx-user icon'></i> Profil</a></li>
		<li><a href="{{ route('riwayat') }}" class="{{ request()->is('dashboard/riwayat') ? 'active' : ''}}"><i class='bx bx-list-ul icon'></i> Riwayat</a></li>
		<li><a href="{{ route('favorit') }}" class="{{ request()->is('dashboard/favorit') ? 'active' : ''}}"><i class='bx bx-bookmark-heart icon'></i> Buku Favorit</a></li>
		
		@can('admin')
			<li class="divider" data-text="Admin">Admin</li>
			<li>
				<a href="#" class="{{ request()->is('dashboard/kategori*') || request()->is('dashboard/buku*') ? 'active' : ''}}" ><i class='bx bx-collection icon' ></i> Katalog <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown {{ request()->is('dashboard/buku*') || request()->is('dashboard/kategori*') ? 'show' : '' }}">
					<li><a href="{{ route('kategori.index') }}" class="{{ request()->is('dashboard/kategori*') ? 'active' : ''}}"><i class='bx bx-category-alt icon'></i>Kategori</a></li>
					<li><a href="{{ route('buku.index') }}" class="{{ request()->is('dashboard/buku*') ? 'active' : ''}}"><i class='bx bx-book icon' ></i></i>Buku</a></li>
				</ul>
			</li>
			<li>
				<a href="#" class="{{ request()->is('dashboard/role*') || request()->is('dashboard/user*') ? 'active' : ''}}"><i class='bx bx-shield icon' ></i> Keanggotaan <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown {{ request()->is('dashboard/role*') || request()->is('dashboard/user*') ? 'show' : '' }}">
					<li><a href="{{ route('role.index') }}" class="{{ request()->is('dashboard/role*') ? 'active' : ''}}"><i class='bx bx-group icon'></i>Hak Akses</a></li>
					<li><a href="{{ route('user.index') }}" class="{{ request()->is('dashboard/user*') ? 'active' : ''}}"><i class='bx bx-user icon'></i>Pengguna</a></li>
				</ul>
			</li>
			<li><a href="{{ route('transaksi.index') }}" class="{{ request()->is('dashboard/transaksi*') ? 'active' : ''}}"><i class='bx bx-cart icon' ></i></i>Transaksi</a></li>
		@endcan


		<li>
			<form action="{{ route('logout.post') }}" method="post" class="flex items-center font-medium text-sm text-gray-600 dark:text-gray-400 p-3 transition-all duration-300 rounded-[10px] my-1 whitespace-nowrap">
				@csrf
				<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Keluar" class="flex gap-5"><i class='bx bx-log-out text-xl'></i> Logout</button>
			</form>
		</li>
	</ul>
</section>
	