<x-layout>
  <div class="container px-5 md:px-10 lg:px-20 py-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 items-center">
    <div class="max-w-full lg:max-w-lg text-center lg:text-left">
      <h1 class="font-poppins text-4xl lg:text-7xl font-bold bg-gradient-to-b from-[#41A99D] via-[#1AE3CC] to-[#41A99D] bg-clip-text text-transparent mb-5">
        Posyandu<br>Pikasti
      </h1>
      <p class="text-[#41A99D] font-bold font-poppins text-2xl lg:text-3xl">
        Selamat Datang!
      </p>
    </div>
    <div class="flex justify-center lg:justify-end mt-5 lg:mt-0">
      <img 
        src="{{ asset('img/home1.png') }}" 
        alt="Gambar"
        class="w-full h-auto max-w-full object-contain">
    </div>
  </div>

  {{-- PROFIL POSYANDU --}}
  <div class="container px-5 sm:px-10 lg:px-20 py-5 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <div class="flex justify-center">
      <img 
        src="{{ asset('img/bayi-home.png') }}" 
        alt="Gambar"
        class="w-[80%] sm:w-[60%] lg:w-full h-auto object-contain hidden lg:block">
    </div>
    <div class="font-poppins mt-10 lg:mt-0 lg:ml-10 text-center lg:text-left">
      <div>
        <h1 class="text-[#41A99D] font-bold text-3xl lg:text-4xl">PROFIL POSYANDU</h1>
        <p class="flex items-center justify-center lg:justify-start space-x-2 mt-5">
          <img
          src="{{ asset('img/ikon-lamp.png') }}" 
          alt="Ikon"
          class="w-[15%] sm:w-[10%] h-auto"><span class="text-[#41A99D] font-bold text-3xl">Visi</span></p>
        <p class="text-[#353535] font-poppins font-medium px-5 sm:px-10 text-justify mt-4">
          Menjadikan Masyarakat yang Sehat, Sejahtera, dan Mandiri.
        </p>
      </div>
      
      <div class="mt-10">
        <p class="flex items-center justify-center lg:justify-start space-x-2">
        <img
          src="{{ asset('img/ikon-target.png') }}" 
          alt="Ikon"
          class="w-[15%] sm:w-[10%] h-auto"><span class="text-[#41A99D] font-bold text-2xl lg:text-3xl">Misi</span></p>
        <ul class="text-[#353535] font-poppins font-medium px-5 sm:px-10 list-disc text-justify mt-4">
          <li>Melaksanakan pelayanan kesehatan dari, oleh, untuk masyarakat.</li>
          <li>Menggerakan dan meningkatkan peran serta masyarakat untuk mewujudkan masyarakat sehat.</li>
        </ul>
      </div>
    </div>
  </div>

{{-- JADWAL --}}
<div>
  <div class="flex items-center w-full mt-20">
    <div class="border-t-2 border-[#7EA9A4] flex-grow mr-0"></div>
    <p class="text-center px-2 text-[#41A99D] font-bold text-2xl">JADWAL POSYANDU</p>
    <div class="border-t-2 border-[#7EA9A4] flex-grow ml-0 w-1/2"></div>
  </div>

  <div class="flex flex-col items-center justify-center mb-15 mt-10">
    <section class="w-full max-w-[800px]">
      <div class="border-l-4 border-[#7ea9a4] ml-3 mt-3 py-16 space-y-14">
        
        @forelse($jadwal as $item)
          <div class="relative">
              <div class="absolute top-0 -left-3.5 bg-[#7ea9a4] h-6 w-6 rounded-full"></div>
                <div class="pl-10 border-3 border-gray-300 p-6 bg-[#41a99d] rounded-lg ml-5 shadow-inner">
                  <h3 class="text-2xl sm:text-3xl text-white font-semibold tracking-wide mb-2">
                      {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                  </h3>
                  <p class="text-white text-lg sm:text-xl">
                      {{ $item->nama_kegiatan }} - {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}
                  </p>
                </div>
              </div>
        @empty
                <p class="text-center text-gray-500">Belum ada jadwal yang tersedia.</p>
        @endforelse
        
      </div>
    </section>
  </div>
</div>

<a href="orang_tua/before_login/jadwal">
  <div class="flex justify-end cursor-pointer mt-10 hover:underline">
    <p class="flex items-center space-x-2">
      <span class="text-[#353535] font-semibold text-lg sm:text-xl md:text-2xl">Lihat Selengkapnya</span>
      <img
        src="{{ asset('img/arrow.png') }}" 
        alt="Ikon"
        class="w-6 sm:w-8 md:w-10 h-auto">
    </p>
  </div>
</a>


  {{-- PROFIL KADER --}}
  <div>
    <div class="flex items-center w-full mt-20">
        <div class="border-t-2 border-[#7EA9A4] flex-grow mr-2"></div>
        <p class="text-center px-2 text-[#41A99D] font-bold text-2xl">PROFIL KADER</p>
        <div class="border-t-2 border-[#7EA9A4] flex-grow ml-2"></div>
    </div>

    <div class="container px-5 py-5">
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($kader as $item)
                <!-- Card Kader -->
                <div class="bg-[#f3f3f3] shadow-md rounded-t-xl overflow-hidden w-full max-w-xs mx-auto">
                    <a href="">
                        <img src="{{ asset($item->foto) }}" alt="Gambar"
                             class="h-64 w-full object-cover rounded-t-xl">
                    </a>
                    <div class="px-4 py-3 w-full">
                        <p class="text-lg font-bold block truncate">{{ $item->nama }}</p>
                        <span class="text-[#35353580] uppercase text-sm">{{ $item->jabatan }}</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada kader yang tersedia.</p>
            @endforelse
        </div>
    </div>
  </div>


  <!-- Lihat Selengkapnya -->
  <a href="orang_tua/before_login/profil_kader">
    <div class="flex justify-end cursor-pointer mt-10 hover:underline">
      <p class="flex items-center space-x-2">
        <span class="text-[#353535] font-semibold text-lg sm:text-xl md:text-2xl">Lihat Selengkapnya</span>
        <img src="{{ asset('img/arrow.png') }}" alt="Ikon" class="w-6 sm:w-8 md:w-10 h-auto">
      </p>
    </div>
  </a>

{{-- DOKUMENTASI KEGIATAN --}}
<div>
  <div class="flex items-center w-full mt-20">
    <div class="border-t-2 border-[#7EA9A4] flex-grow mr-2 w-1/2"></div>
    <p class="text-center px-2 text-[#41A99D] font-bold text-2xl">DOKUMENTASI KEGIATAN</p>
    <div class="border-t-2 border-[#7EA9A4] flex-grow ml-2"></div>
  </div>

  <div class="container px-5 py-5">
    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8 p-5">
      {{-- CARD 1 --}}
      <a href="">
      <div class="rounded-xl shadow-lg bg-[#f3f3f3] w-full max-w-sm mx-auto">
        <div class="p-5 flex flex-col">
          <div class="rounded-xl overflow-hidden">
            <img src="https://images.unsplash.com/photo-1576765975429-d2d8cf8c0ba0?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
            alt="Gambar" 
            class="w-full h-full object-cover rounded-t-xl">
          </div>
          <h5 class="text-2xl sm:text-xl md:text-3xl font-poppins mt-3 font-semibold truncate">Nama Kegiatan</h5>
          <p class="text-[#35353580] text-lg sm:text-sm md:text-base mt-2 truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde quaerat quidem architecto perspiciatis. Esse nihil porro accusamus, voluptatibus labore consequatur ab quidem facilis in quia officiis alias aspernatur sequi natus?</p>
          <div class="flex justify-end mt-2 font-medium text-[#35353560]"><h6>Tanggal</h6></div>
        </div>
      </div>
    </a>

      {{-- CARD 2 --}}
      <a href="">
      <div class="rounded-xl shadow-lg bg-[#f3f3f3] w-full max-w-sm mx-auto">
        <div class="p-5 flex-col">
          <div class="rounded-xl overflow-hidden">
            <img src="https://images.unsplash.com/photo-1576765975429-d2d8cf8c0ba0?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
            alt="Gambar" 
            class="w-full h-full object-cover rounded-t-xl">
          </div>
          <h5 class="text-2xl sm:text-xl md:text-3xl font-poppins mt-3 font-semibold truncate">Nama Kegiatan</h5>
          <p class="text-[#35353580] text-lg sm:text-sm md:text-base mt-2 truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde quaerat quidem architecto perspiciatis. Esse nihil porro accusamus, voluptatibus labore consequatur ab quidem facilis in quia officiis alias aspernatur sequi natus?</p>
          <div class="flex justify-end mt-2 font-medium text-[#35353560]"><h6>Tanggal</h6></div>
        </div>
      </div>
    </a>

      {{-- CARD 3 --}}
      <a href="">
      <div class="rounded-xl shadow-lg bg-[#f3f3f3] w-full max-w-sm mx-auto">
        <div class="p-5 flex-col">
          <div class="rounded-xl overflow-hidden">
            <img src="https://images.unsplash.com/photo-1576765975429-d2d8cf8c0ba0?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
            alt="Gambar" 
            class="w-full h-full object-cover rounded-t-xl">
          </div>
          <h5 class="text-2xl sm:text-xl md:text-3xl font-poppins mt-3 font-semibold truncate">Nama Kegiatan</h5>
          <p class="text-[#35353580] text-lg sm:text-sm md:text-base mt-2 truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde quaerat quidem architecto perspiciatis. Esse nihil porro accusamus, voluptatibus labore consequatur ab quidem facilis in quia officiis alias aspernatur sequi natus?</p>
          <div class="flex justify-end mt-2 font-medium text-[#35353560]"><h6>Tanggal</h6></div>
        </div>
      </div>
    </a>
      {{-- END GRID --}}
    </div>
  </div>
</div>

{{-- Lihat Selengkapnya --}}
<a href="orang_tua/before_login/dokumentasi">
  <div class="flex justify-end cursor-pointer mt-5 mb-10 hover:underline">
    <p class="flex items-center space-x-2">
      <span class="text-[#353535] font-semibold text-lg sm:text-xl md:text-2xl">Lihat Selengkapnya</span>
      <img src="{{ asset('img/arrow.png') }}" alt="Ikon" class="w-6 sm:w-8 md:w-10 h-auto">
    </p>
  </div>
</a>

</x-layout>

{{-- FOOTER --}}
<div class="bg-[#62bcb1] text-white items-center justify-center py-10">
  <p class="text-center text-sm md:text-base lg:text-lg">Copyright © 2024/2025 by Posyandu Pikasti. All Rights Reserved.</p>
  <p class="text-center text-sm md:text-base lg:text-lg">RT 013-014 RW 07 Kelurahan Pondok Bambu, Kecamatan Duren Sawit | Telp: (021) **** ****</p>
</div>



