<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kader Pikasti</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="{{ asset('img/logo2.png') }}">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #62BCB1; }
        .active-nav-link { background: #93E5DC; }
        .nav-item:hover { background: #93E5DC; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
    <x-sidebar-kader></x-sidebar-kader>
    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <x-header-kader></x-header-kader>
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6"></h1>
            {{ $slot }}
        </main>
    </div>
    
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>