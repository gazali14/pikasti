<div class="relative sm:static w-full bg-white p-2 shadow rounded-md z-10 sm:z-0">
    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center justify-end gap-4">
        <!-- Dropdown Tahun -->
        <div class="relative w-1/4">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun:</label>
            <div class="mt-2">
                <select name="tahun" id="tahun"
                    class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                    <!-- Options dynamically populated -->
                </select>
            </div>
        </div>

        <!-- Tombol Terapkan -->
        <div class="flex justify-end ml-4 mr-20">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Terapkan
            </button>
        </div>
    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tahunOptions = [2024, 2023, 2022, 2021, 2020];

        const tahunSelect = document.getElementById('tahun');
        tahunOptions.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option;
            opt.textContent = option;
            tahunSelect.appendChild(opt);
        });
    });
</script>
