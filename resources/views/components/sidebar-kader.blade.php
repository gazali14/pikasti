<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6 flex items-center">
        <img class="h-8 w-8 mr-3" src="{{ asset('img/White.png') }}" alt="Pikasti">
        <span class="text-white text-sm font-semibold uppercase whitespace-nowrap">Posyandu Pikasti</span>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="/kader/dashboard" class="{{ request()->is('kader/dashboard') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="/kader/presensi_bayi" 
            class="{{ request()->is('kader/presensi_bayi') || request()->is('kader/cek_presensi*') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} 
                flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-check-square mr-3"></i>
            Presensi Bayi
        </a>
        <a href="/kader/kms" class="{{ request()->is('kader/kms') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-chart-line mr-3"></i>
            KMS
        </a>
        <div x-data="{ isSubmenuOpen: false }" class="flex flex-col">
            <a href="javascript:void(0);" @click="isSubmenuOpen = !isSubmenuOpen" class="{{ request()->is('kader/vitamin-pmt') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
                <i class="fas fa-apple-alt mr-3"></i>
                Vitamin & PMT
            </a>
            <div x-show="isSubmenuOpen" x-transition class="pl-10">
                <a href="/kader/vitamin" class="{{ request()->is('kader/vitamin') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-2">
                    <i class="fas fa-capsules mr-2"></i> Vitamin
                </a>
                <a href="/kader/pmt" class="{{ request()->is('kader/pmt') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-2">
                    <i class="fas fa-utensils mr-2"></i> PMT
                </a>
            </div>
        </div>
        <a href="/kader/konsultasi" class="{{ request()->is('kader/konsultasi') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-comments mr-3"></i>
            Konsultasi
        </a>
        <a href="/kader/laporan" class="{{ request()->is('kader/laporan') ? 'active-nav-link text-white' : 'text-white opacity-75 hover:opacity-100'}} flex items-center py-4 pl-6 nav-item">
            <i class="fas fa-file-alt mr-3"></i>
            Laporan
        </a>
    </nav>
</aside>