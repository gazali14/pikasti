<x-layout>
    <div class="container px-5 py-5">
        {{-- GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8 p-5">
            @forelse ($dokumentasis as $dokumentasi)
                {{-- CARD --}}
                <a href="javascript:void(0)"
                    onclick="openModal({{ json_encode(json_decode($dokumentasi->foto)) }}, '{{ $dokumentasi->nama_kegiatan }}', '{{ $dokumentasi->deskripsi }}', '{{ $dokumentasi->tanggal }}')">
                    <div class="rounded-xl shadow-lg bg-[#f3f3f3] w-full max-w-sm mx-auto">
                        <div class="p-5 flex flex-col justify-between min-h-[350px]">
                            {{-- Gambar --}}
                            <div class="rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . json_decode($dokumentasi->foto, true)[0]) }}"
                                    alt="Foto {{ $dokumentasi->nama_kegiatan }}"
                                    class="w-full h-48 object-cover rounded-t-xl">
                            </div>

                            {{-- Nama Kegiatan --}}
                            <h5
                                class="text-2xl sm:text-xl md:text-3xl font-poppins font-semibold mt-3 text-[#353535] line-clamp-1">
                                {{ $dokumentasi->nama_kegiatan }}
                            </h5>

                            {{-- Deskripsi --}}
                            <p class="text-[#35353580] text-lg sm:text-sm md:text-base mt-2 line-clamp-3"
                                style="min-height: 72px;">
                                {{ $dokumentasi->deskripsi }}
                            </p>

                            {{-- Tanggal --}}
                            <div class="flex justify-end mt-2 font-medium text-[#35353560]">
                                <h6>{{ \Carbon\Carbon::parse($dokumentasi->tanggal)->translatedFormat('d F Y') }}</h6>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-full">Belum ada dokumentasi kegiatan yang tersedia.</p>
            @endforelse
        </div>
    </div>

    {{-- MODAL POP-UP --}}
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50">
        <div
            class="relative bg-white rounded-lg shadow-md p-6 w-[90%] max-w-4xl flex flex-col md:flex-row items-center">
            {{-- Panah Kiri --}}
            <button id="prevButton"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 p-2 bg-gray-200 rounded-full shadow-md hover:bg-gray-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            {{-- Foto --}}
            <div class="flex-shrink-0 w-full md:w-1/2">
                <img id="modalImage" src="" alt="Foto Dokumentasi"
                    class="w-full rounded-lg object-contain max-h-[400px]">
            </div>

            {{-- Konten Deskripsi --}}
            <div class="mt-6 md:mt-0 md:ml-6 w-full md:w-1/2">
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-3"></h2>
                <p id="modalDescription" class="text-gray-700 mb-3"></p>
                <p id="modalDate" class="text-gray-500 text-sm"></p>
            </div>

            {{-- Panah Kanan --}}
            <button id="nextButton"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 p-2 bg-gray-200 rounded-full shadow-md hover:bg-gray-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Tombol Close --}}
            <button onclick="closeModal()"
                class="absolute top-4 right-4 p-2 bg-gray-200 rounded-full shadow hover:bg-gray-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</x-layout>

{{-- FOOTER --}}
<x-footer-home></x-footer-home>

<script>
    let currentIndex = 0;
    let currentFotos = [];

    function openModal(fotos, title, description, date) {
        currentFotos = fotos;
        currentIndex = 0;

        document.getElementById('modalImage').src = `/storage/${currentFotos[currentIndex]}`;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('modalDate').textContent = new Date(date).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        document.getElementById('imageModal').classList.remove('hidden');

        const isMultipleFotos = currentFotos.length > 1;
        document.getElementById('prevButton').classList.toggle('hidden', !isMultipleFotos);
        document.getElementById('nextButton').classList.toggle('hidden', !isMultipleFotos);
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    document.getElementById('prevButton').addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + currentFotos.length) % currentFotos.length;
        document.getElementById('modalImage').src = `/storage/${currentFotos[currentIndex]}`;
    });

    document.getElementById('nextButton').addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % currentFotos.length;
        document.getElementById('modalImage').src = `/storage/${currentFotos[currentIndex]}`;
    });
</script>