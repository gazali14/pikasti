<x-layout-admin :selectedKader='$selectedKader'>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cek Presensi</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body id="cek-presensi" class="bg-[#E8F6F3] font-poppins m-0 p-0">
        <div class="flex mx-auto items-center relative my-4">
            <a href="/admin/presensi_kader"
                class="flex px-2 py-2 text-sm mx-5 text-white bg-[#62BCB1] rounded-lg hover:bg-teal-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="absolute inset-0 flex justify-center">
                <h1 class="font-bold text-3xl">Presensi Kader</h1>
            </div>
        </div>

        <div class="min-h-screen max-h-96">
            <div class="container mx-auto p-5">
                <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                    <div class="mx-auto mt-1 mb-10 p-5">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <!-- Kolom Tanggal -->
                            <div
                                class="flex items-center  bg-white border border-gray-300 rounded-lg p-2 w-80 shadow-md">
                                <label class="block text-lg font-medium text-black mx-4">Tanggal:</label>
                                <span id="tanggal-kegiatan"
                                    class="text-lg font-semibold">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}
                                </span>
                            </div>

                            <!-- Kolom Pencarian -->
                            <div>
                                <input type="text" id="search"
                                    class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                                    placeholder="Cari nama kader..." oninput="filterKaders()" />
                            </div>
                        </div>


                        <form action="{{ route('admin.cek_presensi_kader.save') }}" method="POST" id="presensi-form">
                            @csrf
                            <!-- Hidden input untuk ID kegiatan -->
                            <input type="hidden" name="id_kegiatan" value="{{ $jadwal->id }}">

                            <!-- Tabel Kehadiran -->
                            <table class="w-full table-auto border border-[#62BCB1] mt-5">
                                <thead>
                                    <tr>
                                        <th class="text-white text-center bg-[#62BCB1] border py-2 px-4">NIK</th>
                                        <th class="text-white text-center bg-[#62BCB1] border py-2 px-4">Nama Kader</th>
                                        <th class="text-white text-center bg-[#62BCB1] border py-2 px-4">Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody id="kader-list" class="bg-white">
                                    @foreach ($kaders as $kader)
                                        <tr class="kader-item">
                                            <td
                                                class="text-gray-900 text-center font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $kader->nik }}</td>
                                            <td
                                                class="text-gray-900 text-center font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $kader->nama }}</td>
                                            <td
                                                class="text-gray-900 text-center font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                <!-- Hidden input untuk nilai default jika tidak diceklis -->
                                                <input type="hidden" name="kehadiran[{{ $kader->nik }}]"
                                                    value="0">
                                                <!-- Tambahkan nilai 1 untuk checkbox yang dicentang -->
                                                <input type="checkbox" name="kehadiran[{{ $kader->nik }}]"
                                                    value="1" class="w-4 h-4 cursor-pointer"
                                                    {{ isset($kehadiran[$kader->nik]) && $kehadiran[$kader->nik] == 1 ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div id="no-results" class="text-center text-red-500 font-semibold mt-3"
                                style="display: none;">
                                <span id="no-results-text"></span>
                            </div>

                            <div class="flex justify-end gap-3 mt-5">
                                <!-- Tombol Simpan -->
                                <button id="save-button"
                                    class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let isFormModified = false; // Flag untuk melacak perubahan pada form

            // Fungsi untuk mendeteksi perubahan pada checkbox
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    isFormModified = true; // Tandai bahwa ada perubahan
                });
            });

            function filterKaders() {
                const searchValue = document.getElementById("search").value.toLowerCase();
                const kaderItems = document.querySelectorAll(".kader-item");
                let hasResults = false; // Untuk mengecek hasil pencarian

                kaderItems.forEach(item => {
                    const nik = item.querySelector("td:nth-child(1)").textContent.toLowerCase();
                    const nama = item.querySelector("td:nth-child(2)").textContent.toLowerCase();

                    if (nik.includes(searchValue) || nama.includes(searchValue)) {
                        item.style.display = ""; // Tampilkan baris yang cocok
                        hasResults = true; // Set hasil pencarian menjadi true
                    } else {
                        item.style.display = "none"; // Sembunyikan baris yang tidak cocok
                    }
                });

                // Tampilkan atau sembunyikan pesan 'Tidak ada hasil'
                const noResultsMessage = document.getElementById("no-results");
                const noResultsText = document.getElementById("no-results-text");

                if (!hasResults && searchValue !== "") {
                    // Mengubah teks menjadi dinamis dengan nama pencarian
                    noResultsText.textContent = `Mohon Maaf, Nama " ${searchValue} " tidak ada`;
                    noResultsMessage.style.display = "block";
                } else {
                    noResultsMessage.style.display = "none";
                }
            }

            // Event listener untuk mencegah berpindah halaman jika ada perubahan yang belum disimpan
            window.addEventListener('beforeunload', function(event) {
                if (isFormModified) {
                    const confirmationMessage =
                        'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
                    event.returnValue = confirmationMessage; // Untuk browser yang mendukung
                    return confirmationMessage; // Untuk browser yang lebih lama
                }
            });

            // Fungsi untuk menangani simpan perubahan
            document.getElementById('presensi-form').addEventListener('submit', function() {
                isFormModified = false; // Reset flag saat form disubmit
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
</x-layout-admin>
