<x-layout-kader>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Judul Halaman -->
        <div class="text-center my-4">
            <h1 class="text-2xl font-bold text-[#353535] font-poppins">Pemberian Makanan Tambahan</h1>
        </div>


        <!-- Tabel Daftar PMT dengan Scroll -->
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded shadow">
            <x-tabel-pmt />
        </div>

        <!-- Form Tambah PMT -->
        <x-form-tambah-pmt></x-form-tambah-pmt>
    </div>
</x-layout-kader>