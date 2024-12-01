<div class="absolute top-0 left-0 w-full bg-white p-4 shadow rounded-md z-10">
    <form method="GET" action="{{ route('kader.dashboard') }}" class="flex items-center gap-4">
        <!-- Bulan Dropdown -->
        <div class="relative w-1/4">
            <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan:</label>
            <div class="mt-2">
                <select name="bulan" id="bulan" class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Tahun Dropdown -->
        <div class="relative w-1/4">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun:</label>
            <div class="mt-2">
                <select name="tahun" id="tahun" class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Jenis Kelamin Dropdown -->
        <div class="relative w-1/4">
            <label for="jenisKelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin:</label>
            <div class="mt-2">
                <select name="jenisKelamin" id="jenisKelamin" class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4 ml-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Terapkan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const bulanOptions = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const tahunOptions = [2023, 2024, 2025];
        const jenisKelaminOptions = ["Laki-Laki", "Perempuan"];

        // Populate dropdowns dynamically
        const bulanSelect = document.getElementById('bulan');
        bulanOptions.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.toLowerCase();
            opt.textContent = option;
            bulanSelect.appendChild(opt);
        });

        const tahunSelect = document.getElementById('tahun');
        tahunOptions.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option;
            opt.textContent = option;
            tahunSelect.appendChild(opt);
        });

        const jenisKelaminSelect = document.getElementById('jenisKelamin');
        jenisKelaminOptions.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.toLowerCase();
            opt.textContent = option;
            jenisKelaminSelect.appendChild(opt);
        });
    });
</script>
