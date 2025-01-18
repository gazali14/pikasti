<x-layout-admin :selectedKader="$selectedKader">
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold mx-5">Daftar Dokumentasi</h1>
    </div>
    <div class="min-h-screen max-h-96">
        <div class="container mx-auto p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                <div class="mx-auto mt-1 mb-10 p-5">
                    <div class="overflow-x-auto">
                        <!-- Search bar dan tombol tambah -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 overflow-auto">
                            <form class="shrink-0">
                                <input type="search" id="default-search"
                                    class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                                    placeholder="Cari Dokumentasi" required />
                            </form>

                            <button id="tambahButton"
                                class="p-3 bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[200px] max-w-[250px] whitespace-nowrap shrink-0"
                                onclick="showPopup('Tambah Dokumentasi')">
                                <i class="fas fa-folder-plus"></i>
                                <span>Tambah Dokumentasi</span>
                            </button>
                        </div>

                        <!-- Tabel -->
                        <div class="mt-5">
                            <table id="dokumentasiTable" class="w-full table-auto border border-[#62BCB1]">
                                <thead>
                                    <tr>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Nama
                                            Kegiatan</th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                                            Tanggal
                                        </th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white ">
                                    @forelse ($dokumentasis as $dokumentasi)
                                        <tr class="text-center">
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
                                                {{ $dokumentasi->nama_kegiatan }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
                                                {{ $dokumentasi->tanggal->format('d-m-Y') }}
                                            </td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
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
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-gray-500 py-4">
                                                Belum ada dokumentasi yang tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-4">
                            {{ $dokumentasis->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup form -->
            <div id="popupForm" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div
                    class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full max-h-[80vh] overflow-y-auto m-4">

                    <h2 id="popupTitle" class="text-xl text-center font-bold mb-4"></h2>
                    <form id="popupInputForm" action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-black-700" for="namaKegiatan">Nama Kegiatan</label>
                            <input type="text" id="namaKegiatan" name="nama_kegiatan" required
                                class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                        </div>
                        @error('nama_kegiatan')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-black-700" for="deskripsiKegiatan">Deskripsi</label>
                            <input type="text" id="deskripsiKegiatan" name="deskripsi"
                                class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                        </div>
                        @error('deskripsi')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-black-700" for="tanggalKegiatan">Tanggal</label>
                            <input type="date" id="tanggalKegiatan" name="tanggal" required
                                class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 bg-white rounded-lg" />
                        </div>
                        @error('tanggal')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-black-700" for="foto">Upload Foto</label>
                            <input type="file" id="foto" name="foto[]" multiple
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
                fetch(`{{ route('dokumentasi.index') }}?search=${search}`)
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
