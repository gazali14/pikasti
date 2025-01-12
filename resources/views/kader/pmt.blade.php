<x-layout-kader>
    <!-- Judul Halaman -->
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold mx-5">Pemberian Makanan Tambahan (PMT)</h1>
    </div>

    <div class="min-h-screen max-h-96">
        <div class="container p-5">
            <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded shadow">
                <!-- Tabel Daftar PMT dengan Scroll -->
                <x-tabel-pmt :bayiList="$bayiList" :pmtData="$pmtData" :selectedBayiNik="$selectedBayiNik" />
            </div>
        </div>
    </div>
</x-layout-kader>
