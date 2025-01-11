<x-layout-kader>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Judul Halaman -->
        <div class="text-center my-4">
            <h1 class="text-3xl font-bold mx-5">Pendataan Kondisi Bayi</h1>
        </div>

        <!-- Tabel KMS -->
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded shadow">
            <div class="container mx-auto mt-5 mb-10 px-10">
                <!-- Dropdown dan Tombol Tambah -->
                <div class="flex items-center justify-between mb-4">
                    <!-- Dropdown Pilih Bayi -->
                    <div class="relative">
                        <button id="dropdown-button"
                            class="inline-flex items-center justify-between px-4 py-2 w-full text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                            <!-- Teks Dropdown -->
                            {{ $bayiList->firstWhere('nik', $selectedBayiNik)->nama ?? 'Pilih Nama Bayi' }}
                            <!-- Ikon Filter -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-black" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3 5h18a1 1 0 0 1 .8 1.6l-6.6 8.8a1 1 0 0 0-.2.6v5.2a1 1 0 0 1-1.6.8l-4-3.2a1 1 0 0 1-.4-.8v-2.6a1 1 0 0 0-.2-.6L2.2 6.6A1 1 0 0 1 3 5z" />
                            </svg>
                        </button>
                        <div id="dropdown-menu"
                            class="hidden absolute left-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                            <input id="search-input"
                                class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none"
                                type="text" placeholder="Cari Nama Bayi..." autocomplete="off">
                            <div id="dropdown-list">
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
                    <div>
                        <button id="add-button" class="inline-block px-6 py-2.5 bg-teal-500 text-white rounded">
                            <i class="fas fa-folder-plus"></i>
                            <span>Tambah Data Bayi</span>
                        </button>
                    </div>
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


                <!-- Tabel Data KMS -->
                <div class="rounded shadow-sm overflow-x-auto">
                    <table id="TableKMS" class="min-w-full border-collapse border border-[#62BCB1]">
                        <thead>
                            <tr>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Tanggal</th>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Umur (Bulan)</th>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Tinggi Badan (cm)</th>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Berat Badan (kg)</th>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Imunisasi</th>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Kategori</th>
                                <th
                                    class="text-sm font-medium text-white bg-[#62BCB1] border-[#62BCB1] px-6 py-4 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody
                            class= "bg-white text-sm text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-center">
                            @forelse ($kmsDataPaginate as $kms)
                                @php
                                    $umurBulan = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir)->diffInMonths(
                                        \Carbon\Carbon::parse($kms->tanggal),
                                    );
                                @endphp
                                <tr>
                                    <td class="border-collapse border border-[#62BCB1] text-center">{{ $kms->tanggal }}
                                    </td>
                                    <td class="border-collapse border border-[#62BCB1] text-center">
                                        {{ floor($umurBulan) }}
                                        bulan</td> <!-- Tambahkan usia bulan jika dibutuhkan -->
                                    <td class="border-collapse border border-[#62BCB1] text-center">
                                        {{ $kms->tinggi_badan }}
                                    </td>
                                    <td class="border-collapse border border-[#62BCB1] text-center">
                                        {{ $kms->berat_badan }}
                                    </td>
                                    <td class="border-collapse border border-[#62BCB1] text-center">
                                        {{ $kms->imunisasi ? $kms->imunisasi : '-' }}</td>
                                    <td class="border-collapse border border-[#62BCB1] text-center">
                                        {{ $kms->kategori }}</td>
                                    <td class="border-collapse border border-[#62BCB1] text-center py-2 px-4">
                                        <!-- Tombol Edit -->
                                        <button type="button"
                                            onclick="openEditModal('{{ $kms->id }}', '{{ $kms->tanggal }}', '{{ $kms->tinggi_badan }}', '{{ $kms->berat_badan }}', '{{ $kms->imunisasi }}', '{{ $kms->kategori }}')"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-teal-600 transition">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $kms->id }}"
                                            action="{{ route('kms.destroy', $kms->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $kms->id }})"
                                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500">Belum ada data KMS untuk bayi
                                        ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($kmsDataPaginate->count())
                        <div class="mt-4">
                            {{ $kmsDataPaginate->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                </div>
            </div>


            <!-- Modal Tambah -->
            <div id="modal"
                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg w-full sm:w-1/2 md:w-1/3 mx-4">
                    <h2 id="modal-title" class="text-lg font-bold mb-4">Tambah Data</h2>
                    <form id="form-data" action="{{ route('kms.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nik_bayi" value="{{ $selectedBayiNik }}">

                        <div class="mb-4">
                            <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="block w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="tinggi_badan" class="block text-sm font-medium">Tinggi Badan (cm)</label>
                            <input type="text" name="tinggi_badan" id="tinggi_badan"
                                class="block w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="berat_badan" class="block text-sm font-medium">Berat Badan (kg)</label>
                            <input type="text" name="berat_badan" id="berat_badan"
                                class="block w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="imunisasi" class="block text-sm font-medium">Imunisasi</label>
                            <select id="imunisasi" name="imunisasi" class="w-full border p-2 rounded">
                                <option value="" disabled selected>Pilih Jenis Imunisasi</option>
                                <option value="BCG">BCG</option>
                                <option value="Polio I">Polio I</option>
                                <option value="Polio II">Polio II</option>
                                <option value="Polio III">Polio III</option>
                                <option value="Polio IV">Polio IV</option>
                                <option value="Campak">Campak</option>
                                <option value="DPT Hb Com1">DPT, Hb Com1</option>
                                <option value="DPT Hb Com2">DPT, Hb Com2</option>
                                <option value="DPT Hb Com3">DPT, Hb Com3</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="kategori" class="block text-sm font-medium">Kategori</label>
                            <input type="text" name="kategori" id="kategori"
                                class="block w-full px-3 py-2 border rounded-md bg-gray-200" readonly
                                placeholder="Terisi otomatis">
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
            <div id="modal-edit"
                class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
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
                            <label for="edit-tinggi_badan" class="block text-sm font-medium">Tinggi Badan (cm)</label>
                            <input type="text" name="tinggi_badan" id="edit-tinggi_badan"
                                class="block w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit-berat_badan" class="block text-sm font-medium">Berat Badan (kg)</label>
                            <input type="twxt" name="berat_badan" id="edit-berat_badan"
                                class="block w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit-imunisasi" class="block text-sm font-medium">Imunisasi</label>
                            <select id="edit-imunisasi" name="imunisasi" class="w-full border p-2 rounded">
                                <option value="" disabled selected>Pilih Jenis Imunisasi</option>
                                <option value="BCG">BCG</option>
                                <option value="Polio I">Polio I</option>
                                <option value="Polio II">Polio II</option>
                                <option value="Polio III">Polio III</option>
                                <option value="Polio IV">Polio IV</option>
                                <option value="Campak">Campak</option>
                                <option value="DPT Hb Com1">DPT, Hb Com1</option>
                                <option value="DPT Hb Com2">DPT, Hb Com2</option>
                                <option value="DPT Hb Com3">DPT, Hb Com3</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="edit-kategori" class="block text-sm font-medium">Kategori</label>
                            <input type="text" name="kategori" id="edit-kategori"
                                class="block w-full px-3 py-2 border rounded-md bg-gray-200" readonly
                                placeholder="Terisi otomatis">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" id="edit-cancel-button"
                                class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Grafik KMS -->
        @if ($kmsData->count())
        <x-grafik-kms :bayiList="$bayiList" :kmsData="$kmsData" :selectedBayiNik="$selectedBayiNik" />
        @endif
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
        const openEditModal = (id, tanggal, tinggi_badan, berat_badan, imunisasi, kategori) => {
            const modal = document.getElementById('modal-edit');
            modal.classList.remove('hidden');

            // Isi nilai input dalam form
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-tinggi_badan').value = tinggi_badan;
            document.getElementById('edit-berat_badan').value = berat_badan;

            // Set selected value for dropdown
            const imunisasiDropdown = document.getElementById('edit-imunisasi');
            imunisasiDropdown.value = imunisasi; // Pastikan 'imunisasi' cocok dengan value dropdown

            document.getElementById('edit-kategori').value = kategori;

            // Update action form untuk route update
            const form = document.getElementById('form-edit');
            form.action = `/kader/kms/${id}`;
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
        };

        // Notifikasi sukses
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

        // Notifikasi error
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end', // Lokasi di kanan atas
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false, // Tidak ada tombol
                    timer: 5000, // Menghilang setelah 3 detik
                    timerProgressBar: true, // Menampilkan progress bar
                });
            @endif
        });
    </script>
</x-layout-kader>
