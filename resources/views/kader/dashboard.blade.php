<x-layout-kader>
    <div class="p-6 bg-[#EEFFF8] min-h-screen">
        <!-- Filter Section -->
        <x-filters />

        <!-- Content Section -->
        <div class="mt-6 grid grid-cols-3 gap-6">
            <!-- Diagram Lingkaran -->
            <x-diagram-lingkaran />

            <!-- Grafik Tinggi Badan dan Berat Badan -->
            <div class="col-span-2">
                <x-grafik />
            </div>
        </div>
    </div>
</x-layout-kader>
