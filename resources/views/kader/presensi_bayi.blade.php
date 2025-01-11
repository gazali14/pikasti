<x-layout-kader>
  <!DOCTYPE html>
  <html lang="id">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Daftar Presensi Kegiatan</title>
      <script src="https://cdn.tailwindcss.com"></script>
       
  </head>

  <body class="bg-[#f4fcf7]">
      <div class="container mx-auto p-5 mt-[-20px]">
         <!-- Judul Halaman -->
         <div class="text-center my-4">
            <h1 class="text-3xl font-bold mx-5">Daftar Presensi Bayi</h1>
        </div>

        <!-- Search Input -->
          <div class="flex">
              <input type="text" id="search"
                  class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                  placeholder="Cari Nama Kegiatan" oninput="filterActivities()" />
          </div>

          <!-- Jadwal Kegiatan -->
          <ul id="activity-list" class="list-none mt-5">
            @forelse ($jadwal as $index => $item)
                @php
                    $currentDate = \Carbon\Carbon::now();
                    $eventDate = \Carbon\Carbon::parse($item->tanggal);
                    $isEventUpcoming = $eventDate > $currentDate;
                @endphp
                <li
                    class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
                    <div class="details flex-1 flex flex-col sm:flex-row sm:items-center sm:gap-4 ">
                        <strong class="text-lg sm:text-xl sm:w-1/3">{{ $item->nama_kegiatan }} </strong>
                        <div class="flex flex-col text-left">
                            <span
                                class="text-base sm:text-lg">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</span>
                            <span
                                class="text-sm sm:text-base">{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</span>
                        </div>

                    </div>
                    <div class="flex-shrink-0">
                        <button
                            @if ($isEventUpcoming) class="w-[120px] h-[40px] flex items-center justify-center bg-white text-black cursor-not-allowed rounded-lg"
                            disabled
                        @else
                            class="w-[120px] h-[40px] flex items-center justify-center bg-[#4b9df1] text-white rounded-lg" @endif
                            onclick="window.location.href='{{ route('kader.cek_presensi', ['id_kegiatan' => $item->id]) }}'">
                            @if ($isEventUpcoming)
                                Akan Datang
                            @else
                                Presensi
                            @endif
                        </button>
                    </div>
                </li>
            @empty
                <p class="text-center text-gray-500">Belum ada jadwal yang tersedia.</p>
            @endforelse
        </ul>

        <div class="mt-4">
            {{ $jadwal->links('vendor.pagination.tailwind') }}
        </div>

        <!-- Pesan jika tidak ada hasil pencarian -->
        <p id="no-result-message" class="text-center text-red-600 font-semibold text-xl hidden">Kegiatan yang Anda cari tidak ada.</p>

      <script>
          document.getElementById('page-title').textContent = "Daftar Presensi Kegiatan";
          const pageTitle = document.getElementById('page-title');
          pageTitle.textContent = "Daftar Presensi Kegiatan";

          pageTitle.classList.add("font-semibold", "text-2xl", "text-[#2c3e50]", "mt-1", "tracking-wider", "p-2");

          function filterActivities() {
              const searchValue = document.getElementById("search").value.toLowerCase();
              const activities = document.querySelectorAll(".activity-item");
              let hasResults = false; // Variabel untuk memeriksa apakah ada hasil pencarian

              activities.forEach(activity => {
                  const title = activity.querySelector(".details strong").textContent.toLowerCase();
                  if (title.includes(searchValue)) {
                      activity.style.display = "";
                      hasResults = true; // Jika ditemukan, atur hasResults ke true
                  } else {
                      activity.style.display = "none";
                  }
              });

              // Menampilkan pesan jika tidak ada hasil
              const noResultMessage = document.getElementById("no-result-message");
              if (!hasResults && searchValue.trim() !== "") {
                  noResultMessage.textContent = `Kegiatan "${searchValue}" tidak ada.`; // Menampilkan pesan dengan kata yang dicari
                  noResultMessage.classList.remove("hidden"); // Menampilkan pesan jika tidak ada hasil
              } else {
                  noResultMessage.classList.add("hidden"); // Menyembunyikan pesan jika ada hasil
              }
          }
      </script>
  </body>
  </html>
</x-layout-kader>
