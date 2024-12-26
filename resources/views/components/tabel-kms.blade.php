<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel KMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- resources/views/components/tabel-kms.blade.php -->
    @props(['bayiList', 'kmsData', 'selectedBayiNik'])

    <div class="container mx-auto mt-5 mb-10 px-10">
        <!-- Dropdown dan Tombol Tambah -->
        <div class="flex items-center justify-between mb-4">
            <!-- Dropdown Pilih Bayi -->
            <div class="relative">
                <button id="dropdown-button" class="inline-flex items-center justify-between px-4 py-2 w-full text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                    <!-- Teks Dropdown -->
                    {{ $bayiList->firstWhere('nik', $selectedBayiNik)->nama ?? 'Pilih Nama Bayi' }}
                    <!-- Ikon Filter -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 5h18a1 1 0 0 1 .8 1.6l-6.6 8.8a1 1 0 0 0-.2.6v5.2a1 1 0 0 1-1.6.8l-4-3.2a1 1 0 0 1-.4-.8v-2.6a1 1 0 0 0-.2-.6L2.2 6.6A1 1 0 0 1 3 5z" />
                    </svg>
                </button>
                <div id="dropdown-menu" class="hidden absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <input id="search-input" class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none" type="text" placeholder="Cari Nama Bayi..." autocomplete="off">
                    <div id="dropdown-list">
                        @foreach ($bayiList as $bayi)
                            <a href="javascript:void(0)" onclick="selectBayi('{{ $bayi->nik }}', '{{ $bayi->nama }}')"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">
                                {{ $bayi->nama }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah -->
            <div>
                <button id="add-button" class="px-6 py-2.5 bg-black text-white font-medium text-sm leading-tight uppercase rounded-md shadow-md hover:bg-green-600 transition duration-150 ease-in-out">
                    Tambah
                </button>
            </div>
        </div>

        <!-- Tabel Data KMS -->
        <div class="rounded shadow-sm overflow-x-auto">
            <table id="TableKMS" class="min-w-full border-collapse border border-[#62BCB1]">
                <thead>
                    <tr>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">Tanggal</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">Tinggi Badan (cm)</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">Berat Badan (kg)</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">Kategori</th>
                        <th class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class= "bg-white text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                    @forelse ($kmsData as $kms)
                        <tr class="border border-[#62BCB1] py-2 px-4">
                            <td class="text-center py-2 px-4">{{ $kms->tanggal }}</td>
                            <td class="text-center py-2 px-4">{{ $kms->tinggi_badan }}</td>
                            <td class="text-center py-2 px-4">{{ $kms->berat_badan }}</td>
                            <td class="text-center py-2 px-4">{{ $kms->kategori }}</td>
                            <td class="text-center py-2 px-4">
                                <!-- Tombol Edit -->
                                <button type="button" onclick="openEditModal('{{ $kms->id }}', '{{ $kms->tanggal }}', '{{ $kms->tinggi_badan }}', '{{ $kms->berat_badan }}', '{{ $kms->kategori }}')"
                                        class="bg-teal-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">Edit</button>

                                <!-- Tombol Hapus -->
                                <form id="delete-form-{{ $kms->id }}" action="{{ route('kms.destroy', $kms->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $kms->id }})" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">Belum ada data KMS untuk bayi ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Tambah -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 id="modal-title" class="text-lg font-bold mb-4">Tambah Data</h2>
            <form id="form-data" action="{{ route('kms.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nik_bayi" value="{{ $selectedBayiNik }}">

                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="tinggi_badan" class="block text-sm font-medium">Tinggi Badan (cm)</label>
                    <input type="number" name="tinggi_badan" id="tinggi_badan" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="berat_badan" class="block text-sm font-medium">Berat Badan (kg)</label>
                    <input type="number" name="berat_badan" id="berat_badan" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="kategori" class="block text-sm font-medium">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="cancel-button" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modal-edit" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-lg font-bold mb-4">Edit Data</h2>
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit-tanggal" class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="edit-tanggal" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="edit-tinggi_badan" class="block text-sm font-medium">Tinggi Badan (cm)</label>
                    <input type="number" name="tinggi_badan" id="edit-tinggi_badan" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="edit-berat_badan" class="block text-sm font-medium">Berat Badan (kg)</label>
                    <input type="number" name="berat_badan" id="edit-berat_badan" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="edit-kategori" class="block text-sm font-medium">Kategori</label>
                    <input type="text" name="kategori" id="edit-kategori" class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="edit-cancel-button" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        let selectedBayiNik = "{{ $selectedBayiNik }}";

        // Fungsi untuk membuka dropdown
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const searchInput = document.getElementById('search-input');

        dropdownButton.onclick = () => {
            dropdownMenu.classList.toggle('hidden');
        };

        // Menyembunyikan dropdown jika klik terjadi di luar dropdown
        document.onclick = (e) => {
            if (!dropdownMenu.contains(e.target) && !dropdownButton.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        };

        // Fungsi pencarian pada dropdown
        searchInput.oninput = () => {
            const searchTerm = searchInput.value.toLowerCase();
            const items = dropdownMenu.querySelectorAll('a');
            items.forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(searchTerm) ? 'block' : 'none';
            });
        };

        // Fungsi untuk memilih bayi dari dropdown
        const selectBayi = (nik, nama) => {
            selectedBayiNik = nik;

            // Menampilkan nama bayi yang dipilih di tombol dropdown
            dropdownButton.innerHTML = `Pilih Nama Bayi: ${nama}`;
            
            // Menutup dropdown setelah bayi dipilih
            dropdownMenu.classList.add('hidden');

            // Redirect ke server untuk memuat data bayi yang dipilih
            window.location.href = `/kader/kms/${nik}`;
        };

        // Event untuk tombol tambah data
        document.getElementById('add-button').onclick = () => {
            if (!selectedBayiNik) {
                alert('Pilih nama bayi terlebih dahulu!');
            } else {
                openModal();
            }
        };

        // Fungsi untuk membuka modal
        const openModal = () => {
            document.getElementById('modal').classList.remove('hidden');
        };

        // Fungsi untuk menutup modal
        const closeModal = () => {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('form-data').reset(); // Reset data pada form modal
        };

        // Event untuk tombol batal di modal
        document.getElementById('cancel-button').onclick = closeModal;

        // Fungsi untuk membuka modal edit
        const openEditModal = (nik, tanggal, tinggi_badan, berat_badan, kategori) => {
            const modal = document.getElementById('modal-edit');
            modal.classList.remove('hidden');

            // Isi nilai input dalam form
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-tinggi_badan').value = tinggi_badan;
            document.getElementById('edit-berat_badan').value = berat_badan;
            document.getElementById('edit-kategori').value = kategori;

            // Update action form untuk route update
            const form = document.getElementById('form-edit');
            form.action = `/kader/kms/${nik}`;
        };

        // Fungsi untuk menutup modal edit
        const closeEditModal = () => {
            const modal = document.getElementById('modal-edit');
            modal.classList.add('hidden');
            document.getElementById('form-edit').reset(); // Reset data pada form
        };

        // Event untuk tombol batal di modal edit
        document.getElementById('edit-cancel-button').onclick = closeEditModal;

        // Fungsi untuk menampilkan popup konfirmasi sebelum menghapus
        function confirmDelete(id) {
            // Tampilkan dialog konfirmasi
            const confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');

            // Jika pengguna mengklik "OK", kirim form penghapusan
            if (confirmation) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
</body>

</html>
