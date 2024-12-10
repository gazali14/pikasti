<x-layout>
  <div class="container px-5 py-5">
    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8 p-5">
      @forelse ($dokumentasis as $dokumentasi)
        {{-- CARD --}}
        <a href="">
          <div class="rounded-xl shadow-lg bg-[#f3f3f3] w-full max-w-sm mx-auto">
            <div class="p-5 flex flex-col justify-between min-h-[350px]">
              {{-- Gambar --}}
              <div class="rounded-xl overflow-hidden">
                <img src="{{ asset($dokumentasi->foto) }}" 
                alt="Foto {{ $dokumentasi->nama_kegiatan }}" 
                class="w-full h-48 object-cover rounded-t-xl">
              </div>

              {{-- Nama Kegiatan (1 Baris Maksimum) --}}
              <h5 class="text-2xl sm:text-xl md:text-3xl font-poppins font-semibold mt-3 text-[#353535] line-clamp-1">
                {{ $dokumentasi->nama_kegiatan }}
              </h5>

              {{-- Deskripsi (3 Baris Maksimum, Tinggi Tetap) --}}
              <p class="text-[#35353580] text-lg sm:text-sm md:text-base mt-2 line-clamp-3" style="min-height: 72px;">
                {{ $dokumentasi->deskripsi }}
              </p>

              {{-- Tanggal --}}
              <div class="flex justify-end mt-2 font-medium text-[#35353560]">
                <h6>{{ \Carbon\Carbon::parse($dokumentasi->tanggal)->translatedFormat('d F Y') }}</h6>
              </div>
            </div>
          </div>
        </a>
      @empty
        <p class="text-center text-gray-500 col-span-full">Belum ada dokumentasi kegiatan yang tersedia.</p>
      @endforelse
    </div>
  </div>
</x-layout>

{{-- FOOTER --}}
<x-footer-home></x-footer-home>
