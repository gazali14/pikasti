@props(['selectedKader'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kader Pikasti</title>
    <meta name="author" content="Tim 2 RPL">
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="{{ asset('img/logo2.png') }}">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #62BCB1;
        }

        .active-nav-link {
            background: #93E5DC;
        }

        .nav-item:hover {
            background: #93E5DC;
        }

        @media (max-width: 640px) {
            .chart canvas {
                height: 300px !important;
            }
        }
    </style>
</head>

<body class="bg-green-50 font-family-karla flex ">
    <x-sidebar-kader></x-sidebar-kader>
    <div class="relative w-full flex flex-col h-screen">
        <x-header-kader :selectedKader="$selectedKader"></x-header-kader>
        <main class="w-full flex-grow p-6 overflow-y-auto bg-[#EEFFF8]">
            {{ $slot }}
        </main>
    </div>

    <!--Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <!-- Menambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
