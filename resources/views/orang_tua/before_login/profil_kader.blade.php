<x-layout>
    <div class="container px-5 py-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($kaders as $kader)
                <!-- Card Kader -->
                <div class="bg-[#f3f3f3] shadow-md rounded-t-xl overflow-hidden w-full max-w-xs mx-auto">
                    <img src="{{ $kader->foto ? asset('storage/' . $kader->foto) : asset('img/Profile.png') }}" alt="Foto {{ $kader->nama }}"
                        class="h-64 w-full object-cover rounded-t-xl">
                    <div class="px-4 py-3 w-full">
                        <p class="text-lg font-bold block truncate">{{ $kader->nama }}</p>
                        <span class="text-[#35353580] uppercase text-sm">{{ $kader->jabatan }}</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">Belum ada kader yang tersedia.</p>
            @endforelse
        </div>
    </div>
</x-layout>

{{-- FOOTER --}}
<x-footer-home></x-footer-home>
