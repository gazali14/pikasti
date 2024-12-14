<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kader</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-4">Daftar Dokumentasi Kegiatan</h1>
        <!-- Container untuk search box dan tombol tambah -->
        <div class="flex items-center justify-between mb-4">
            <!-- Form pencarian -->
            <form class="flex items-center w-1/2">
                <input type="text" id="search"
                    class="border border-gray-300 rounded-md px-3 py-2 w-full focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                    placeholder="Cari Dokumentasi Kegiatan" />
                <button type="submit"
                    class="ml-2 bg-[#41a99dac] text-white px-4 py-2 rounded-md hover:bg-[#3a928d] transition active:scale-95">
                    Cari
                </button>
            </form>

            <!-- Tombol tambah -->
            <button id="tambahButton"
                class="ml-4 bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                Tambah
            </button>
        </div>

        <!-- Tabel -->
        <table id="dokumentasiKegiatanTable" class="w-full border-collapse border border-[#62BCB1]">
            <thead>
                <tr>
                    <th class="text-white border bg-[#62BCB1] border-[#62BCB1] py-2 px-4">Judul Dokumentasi</th>
                    <th class="text-white border bg-[#62BCB1] border-[#62BCB1] py-2 px-4">Edit</th>
                    <th class="text-white border bg-[#62BCB1] border-[#62BCB1] py-2 px-4">Hapus</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="text-center">
                    <td class="border border-[#62BCB1] py-2 px-4">Dokumentasi 1</td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="editButton bg-teal-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">Edit</button>
                    </td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                    </td>
                </tr>
                <tr class="text-center">
                    <td class="border border-[#62BCB1] py-2 px-4">Dokumentasi 2</td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="editButton bg-teal-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">Edit</button>
                    </td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                    </td>
                </tr>
                <tr class="text-center">
                    <td class="border border-[#62BCB1] py-2 px-4">Dokumentasi 3</td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="editButton bg-teal-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">Edit</button>
                    </td>
                    <td class="border border-[#62BCB1] py-2 px-4">
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pop-up form -->
    <div id="popupForm" class="fixed inset-0 bg-black bg-opacity-50 justify-center items-center hidden">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white p-5 rounded-md w-2/4 shadow-lg pt-8 pb-8">
            <h2 id="popupTitle" class="text-xl text-center font-bold mb-4"></h2>
            <form id="popupInputForm">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-black-700" for="namaKegiatan">Nama
                        Kegiatan</label>
                    <input type="text" id="namaKegiatan" name="namaKegiatan"
                        class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white hover:border-black focus:border-transparent focus:ring-1 focus:ring-black rounded-lg" />
                </div>
                <div class="mb-4">
                    <label for="large-input" class="block mb-2 text-sm font-bold text-black-700"
                        for="deskripsiKegiatan">Deskripsi
                        Kegiatan</label>
                    <input type="text" id="deskripsiKegiatan" name="deskripsiKegiatan"
                        class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white hover:border-black focus:border-transparent focus:ring-1 focus:ring-black rounded-lg" />
                </div>
                <div class="mb-4">
                    <div class="w-1/2">
                        <label for="tanggalKegiatan" class="block mb-2 text-sm font-bold text-black-700">Tanggal
                            Kegiatan</label>
                        <input type="date" id="search-date"
                            class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white hover:border-black focus:border-transparent focus:ring-1 focus:ring-black rounded-lg">
                    </div>
                </div>
                <div class="mb-4 flex space-x-4">
                    <div class="w-1/2">
                        <label for="fileDokumentasi" class="block mb-2 text-sm font-bold text-black-700">Upload
                            Dokumentasi</label>
                        <input type="file" id="fileDokumentasi" name="fileDokumentasi" accept="image/*"
                            class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white hover:border-black focus:border-transparent focus:ring-1 focus:ring-black rounded-lg">
                    </div>

                    <!-- Preview gambar -->
                    <div id="filePreviewContainer" class="w-1/2 mt-4 hidden">
                        <p class="text-sm text-gray-700 mb-2">Preview Dokumentasi:</p>
                        <img id="filePreview" class="w-40 h-48 border rounded shadow">
                    </div>

                    <span id="errorMessage" class="text-red-500 text-sm hidden">File yang dipilih bukan
                        gambar!</span>
                </div>

                <div class="flex justify-end">
                    <button type="button" id="cancelButton"
                        class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition"
                        data-modal-toggle="crud-modal">Batal</button>
                    <button type="submit"
                        class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi Untuk Mengantur Input Tanggal dan Jam
        document.getElementById("search-date").addEventListener("click", function() {
            this.showPicker();
        });

        // Fungsi untuk menampilkan pop-up
        function showPopup(title, defaultValue = '') {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('namaKegiatan').value = defaultValue;
            document.getElementById('popupForm').classList.remove('hidden');
        }

        // Fungsi untuk menyembunyikan pop-up
        function hidePopup() {
            document.getElementById('popupForm').classList.add('hidden');
        }

        // Event listener untuk tombol Tambah
        document.getElementById('tambahButton').addEventListener('click', () => {
            showPopup('Tambah Dokumentasi Kegiatan');
        });

        // Event listener untuk tombol Edit
        document.querySelectorAll('.editButton').forEach(button => {
            button.addEventListener('click', (event) => {
                const row = event.target.closest('tr');
                const namaKegiatan = row.querySelector('td:first-child').textContent;
                showPopup('Edit Dokumentasi Kegiatan', namaKegiatan);
            });
        });

        // Event listener untuk input file
        document.getElementById("fileDokumentasi").addEventListener("change", function() {
            const file = this.files[0];
            const previewContainer = document.getElementById("filePreviewContainer");
            const previewImage = document.getElementById("filePreview");
            const errorMessage = document.getElementById("errorMessage");

            if (file) {
                const fileReader = new FileReader();
                if (file.type.startsWith("image/")) {
                    fileReader.onload = function(e) {
                        previewImage.src = e.target.result; // Set source untuk pratinjau
                        previewContainer.classList.remove("hidden"); // Tampilkan pratinjau
                        errorMessage.classList.add("hidden"); // Sembunyikan pesan error
                    };
                    fileReader.readAsDataURL(file); // Membaca file sebagai URL
                } else {
                    // Jika file bukan gambar
                    previewContainer.classList.add("hidden"); // Sembunyikan pratinjau
                    errorMessage.classList.remove("hidden"); // Tampilkan pesan error
                    this.value = ""; // Reset input file
                }
            } else {
                // Jika tidak ada file yang dipilih
                previewContainer.classList.add("hidden"); // Sembunyikan pratinjau
                errorMessage.classList.add("hidden"); // Sembunyikan pesan error
            }
        });

        // Event listener untuk tombol Batal
        document.getElementById('cancelButton').addEventListener('click', hidePopup);

        // Event listener untuk form submit
        document.getElementById('popupInputForm').addEventListener('submit', (event) => {
            event.preventDefault();
            // Ambil nilai input dan lakukan action (misalnya, simpan ke database atau update tabel)
            const namaKegiatan = document.getElementById('namaKegiatan').value;
            console.log(`Data disimpan: ${namaKegiatan}`);
            hidePopup();
        });
    </script>
</body>
