<!-- Header Component -->
<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen" class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
            <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" x-transition class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
            <!-- Logout Link -->
            <a href="{{ route('logout') }}" class="block px-4 py-2 account-link hover:text-[#93E5DC]" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</header>



<!-- Mobile Header & Nav -->
<header x-data="{ isOpen: false }" class="w-full bg-sidebar py-2 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <div class="p-6 flex items-center">
            <img class="h-12 w-12 mr-3" src="{{ asset('img/White.png') }}" alt="Pikasti">
            <span class="text-white text-lg font-semibold uppercase whitespace-nowrap">Posyandu Pikasti</span>
        </div>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
        </button>
    </div>

    <!-- Dropdown Nav -->
    <nav :class="isOpen ? 'flex' : 'hidden'" class="flex flex-col pt-4">
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="/admin/kelola_kader" class="{{ request()->is('admin/kelola_kader') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-user mr-3"></i>
            Kelola Kader
        </a>
        <a href="/admin/presensi_kader" class="{{ request()->is('admin/presensi_kader') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-check-square mr-3"></i>
            Presensi Kader
        </a>
        <a href="/admin/kelola_jadwal" class="{{ request()->is('admin/kelola_jadwal') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-calendar-alt mr-3"></i>
            Kelola Jadwal
        </a>
        <a href="/admin/dokumentasi" class="{{ request()->is('admin/dokumentasi') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-camera mr-3"></i>
            Dokumentasi
        </a>
        <a href="/admin/kohort" class="{{ request()->is('admin/kohort') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-baby mr-3"></i>
            Kohort Bayi
        </a>

        <!-- Logout Link for Mobile -->
        <a href="{{ route('logout') }}" class="text-white opacity-75 rounded-md hover:opacity-100 flex items-center py-2 pl-4 nav-item" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt mr-3"></i>
            Logout
        </a>

        <!-- Logout Form (Mobile) -->
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</header>
