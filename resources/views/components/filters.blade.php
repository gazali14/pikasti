<!-- Tanggal -->
<form action="{{ route('dashboard.index') }}" method="GET">
    <div class="flex flex-wrap md:flex-nowrap justify-between items-center space-y-2 md:space-y-0 md:space-x-4 bg-white p-4 rounded-lg shadow-md mb-4">
        @if(request('tanggal'))
        <div class="w-full md:w-auto flex justify-start">
            <p class="font-bold text-gray-900">Kegiatan: {{ $namaKegiatan }}</p>
        </div>
        @endif
        <div class="flex justify-end w-full md:w-auto space-x-4">
            <div class="w-full md:w-auto">
                <label for="tanggal" class="block text-sm font-medium text-gray-700 md:mr-2">
                    Pilih Tanggal
                </label>
                <input 
                    type="date" 
                    name="tanggal" 
                    id="tanggal" 
                    value="{{ request('tanggal', \Carbon\Carbon::today()->toDateString()) }}" 
                    class="form-input w-full md:w-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                />
            </div>
            <button 
                type="submit" 
                class="inline-flex items-center px-4 py-1 text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 rounded-md text-center">
                Tampilkan
            </button>
        </div>
    </div>
</form>
