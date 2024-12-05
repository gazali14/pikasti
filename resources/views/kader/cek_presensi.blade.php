<x-layout-kader>
  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Presensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body id="cek-presensi" class="bg-[#E8F6F3] font-poppins m-0 p-0">
    <div class="max-w-screen-xl mx-auto p-5">
      <div id="date-section" class="flex items-center gap-3 text-[#34495e]">
        <label class="block text-left font-medium text-base text-black">Tanggal Kegiatan</label>
        <span id="tanggal-kegiatan" class="text-lg font-semibold">{{ $jadwal->tanggal }}</span>
      </div>
      <div id="search-container" class="flex justify-end mt-[-50px] mb-5">
        <form action="{{ route('kader.cek_presensi.search') }}" method="POST">
          @csrf
          <input type="text" name="search" placeholder="Cari nama bayi" class="w-72 p-3 border border-[#ddd] rounded-md focus:outline-none" />
          <button type="submit" class="ml-3 bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
            Cari
          </button>
        </form>
      </div>

      <table class="w-full border-collapse mb-5">
        <thead class="bg-[#41a99d]">
          <tr>
            <th class="text-white text-center py-2 px-4">NIK</th>
            <th class="text-white text-center py-2 px-4">Nama Bayi</th>
            <th class="text-white text-center py-2 px-4">Kehadiran</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($bayis as $bayi)
            <tr>
              <td class="border px-4 py-2">{{ $bayi->nik }}</td>
              <td class="border px-4 py-2">{{ $bayi->nama }}</td>
              <td class="border px-4 py-2"></td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="border px-4 py-2 text-center">Tidak ada bayi yang ditemukan</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <button id="save-button" class="float-right bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
        Simpan
      </button>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const tanggal = localStorage.getItem('tanggal_kegiatan');
        if (tanggal) {
          document.getElementById('tanggal-kegiatan').textContent = tanggal;
        }
      });
    </script>
  </body>
  </html>
</x-layout-kader>
