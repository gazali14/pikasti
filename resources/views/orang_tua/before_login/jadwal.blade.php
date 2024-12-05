<x-layout>
<div class="container px-5 sm:px-10 lg:px-20 py-5">
  <!-- Filter Tahun di Sebelah Kanan -->
  <div class="flex justify-end mb-8 items-center">
    <label for="tahun" class="sm:block text-lg sm:text-xl hidden font-semibold text-white mb-2 mr-4">Pilih Tahun:</label>
    <div class="w-full sm:w-auto">
      <select name="year" id="tahun" class="w-full sm:w-auto p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#41a99d] text-gray-500 font-light text-base">
        <option value="">Filter berdasarkan tahun</option>
        <option value="2025">2025</option>
        <option value="2024">2024</option>
        <option value="2023">2023</option>
      </select>
    </div>
  </div>

  <!-- Jadwal -->
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Card Jadwal 1 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-white shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-[#41A99D]">27 Januari 2025</h1>
      <p class="text-xl font-medium text-[#62bcb1]">Imunisasi Campak</p>
      <p class="text-lg text-[#62bcb1] font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 2 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Februari 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 3 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Maret 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 4 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 April 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 5 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Mei 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 6 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Juni 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 7 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Juli 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 8 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Agustus 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 9 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 September 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 10 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Oktober 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 11 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 November 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

    <!-- Card Jadwal 12 -->
    <div class="rounded-xl border border-gray-300 px-10 py-5 bg-[#41a99d] shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
      <h1 class="text-2xl font-bold text-white">27 Desember 2025</h1>
      <p class="text-xl font-medium text-white">Imunisasi Campak Rubela</p>
      <p class="text-lg text-white font-medium self-end mt-5">08.00 - Selesai</p>
    </div>

  </div>
  
</div>
  
</x-layout>

{{-- FOOTER --}}
<x-footer-home></x-footer-home>