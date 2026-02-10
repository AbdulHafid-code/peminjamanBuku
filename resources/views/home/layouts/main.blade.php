<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <script>
    (function () {
        const theme = localStorage.getItem('theme');

        if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        } else {
        document.documentElement.classList.remove('dark');
        }
    })();
  </script>
  
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/home.css', 'resources/js/home.js'])

  <title>TheBooks | @yield('title', 'Beranda')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="body-landingpage">
  
    @include('home.layouts.navbar')
  
    @yield('container')

    @include('home.layouts.footer')

    <button
        type="button"
        id="dark-light"
        class="fixed bottom-20 right-20 z-50 w-13 h-13 rounded-full flex items-center justify-center bg-violet-600 text-gray-900 dark:text-amber-500 shadow-lg shadow-gray-300/40 dark:shadow-violet-900/30 hover:scale-105 transition">
        <div class="flex justify-center items-center dark:hidden">
            <i class="bx bx-moon text-2xl"></i>
        </div>
        <div class="hidden dark:flex justify-center items-center">
            <i class="bx bx-sun text-2xl"></i>
        </div>
    </button>

</body>
</html>