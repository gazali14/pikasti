<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Vitamin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-5 mb-10 px-10">
        <!-- Header -->
        <div class="flex justify-between items-center mb-3">
            <div class="flex items-center mb-4">
                <label for="search-date" class="mr-4">Tanggal:</label>
                <input type="date" id="search-date" name="tanggal" value="{{ $tanggal ?? '' }}" class="p-2 border border-gray-300 rounded-lg" onchange="filterByDate()">                
            </div>            
            <div class="flex items-center mb-4 ml-auto">
                <input type="text" id="search" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Cari nama bayi" autocomplete="off" oninput="searchBayi()">
            </div>
            <div id="suggestions" class="bg-white border border-gray-300 rounded-lg mt-1 hidden absolute w-full"></div>            
        </div>

        <!-- Table -->
        <div class="rounded shadow-sm overflow-x-auto">
            <table id="TableVitamin" class="min-w-full border-collapse border border-[#62BCB1]">
                <thead>
                    <tr>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Nama Bayi
                        </th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Vitamin A
                        </th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                            Nama Kegiatan
                        </th>
                    </tr>
                </thead>
                <tbody id="vitamin-list">
                    @foreach ($bayis as $bayi)
                        @foreach ($bayi->vitamins as $vitamin)
                            <tr class="vitamin-row" data-id="{{ $bayi->id }}" data-nama="{{ $bayi->nama }}" data-id-kegiatan="{{ $vitamin->jadwal->id ?? '' }}" data-nama-kegiatan="{{ $vitamin->jadwal->nama_kegiatan ?? '' }}">
                                <td class="border px-4 py-2">{{ $bayi->nama }}</td>
                                <td class="border px-4 py-2">{{ $vitamin->vitamin }}</td>
                                <td class="border px-4 py-2">{{ $vitamin->jadwal->nama_kegiatan ?? 'Tidak ada data kegiatan' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>                              
            </table>

             <!-- Error Message -->
            <div id="error-message" class="text-red-500 mt-2 hidden font-bold text-center"></div>

            <!-- Tombol Edit -->
            <div class="flex justify-end mt-4" id="actionButtons" style="display: none;">
                <button
                    class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-600 transition duration-150 ease-in-out"
                    id="editBtn">Edit</button>
                <button
                    class="inline-block px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-600 transition duration-150 ease-in-out"
                    id="hapusBtn">Hapus</button>
            </div>

        </div>
    </div>

    <script>
        const rows = document.querySelectorAll('.vitamin-row');
        let selectedRow = null;

        rows.forEach(row => {
            row.addEventListener('click', function(event) {
                event.stopPropagation();

                // If the same row is clicked again, hide action buttons and remove highlight
                if (selectedRow === row) {
                    selectedRow.classList.remove('bg-blue-100');
                    selectedRow = null;
                    const actionRow = row.nextElementSibling;
                    if (actionRow) actionRow.remove(); // Remove action buttons
                } else {
                    // Remove previous highlights and hide action buttons
                    if (selectedRow) {
                        selectedRow.classList.remove('bg-blue-100');
                        selectedRow.nextElementSibling?.remove(); // Remove previous action buttons
                    }

                    // Highlight the selected row and display action buttons
                    selectedRow = row;
                    row.classList.add('bg-blue-100');

                    // Create action buttons and place them after the selected row
                    const actionRow = document.createElement('tr');
                    actionRow.innerHTML = `
                        <td colspan="3" class="text-center">
                            <button class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-600 transition duration-150 ease-in-out editBtn">Edit</button>
                            <button class="inline-block px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-600 transition duration-150 ease-in-out hapusBtn">Hapus</button>
                        </td>
                    `;
                    
                    row.parentNode.insertBefore(actionRow, row.nextSibling); // Place action buttons after the selected row

                    // Add event listeners for Edit and Delete buttons
                    const editBtn = actionRow.querySelector('.editBtn');
                    const hapusBtn = actionRow.querySelector('.hapusBtn');

                    editBtn.addEventListener('click', function () {
                        if (selectedRow) {
                            const idBayi = selectedRow.getAttribute('data-id');
                            const namaBayi = selectedRow.getAttribute('data-nama');
                            const vitamin = selectedRow.children[1].textContent.trim();
                            const idKegiatan = selectedRow.getAttribute('data-id-kegiatan');

                            // Fill form with selected data
                            document.querySelector('#id_bayi').value = idBayi;
                            document.querySelector('#nama').value = namaBayi;
                            document.querySelector('#jenis_vitamin').value = vitamin === 'Tidak ada data vitamin' ? '' : vitamin;

                            // Fill dropdown with kegiatan
                            const kegiatanSelect = document.querySelector('#id_kegiatan');
                            kegiatanSelect.value = idKegiatan || '';

                            if (!idKegiatan) {
                                kegiatanSelect.querySelector('option[disabled]').selected = true;
                            }
                        }
                    });

                    hapusBtn.addEventListener('click', function () {
                        if (selectedRow) {
                            const idKegiatan = selectedRow.getAttribute('data-id-kegiatan');
                            const idBayi = selectedRow.getAttribute('data-id');

                            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                                fetch(`{{ route('kader.vitamin.destroy') }}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    body: JSON.stringify({ id_kegiatan: idKegiatan, id_bayi: idBayi })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert(data.message);
                                        selectedRow.remove();
                                        actionRow.remove();
                                    } else {
                                        alert('Gagal menghapus data');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Terjadi kesalahan');
                                });
                            }
                        }
                    });
                }
            });
        });

        // Hide action buttons if clicked outside the table
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#TableVitamin')) {
                if (selectedRow) {
                    selectedRow.classList.remove('bg-blue-100');
                    selectedRow = null;
                    const actionRow = selectedRow ? selectedRow.nextElementSibling : null;
                    if (actionRow) actionRow.remove(); // Remove action buttons
                }
            }
        });

        // Function to filter data by date
        function filterByDate() {
            const date = document.getElementById('search-date').value;
            if (date) {
                window.location.href = `?tanggal=${date}`;
            }
        }

       // Fungsi untuk mencari dan memfilter nama bayi serta memperbarui tabel
    function searchBayi() {
        const query = document.getElementById('search').value.toLowerCase();
        //const suggestions = document.getElementById('suggestions');
        const rows = document.querySelectorAll('.vitamin-row');
        //const filteredRows = [];
        let found = false; // Flag untuk memeriksa apakah ada hasil pencarian

        // Sembunyikan pesan error sebelum memulai pencarian
        const errorMessage = document.getElementById('error-message');
        errorMessage.classList.add('hidden');
        errorMessage.textContent = '';

        // Filter rows berdasarkan nama bayi yang dicari
        rows.forEach(row => {
            const namaBayi = row.getAttribute('data-nama').toLowerCase();

            // Jika nama bayi mengandung query, tampilkan baris tersebut
            if (namaBayi.includes(query)) {
                row.style.display = ''; // Tampilkan baris yang cocok
                //filteredRows.push(row);
                found = true;
            } else {
                row.style.display = 'none'; // Sembunyikan baris yang tidak cocok
            }
        });

        // Jika tidak ada hasil yang ditemukan, tampilkan pesan error
        if (!found && query.length > 0) {
            errorMessage.textContent = `Nama "${query}" tidak ada.`;
            errorMessage.classList.remove('hidden');
        }
        
        // Menampilkan saran jika input ada dan ada baris yang cocok
        if (query.length > 0 && filteredRows.length > 0) {
            suggestions.innerHTML = '';
            filteredRows.forEach(row => {
                const suggestion = document.createElement('div');
                suggestion.classList.add('p-2', 'cursor-pointer');
                suggestion.textContent = row.getAttribute('data-nama');
                suggestion.onclick = function() {
                    document.getElementById('search').value = suggestion.textContent;
                    searchBayi(); // Trigger pencarian lagi untuk filter tabel
                    suggestions.innerHTML = ''; // Bersihkan saran setelah memilih
                };
                suggestions.appendChild(suggestion);
            });
            suggestions.classList.remove('hidden');
        } else {
            suggestions.classList.add('hidden'); // Sembunyikan saran jika tidak ada hasil
        }
    }
    </script>
</body>
</html>
