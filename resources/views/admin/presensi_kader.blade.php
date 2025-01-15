<x-layout-admin :selectedKader='$selectedKader'>
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
                <h1 class="text-3xl font-bold mx-5">Daftar Presensi Kader</h1>
            </div>
            <!-- Search Input -->
            <div class="flex">
                <input type="search" id="default-search"
                    class="border border-gray-300 rounded-md w-80 p-3 focus:ring-1 focus:ring-gray-300 text-gray-700 text-sm"
                placeholder="Cari Kegiatan" required />
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


            <div class="mt-4">
                {{ $jadwal->links('vendor.pagination.tailwind') }}
            </div>

            <!-- Pesan jika tidak ada hasil pencarian -->
            <p id="no-result-message" class="text-center text-red-500 text-xl hidden">Mohon Maaf, Kegiatan "<span
                    id="search-term"></span>" tidak ada.</p>
        </div>

        <script>
            document.getElementById('default-search').addEventListener('input', function () {
                const search = this.value;

                // AJAX Request
                fetch(`{{ route('admin.presensi_kader.searchKegiatanKader') }}?search=${encodeURIComponent(search)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        const activityList = document.getElementById('activity-list');
                        activityList.innerHTML = '';

                        if (data.jadwals.length > 0) {
                            const presensiRoute = @json(route('admin.cek_presensi_kader', ['id_kegiatan' => ':id'])); // Placeholder ':id'

                            data.jadwals.forEach(item => {
                                const eventDate = new Date(item.tanggal);
                                const currentDate = new Date();
                                const isEventUpcoming = eventDate > currentDate;

                                const listItem = document.createElement('li');
                                listItem.className = "activity-item flex justify-between items-center p-3 mb-3 rounded-xl bg-[#41a99dac] text-white hover:scale-105 transition-all";

                                // Replace ':id' in the route placeholder with the actual ID
                                const presensiUrl = presensiRoute.replace(':id', item.id);

                                listItem.innerHTML = `
                                    <div class="details flex-1 flex flex-col sm:flex-row sm:items-center sm:gap-4">
                                        <strong class="text-lg sm:text-xl sm:w-1/3">${item.nama_kegiatan}</strong>
                                        <div class="flex flex-col text-left">
                                            <span class="text-base sm:text-lg">${eventDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</span>
                                            <span class="text-sm sm:text-base">${item.waktu}</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button
                                            class="${isEventUpcoming ? 'w-[120px] h-[40px] flex items-center justify-center bg-white text-black cursor-not-allowed rounded-lg' : 'w-[120px] h-[40px] flex items-center justify-center bg-[#4b9df1] text-white rounded-lg'}"
                                            ${isEventUpcoming ? 'disabled' : ''}
                                            onclick="window.location.href='${presensiUrl}'"
                                        >
                                            ${isEventUpcoming ? 'Akan Datang' : 'Presensi'}
                                        </button>
                                    </div>
                                `;
                                activityList.appendChild(listItem);
                            });
                        } else {
                            activityList.innerHTML = '<p class="text-center text-gray-500">Kegiatan yang Anda cari tidak ada.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        </script>
    </body>
    </html>
</x-layout-admin>
