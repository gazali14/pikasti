<x-layout-kader>
    <div class="p-6 bg-[#EEFFF8] min-h-screen">
        <!-- Filter Section -->
        <x-filters />

        <!-- Content Section -->
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Diagram Lingkaran -->
            <x-diagram-lingkaran />

            <!-- Grafik Tinggi Badan dan Berat Badan -->
            <div class="sm:col-span-2 lg:col-span-2">
                <x-grafik />
            </div>
        </div>
    </div>
</x-layout-kader>
