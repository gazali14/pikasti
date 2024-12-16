<x-layout-admin>
    <body class="bg-[#E8F6F3] font-poppins m-0 p-0">
        <div class="flex items-center mb-2 mx-auto">
            <button onclick="window.history.back()"
                class="flex items-center px-2 py-2 text-sm text-white bg-[#62BCB1] rounded-lg hover:bg-teal-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="p-5 font-bold text-[#353535] font-poppins text-3xl">Presensi Kader</h1>
        </div>

        <div class="max-w-screen-xl mx-auto p-5">
            <div class="flex flex-wrap justify-between items-center mb-3">
                <div class="flex items-center w-full sm:w-auto mb-4">
                    <label for="search-date" class="mr-4 text-lg text-gray-800">Tanggal:</label>
                    <input type="date" id="search-date"
                        class="block w-full sm:w-48 py-2 pl-5 pr-5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg">
                </div>

                <div class="relative w-full sm:w-auto items-center mb-4 flex">
                    <input type="search" id="search" class="block w-full py-2 pl-5 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                        placeholder="Cari Nama Kader" />
                    <button type="submit"
                        class="ml-3 bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d]">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Tabel Kehadiran -->
            <table class="w-full border-collapse mb-5 table-auto">
                <thead class="bg-teal-500">
                    <tr>
                        <th class="text-black text-center py-3 px-4">NIK</th>
                        <th class="text-black text-center py-3 px-4">Nama Kader</th>
                        <th class="text-black text-center py-3 px-4">Jenis Kelamin</th>
                        <th class="text-black text-center py-3 px-4">Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-sm text-gray-900 font-light border-collapse border border-[#62BCB1]" id="table-body">
                    @foreach($kaders as $kader)
                    <tr class="hover:bg-teal-100 transition-colors duration-200">
                        <td class="border px-4 py-3 text-center text-gray-700 font-semibold">{{ $kader->nik }}</td>
                        <td class="border px-4 py-3 text-center text-gray-700 font-semibold">{{ $kader->nama }}</td>
                        <td class="border px-4 py-3 text-center text-gray-700 font-semibold">{{ $kader->jenis_kelamin }}</td>
                        <td class="border px-4 py-3 text-center">
                            <input type="checkbox" class="presence-checkbox rounded-lg border-teal-500 focus:ring-2 focus:ring-teal-400"
                                data-id="{{ $kader->id }}"
                                data-nik="{{ $kader->nik }}"
                                data-nama="{{ $kader->nama }}"
                                data-jenis_kelamin="{{ $kader->jenis_kelamin }}" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol Simpan -->
            <button id="save-button"
                class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                Simpan
            </button>
        </div>

        <script>
            document.getElementById('save-button').addEventListener('click', function () {
                const searchDate = document.getElementById('search-date').value; // Ambil tanggal yang dipilih
                const checkedCheckboxes = document.querySelectorAll('.presence-checkbox:checked');
                const presensiData = [];
                const waktu = new Date().toLocaleTimeString(); // Ambil waktu saat ini

                if (!searchDate) {
                    alert('Harap pilih tanggal terlebih dahulu!');
                    return; // Pastikan tanggal dipilih sebelum menyimpan
                }

                checkedCheckboxes.forEach(checkbox => {
                    const data = {
                        nik: checkbox.getAttribute('data-nik'),
                        nama_kader: checkbox.getAttribute('data-nama'),
                        kehadiran: true,
                        jenis_kelamin: checkbox.getAttribute('data-jenis_kelamin'),
                        tanggal: searchDate,
                        waktu: waktu,
                        id_kegiatan: checkbox.getAttribute('data-id') // Jika id_kegiatan adalah ID kader atau yang relevan
                    };
                    presensiData.push(data);
                });

                // Cek jika tidak ada kader yang dipilih
                if (presensiData.length === 0) {
                    alert('Harap pilih kader yang hadir!');
                    return;
                }

                fetch('{{ route("presensi.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        presensi: presensiData
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Tampilkan pesan dari server
                })
                .catch(error => console.error('Error:', error));
            });
        </script>
    </body>
</x-layout-admin>
