<x-layout-kader>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Judul Halaman -->
        <div class="text-center my-4">
            <h1 class="text-2xl font-bold text-[#353535] font-poppins">Pemberian Vitamin</h1>
        </div>


        <!-- Tabel Daftar Vitamin dengan Scroll -->
        <div class="p-2 bg-[#EEFFF8] rounded shadow">
            <x-tabel-vitamin />
        </div>

        <!-- Form Tambah Vitamin -->
        <x-form-tambah-vitamin></x-form-tambah-vitamin>
    </div>
</x-layout-kader>