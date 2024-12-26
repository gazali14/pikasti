<!-- Form Tambah Kader -->
<div class="mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Catat Konsultasi</h2>
    <form action="{{ route('kader.vitamin') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Input Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi/Keluhan</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi atau keluhan"
                class="mt-1 block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-teal-300 focus:border-teal-500"
                rows="5"></textarea>
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
