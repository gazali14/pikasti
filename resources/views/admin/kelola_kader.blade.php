<x-layout-admin :selectedKader='$selectedKader'>
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold mx-5">Kelola Kader</h1>
    </div>
    <div class="min-h-screen max-h-96">
        <div class="container mx-auto p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                <div class="mx-auto mt-1 mb-10 p-5">
                    <div id='kaderTableContainer'>
                        <div class="flex flex-wrap sm:flex-nowrap items-center justify-between gap-4 mb-5">
                            <div>
                                <input type="text" id="default-search" placeholder="Cari Nama Bayi" required
                                    class="border border-gray-300 rounded-md w-full sm:w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm" />
                            </div>
                            <button id='tambahKaderBtn'
                                class="p-3 bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[150px] max-w-[150px] whitespace-nowrap">
                                <i class="fas fa-folder-plus"></i>
                                <span>Tambah Kader</span>
                            </button>
                        </div>

                        <!-- Tombol Edit dan Hapus di atas tabel -->
                        <div class="flex justify-end mt-4" id="actionButtons" style="display: none;">
                            <button
                                class="inline-block  bg-blue-500 text-white px-6 py-2.5 rounded-md hover:bg-gray-600 transition duration-150 ease-in-out"
                                id="editBtn">Edit</button>
                            <button
                                class="inline-block px-6 py-2.5 bg-red-600 text-white rounded-md shadow-md hover:bg-gray-600 transition duration-150 ease-in-out ml-2"
                                id="deleteBtn">Hapus</button>
                        </div>

                        <!-- Table -->
                        <div class="rounded shadow-sm overflow-x-auto">
                            <table id="kaderTable" class="w-full table-auto border border-[#62BCB1] mt-5">
                                <thead>
                                    <tr>
                                        <th class="text-sm sm:text-base text-white bg-[#62BCB1] border px-4 py-2 ">
                                            Nama</th>
                                        <th class="text-sm sm:text-base text-white bg-[#62BCB1] border px-4 py-2 ">
                                            Alamat</th>
                                        <th class="text-sm sm:text-base text-white bg-[#62BCB1] border px-4 py-2 ">
                                            Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody class= "bg-white">
                                    <!-- Contoh Data -->
                                    @forelse ($kaders as $kader)
                                        <tr class="text-center kader-row" data-id="{{ $kader->id }}">
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                                {{ $kader->nama }}
                                            </td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
                                                {{ $kader->alamat }}
                                            </td>
                                            <td
                                                class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base ">
                                                {{ $kader->jabatan }}
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-center text-gray-500 col-span-full">Belum ada kader yang
                                            tersedia.
                                        </p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $kaders->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>

            <!-- Form Tambah Kader -->
            <div id="formTambahKader" class="container mx-auto p-5 bg-white shadow-lg rounded-lg mt-10 ">
                <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Kader</h1>

                <form action="{{ route('admin.kelola_kader.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <input type="hidden" name="id" id="kader-id">
                    <div class="flex flex-wrap md:flex-nowrap gap-6">
                        <!-- Kolom Kiri: Form -->
                        <div class="w-full md:w-2/3 space-y-4 mx-5">
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
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                                    required
                                    class="w-full mt-1 p-2 border rounded focus:ring focus:ring-teal-300 focus:outline-none"
                                    placeholder="Masukkan Alamat">
                                @error('alamat')
                                    <span class="text-red-500 text-sm">* {{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="jabatan" class="block text-gray-700 font-medium">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                                    required
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
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                        <button type="reset" id="resetBtn"
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

    const form = document.getElementById('formTambahKader');
    const tabelKader = document.getElementById('kaderTableContainer');
    // Tambahkan event listener ke tombol Tambah
    document.getElementById('tambahKaderBtn').addEventListener('click', function() {
        resetButton();
        form.scrollIntoView({
            behavior: 'smooth'
        });
    })

    // Tambahkan event listener ke tombol Edit
    document.getElementById('editBtn').addEventListener('click', function() {
        if (selectedRow) {
            const kaderId = selectedRow.getAttribute('data-id');

            // Scroll ke form
            form.scrollIntoView({
                behavior: 'smooth'
            });

            // Fetch data kader dari server
            fetch(`{{ url('admin/kelola_kader') }}/${kaderId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi form dengan data kader
                    document.getElementById('nik').value = data.nik;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('alamat').value = data.alamat;
                    document.getElementById('jabatan').value = data.jabatan;
                    document.getElementById('password').value = '';
                    document.getElementById('kader-id').value = data.id;
                });
        }
    });

    // Tambahkan event listener ke tombol Hapus
    document.getElementById('deleteBtn').addEventListener('click', function() {
        if (selectedRow) {
            const kaderId = selectedRow.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat membatalkan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('admin/kelola_kader') }}/${kaderId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then(data => {
                            location.reload();
                        });
                }
            });
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

    function resetButton() {
        // Hapus isi form
        document.getElementById('nik').value = "";
        document.getElementById('nama').value = "";
        document.getElementById('alamat').value = "";
        document.getElementById('jabatan').value = "";
        document.getElementById('password').value = '';
        document.getElementById('kader-id').value = "";
    }

    // Tambahkan event listener ke tombol Reset
    document.getElementById('resetBtn').addEventListener('click', function() {
        resetButton();
        tabelKader.scrollIntoView({
            behavior: 'smooth'
        })
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

    attachRowEventListeners();
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
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');

        // Pastikan ada file yang dipilih
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            // Jika tidak ada file, kembalikan ke placeholder
            preview.src = '{{ asset('images/placeholder.jpg') }}';
        }
    }
</script>
