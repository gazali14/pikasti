<!-- Form Tambah Vitamin -->
<div class="mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Catat Vitamin</h2>
    <form id="vitaminForm" action="{{ route('kader.vitamin.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" id="id_kegiatan" name="id_kegiatan">
        <input type="hidden" id="id_bayi" name="id_bayi">

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama"
                class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500"
                readonly>
        </div>
        <div>
            <label for="jenis_vitamin" class="block text-sm font-medium text-gray-700">Vitamin</label>
            <select id="jenis_vitamin" name="jenis_vitamin"
                class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500 text-gray-500">
                <option value="" disabled selected>Masukkan Jenis Vitamin A</option>
                <option value="biru" class="text-black">Biru</option>
                <option value="merah" class="text-black">Merah</option>
            </select>
        </div>  
        <div>
            <label for="id_kegiatan" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
            <select id="id_kegiatan" name="id_kegiatan"
                class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
                <option value="" disabled selected>Pilih Nama Kegiatan</option>
                @foreach ($jadwals as $jadwal)
                    <option value="{{ $jadwal->id }}">
                        {{ $jadwal->nama_kegiatan }} Tanggal {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}
                    </option>
                @endforeach
            </select>
        </div>
             
        <div class="flex space-x-4">
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

    <script>
        const rows = document.querySelectorAll('.vitamin-row');
        const form = document.getElementById('vitaminForm');

        rows.forEach(row => {
            row.addEventListener('click', function () {
                // Ambil data dari baris yang dipilih
                const idBayi = row.dataset.id;
                const namaBayi = row.dataset.nama;
                const vitamin = row.children[1].textContent.trim();

                // Isi form dengan data yang dipilih
                document.getElementById('id_bayi').value = idBayi;
                document.getElementById('nama').value = namaBayi;
                document.getElementById('jenis_vitamin').value = vitamin === 'Tidak Ada Data Vitamin' ? '' : vitamin;
            });
        });

        form.addEventListener('reset', function () {
            // Kosongkan ID Bayi saat reset
            document.getElementById('id_bayi').value = '';
        });
    </script>
    
</div>

