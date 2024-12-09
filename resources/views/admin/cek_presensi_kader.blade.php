<x-layout-admin>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cek Presensi</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body id="cek-presensi" class="bg-[#E8F6F3] font-poppins m-0 p-0">
        <div class="flex items-center mb-2 mx-auto ">
            <button onclick='admin.presensi_kader'
                class="flex items-center px-2 py-2 text-sm text-white bg-[#62BCB1] rounded-lg hover:bg-teal-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="p-5 font-bold text-[#353535] font-poppins text-3xl">Presensi Kader</h1>
        </div>

        <div class="max-w-screen-xl mx-auto p-5">
            <div class="flex flex-wrap justify-between items-center mb-3">
                <div class="flex items-center w-full sm:w-auto mb-4">
                    <label for="search-date" class="mr-4">Tanggal:</label>
                    <input type="date" id="search-date"
                        class="block w-full sm:w-48 py-2 pl-5 pr-5 text-sm text-gray-900 border border-gray-300 bg-white focus:border-gray-300 focus:ring-1 focus:ring-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white rounded-lg">
                </div>

                <!-- Input pencarian
                <div class="flex items-center mb-4 ml-auto">
                    Menggunakan ml-auto untuk memindahkan input ke kanan
                    <input type="text" id="search" class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Cari nama kader" oninput="filterActivities()">
                </div>
                -->

                <div class="relative w-full sm:w-auto items-center mb-4">
                    <!-- Input Box -->
                    <input type="search" id="default-search"
                        class="block w-full py-2 pl-5 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:border-gray-300 focus:ring-1 focus:ring-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Cari Nama Kader" style="outline: none;" required />
                    <!-- Ikon Cari -->
                    <button type="submit"
                        class="ml-3 bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
                        Cari
                    </button>
                </div>

            </div>

            <!-- Tabel Kehadiran -->
            <table class="w-full border-collapse mb-5">
                <thead class="bg-[#41a99d]">
                    <tr>
                        <th class="text-white text-center py-2 px-4">NIK</th>
                        <th class="text-white text-center py-2 px-4">Nama Kader</th>
                        <th class="text-white text-center py-2 px-4">Kehadiran</th>
                    </tr>
                </thead>
                <tbody
                    class= "bg-white text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center"
                    id="table-body">
                    <!-- Contoh Data 1 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">1234567890</td>
                        <td class="border px-4 py-2">Kader 1</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 2 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876543210</td>
                        <td class="border px-4 py-2">Kader 2</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 3 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876533243</td>
                        <td class="border px-4 py-2">Kader 3</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 4 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876521233</td>
                        <td class="border px-4 py-2">Kader 4</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 5 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876544251</td>
                        <td class="border px-4 py-2">Kader 5</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 6 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876541322</td>
                        <td class="border px-4 py-2">Kader 6</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 7 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876554276</td>
                        <td class="border px-4 py-2">Kader 7</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 8 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876578318</td>
                        <td class="border px-4 py-2">Kader 8</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 9 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876573619</td>
                        <td class="border px-4 py-2">Kader 9</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 10 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876571288</td>
                        <td class="border px-4 py-2">Kader 2</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Contoh Data 11 -->
                    <tr>
                        <td class="border px-4 py-2 text-center">9876591470</td>
                        <td class="border px-4 py-2">Kader 11</td>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" class="presence-checkbox" />
                        </td>
                    </tr>
                    <!-- Pesan Jika Tidak Ada Data -->
                    <tr id="no-data-row" style="display: none;">
                        <td colspan="3" class="border px-4 py-2 text-center text-gray-500">
                            Tidak ada kader yang ditemukan
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol Simpan -->
            <button id="save-button"
                class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                Simpan
            </button>
        </div>

        <script>
            // Fungsi Pencarian
            document.getElementById("search-button").addEventListener("click", function() {
                const searchValue = document.getElementById("search").value.toLowerCase();
                const rows = document.querySelectorAll("#table-body tr");
                let hasVisible = false;

                rows.forEach(row => {
                    const nameCell = row.querySelector("td:nth-child(2)");
                    if (nameCell) {
                        const name = nameCell.textContent.toLowerCase();
                        if (name.includes(searchValue)) {
                            row.style.display = "";
                            hasVisible = true;
                        } else {
                            row.style.display = "none";
                        }
                    }
                });

                // Tampilkan/Sembunyikan pesan jika tidak ada data yang ditemukan
                document.getElementById("no-data-row").style.display = hasVisible ? "none" : "";
            });

            // Simpan Kehadiran
            document.getElementById("save-button").addEventListener("click", function() {
                const checkboxes = document.querySelectorAll(".presence-checkbox");
                const presenceData = Array.from(checkboxes).map((checkbox, index) => ({
                    id: index + 1,
                    hadir: checkbox.checked
                }));

                console.log("Data Kehadiran:", presenceData);
                alert("Data kehadiran berhasil disimpan!");
            });
        </script>
    </body>

    </html>

</x-layout-admin>
