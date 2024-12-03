<div class="relative sm:static sm:mt-8 w-full bg-white p-2 shadow rounded-md z-10 sm:z-0">
    <form method="GET" action="{{ route('kader.dashboard') }}" class="flex items-center gap-4 flex-wrap">
        <!-- Bulan Dropdown -->
        <div class="relative w-1/3 sm:w-1/4 mb-4 sm:mb-0">
            <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan:</label>
            <div class="mt-2">
                <select name="bulan" id="bulan" class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Tahun Dropdown -->
        <div class="relative w-1/3 sm:w-1/4 mb-4 sm:mb-0">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun:</label>
            <div class="mt-2">
                <select name="tahun" id="tahun" class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Jenis Kelamin Dropdown -->
        <div class="relative w-1/3 sm:w-1/4 mb-4 sm:mb-0">
            <label for="jenisKelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin:</label>
            <div class="mt-2">
                <select name="jenisKelamin" id="jenisKelamin" class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end w-full sm:w-auto mt-2 ml-2 sm:ml-0">
            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600">Terapkan</button>
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
