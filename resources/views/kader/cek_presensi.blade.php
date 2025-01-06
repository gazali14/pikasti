<x-layout-kader>
    <!DOCTYPE html>
    <html lang="id">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cek Presensi</title>
    </head>
  
    <body id="cek-presensi" class="bg-[#E8F6F3] font-poppins m-0 p-0">
      <div class="flex items-center mb-2 mx-auto ">
        <a href="/kader/presensi_bayi"
            class="flex items-center px-2 py-2 text-sm text-white bg-[#62BCB1] rounded-lg hover:bg-teal-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="p-5 font-bold text-[#353535] font-poppins text-3xl">Presensi Bayi</h1>
      </div>
      
      <div class="max-w-screen-xl mx-auto p-5">
        <div class="flex flex-wrap items-center justify-between mb-4">
          <!-- Kolom Tanggal -->
          <div class="flex items-center gap-3">
              <label class="block text-left font-medium text-base text-black">Tanggal</label>
                <span id="tanggal-kegiatan" class="text-lg font-semibold">
                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}
                </span>
          </div>
  
           <!-- Kolom Pencarian -->
          <div class="flex justify-end mb-4">
              <input type="text" id="search" class="w-1/8 p-3 border border-gray-300 rounded-lg"
                  placeholder="Cari nama bayi..." oninput="filterBayis()" />
          </div>
      </div>  
  
        <form id="presensi-form" action="{{ route('kader.cek_presensi.save') }}" method="POST">
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
              <tbody id="bayi-list">
                  @foreach ($bayis as $bayi)
                  <tr class="bayi-item">
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
            <div id="no-results" class="text-center text-red-500 mb-4 hidden">
                <span id="no-results-text"></span>
            </div>
  
          <div class="flex justify-end gap-3 mt-5">
            <!-- Tombol Simpan -->
            <button 
                type="submit" 
                class="bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
                Simpan
            </button>
        </div>
  
      </form>  
  
      <script>
        let isFormModified = false;
  
        // Tandai perubahan pada form jika ada interaksi dengan checkbox
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                isFormModified = true;
            });
        });
  
        // Fungsi untuk memfilter bayi berdasarkan input pencarian
        function filterBayis() {
            const searchValue = document.getElementById("search").value.toLowerCase();
            const bayiItems = document.querySelectorAll(".bayi-item");
            let hasResults = false;
  
            bayiItems.forEach(item => {
                const nik = item.querySelector("td:nth-child(1)").textContent.toLowerCase();
                const nama = item.querySelector("td:nth-child(2)").textContent.toLowerCase();
  
                if (nik.includes(searchValue) || nama.includes(searchValue)) {
                    item.style.display = "";
                    hasResults = true;
                } else {
                    item.style.display = "none";
                }
            });
  
            const noResultsMessage = document.getElementById("no-results");
            const noResultsText = document.getElementById("no-results-text");
  
            if (!hasResults && searchValue !== "") {
                noResultsText.textContent = `Mohon Maaf, Nama "${searchValue}" tidak ada`;
                noResultsMessage.style.display = "block";
            } else {
                noResultsMessage.style.display = "none";
            }
        }
  
        // Peringatan sebelum meninggalkan halaman jika ada perubahan yang belum disimpan
        window.addEventListener('beforeunload', function (event) {
            if (isFormModified) {
                const confirmationMessage = 'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
                event.returnValue = confirmationMessage;
                return confirmationMessage;
            }
        });
  
        // Reset flag perubahan saat form disubmit
        document.getElementById('presensi-form').addEventListener('submit', function () {
            isFormModified = false;
        });

         // Notifikasi sukses menambahkan data kader
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Lokasi di kanan atas
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false, // Tidak ada tombol
                    timer: 3000, // Menghilang setelah 3 detik
                    timerProgressBar: true, // Menampilkan progress bar
                });
            @endif
        });
      </script>
    </body>
    </html>
  </x-layout-kader>