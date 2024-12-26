<x-layout-kader>
    <p class="font-bold text-2xl text-[#353535] text-center mb-10">Generate Laporan</p>
    <div class="font-bold text-2xl ml-8">Jenis Variabel:</div>

    <div class="relative inline-block w-64 p-4 ml-4">
        <!-- Dropdown Toggle -->
        <button id="dropdownToggle" class="flex items-center justify-between text-sm w-full bg-white px-2 py-2 rounded-lg shadow focus:outline-none focus:ring focus:ring-[#41a99d]">
          Pilih Jenis Variabel
          <img src="{{ asset('img/Dropdown.png') }}" 
          alt=""
          class="w-3 h-auto">
        </button>
      
        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="absolute z-10 hidden w-full mt-2 bg-white border border-gray-200 rounded-lg shadow-lg">
          <!-- Search Box -->
          <div class="p-2">
            <input
              type="text"
              id="dropdownSearch"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-[#41a99d]"
              placeholder="Search..."
            />
          </div>
          <!-- Dropdown Items -->
          <ul id="dropdownItems" class="max-h-48 overflow-y-auto">
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Semua Variabel</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Presensi Bayi</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Kondisi Bayi</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Vitamin</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">PMT</li>
            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Konsultasi</li>
          </ul>
        </div>
      </div>
      
      <script>
        const toggleButton = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const searchInput = document.getElementById('dropdownSearch');
        const dropdownItems = document.getElementById('dropdownItems');
        const items = dropdownItems.querySelectorAll('li');
      
        // Toggle dropdown visibility
        toggleButton.addEventListener('click', () => {
          dropdownMenu.classList.toggle('hidden');
        });
      
        // Close dropdown if clicked outside
        document.addEventListener('click', (e) => {
          if (!dropdownMenu.contains(e.target) && !toggleButton.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
          }
        });
      
        // Filter dropdown items based on search
        searchInput.addEventListener('input', (e) => {
          const searchValue = e.target.value.toLowerCase();
          items.forEach((item) => {
            if (item.textContent.toLowerCase().includes(searchValue)) {
              item.classList.remove('hidden');
            } else {
              item.classList.add('hidden');
            }
          });
        });
      
        // Select an item
        items.forEach((item) => {
          item.addEventListener('click', () => {
            toggleButton.textContent = item.textContent;
            dropdownMenu.classList.add('hidden');
          });
        });
      </script>
      
      <div class="font-bold text-2xl ml-8 mb-2">Tanggal:</div>
      <input type="date" id="search-date" class="p-2 border-collapse border border-[#62BCB1] rounded-lg ml-8">

      <div>
        <button id="generate-button" class="text-white font-semibold bg-[#62bcb1]">Generate</button>
        </div>
</x-layout-kader>
