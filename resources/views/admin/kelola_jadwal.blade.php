<x-layout-admin :selectedKader='$selectedKader'>
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold mx-5">Daftar Jadwal Posyandu</h1>
    </div>
    <div class="min-h-screen max-h-96">
        <div class="container mx-auto p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                <div class="mx-auto mt-1 mb-10 p-5">
                    <div class="overflow-x-auto">
                        <!-- Container untuk search box dan tombol tambah -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <!-- Form pencarian -->
                            <form class="shrink-0">
                                <input type="search" id="default-search"
                                    class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                                    placeholder="Cari Dokumentasi" required />
                            </form>

                            <!-- Tombol tambah -->
                            <button id="tambahButton"
                                class="p-3 bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[170px] max-w-[170px] whitespace-nowrap"
                                onclick="showPopup('Tambah Jadwal Posyandu')">
                                <i class="fas fa-folder-plus"></i>
                                <span>Tambah Jadwal</span>
                            </button>
                        </div>

                        <!-- Tabel -->
                        <div class="mt-5">
                            <table id="jadwalPosyanduTable" class="w-full table-auto border border-[#62BCB1]">
                                <thead>
                                    <tr>
                                        <th class="text-white border bg-[#62BCB1] text-sm sm:text-base py-2 px-4">Nama
                                            Kegiatan</th>
                                        <th class="text-white border bg-[#62BCB1] text-sm sm:text-base py-2 px-4">
                                            Tanggal</th>
                                        <th class="text-white border bg-[#62BCB1] text-sm sm:text-base py-2 px-4">Jam
                                            Pelayanan</th>
                                        <th class="text-white border bg-[#62BCB1] text-sm sm:text-base py-2 px-4">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($jadwals as $jadwal)
                                        <tr class="text-center">
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
                                                {{ $jadwal->nama_kegiatan }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $jadwal->tanggal->format('Y-m-d') }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $jadwal->waktu }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <!-- Tombol Edit -->
                                                    <button
                                                        class="editButton bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition text-sm sm:text-base"
                                                        onclick="showPopup('Edit Jadwal Posyandu', '{{ $jadwal->id }}', '{{ $jadwal->nama_kegiatan }}', '{{ $jadwal->tanggal->format('Y-m-d') }}', '{{ $jadwal->waktu }}')">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                    <!-- Tombol Hapus dengan SweetAlert -->
                                                    <form action="{{ route('kelola_jadwal.destroy', $jadwal->id) }}"
                                                        method="POST" class="delete-form inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition text-sm sm:text-base">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span>Hapus</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $jadwals->links('vendor.pagination.tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pop-up Modal -->
        <div id="popupForm" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full max-h-[80vh] overflow-y-auto m-4">
                <h2 id="popupTitle" class="text-xl text-center font-bold mb-4"></h2>
                <form id="popupInputForm" action="{{ route('kelola_jadwal.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black-700" for="namaKegiatan">Nama
                            Kegiatan</label>
                        <input type="text" id="namaKegiatan" name="nama_kegiatan" placeholder="Nama Kegiatan"
                            required
                            class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white focus:border-gray-300 focus:ring-1 focus:ring-gray-300 rounded-lg" />
                    </div>
                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label for="tanggalKegiatan" class="block mb-2 text-sm font-bold text-black-700">Tanggal
                                Kegiatan</label>
                            <input type="date" id="tanggalKegiatan" name="tanggal"
                                class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white focus:border-gray-300 focus:ring-1 focus:ring-gray-300 rounded-lg"
                                required />
                        </div>
                        <div class="w-1/2">
                            <label for="jamPelayanan" class="block mb-2 text-sm font-bold text-black-900">Jam
                                Pelayanan</label>
                            <input type="time" id="jamPelayanan" name="waktu"
                                class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white focus:border-gray-300 focus:ring-1 focus:ring-gray-300 rounded-lg"
                                value="00:00" required />
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="cancelButton"
                            class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition"
                            onclick="hidePopup()">Batal</button>
                        <button type="submit"
                            class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <script>
        function showPopup(title, id = '', nama_kegiatan = '', tanggal = '', waktu = '') {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('namaKegiatan').value = nama_kegiatan;
            document.getElementById('tanggalKegiatan').value = tanggal;
            document.getElementById('jamPelayanan').value = waktu;

            let form = document.getElementById('popupInputForm');
            if (id) {
                // Mode Edit
                form.action = `/admin/kelola_jadwal/${id}`;
                form.method = 'POST';
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            } else {
                // Mode Tambah
                form.action = '{{ route('kelola_jadwal.store') }}';
                form.method = 'POST';
            }

            document.getElementById('popupForm').classList.remove('hidden');
        }

        function hidePopup() {
            document.getElementById('popupForm').classList.add('hidden');
        }

        // SweetAlert Konfirmasi Hapus
        document.querySelectorAll('.delete-form').forEach((form) => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat membatalkan ini! Data presensi yang ada juga akan dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

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

        // Notifikasi error
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                });
            @endif
        });

        // Pencarian dengan AJAX
        document.getElementById('default-search').addEventListener('input', function() {
            const search = this.value;

            fetch(`{{ route('kelola_jadwal.index') }}?search=${search}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const tbody = doc.querySelector('tbody');
                    document.querySelector('tbody').innerHTML = tbody.innerHTML;

                    // Reapply event listeners for dynamically updated rows
                    attachRowEventListeners();
                });
        });
    </script>
</x-layout-admin>
