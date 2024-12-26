<nav class="bg-[rgb(137,201,196)]" x-data="{ isOpen: false }">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="shrink-0">
          <img class="size-12" src="{{ asset('img/logo.png') }}" alt="">
        </div>
      </div>
      <div class="hidden md:flex justify-center flex-grow">
        <div class="ml-15 flex space-x-8">
       
        <!-- Cek jika pengguna sudah login -->
        @auth
            <a href="{{ route('orang_tua.before_login.home') }}" class="{{ request()->routeIs('orang_tua.before_login.home') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
            <a href="{{ route('orang_tua.before_login.jadwal') }}" class="{{ request()->routeIs('orang_tua.before_login.jadwal') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Jadwal</a>
            <a href="{{ route('orang_tua.before_login.profil_kader') }}" class="{{ request()->routeIs('orang_tua.before_login.profil_kader') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Profil Kader</a>
            <a href="{{ route('orang_tua.before_login.dokumentasi') }}" class="{{ request()->routeIs('orang_tua.before_login.dokumentasi') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Dokumentasi</a>
            <a href="{{ route('orang_tua.dashboard') }}" class="{{ request()->routeIs('orang_tua.dashboard') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>            
            @else
            <a href="/" class="{{ request()->is('/') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md  px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
            <a href="/orang_tua/before_login/jadwal" class="{{ request()->is('orang_tua/before_login/jadwal') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium ">Jadwal</a>
            <a href="/orang_tua/before_login/profil_kader" class="{{ request()->is('orang_tua/before_login/profil_kader') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Profil Kader</a>
            <a href="/orang_tua/before_login/dokumentasi" class="{{ request()->is('orang_tua/before_login/dokumentasi') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Dokumentasi</a>
            <a href="{{ route('orang_tua.before_login.login') }}" class="{{ request()->routeIs('orang_tua.before_login.login') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} rounded-md px-3 py-2 text-sm font-medium">Login</a>
        @endauth
        </div>
      </div>

      @auth
        
      
      <!-- Open user menu -->
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          <div class="relative ml-3">
            <div>
              <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#62BCB1]" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <!-- Gambar profil (opsional) -->
                <img class="size-8 rounded-full" src="{{  asset('img/Profile.png') }}" alt="profile">
              </button>
            </div>
            <div x-show="isOpen" 
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" 
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-[#ff5c5c] hover:text-white" 
                        role="menuitem" tabindex="-1">Logout</button>
                </form>
            </div>

          </div>
        </div>
      </div>
      @endauth
      <div class="-mr-2 flex md:hidden">
        <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-[#93E5DC] hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#62BCB1]" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div x-show="isOpen" class="md:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">

      <!-- Cek jika pengguna sudah login -->
      @auth
            <a href="{{ route('orang_tua.before_login.home') }}" 
            class="{{ request()->routeIs('orang_tua.before_login.home') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium" 
            aria-current="page">Home</a>

          <a href="{{ route('orang_tua.before_login.jadwal') }}" 
            class="{{ request()->routeIs('orang_tua.before_login.jadwal') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Jadwal</a>

          <a href="{{ route('orang_tua.before_login.profil_kader') }}" 
            class="{{ request()->routeIs('orang_tua.before_login.profil_kader') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Profil Kader</a>

          <a href="{{ route('orang_tua.before_login.dokumentasi') }}" 
            class="{{ request()->routeIs('orang_tua.before_login.dokumentasi') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Dokumentasi</a>

          <a href="{{ route('orang_tua.dashboard') }}" 
            class="{{ request()->routeIs('orang_tua.dashboard') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Dashboard</a>
      @else
          <a href="/" 
            class="{{ request()->routeIs('orang_tua.before_login.home') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium" 
            aria-current="page">Home</a>

          <a href="/orang_tua/before_login/jadwal" 
            class="{{ request()->routeIs('orang_tua.before_login.jadwal') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Jadwal</a>

          <a href="/orang_tua/before_login/profil_kader" 
            class="{{ request()->routeIs('orang_tua.before_login.profil_kader') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Profil Kader</a>

          <a href="/orang_tua/before_login/dokumentasi" 
            class="{{ request()->routeIs('orang_tua.before_login.dokumentasi') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Dokumentasi</a>

          <a href="{{ route('orang_tua.before_login.login') }}" 
            class="{{ request()->routeIs('orang_tua.before_login.login') ? 'bg-white text-[#62BCB1]' : 'text-white hover:bg-[#93E5DC]'}} 
            block rounded-md px-3 py-2 text-base font-medium">Login</a>
      @endauth

      @auth
      <form method="POST" action="{{ route('logout') }}">
        @csrf
          <button type="submit" 
            class="text-white hover:bg-[#93E5DC] block rounded-md px-5 py-2 text-base font-medium" 
            role="menuitem" tabindex="-1">Logout</button>
      </form>
      @endauth

    </div>
  </div>
</nav>
