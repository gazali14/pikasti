<x-layout-admin>
    <h1 class="text-3xl font-bold mb-4">Registrasi Kohort Bayi</h1>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Tabel Daftar Kader dengan Scroll -->
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
            <div class="">
                <div class="mx-auto mt-1 mb-10 px-10">
                    <form class="mb-2 flex justify-start items-center">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative w-1/4">
                            <!-- Ikon di awal input -->
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <!-- Input Box -->
                            <input type="search" id="default-search"
                                class="block w-full py-2 pl-5 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:border-gray-300 focus:ring-1 focus:ring-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Cari Nama Bayi" style="outline: none;" required />
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table id="bayiTable" class="min-w-full table-fixed border-collapse border border-[#62BCB1]">
                            <thead>
                                <tr>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Nama Bayi</th>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Nama Ibu Kandung</th>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Tanggal Lahir</th>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Jenis Kelamin</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white ">
                                <!-- Contoh Data -->
                                <tr class="border-b bayi-row" data-id="1">
                                    <td
                                        class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                        Acha Putri</td>
                                    <td
                                        class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                        Rosalina</td>
                                    <td
                                        class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                        20-03-2023</td>
                                    <td
                                        class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                        Perempuan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Edit dan Hapus di bawah tabel -->
                <div class="flex justify-end mt-4" id="actionButtons" style="display: none;">
                    <button
                        class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-600 transition duration-150 ease-in-out"
                        id="editBtn">Edit</button>
                    <button
                        class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 transition duration-150 ease-in-out ml-2"
                        id="deleteBtn">Hapus</button>
                </div>
            </div>
        </div>

        <!-- Form Tambah Bayi -->
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-10 mb-10">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Bayi</h1>

            <form class="space-y-6 w-full">

                <!-- Kolom Kiri: Form -->
                <div class="w-full space-y-4">
                    <div>
                        <label for="nikBayi" class="block text-gray-700 font-medium">NIK Bayi</label>
                        <input type="text" name="nikBayi" id="nikBayi"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan NIK Bayi">
                    </div>

                    <div>
                        <label for="namaBayi" class="block text-gray-700 font-medium">Nama Bayi</label>
                        <input type="text" name="namaBayi" id="namaBayi"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Nama Bayi">
                    </div>

                    <div>
                        <label for="namaIbuKandung" class="block text-gray-700 font-medium">Nama Ibu
                            Kandung</label>
                        <input type="text" name="namaIbuKandung" id="namaIbuKandung"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Nama Ibu Kandung">
                    </div>

                    <div>
                        <label for="jenisKelamin" class="block text-gray-700 font-medium">Jenis Kelamin</label>
                        <input type="text" name="jenisKelamin" id="jenisKelamin"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="">
                    </div>

                    <div>
                        <label for="tanggalLahir" class="block text-gray-700 font-medium">Tanggal Lahir</label>
                        <input type="date" id="tanggalLahir" name="tanggalLahir"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            required placeholder="Masukkan Tanggal Lahir">
                    </div>

                    <div>
                        <label for="alamat" class="block text-gray-700 font-medium">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="Masukkan Alamat">
                    </div>

                    <div>
                        <label for="beratLahir" class="block text-gray-700 font-medium">Berat Lahir (kg)</label>
                        <input type="number" name="beratLahir" id="beratLahir" min="0" max="100"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="0" required>
                    </div>

                    <div>
                        <label for="panjangLahir" class="block text-gray-700 font-medium">Panjang Lahir (cm)</label>
                        <input type="number" name="panjangLahir" id="panjangLahir" min="0" max="1000"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            placeholder="0" required>
                    </div>

                    <div class="relative">
                        <label for="password" class="block text-gray-700 font-medium">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full mt-1 p-2 pr-10 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                placeholder="Masukkan Password">
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-3 flex items-center justify-center text-gray-500 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d=" M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-center gap-4 mt-6">
                    <button type="reset"
                        class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Reset
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-layout-admin>

<script>
    let selectedRow = null;

    // Fungsi untuk menambahkan event listener ke baris tabel
    function attachRowEventListeners() {
        const rows = document.querySelectorAll('.bayi-row');
        rows.forEach(row => {
            row.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah event keluar dari baris
                if (selectedRow === row) {
                    // Jika baris sudah dipilih, batalkan pemilihan
                    selectedRow.classList.remove('bg-blue-100');
                    selectedRow = null;
                    hideActionButtons();
                } else {
                    // Pilih baris baru
                    if (selectedRow) selectedRow.classList.remove('bg-blue-100');
                    selectedRow = row;
                    row.classList.add('bg-blue-100');
                    showActionButtons();
                }
            });
        });
    }

    // Menampilkan tombol aksi
    function showActionButtons() {
        document.getElementById('actionButtons').style.display = 'flex';
    }

    // Menyembunyikan tombol aksi
    function hideActionButtons() {
        document.getElementById('actionButtons').style.display = 'none';
    }

    // Reset pilihan baris ketika klik di luar tabel
    document.addEventListener('click', function(event) {
        if (!event.target.closest('#bayiTable')) {
            if (selectedRow) {
                selectedRow.classList.remove('bg-blue-100');
                selectedRow = null;
                hideActionButtons();
            }
        }
    });

    attachRowEventListeners();
</script>
