<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kader</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="p-2 bg-[#EEFFF8] rounded shadow">
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
                        placeholder="Cari Nama Kader" style="outline: none;" required />
                    <!-- Tombol Cari -->
                    <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Magnifying_glass_icon.svg/2048px-Magnifying_glass_icon.svg.png"
                            alt="Cari" class="w-5 h-5">
                    </button>
                </div>
            </form>


            <!-- Table -->
            <table id="kaderTable" class="min-w-full table-fixed border-collapse border border-[#62BCB1]">
                <thead>
                    <tr>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Nama</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Alamat</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Jabatan</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Password</th>
                    </tr>
                </thead>
                <tbody
                    class= "bg-white text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                    <!-- Contoh Data -->
                    <tr class="border-b kader-row" data-id="1">
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            John Doe
                        </td>
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            Jl. Mawar
                            No. 1</td>
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            Ketua</td>
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            abc123</td>
                    </tr>
                    <tr class="border-b kader-row" data-id="2">
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            Jane Smith
                        </td>
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            Jl. Melati
                            No. 2</td>
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            Sekretaris
                        </td>
                        <td
                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            def456</td>
                    </tr>
                </tbody>
            </table>
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

    <script>
        // JavaScript untuk menangani klik pada baris tabel
        const rows = document.querySelectorAll('.kader-row');
        const actionButtons = document.getElementById('actionButtons');
        let selectedRow = null;

        rows.forEach(row => {
            row.addEventListener('click', function(event) {
                event.stopPropagation(); // Menghentikan event agar tidak memicu klik pada area luar tabel
                // Jika baris sudah dipilih, batalkan pemilihan
                if (selectedRow === row) {
                    selectedRow.classList.remove('bg-blue-100');
                    selectedRow = null;
                    actionButtons.style.display = 'none'; // Sembunyikan tombol
                } else {
                    // Pilih baris yang baru
                    if (selectedRow) selectedRow.classList.remove('bg-blue-100');
                    selectedRow = row;
                    row.classList.add('bg-blue-100');
                    actionButtons.style.display = 'flex'; // Tampilkan tombol
                }
            });
        });

        // Menangani klik tombol Edit
        document.getElementById('editBtn').addEventListener('click', function() {
            if (selectedRow) {
                const kaderId = selectedRow.getAttribute('data-id');
                alert('Edit Kader ID: ' + kaderId); // Ganti dengan logika edit yang sesuai
            }
        });

        // Menangani klik tombol Hapus
        document.getElementById('deleteBtn').addEventListener('click', function() {
            if (selectedRow) {
                const kaderId = selectedRow.getAttribute('data-id');
                const confirmDelete = confirm('Apakah Anda yakin ingin menghapus Kader ID ' + kaderId + '?');
                if (confirmDelete) {
                    alert('Kader ID ' + kaderId + ' dihapus'); // Ganti dengan logika hapus yang sesuai
                }
            }
        });

        // Menangani klik di luar tabel untuk membatalkan pemilihan
        document.addEventListener('click', function(event) {
            // Cek apakah klik terjadi di luar tabel atau baris
            if (!event.target.closest('#kaderTable')) {
                // Jika ya, hilangkan pemilihan baris dan sembunyikan tombol
                if (selectedRow) {
                    selectedRow.classList.remove('bg-blue-100');
                    selectedRow = null;
                    actionButtons.style.display = 'none'; // Sembunyikan tombol
                }
            }
        });
    </script>

</body>

</html>
