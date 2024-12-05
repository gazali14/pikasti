<x-layout-kader>
    <!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Presensi Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-[#f4fcf7] font-sans">
    <div class="container mx-auto p-5 mt-[-45px]">
      <div class="flex mb-4">
        <input type="text" id="search" class="w-1/2 p-3 border border-gray-300 rounded-lg" placeholder="Search here..." oninput="filterActivities()">
      </div>
      <ul id="activity-list" class="list-none mt-12">
        <li class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
          <div class="details flex flex-col justify-center">
            <strong class="text-xl">Kegiatan 1</strong>
            <span>Imunisasi Campak</span>
          </div>
          <div>
            <strong class="text-lg">27 Januari 2025</strong>
            <button class="p-3 bg-[#4b9df1] text-white rounded-lg hover:bg-[#3278c7]" onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
          </div>
        </li>
        <li class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
          <div class="details flex flex-col justify-center">
            <strong class="text-xl">Kegiatan 2</strong>
            <span>Imunisasi Stunting</span>
          </div>
          <div>
            <strong class="text-lg">27 Februari 2025</strong>
            <button class="p-3 bg-[#4b9df1] text-white rounded-lg hover:bg-[#3278c7]" onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
          </div>
        </li>
        <li class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
          <div class="details flex flex-col justify-center">
            <strong class="text-xl">Kegiatan 3</strong>
            <span>Imunisasi Stunting</span>
          </div>
          <div>
            <strong class="text-lg">27 Maret 2025</strong>
            <button class="p-3 bg-[#4b9df1] text-white rounded-lg hover:bg-[#3278c7]" onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
          </div>
        </li>
        <li class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
          <div class="details flex flex-col justify-center">
            <strong class="text-xl">Kegiatan 4</strong>
            <span>Imunisasi Stunting</span>
          </div>
          <div>
            <strong class="text-lg">27 April 2025</strong>
            <button class="p-3 bg-[#4b9df1] text-white rounded-lg hover:bg-[#3278c7]" onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
          </div>
        </li>
        <li class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
          <div class="details flex flex-col justify-center">
            <strong class="text-xl">Kegiatan 5</strong>
            <span>Imunisasi Stunting</span>
          </div>
          <div>
            <strong class="text-lg">27 Mei 2025</strong>
            <button class="p-3 bg-[#4b9df1] text-white rounded-lg hover:bg-[#3278c7]" onclick="window.location.href='{{ route('kader.cek_presensi') }}'">Presensi</button>
          </div>
        </li>
      </ul>
    </div>

    <script>
      document.getElementById('page-title').textContent = "Daftar Presensi Kegiatan";
      const pageTitle = document.getElementById('page-title');
      pageTitle.textContent = "Daftar Presensi Kegiatan";

      pageTitle.classList.add("font-semibold", "text-2xl", "text-[#2c3e50]", "mt-1", "tracking-wider", "p-2");

      function filterActivities() {
        const searchValue = document.getElementById("search").value.toLowerCase();
        const activities = document.querySelectorAll(".activity-item");
        activities.forEach(activity => {
          const title = activity.querySelector(".details strong").textContent.toLowerCase();
          if (title.includes(searchValue)) {
            activity.style.display = "";
          } else {
            activity.style.display = "none";
          }
        });
      }
    </script>
  </body>
  </html>

</x-layout-kader>
