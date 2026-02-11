<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <script>
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme) {
                document.documentElement.setAttribute('data-theme', theme);
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
	<title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

</head>
<body>
	
    <!-- SIDEBAR -->
	@include('dashboard.layouts.sidebar')
    <!-- SIDEBAR -->

	<section id="content">
        <!-- NAVBAR -->
		@include('dashboard.layouts.navbar')
        <!-- NAVBAR -->

        <!-- Main -->
        <main>
            @yield('content')
        </main>
        <!-- Main -->
	</section>
    
</body>
</html>