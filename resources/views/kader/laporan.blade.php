<x-layout-kader>
  <p class="font-bold text-2xl text-[#353535] text-center mb-10">Generate Laporan</p>

  <div class="flex flex-col items-start px-8 max-w-xl mx-auto">
    <!-- Container for inputs -->
    <div class="space-y-6 w-full">
      <!-- Jenis Variabel -->
      <div>
        <div class="font-bold text-xl text-left mb-4">Jenis Variabel:</div>
        <div class="relative w-full">
          <!-- Dropdown Toggle -->
          <button id="dropdownToggle" class="flex items-center justify-between text-sm w-full bg-white px-4 py-2 rounded-lg shadow focus:outline-none focus:ring focus:ring-[#41a99d]">
            Pilih Jenis Variabel
            <img src="{{ asset('img/Dropdown.png') }}" alt="" class="w-3 h-auto">
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
      </div>

      <!-- Tanggal -->
      <div>
        <div class="font-bold text-xl text-left mb-4">Tanggal:</div>
        <input type="date" id="search-date" class="w-full p-2 border border-[#62BCB1] rounded-lg">
      </div>

      <!-- Format -->
      <div>
        <label for="format" class="font-bold text-xl text-left mb-2 block">Format:</label>
        <div class="flex">
          <button id="pdfButton" class="pdf w-32 py-2 text-center bg-white text-black border border-gray-300 rounded-l-lg hover:bg-gray-100 focus:outline-none focus:ring focus:ring-[#41a99d]" onclick="selectFormat('PDF')">
            PDF
          </button>
          <button id="excelButton" class="excel w-32 py-2 text-center bg-white text-black border border-gray-300 rounded-r-lg hover:bg-gray-100 focus:outline-none focus:ring focus:ring-[#41a99d]" onclick="selectFormat('EXCEL')">
            EXCEL
          </button>
        </div>
      </div>
    </div>

    <!-- Button Generate -->
    <div class="mt-8 w-full flex justify-end">
      <button id="generate-button" 
          type="submit"
          style="background-color: #4EC3AF; color: #ffffff; padding: 10px 20px;
          border-radius: 8px; font-size: 16px; cursor: pointer; font-weight: bold;
          box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
          transition: background-color 0.3s ease, transform 0.1s ease;">
          Generate
      </button>
    </div>
  </div>

  <script>
      // Fungsi Generate
      document.getElementById('generate-button').addEventListener('mousedown', function() {
          this.style.transform = 'scale(0.98)';
      });

      document.getElementById('generate-button').addEventListener('mouseup', function() {
          this.style.transform = 'scale(1)';
      });

      document.getElementById('generate-button').addEventListener('mouseleave', function() {
          this.style.transform = 'scale(1)';
      });
  </script>

  <script>
      // Fungsi untuk memilih format
      function selectFormat(format) {
          document.getElementById('pdfButton').style.backgroundColor = '#fff';
          document.getElementById('pdfButton').style.color = '#000';
          document.getElementById('pdfButton').style.border = '1px solid #ddd';

          document.getElementById('excelButton').style.backgroundColor = '#fff';
          document.getElementById('excelButton').style.color = '#000';
          document.getElementById('excelButton').style.border = '1px solid #ddd';

          if (format === 'PDF') {
              document.getElementById('pdfButton').style.backgroundColor = '#4EC3AF';
              document.getElementById('pdfButton').style.color = '#fff';
          } else if (format === 'EXCEL') {
              document.getElementById('excelButton').style.backgroundColor = '#4EC3AF';
              document.getElementById('excelButton').style.color = '#fff';
          }
      }

      const toggleButton = document.getElementById('dropdownToggle');
      const dropdownMenu = document.getElementById('dropdownMenu');
      const searchInput = document.getElementById('dropdownSearch');
      const dropdownItems = document.getElementById('dropdownItems');
      const items = dropdownItems.querySelectorAll('li');

      toggleButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', (e) => {
        if (!dropdownMenu.contains(e.target) && !toggleButton.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });

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

      items.forEach((item) => {
        item.addEventListener('click', () => {
          toggleButton.textContent = item.textContent;
          dropdownMenu.classList.add('hidden');
        });
      });
  </script>
</x-layout-kader>
