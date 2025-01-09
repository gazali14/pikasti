<!-- Tanggal -->
<form action="{{ route('dashboard.index') }}" method="GET">
    <div class="flex flex-wrap md:flex-nowrap justify-between items-center space-y-2 md:space-y-0 md:space-x-4 bg-white p-4 rounded-lg shadow-md mb-4">
        <div class="w-full md:w-auto flex justify-start">
        @if(request('tanggal'))
            <h3 class="text-xl font-semibold text-gray-900">Kegiatan: <span class="text-blue-600">{{ $namaKegiatan }}</span></h3>
        @else
            <h3 class="text-xl font-semibold text-gray-900">Kegiatan: <span class="text-gray-500">Belum ada kegiatan</span></h3>
        @endif
        </div>
        <div class="flex justify-end w-full md:w-auto space-x-4">
            <input 
                type="date" 
                name="tanggal" 
                id="tanggal" 
                value="{{ request('tanggal', \Carbon\Carbon::today()->toDateString()) }}" 
                class="form-input w-full md:w-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900"
            />
            <button 
                type="submit" 
                class="inline-flex items-center px-6 py-2 w-full md:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 rounded-md text-center">
                Tampilkan
            </button>
        </div>    
    </div>
</form>
