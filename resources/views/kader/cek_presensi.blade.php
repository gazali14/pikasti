<x-layout-kader>
  <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Presensi</title>
        <script src="https://cdn.tailwindcss.com"></script>
    
  </head>
  <body id="cek-presensi" class="bg-[#E8F6F3] font-poppins m-0 p-0">
    <div class="max-w-screen-xl mx-auto p-5">
      <div id="date-section" class="flex items-center gap-3 text-[#34495e]">
        <label for="date-input" class="block text-left font-medium text-base text-black">Tanggal Pelayanan Rutin</label>
        <input type="date" id="date-input" class="p-2 text-base border border-[#ddd] rounded-md focus:outline-none" />
      </div>

      <div id="search-container" class="flex justify-end mt-[-50px] mb-5">
        <input type="text" placeholder="Cari nama bayi" class="w-72 p-3 border border-[#ddd] rounded-md focus:outline-none" />
        <button class="ml-3 bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
          Cari
        </button>
      </div>

      <table class="w-full border-collapse mb-5">
        <thead class="bg-[#41a99d]">
          <tr>
            <th class="text-white text-center py-2 px-4">NIK</th>
            <th class="text-white text-center py-2 px-4">Nama Bayi</th>
            <th class="text-white text-center py-2 px-4">Kehadiran</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border px-4 py-2">222212824</td>
            <td class="border px-4 py-2">Raditya Dika</td>
            <td class="border px-4 py-2"></td>
          </tr>
          <tr>
            <td class="border px-4 py-2">222212476</td>
            <td class="border px-4 py-2">Alfitra Rifa Geandra</td>
            <td class="border px-4 py-2"></td>
          </tr>
          <tr>
            <td class="border px-4 py-2">222212462</td>
            <td class="border px-4 py-2">Ricardo Septian</td>
            <td class="border px-4 py-2"></td>
          </tr>
          <tr>
            <td class="border px-4 py-2">221234472</td>
            <td class="border px-4 py-2">Gazali Yahya</td>
            <td class="border px-4 py-2"></td>
          </tr>
          <tr>
            <td class="border px-4 py-2">212223472</td>
            <td class="border px-4 py-2">Euroea Sugiono Manurung</td>
            <td class="border px-4 py-2"></td>
          </tr>
          <tr>
            <td class="border px-4 py-2">212223346</td>
            <td class="border px-4 py-2">Irsanto Kapi Ten</td>
            <td class="border px-4 py-2"></td>
          </tr>
          <tr>
            <td class="border px-4 py-2">222123467</td>
            <td class="border px-4 py-2">Angga Suryana Arivia</td>
            <td class="border px-4 py-2"></td>
          </tr>
        </tbody>
      </table>

      <button id="save-button" class="float-right bg-[#41a99dac] text-white border-none p-3 rounded-md transition-colors duration-300 hover:bg-[#3a928d] active:scale-95">
        Simpan
      </button>
    </div>
        <script>
      // Mendapatkan elemen page-title
      const pageTitle = document.getElementById('page-title');

      // Menambahkan teks dan tombol panah ke dalam page-title
      pageTitle.textContent = "Cek Presensi"; // Mengatur teks halaman

      // Menambahkan tombol panah ke dalam pageTitle
      const backButton = document.createElement('button');
      backButton.innerHTML = "←"; // Menambahkan simbol panah
      backButton.classList.add("text-black", "bg-[#41a99d]", "rounded-full", "w-12", "h-12", "flex", "items-center", "justify-center", "p-3", "transition-colors", "duration-300", "hover:bg-[#3a928d]", "active:scale-95");
      backButton.addEventListener('click', () => {
        window.location.href = 'presensi_bayi'; // Ganti dengan URL yang diinginkan
      });

      // Menambahkan tombol panah sebelum teks di pageTitle
      pageTitle.insertBefore(backButton, pageTitle.firstChild);

      // Mengatur gaya untuk pageTitle
      pageTitle.classList.add("font-semibold", "text-3xl", "text-[#2c3e50]", "shadow-md", "mt-1", "tracking-wide", "p-2");
    </script>
  </body>
  </html>
</x-layout-kader>
