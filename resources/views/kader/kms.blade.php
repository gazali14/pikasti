<x-layout-kader>
    <div class="p-2 min-h-screen max-h-96">
        <!-- Judul Halaman -->
        <div class="text-center my-4">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Pendataan Kondisi Bayi</h1>
        </div>

        <!-- Tabel KMS -->
        <div class="p-2 bg-[rgba(191,243,221,0.8)] rounded shadow">
            <x-tabel-kms :bayiList="$bayiList" :kmsData="$kmsData" :selectedBayiNik="$selectedBayiNik" />
        </div>

        <!-- Grafik KMS -->
        <x-grafik-kms :bayiList="$bayiList" :kmsData="$kmsData" :selectedBayiNik="$selectedBayiNik" />
        
    </div>
    <div>
        <x-footer-home></x-footer-home>      
    </div>  
</x-layout-kader>

