<x-layout-kader :selectedKader='$selectedKader'>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cek Presensi</title>
    </head>
    <body id="cek-presensi" class="bg-[#E8F6F3] font-poppins m-0 p-0">
        <div class="flex mx-auto items-center relative my-4">
            <a href="/kader/presensi_kader"
                class="flex px-2 py-2 text-sm mx-5 text-white bg-[#62BCB1] rounded-lg hover:bg-teal-600"
                style="position: relative; z-index: 1000;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="absolute inset-0 flex justify-center">
                <h1 class="font-bold text-3xl">Presensi Bayi</h1>
            </div>
        </div>
        
        <div class="min-h-screen max-h-96">
            <div class="container mx-auto p-5">
                <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                    <div class="mx-auto mt-1 mb-10 p-5">
                        <div class="overflow-x-auto">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <!-- Kolom Tanggal -->
                                <div class="flex items-center bg-white border border-gray-300 rounded-lg p-2 w-80 shadow-md">
                                    <label class="block text-lg font-medium text-black mx-4">Tanggal:</label>
                                    <span id="tanggal-kegiatan" class="text-lg font-semibold">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                    </span>
                                </div>
                    
                                <!-- Kolom Pencarian -->
                                <div class="flex justify-end mb-4">
                                    <input type="text" id="search" class="w-64 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="Cari nama bayi..." oninput="filterBayis()" />
                                </div>
                            </div>
                            
                            
                            <form id="presensi-form" action="{{ route('kader.cek_presensi.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_kegiatan" value="{{ $jadwal->id }}">
                                
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full border border-gray-200 shadow rounded-lg">
                                        <thead class="bg-[#41a99d] text-white">
                                            <tr>
                                                <th class="py-3 px-6 text-center border-b border-gray-300">NIK</th>
                                                <th class="py-3 px-6 text-center border-b border-gray-300">Nama Bayi</th>
                                                <th class="py-3 px-6 text-center border-b border-gray-300">Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bayi-list" class="bg-white">
                                            @foreach ($bayis as $bayi)
                                            <tr class="bayi-item hover:bg-gray-100">
                                                <td class="py-3 px-6 text-center border-b border-gray-300">{{ $bayi->nik }}</td>
                                                <td class="py-3 px-6 text-center border-b border-gray-300">{{ $bayi->nama }}</td>
                                                <td class="py-3 px-6 text-center border-b border-gray-300">
                                                    <input type="hidden" name="kehadiran[{{ $bayi->nik }}]" value="0">
                                                    <input type="checkbox" name="kehadiran[{{ $bayi->nik }}]" value="1" class="w-5 h-5 cursor-pointer" {{ isset($kehadiran[$bayi->nik]) && $kehadiran[$bayi->nik] == 1 ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div id="no-results" class="text-center text-red-500 mt-4 hidden">
                                    <span id="no-results-text"></span>
                                </div>
                    
                                <div class="flex justify-end gap-3 mt-5">
                                    <button type="submit" class="bg-[#41a99d] text-white px-6 py-3 rounded-md shadow-md transition duration-300 hover:bg-[#41a99dac] active:scale-95">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div> 
        
                </div>
            </div>
        </div>
  
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