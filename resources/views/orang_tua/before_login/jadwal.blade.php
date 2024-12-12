<x-layout>
  <div class="container px-5 sm:px-10 lg:px-20 py-5">
    <!-- Dropdown Filter Tahun -->
    <div class="flex justify-end mb-8 items-center">
      <label for="tahun" class="text-lg font-semibold text-[#41a99d] mb-2 mr-4">Pilih Tahun:</label>
      <select name="year" id="tahun" class="p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#41a99d] text-gray-500">
        <option value="">Semua Tahun</option>
        @foreach ($jadwals->pluck('tanggal')->map(fn($date) => date('Y', strtotime($date)))->unique() as $year)
          <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
      </select>
    </div>

    <!-- Kontainer Jadwal -->
    <div id="jadwalContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      @foreach ($jadwals as $jadwal)
        <div class="rounded-xl border border-gray-300 px-10 py-5 {{ $loop->first ? 'bg-white' : 'bg-[#41a99d]' }} shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
          <h1 class="text-2xl font-bold {{ $loop->first ? 'text-[#41a99d]' : 'text-white' }}">
            {{ date('d M Y', strtotime($jadwal->tanggal)) }}
          </h1>
          <p class="text-xl font-medium {{ $loop->first ? 'text-[#41a99d]' : 'text-white' }}">{{ $jadwal->nama_kegiatan }}</p>
          <p class="text-lg font-medium {{ $loop->first ? 'text-[#41a99d]' : 'text-white' }} self-end mt-5">
            {{ date('H:i', strtotime($jadwal->waktu)) }} - Selesai
          </p>
        </div>
      @endforeach
    </div>
  </div>
</x-layout>


{{-- FOOTER --}}
<x-footer-home />


{{-- FOOTER --}}
<x-footer-home></x-footer-home>

{{-- JavaScript --}}
<script>
  // Fungsi untuk membuat card
  function generateCard(jadwal) {
    const cardColor = jadwal.isLatest ? "bg-white" : "bg-[#41a99d]";
    const textColor = jadwal.isLatest ? "text-[#41a99d]" : "text-white";

    return `
      <div class="rounded-xl border border-gray-300 px-10 py-5 ${cardColor} shadow-xl flex flex-col justify-between max-w-xs mx-auto min-h-[150px] min-w-[300px]">
        <h1 class="text-2xl font-bold ${textColor}">${jadwal.tanggal}</h1>
        <p class="text-xl font-medium ${textColor}">${jadwal.nama_kegiatan}</p>
        <p class="text-lg font-medium ${textColor} self-end mt-5">${jadwal.waktu}</p>
      </div>
    `;
  }

  // Event listener untuk filter tahun
  document.getElementById('tahun').addEventListener('change', function () {
    const selectedYear = this.value;

    fetch(`{{ route('jadwal.filter') }}?year=${selectedYear}`)
      .then(response => response.json())
      .then(data => {
        const jadwalContainer = document.getElementById('jadwalContainer');
        jadwalContainer.innerHTML = ''; // Bersihkan kontainer

        if (data.length > 0) {
          data.forEach(jadwal => {
            jadwalContainer.innerHTML += generateCard(jadwal);
          });
        } else {
          jadwalContainer.innerHTML = `<p class="text-center text-gray-500 col-span-full">Tidak ada jadwal untuk tahun ${selectedYear || 'semua'}.</p>`;
        }
      });
  });
</script>

