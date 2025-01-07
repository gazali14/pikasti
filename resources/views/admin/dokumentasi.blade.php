<x-layout-admin>
    <h1 class="text-3xl font-bold mx-5">Daftar Dokumentasi</h1>
    <div class="min-h-screen max-h-96">
        <div class="container mx-auto p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                <div class="mx-auto mt-1 mb-10 p-5">
                    <!-- Search bar dan tombol tambah -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <form method="GET" action="{{ route('dokumentasi.search') }}">
                            <input type="text" id="search" name='search' placeholder="Cari Dokumentasi"
                                class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                                placeholder="Cari Dokumentasi" />
                        </form>

                        <button id="tambahButton"
                            class="p-3 bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[250px] max-w-[250px] whitespace-nowrap"
                            onclick="showPopup('Tambah Dokumentasi')">
                            <i class="fas fa-folder-plus"></i>
                            <span>Tambah Dokumumentasi</span>
                        </button>
                    </div>

                    <!-- Tabel -->
                    <table id="dokumentasiTable" class="w-full table-auto border border-[#62BCB1] mt-5">
                        <thead>
                            <tr>
                                <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Nama
                                    Kegiatan</th>
                                <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Tanggal
                                </th>
                                <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white ">
                            @foreach ($dokumentasis as $dokumentasi)
                                <tr class="border-b">
                                    <td class="border border-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                                        {{ $dokumentasi->nama_kegiatan }}</td>
                                    <td class="border border-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                                        {{ $dokumentasi->tanggal->format('d-m-Y') }}
                                    </td>
                                    <td class="border border-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                                        <div class="flex justify-center items-center space-x-2">
                                            <button
                                                class="editButton bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition text-sm sm:text-base"
                                                onclick="showPopup('Edit Jadwal Posyandu', '{{ $dokumentasi->id }}', '{{ $dokumentasi->nama_kegiatan }}', '{{ $dokumentasi->deskripsi }}','{{ $dokumentasi->tanggal->format('Y-m-d') }}')">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </button>
                                            <!-- Tombol Hapus dengan SweetAlert -->
                                            <form action="{{ route('dokumentasi.destroy', $dokumentasi->id) }}"
                                                method="POST" class="delete-form">
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
                </div>
            </div>
        </div>

        <!-- Popup form -->
        <div id="popupForm" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white p-5 rounded-md w-2/4 shadow-lg">
                <h2 id="popupTitle" class="text-xl text-center font-bold mb-4"></h2>
                <form id="popupInputForm" action="{{ route('dokumentasi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black-700" for="namaKegiatan">Nama
                            Kegiatan</label>
                        <input type="text" id="namaKegiatan" name="nama_kegiatan" required
                            class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                    </div>
                    @error('nama_kegiatan')
                        <span class="text-red-500 text-sm">* {{ $message }}</span>
                    @enderror

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black-700" for="namaKegiatan">Deskripsi</label>
                        <input type="text" id="deskripsiKegiatan" name="deskripsi"
                            class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                    </div>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm">* {{ $message }}</span>
                    @enderror

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black-700" for="tanggal">Tanggal</label>
                        <input type="date" id="tanggalKegiatan" name="tanggal" required
                            class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                    </div>
                    @error('tanggal')
                        <span class="text-red-500 text-sm">* {{ $message }}</span>
                    @enderror

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-black-700" for="foto">Upload
                            Foto</label>
                        <input type="file" id="foto" name="foto.*" multiple
                            class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                    </div>
                    @error('foto.*')
                        <span class="text-red-500 text-sm">* {{ $message }}</span>
                    @enderror

                    <div class="flex justify-end">
                        <button type="button"
                            class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition"
                            onclick="hidePopup()">Batal</button>
                        <button type="submit"
                            class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <!-- Javascript -->
    <script>
        function showPopup(title, id = '', nama_kegiatan = '', deskripsi = '', tanggal = '') {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('namaKegiatan').value = nama_kegiatan;
            document.getElementById('deskripsiKegiatan').value = deskripsi;
            document.getElementById('tanggalKegiatan').value = tanggal;

            let form = document.getElementById('popupInputForm');
            if (id) {
                // Mode Edit
                form.action = `/admin/dokumentasi/${id}`;
                form.method = 'POST';
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            } else {
                form.action = '{{ route('dokumentasi.store') }}';
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
                    text: "Anda tidak dapat membatalkan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Kirim form jika dikonfirmasi
                    }
                });
            });
        });

        // Notifikasi sukses menambahkan data kader
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Lokasi di kanan atas
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false, // Tidak ada tombol
                    timer: 3000, // Menghilang setelah 3 detik
                    timerProgressBar: true, // Menampilkan progress bar
                });
            @endif
        });

        document.getElementById('search').addEventListener('input', function() {
            let searchQuery = this.value.toLowerCase();
            let rows = document.querySelectorAll('#dokumentasiTable tbody tr');

            rows.forEach((row) => {
                let namaKegiatan = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                let tanggal = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (namaKegiatan.includes(searchQuery) || tanggal.includes(searchQuery)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris yang tidak sesuai
                }
            });
        });
    </script>
</x-layout-admin>
