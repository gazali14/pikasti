<!-- Form Tambah Kader -->
<div class="mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Catat Vitamin</h2>
    <form action="{{ route('kader.vitamin') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Input Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama"
                class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500">
        </div>

        <!-- Input Jenis Vitamin -->
        <div>
            <label for="jenis_vitamin" class="block text-sm font-medium text-gray-700">Vitamin</label>
            <select id="jenis_vitamin" name="jenis_vitamin"
                class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500 text-gray-500">
                <option value="" disabled selected>Masukkan Jenis Vitamin A</option>
                <option value="biru" class="text-black">Biru</option>
                <option value="merah" class="text-black">Merah</option>
            </select>
        </div>

        <!-- Tombol Aksi -->
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
</div>
