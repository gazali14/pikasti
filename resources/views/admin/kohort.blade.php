<x-layout-admin :selectedKader='$selectedKader'>
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold mx-5">Registrasi Kohort Bayi</h1>
    </div>
    <div class="min-h-screen max-h-96">
        <div class="container mx-auto p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded-2xl shadow">
                <div class="mx-auto mt-1 mb-10 p-5">
                    <div class="overflow-x-auto">
                        <!-- Search dan Tombol Tambah -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <input type="text" id="default-search" placeholder="Cari Nama Bayi" required
                                    class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm" />
                            </div>
                            <button
                                class="p-3 bg-teal-500 text-white rounded hover:bg-teal-600 min-w-[150px] max-w-[150px] whitespace-nowrap"
                                onclick="openAddModal()">
                                <i class="fas fa-folder-plus"></i>
                                <span>Tambah Bayi</span>
                            </button>
                        </div>

                        <!-- Tabel Data Bayi -->
                        <table id="kohortTable" class="w-full table-auto  border border-[#62BCB1] mt-5">
                            <thead>
                                <tr>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">NIK</th>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Nama Bayi
                                    </th>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Nama Ibu
                                    </th>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Tanggal
                                        Lahir</th>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Alamat
                                    </th>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">No Telp
                                    </th>
                                    <th class="text-white border bg-[#62BCB1] py-2 px-4 text-sm sm:text-base">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white text-center">
                                @foreach ($bayis as $bayi)
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
                                            class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                            {{ $bayi->no_telpon }}</td>
                                        <td
                                            class="text-gray-900 font-light border-collapse border border-[#62BCB1] px-6 py-4 text-sm sm:text-base">
                                            <button
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition text-sm sm:text-base"
                                                onclick="openEditModal('{{ $bayi->nik }}')">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $bayis->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Bayi -->
        <div id="addModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full max-h-[80vh] overflow-y-auto">
                <h2 class="text-xl font-bold mb-4">Tambah Bayi</h2>
                <form method="POST" action="{{ route('admin.kohort.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <label for="addNik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="addNik" name="nik" maxlength="16" pattern="\d{16}"
                            class="w-full border p-2 rounded" placeholder="NIK harus terdiri dari 16 Digit" required />

                        <label for="addNama" class="block text-sm font-medium text-gray-700">Nama Bayi</label>
                        <input type="text" id="addNama" name="nama" class="w-full border p-2 rounded"
                            required />

                        <label for="addIbu" class="block text-sm font-medium text-gray-700">Nama Ibu Kandung</label>
                        <input type="text" id="addIbu" name="nama_ibu" class="w-full border p-2 rounded"
                            required />

                        <label for="addTanggal" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="addTanggal" name="tanggal_lahir" class="w-full border p-2 rounded"
                            required />

                        <label for="addKelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="addKelamin" name="jenis_kelamin" class="w-full border p-2 rounded" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        </select>

                        <label for="addAlamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="addAlamat" name="alamat" class="w-full border p-2 rounded"
                            required />

                        <label for="addNoTelpon" class="block text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" id="addNoTelpon" name="no_telpon" class="w-full border p-2 rounded"
                            required />

                        <label for="addBerat" class="block text-sm font-medium text-gray-700">Berat Lahir (kg)</label>
                        <input type="text" id="addBerat" name="berat_badan_lahir" class="w-full border p-2 rounded"
                            required />

                        <label for="addTinggi" class="block text-sm font-medium text-gray-700">Tinggi Lahir (cm)</label>
                        <input type="text" id="addTinggi" name="tinggi_badan_lahir"
                            class="w-full border p-2 rounded" required />

                        <label for="addPassword" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="addPassword" name="password" class="w-full border p-2 rounded"
                            required />
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded"
                            onclick="closeAddModal()">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit Bayi -->
        <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full max-h-[80vh] overflow-y-auto">
                <h2 class="text-xl font-bold mb-4">Edit Bayi</h2>
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <label for="editNik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="editNik" name="nik" maxlength="16" pattern="\d{16}"
                            class="w-full border p-2 rounded" required />

                        <label for="editNama" class="block text-sm font-medium text-gray-700">Nama Bayi</label>
                        <input type="text" id="editNama" name="nama" class="w-full border p-2 rounded"
                            required />

                        <label for="editIbu" class="block text-sm font-medium text-gray-700">Nama Ibu Kandung</label>
                        <input type="text" id="editIbu" name="nama_ibu" class="w-full border p-2 rounded"
                            required />

                        <label for="editTanggal" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="editTanggal" name="tanggal_lahir"
                            class="w-full border p-2 rounded" required />

                        <label for="editKelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="editKelamin" name="jenis_kelamin" class="w-full border p-2 rounded" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        </select>

                        <label for="editAlamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="editAlamat" name="alamat" class="w-full border p-2 rounded"
                            required />

                        <label for="editNoTelpon" class="block text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" id="editNoTelpon" name="no_telpon" class="w-full border p-2 rounded"
                            required />

                        <label for="editBerat" class="block text-sm font-medium text-gray-700">Berat Lahir
                            (kg)</label>
                        <input type="text" id="editBerat" name="berat_badan_lahir"
                            class="w-full border p-2 rounded" required />

                        <label for="editTinggi" class="block text-sm font-medium text-gray-700">Tinggi Lahir
                            (cm)</label>
                        <input type="text" id="editTinggi" name="tinggi_badan_lahir"
                            class="w-full border p-2 rounded" required />

                        <label for="editPassword" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="editPassword" name="password"
                            class="w-full border p-2 rounded" />
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded"
                            onclick="closeEditModal()">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-admin>

<script>
    // Pencarian dengan AJAX
    document.getElementById('default-search').addEventListener('input', function() {
        const search = this.value;

        fetch(`{{ route('admin.kohort.index') }}?search=${search}`)
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

    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(nik) {
        const form = document.getElementById('editForm');
        form.action = `{{ url('admin/kohort') }}/${nik}`;
        document.getElementById('editModal').classList.remove('hidden');

        fetch(`{{ url('admin/kohort') }}/${nik}/edit`)
            .then(response => {
                if (!response.ok) throw new Error('Gagal mengambil data');
                return response.json();
            })
            .then(data => {
                document.getElementById('editNik').value = data.nik;
                document.getElementById('editNama').value = data.nama;
                document.getElementById('editIbu').value = data.nama_ibu;
                document.getElementById('editTanggal').value = data.tanggal_lahir;
                document.getElementById('editKelamin').value = data.jenis_kelamin;
                document.getElementById('editAlamat').value = data.alamat;
                document.getElementById('editNoTelpon').value = data.no_telpon;
                document.getElementById('editBerat').value = data.berat_badan_lahir;
                document.getElementById('editTinggi').value = data.tinggi_badan_lahir;
            })
            .catch(error => {
                alert(error.message);
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
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
</script>
