<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    @props(['bayiList', 'konsultasiData', 'selectedBayiNik'])
    <div class="mx-auto mt-1 mb-10 p-5">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-between gap-4 mb-5">
            <!-- Dropdown Pilih Bayi -->
            <div class="relative w-full sm:w-auto">
                <button id="dropdown-button"
                    class="inline-flex items-center justify-between w-full sm:w-80 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                    {{ $bayiList->firstWhere('nik', $selectedBayiNik)->nama ?? 'Pilih Nama Bayi' }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-black" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M3 5h18a1 1 0 0 1 .8 1.6l-6.6 8.8a1 1 0 0 0-.2.6v5.2a1 1 0 0 1-1.6.8l-4-3.2a1 1 0 0 1-.4-.8v-2.6a1 1 0 0 0-.2-.6L2.2 6.6A1 1 0 0 1 3 5z" />
                    </svg>
                </button>
                <div id="dropdown-menu"
                    class="hidden absolute left-0 mt-2 w-full sm:w-64 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-20">
                    <input id="search-input"
                        class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none"
                        type="text" placeholder="Cari Nama Bayi..." autocomplete="off">
                    <div id="dropdown-list" class="max-h-60 overflow-y-auto">
                        @foreach ($bayiList as $bayi)
                            <a href="javascript:void(0)"
                                onclick="selectBayi('{{ $bayi->nik }}', '{{ $bayi->nama }}')"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">
                                {{ $bayi->nama }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah -->
            <button id="add-button"
                class="p-3 w-full sm:w-auto bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[200px] max-w-[250px] whitespace-nowrap">
                <i class="fas fa-folder-plus"></i>
                <span>Tambah Data Konsultasi</span>
            </button>
        </div>

        <!-- Informasi Bayi -->
        @if ($selectedBayiNik)
            @php
                $selectedBayi = $bayiList->firstWhere('nik', $selectedBayiNik);
                $tanggalLahir = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir);
                $usiaBulan = floor($tanggalLahir->diffInMonths(now()));
            @endphp
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-black mb-2">Informasi Data Bayi</h3>
                <table class="table-auto text-sm text-black">
                    <tr>
                        <td class="pr-4 font-semibold">Nama</td>
                        <td class="px-2">:</td>
                        <td>{{ $selectedBayi->nama }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4 font-semibold">Jenis Kelamin</td>
                        <td class="px-2">:</td>
                        <td>{{ $selectedBayi->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="pr-4 font-semibold">Tanggal Lahir</td>
                        <td class="px-2">:</td>
                        <td>{{ $selectedBayi->tanggal_lahir }}</td>
                    </tr>
                </table>
            </div>
        @endif

        <!-- Tabel Data Konsultasi -->
        <div class="rounded shadow-sm overflow-x-auto">
            <table id="TablePmt" class="min-w-full table-auto border border-[#62BCB1]">
                <thead>
                    <tr>
                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                            Tanggal</th>
                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                            Catatan Konsultasi</th>
                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class= "bg-white">
                    @forelse ($konsultasiData as $konsultasi)
                        <tr>
                            <td
                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                {{ $konsultasi->tanggal }}
                            </td>
                            <td
                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                {{ $konsultasi->konsultasi }}</td>
                            <td
                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                <!-- Tombol Edit -->
                                <button type="button"
                                    onclick="openEditModal('{{ $konsultasi->id }}', '{{ $konsultasi->tanggal }}', '{{ $konsultasi->konsultasi }}')"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </button>

                                <!-- Tombol Hapus -->
                                <form id="delete-form-{{ $konsultasi->id }}"
                                    action="{{ route('konsultasi.destroy', $konsultasi->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $konsultasi->id }})"
                                        class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500">Belum ada data Konsultasi untuk bayi
                                ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-full sm:w-1/2 md:w-1/3 mx-4">
            <h2 id="modal-title" class="text-lg font-bold mb-4">Tambah Data</h2>
            <form id="form-data" action="{{ route('konsultasi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nik_bayi" value="{{ $selectedBayiNik }}">

                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="block w-full px-3 py-2 border rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="konsultasi" class="block text-sm font-medium">Catatan Konsultasi</label>
                    <input type="text" name="konsultasi" id="konsultasi"
                        class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="cancel-button"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modal-edit" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-full sm:w-1/2 md:w-1/3 mx-4">
            <h2 class="text-lg font-bold mb-4">Edit Data</h2>
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit-tanggal" class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="edit-tanggal"
                        class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="edit-konsultasi" class="block text-sm font-medium">Catatan Konsultasi</label>
                    <input type="text" name="konsultasi" id="edit-konsultasi"
                        class="block w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="edit-cancel-button"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
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
            dropdownButton.innerHTML = `Pilih Nama Bayi: ${nama}`;
            dropdownMenu.classList.add('hidden');
            window.location.href = `/kader/konsultasi/${nik}`;
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
            document.getElementById('form-data').reset();
        };

        // Event untuk tombol batal di modal
        document.getElementById('cancel-button').onclick = closeModal;

        // Fungsi untuk membuka modal edit
        const openEditModal = (id, tanggal, konsultasi) => {
            const modal = document.getElementById('modal-edit');
            modal.classList.remove('hidden');
            // Isi nilai input dalam form
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-konsultasi').value = konsultasi;
            // Update action form untuk route update
            const form = document.getElementById('form-edit');
            form.action = `/kader/konsultasi/${id}`;
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
            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik "Ya, Hapus!", kirim form penghapusan
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        // Notifikasi sukses menambahkan data kader
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end', 
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false, 
                    timer: 3000, 
                    timerProgressBar: true, 
                });
            @endif
        });
    </script>
</body>
</html>
