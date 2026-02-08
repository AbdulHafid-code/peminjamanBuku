<!-- NAVBAR -->
<nav>
	<i class='bx bx-menu toggle-sidebar'></i>
	{{-- <form action="#">
		<div class="form-group">
			<input type="text" placeholder="Search...">
			<i class='bx bx-search icon' ></i>
		</div>
	</form> --}}
	<div class="flex gap-3">
		<a href="/" class="nav-link">
			<i class="bx bx-home icon"></i>
		</a>
		<a href="#" id="dark-light" class="nav-link">
			<div class="block dark:hidden">
				<i class="bx bx-moon icon"></i>
			</div>
			<div class="hidden dark:block">
				<i class="bx bx-sun icon"></i>
			</div>
		</a>
		<div class="profile">
			<img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" alt="">
			<h3 class="hidden md:block text-xs">{{ auth()->user()->nama }}</h3>

			<ul class="profile-link">
				<h3>{{ auth()->user()->nama }}</h3>
				<span class="text-sm text-gray-500 mb-2">{{auth()->user()->role->role}}</span>
				<div class="border border-gray-100 dark:border-gray-100/10 my-2"></div>
				<li><a href="{{ route('edit_profil') }}"><i class='bx bx-user'></i> Profile</a></li>
				<li>
					<form action="{{ route('logout.post') }}" method="post">
						@csrf
						<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Keluar" class="flex gap-5 justify-center items-center"><i class='bx bx-log-out'></i> Logout</button>
					</form>
				</li>
			</ul>

		</div>
	</div>
</nav>
<!-- NAVBAR -->