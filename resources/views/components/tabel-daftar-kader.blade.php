<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kader</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="container mx-auto mt-1 mb-10 px-10">
        <!-- Header -->
        <div class="flex justify-between items-center mb-3">
        </div>

        <!-- Table -->
        <div class=" rounded shadow-sm overflow-x-auto">
            <table id="kaderTable" class="min-w-full border-collapse border border-[#62BCB1] ">
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
