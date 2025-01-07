<!-- Header Component -->
<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end z-50 mt-4">
        <button @click="isOpen = !isOpen"
            class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
            <img class="w-10 rounded-full object-cover"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt="">
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" x-transition class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
            <!-- Logout link -->
            <a href="{{ route('logout') }}" class="block  px-4 py-2 account-link hover:text-[#93E5DC]"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
</header>

<!-- Mobile Header & Nav -->
<header x-data="{ isOpen: false, isSubmenuOpen: false }" class="w-full bg-sidebar py-2 px-6 sm:hidden">
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
        <a href="/kader/dashboard"
            class="{{ request()->is('kader/dashboard') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="/kader/presensi_bayi"
            class="{{ request()->is('kader/presensi_bayi') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-check mr-3"></i>
            Presensi Bayi
        </a>
        <a href="/kader/kms"
            class="{{ request()->is('kader/kms') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-chart-line mr-3"></i>
            KMS
        </a>

        <!-- Vitamin & PMT Dropdown -->
        <div>
            <a href="javascript:void(0);" @click="isSubmenuOpen = !isSubmenuOpen"
                class="{{ request()->is('kader/vitamin-pmt') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2 pl-4 nav-item">
                <i class="fas fa-apple-alt mr-3"></i>
                Vitamin & PMT
            </a>
            <div x-show="isSubmenuOpen" x-transition class="pl-10">
                <a href="/kader/vitamin"
                    class="{{ request()->is('kader/vitamin') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2">
                    <i class="fas fa-gem mr-2"></i> Vitamin
                </a>
                <a href="/kader/pmt" class="text-white opacity-75 hover:opacity-100 rounded-md flex items-center py-2">
                    <i class="fas fa-utensils mr-2"></i> PMT
                </a>
            </div>
        </div>

        <a href="/kader/konsultasi"
            class="{{ request()->is('kader/konsultasi') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-comments mr-3"></i>
            Konsultasi
        </a>
        <a href="/kader/laporan"
            class="{{ request()->is('kader/laporan') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100' }} rounded-md flex items-center py-2 pl-4 nav-item">
            <i class="fas fa-file-alt mr-3"></i>
            Laporan
        </a>

        <!-- Logout Button for Mobile -->
        <a href="{{ route('logout') }}"
            class="text-white opacity-75 rounded-md hover:opacity-100 flex items-center py-2 pl-4 nav-item"
            onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
            <i class="fas fa-sign-out-alt mr-3"></i>
            Logout
        </a>

        <!-- Logout Form (Mobile) -->
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</header>
