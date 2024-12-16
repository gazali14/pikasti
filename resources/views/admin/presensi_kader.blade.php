<x-layout-admin>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Presensi Kegiatan</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-[#f4fcf7] font-sans">
        <div class="container mx-auto p-5">
            <!-- Judul Halaman -->
            <h1 class="font-semibold text-2xl text-[#2c3e50] mt-1 tracking-wider p-2">Daftar Presensi Kegiatan</h1>

            <!-- Search Input -->
            <div class="flex mb-4">
                <input type="text" id="search" class="w-1/2 p-3 border border-gray-300 rounded-lg"
                    placeholder="Search here..." oninput="filterActivities()" />
            </div>

            <!-- Jadwal Kegiatan -->
            <ul id="activity-list" class="list-none mt-12">
                @forelse ($kegiatan as $item)
                    <li
                        class="activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all">
                        <div class="details flex flex-col justify-center">
                            <strong class="sm:text-xl">{{ $item->nama_kegiatan }}</strong>
                            <small class="text-gray-200">{{ $item->tanggal_kegiatan }}</small>
                        </div>
                        <div>
                            <a href="{{ route('cek.presensi.bayi', $item->id) }}"
                                class="p-3 bg-[#4b9df1] text-white rounded-lg hover:bg-[#3278c7]">
                                Presensi
                            </a>
                        </div>
                    </li>
                @empty
                    <p class="text-center text-gray-500">Belum ada jadwal yang tersedia.</p>
                @endforelse
            </ul>
        </div>

        <script>
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
</x-layout-admin>
