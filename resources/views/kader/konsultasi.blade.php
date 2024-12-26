<x-layout-kader>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Judul Halaman -->
        <div class="text-center my-4">
            <h1 class="text-2xl font-bold text-[#353535] font-poppins">Konsultasi</h1>
        </div>


        <!-- Tabel Daftar Konsultasi dengan Scroll -->
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded shadow">
            <x-tabel-konsultasi />
        </div>

        <!-- Form Tambah Konsultasi -->
        <x-form-konsultasi></x-form-konsultasi>
    </div>
</x-layout-kader>