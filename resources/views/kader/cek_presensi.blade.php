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
        <form action="{{ route('kader.cek_presensi', ['id_kegiatan' => $jadwal->id]) }}" method="GET">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama bayi" class="w-72 p-3 border border-[#ddd] rounded-md focus:outline-none" />
          <button type="submit" class="ml-3 bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
            Cari
          </button>
        </form>
      </div>      

      <form action="{{ route('kader.cek_presensi.save') }}" method="POST">
        @csrf
        <!-- Hidden input untuk ID kegiatan -->
        <input type="hidden" name="id_kegiatan" value="{{ $jadwal->id }}">
        
        <table class="w-full border-collapse mb-5">
            <thead class="bg-[#41a99d]">
                <tr>
                    <th class="text-white text-center py-2 px-4">NIK</th>
                    <th class="text-white text-center py-2 px-4">Nama Bayi</th>
                    <th class="text-white text-center py-2 px-4">Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bayis as $bayi)
                <tr>
                    <td class="border px-4 py-2">{{ $bayi->nik }}</td>
                    <td class="border px-4 py-2">{{ $bayi->nama }}</td>
                    <td class="border px-4 py-2 text-center">
                        <!-- Hidden input untuk nilai default jika tidak diceklis -->
                        <input type="hidden" name="kehadiran[{{ $bayi->nik }}]" value="0">
                        <!-- Tambahkan nilai 1 untuk checkbox yang dicentang -->
                        <input 
                            type="checkbox" 
                            name="kehadiran[{{ $bayi->nik }}]" 
                            value="1" 
                            class="w-4 h-4 cursor-pointer"
                            {{ isset($kehadiran[$bayi->nik]) && $kehadiran[$bayi->nik] == 1 ? 'checked' : '' }}>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Pesan pencarian tidak ditemukan -->
          @if(isset($message))
          <div class="text-red-500 mb-4">
              {{ $message }}
          </div>
          @endif

        <div class="flex justify-end gap-3 mt-5">
          <!-- Tombol Kembali -->
          <a 
              href="{{ route('kader.presensi_bayi') }}" 
              class="bg-gray-400 text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-gray-500 active:scale-95">
              Kembali
          </a>
      
          <!-- Tombol Simpan -->
          <button 
              type="submit" 
              class="bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
              Simpan
          </button>
      </div>

    </form>  

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
