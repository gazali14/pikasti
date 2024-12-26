<x-layout-admin>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Tabel Daftar Kader dengan Scroll -->
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
            {{-- <x-tabel-daftar-kader /> --}}
            <div class="">
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
                            <div class="absolute right-2.5 top-1/2 -translate-y-1/2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Magnifying_glass_icon.svg/2048px-Magnifying_glass_icon.svg.png"
                                    alt="Cari" class="w-5 h-5">
                            </div>
                        </div>
                    </form>


                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table id="kaderTable" class="min-w-full table-fixed border-collapse border border-[#62BCB1]">
                            <thead>
                                <tr>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Nama</th>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Alamat</th>
                                    <th
                                        class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                        Jabatan</th>
                                </tr>
                            </thead>
                            <tbody
                                class= "bg-white text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                <!-- Contoh Data -->
                                @forelse ($kaders as $kader)
                                    <tr class="border-b kader-row" data-id="{{ $kader->id }}">
                                        <td
                                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                            {{ $kader->nama }}
                                        </td>
                                        <td
                                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                            {{ $kader->alamat }}
                                        </td>
                                        <td
                                            class="text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                                            {{ $kader->jabatan }}
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center text-gray-500 col-span-full">Belum ada kader yang tersedia.
                                    </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
        </div>

        <!-- Form Tambah Kader -->
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Kader</h1>

            @if (session('success'))
                <p class="text-green-500">{{ session('success') }}</p>
            @endif

            <form action="{{ route('admin.kelola_kader.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Hidden input untuk ID (diisi saat edit) -->
                <input type="hidden" name="id" id="kader-id">

                <div class="flex flex-wrap md:flex-nowrap gap-6">
                    <!-- Kolom Kiri: Form -->
                    <div class="w-full md:w-2/3 space-y-4">
                        <div>
                            <label for="nik" class="block text-gray-700 font-medium">NIK</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required
                                class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                placeholder="Masukkan NIK">
                            @error('nik')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="nama" class="block text-gray-700 font-medium">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                placeholder="Masukkan Nama">
                            @error('nama')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block text-gray-700 font-medium">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
                                class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                placeholder="Masukkan Alamat">
                            @error('alamat')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="jabatan" class="block text-gray-700 font-medium">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" required
                                class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                placeholder="Masukkan Jabatan">
                            @error('jabatan')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative">
                            <label for="password" class="block text-gray-700 font-medium">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required
                                    class="w-full mt-1 p-2 pr-10 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                    placeholder="Masukkan Password">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-3 flex items-center justify-center text-gray-500 focus:outline-none">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">* {{ $message }}</span>
                            @enderror
                        </div>                        

                    </div>

                    <!-- Kolom Kanan: Foto -->
                    <div class="w-full md:w-1/3 flex flex-col items-center space-y-4">
                        <img id="photoPreview" src="{{ asset('public/img/login-pict.jpg') }}" alt="Placeholder"
                            class="w-48 h-60 object-cover border rounded shadow">
                        <input type="file" name="foto" id="foto"
                            class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                            onchange="previewPhoto(event)">
                        @error('foto')
                            <span class="text-red-500 text-sm">* {{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>

                <!-- Tombol -->
                <div class="flex justify-center gap-4">
                    <button type="reset"
                        class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Reset
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-layout-admin>


<script>
    // Pencarian dengan AJAX
    document.getElementById('default-search').addEventListener('input', function() {
        const search = this.value;

        fetch(`{{ route('admin.kelola_kader.index') }}?search=${search}`)
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

    let selectedRow = null;

    // Fungsi untuk menambahkan event listener ke baris tabel
    function attachRowEventListeners() {
        const rows = document.querySelectorAll('.kader-row');
        rows.forEach(row => {
            row.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah event keluar dari baris
                if (selectedRow === row) {
                    // Jika baris sudah dipilih, batalkan pemilihan
                    selectedRow.classList.remove('bg-blue-100');
                    selectedRow = null;
                    hideActionButtons();
                } else {
                    // Pilih baris baru
                    if (selectedRow) selectedRow.classList.remove('bg-blue-100');
                    selectedRow = row;
                    row.classList.add('bg-blue-100');
                    showActionButtons();
                }
            });
        });
    }

    // Menampilkan tombol aksi
    function showActionButtons() {
        document.getElementById('actionButtons').style.display = 'flex';
    }

    // Menyembunyikan tombol aksi
    function hideActionButtons() {
        document.getElementById('actionButtons').style.display = 'none';
    }

    // Tambahkan event listener ke tombol Edit
    document.getElementById('editBtn').addEventListener('click', function() {
        if (selectedRow) {
            const kaderId = selectedRow.getAttribute('data-id');

            // Fetch data kader dari server
            fetch(`{{ url('admin/kelola_kader') }}/${kaderId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi form dengan data kader
                    document.getElementById('nik').value = data.nik;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('alamat').value = data.alamat;
                    document.getElementById('jabatan').value = data.jabatan;
                    document.getElementById('password').value = ''; // Kosongkan password untuk keamanan
                    document.getElementById('kader-id').value = data.id; // Hidden input untuk ID
                });
        }
    });

    // Tambahkan event listener ke tombol Hapus
    document.getElementById('deleteBtn').addEventListener('click', function() {
        if (selectedRow) {
            const kaderId = selectedRow.getAttribute('data-id');
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus kader ini?');
            if (confirmDelete) {
                fetch(`{{ url('admin/kelola_kader') }}/${kaderId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success);
                        location.reload();
                    });
            }
        }
    });

    // Reset pilihan baris ketika klik di luar tabel
    document.addEventListener('click', function(event) {
        if (!event.target.closest('#kaderTable')) {
            if (selectedRow) {
                selectedRow.classList.remove('bg-blue-100');
                selectedRow = null;
                hideActionButtons();
            }
        }
    });

    // Jalankan fungsi untuk menambahkan event listener ke baris tabel pada saat pertama kali halaman dimuat
    attachRowEventListeners();


    // Javascript untuk menampilkan password
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePasswordButton.addEventListener('click', function() {
        // Cek tipe input saat ini
        const currentType = passwordInput.getAttribute('type');

        // Toggle tipe input
        if (currentType === 'password') {
            passwordInput.setAttribute('type', 'text');
            eyeIcon.setAttribute('d',
                'M13 16a4 4 0 01-6 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
                );
        } else {
            passwordInput.setAttribute('type', 'password');
        }
    });

    // Javascript untuk menampilkan foto yang diupload
    function previewPhoto(event) {
        const file = event.target.files[0]; // Ambil file yang dipilih
        const preview = document.getElementById('photoPreview'); // Ambil elemen img untuk preview

        // Pastikan ada file yang dipilih
        if (file) {
            const reader = new FileReader();

            // Ketika file selesai dibaca, tampilkan di elemen img
            reader.onload = function(e) {
                preview.src = e.target.result; // Ganti src img dengan data foto
            };

            reader.readAsDataURL(file); // Membaca file sebagai URL data base64
        } else {
            // Jika tidak ada file, kembalikan ke placeholder
            preview.src = '{{ asset('images/placeholder.jpg') }}';
        }
    }

</script>
