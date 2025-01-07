<x-layout-admin>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Presensi Kegiatan</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .pagination a,
            .pagination span {
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
                background-color: #4b9df1;
                /* Warna default */
                color: white;
                border: 1px solid transparent;
            }

            .pagination a:hover {
                background-color: #3a88c9;
                /* Warna saat hover */
            }

            .pagination .active {
                background-color: #2c6e9f;
                /* Warna untuk item aktif */
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

    <body class="bg-[#f4fcf7]">
        <div class="container mx-auto p-5 mt-[-20px]">
            <!-- Judul Halaman -->
            <h1 class="text-3xl font-bold mb-4">Daftar Presensi Kader</h1>

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
                                onclick="window.location.href='{{ route('admin.cek_presensi_kader', ['id_kegiatan' => $item->id]) }}'">
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


            <!-- Pagination-->
            <div class="pagination mt-6 flex justify-center space-x-2">
                @if ($jadwal->onFirstPage())
                    <span class="bg-gray-300 text-gray-500 px-3 py-2 rounded-md cursor-not-allowed">←</span>
                @else
                    <a href="{{ $jadwal->previousPageUrl() }}"
                        class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-700">←</a>
                @endif

                @for ($page = 1; $page <= $jadwal->lastPage(); $page++)
                    @if ($page == $jadwal->currentPage())
                        <span class="bg-green-500 text-white px-3 py-2 rounded-md font-bold">{{ $page }}</span>
                    @else
                        <a href="{{ $jadwal->url($page) }}"
                            class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-700">{{ $page }}</a>
                    @endif
                @endfor

                @if ($jadwal->hasMorePages())
                    <a href="{{ $jadwal->nextPageUrl() }}"
                        class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-700">→</a>
                @else
                    <span class="bg-gray-300 text-gray-500 px-3 py-2 rounded-md cursor-not-allowed">→</span>
                @endif
            </div>

            <!-- Pesan jika tidak ada hasil pencarian -->
            <p id="no-result-message" class="text-center text-red-500 text-xl hidden">Mohon Maaf, Kegiatan "<span
                    id="search-term"></span>" tidak ada.</p>
        </div>

        <script>
            function filterActivities() {
                const searchValue = document.getElementById("search").value.toLowerCase();
                const activities = document.querySelectorAll(".activity-item");
                let hasResults = false;

                activities.forEach(activity => {
                    const title = activity.querySelector(".details strong").textContent.toLowerCase();
                    if (title.includes(searchValue)) {
                        activity.style.display = "";
                        hasResults = true;
                    } else {
                        activity.style.display = "none";
                    }
                });

                const noResultMessage = document.getElementById("no-result-message");
                const searchTerm = document.getElementById("search-term");
                if (!hasResults && searchValue.trim() !== "") {
                    searchTerm.textContent = searchValue;
                    noResultMessage.classList.remove("hidden");
                } else {
                    noResultMessage.classList.add("hidden");
                }
            }
        </script>
    </body>

    </html>
</x-layout-admin>
