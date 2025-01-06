<x-layout-kader>
  <!DOCTYPE html>
  <html lang="id">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Daftar Presensi Kegiatan</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <style>
        .pagination a, .pagination span {
            display: inline-block;
            margin: 0 4px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
    
        .pagination a {
            background-color: #4b9df1; /* Warna default */
            color: white;
            border: 1px solid transparent;
        }
    
        .pagination a:hover {
            background-color: #3a88c9; /* Warna saat hover */
        }
    
        .pagination .active {
            background-color: #2c6e9f; /* Warna untuk item aktif */
            color: white;
            font-weight: bold;
        }
    
        .pagination .disabled {
            background-color: #ccc;
            color: #888;
            cursor: not-allowed;
        }
    </style>    
    
  </head>

  <body class="bg-[#f4fcf7] font-sans">
      <div class="container mx-auto p-5 mt-[-45px]">
         <!-- Judul Halaman -->
         <h1 class="text-3xl font-bold mb-4">Daftar Presensi Kegiatan</h1>

        <!-- Search Input -->
          <div class="flex mb-4">
              <input type="text" id="search" class="w-1/2 p-3 border border-gray-300 rounded-lg" placeholder="Search here..." oninput="filterActivities()">
          </div>

          <!-- Jadwal Kegiatan -->
          <ul id="activity-list" class="list-none mt-12">
            @forelse ($jadwal as $index => $item)
            @php
              $currentDate = \Carbon\Carbon::now();
              $eventDate = \Carbon\Carbon::parse($item->tanggal);
              $isEventUpcoming = $eventDate > $currentDate;
            @endphp
            <li class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
              <div class="details flex flex-col justify-center">
                <strong class="sm:text-xl">{{ $item->nama_kegiatan }} - {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</strong>
              </div>
              <div>
                <strong class="text-lg">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</strong>
                <button 
                  class="p-3 text-white rounded-lg" 
                  onclick="window.location.href='{{ route('kader.cek_presensi', ['id_kegiatan' => $item->id]) }}'"
                  @if($isEventUpcoming) 
                    class="bg-white text-black cursor-not-allowed" 
                    disabled
                  @else
                    class="bg-[#4b9df1] text-white"
                  @endif
                >
                  @if($isEventUpcoming)
                    <span class="bg-white text-black py-2 px-4 rounded-lg">Akan Datang</span>
                  @else
                    <span class="bg-[#4b9df1] text-white py-2 px-4 rounded-lg">Presensi</span>
                  @endif
                </button>
              </div>
            </li>
            @empty
              <p class="text-center text-gray-500">Belum ada jadwal yang tersedia.</p>
            @endforelse
        </ul>

        <!-- Pagination-->
        <div class="pagination mt-6 flex justify-center space-x-2">
          @if ($jadwal->onFirstPage())
              <span class="bg-gray-300 text-gray-500 px-3 py-2 rounded-md cursor-not-allowed">←</span>
          @else
              <a href="{{ $jadwal->previousPageUrl() }}" class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-700">←</a>
          @endif
      
          @for ($page = 1; $page <= $jadwal->lastPage(); $page++)
              @if ($page == $jadwal->currentPage())
                  <span class="bg-green-500 text-white px-3 py-2 rounded-md font-bold">{{ $page }}</span>
              @else
                  <a href="{{ $jadwal->url($page) }}" class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-700">{{ $page }}</a>
              @endif
          @endfor
      
          @if ($jadwal->hasMorePages())
              <a href="{{ $jadwal->nextPageUrl() }}" class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-700">→</a>
          @else
              <span class="bg-gray-300 text-gray-500 px-3 py-2 rounded-md cursor-not-allowed">→</span>
          @endif
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
