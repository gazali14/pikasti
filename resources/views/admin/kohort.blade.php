<x-layout-admin :selectedKader="$selectedKader">
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold mx-5">Registrasi Kohort Bayi</h1>
    </div>
    <div class="min-h-screen max-h-96">
        <div class="container mx-auto p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                <div class="mx-auto mt-1 mb-10 p-5">
                    <div class="overflow-x-auto">
                        <!-- Search bar dan tombol tambah -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <form class="shrink-0">
                                <input type="search" id="default-search"
                                    class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                                    placeholder="Cari Bayi" required />
                            </form>

                            <button id="tambahButton"
                                class="p-3 bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[200px] max-w-[250px] whitespace-nowrap shrink-0"
                                onclick="showPopup('Registrasi Bayi')">
                                <i class="fas fa-folder-plus"></i>
                                <span>Registrasi Bayi</span>
                            </button>
                        </div>

                        <!-- Tabel -->
                        <div class="mt-5">
                            <table id="kohortTable" class="w-full table-auto border border-[#62BCB1]">
                                <thead>
                                    <tr>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">NIK
                                        </th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                                            Nama Bayi
                                        </th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Orang
                                            Tua</th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">
                                            Tanggal Lahir</th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Alamat
                                        </th>
                                        <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-center">
                                    @forelse ($bayis as $bayi)
                                        <tr class="text-center">
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $bayi->nik }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $bayi->nama }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $bayi->nama_ibu }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $bayi->tanggal_lahir }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $bayi->alamat }}</td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <button
                                                        class="editButton bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition text-sm sm:text-base"
                                                        onclick="showPopup('Edit Data Bayi', '{{ $bayi->nik }}', '{{ $bayi->nama }}', '{{ $bayi->nama_ibu }}', '{{ $bayi->tanggal_lahir }}', '{{ $bayi->jenis_kelamin }}', '{{ $bayi->alamat }}', '{{ $bayi->berat_badan_lahir }}', '{{ $bayi->tinggi_badan_lahir }}')">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                    <!-- Tombol Hapus dengan SweetAlert -->
                                                    <form action="{{ route('kohort.destroy', $bayi->nik) }}"
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
                                            <td colspan="6" class="text-center text-gray-500 py-4">
                                                Tidak ada data bayi yang tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-4">
                            {{ $bayis->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup form -->
            <div id="popupForm" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full max-h-[80vh] overflow-y-auto m-4">

                    <h2 id="popupTitle" class="text-xl text-center font-bold mb-4"></h2>
                    <form id="popupInputForm" action="{{ route('dokumentasi.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" id="nik" name="nik" maxlength="16" pattern="\d{16}"
                                class="w-full border p-2 rounded" placeholder="NIK harus terdiri dari 16 Digit"
                                required />
                            @error('nik')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <label for="namaBayi" class="block text-sm font-medium text-gray-700">Nama Bayi</label>
                            <input type="text" id="namaBayi" name="nama" class="w-full border p-2 rounded"
                                required />
                            @error('nama')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <label for="namaIbu" class="block text-sm font-medium text-gray-700">Nama Orang Tua</label>
                            <input type="text" id="namaIbu" name="nama_ibu" class="w-full border p-2 rounded"
                                required />
                            @error('nama_ibu')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <label for="tanggalLahir" class="block text-sm font-medium text-gray-700">Tanggal
                                Lahir</label>
                            <input type="date" id="tanggalLahir" name="tanggal_lahir"
                                class="w-full border p-2 rounded" required />
                            @error('tanggal_lahir')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <label for="jenisKelamin" class="block text-sm font-medium text-gray-700">Jenis
                                Kelamin</label>
                            <select id="jenisKelamin" name="jenis_kelamin" class="w-full border p-2 rounded" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="w-full border p-2 rounded"
                                required />
                            @error('alamat')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror


                            <label for="beratLahir" class="block text-sm font-medium text-gray-700">Berat Lahir
                                (kg)</label>
                            <input type="text" id="beratLahir" name="berat_badan_lahir"
                                class="w-full border p-2 rounded" required />
                            @error('berat_badan_lahir')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <label for="tinggiLahir" class="block text-sm font-medium text-gray-700">Tinggi Lahir
                                (cm)</label>
                            <input type="text" id="tinggiLahir" name="tinggi_badan_lahir"
                                class="w-full border p-2 rounded" required />
                            @error('tinggi_badan_lahir')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror

                            <div>
                                <label for="addPassword"
                                    class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="relative">
                                    <input type="password" id="addPassword" name="password"
                                        class="w-full border p-2 rounded" />
                                    <span id="togglePassword"
                                        class="absolute right-4 top-[50%] transform -translate-y-1/2 cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

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
            function showPopup(title, nik = '', nama = '', nama_ibu = '', tanggal_lahir = '', jenis_kelamin = '', alamat = '',
                berat_badan_lahir = '', tinggi_badan_lahir = '') {
                document.getElementById('popupTitle').textContent = title;
                document.getElementById('nik').value = nik;
                document.getElementById('namaBayi').value = nama;
                document.getElementById('namaIbu').value = nama_ibu;
                document.getElementById('tanggalLahir').value = tanggal_lahir;
                document.getElementById('jenisKelamin').value = jenis_kelamin;
                document.getElementById('alamat').value = alamat;
                document.getElementById('beratLahir').value = berat_badan_lahir;
                document.getElementById('tinggiLahir').value = tinggi_badan_lahir;

                let form = document.getElementById('popupInputForm');
                if (nik) {
                    // Mode Edit
                    form.action = `/admin/kohort/${nik}`;
                    form.method = 'POST';
                    let methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                } else {
                    form.action = '{{ route('kohort.store') }}';
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
                fetch(`{{ route('kohort.index') }}?search=${search}`)
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

            // Toggle Password Visibility
            function setupPasswordToggle(inputId, toggleId) {
                const input = document.getElementById(inputId);
                const toggle = document.getElementById(toggleId);

                toggle.addEventListener('click', () => {
                    if (input.type === 'password') {
                        input.type = 'text';
                        toggle.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Ikon untuk "Hide"
                    } else {
                        input.type = 'password';
                        toggle.innerHTML = '<i class="fas fa-eye"></i>'; // Ikon untuk "Show"
                    }
                });
            }

            setupPasswordToggle('addPassword', 'togglePassword')
        </script>
</x-layout-admin>
