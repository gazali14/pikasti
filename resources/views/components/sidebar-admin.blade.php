<!-- Sidebar Component -->
<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6 flex items-center">
        <img class="h-8 w-8 mr-3" src="{{ asset('img/White.png') }}" alt="Pikasti">
        <span class="text-white text-sm font-semibold uppercase whitespace-nowrap">Posyandu Pikasti</span>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="/admin/kelola_kader" class="{{ request()->is('admin/kelola_kader') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-user mr-3"></i>
            Kelola Kader
        </a>
        <a href="/admin/presensi_kader" class="{{ request()->is('admin/presensi_kader') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-check-square mr-3"></i>
            Presensi Kader
        </a>
        <a href="/admin/kelola_jadwal" class="{{ request()->is('admin/kelola_jadwal') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-calendar-alt mr-3"></i>
            Kelola Jadwal
        </a>
        <a href="/admin/dokumentasi" class="{{ request()->is('admin/dokumentasi') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-camera mr-3"></i>
            Dokumentasi
        </a>
        <a href="/admin/kohort" class="{{ request()->is('admin/kohort') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-baby mr-3"></i>
            Kohort Bayi
        </a>
    </nav>
</aside>
