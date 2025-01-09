<x-layout-kader>
    <p class="font-bold text-2xl text-[#353535] text-center mb-10">Laporan</p>
    <!-- Tanggal -->
    <form action="{{ route('laporan.index') }}" method="GET">
        <div class="flex flex-wrap md:flex-nowrap justify-end items-center space-y-2 md:space-y-0 md:space-x-4 bg-white p-4 rounded-lg shadow-md mb-4">
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
            <button 
                type="submit" 
                class="inline-flex items-center px-6 py-2 w-full md:w-auto text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 rounded-md text-center">
                Tampilkan
            </button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white w-full border shadow-md rounded-lg p-6">
        @if(!request('tanggal'))
            <div class="flex items-center justify-center col-span-1 md:col-span-2 bg-yellow-100 text-yellow-800 p-6 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" role="img">
                    <path d="M12 2L2 22h20L12 2zm0 15h-2v-2h2zm0-4h-2v-4h2z"></path>
                </svg>
                <p class="text-center text-lg font-semibold">Silahkan pilih tanggal untuk melihat laporan.</p>
            </div>

        @elseif(request('tanggal'))
            {{-- Summary --}}
            <div class="space-y-4">
                <div class="space-y-2">
                    <p class="font-bold">JUMLAH KEHADIRAN</p>
                    <p class="font-medium">Bayi</p>
                    <ul class="pl-1">
                        <li class="flex flex-wrap items-center">
                            <div class="w-1/2 font-medium">Usia 0-12 Bulan</div>
                            <div class="w-1/2 text-left">: {{ $jumlahBayiUsia1P  }} P,  {{ $jumlahBayiUsia1L }} L</div>
                        </li>

                        <li class="flex flex-wrap items-center">
                            <div class="w-1/2 font-medium">Usia 13-60 Bulan</div>
                            <div class="w-1/2 text-left">: {{ $jumlahBayiUsia2P  }} P,  {{ $jumlahBayiUsia2L  }} L</div>
                        </li>
                    </ul>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Kader yang Hadir </div>
                        <div class="w-1/2">: {{ $jumlahKaderHadir ?? 0 }}</div>
                    </div>
                    
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Seluruh Balita (S)</div>
                        <div class="w-1/2">: {{ $totalBalitaPerempuan }} P, {{ $totalBalitaLakiLaki }} L</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Balita Memiliki KMS (K)</div>
                        <div class="w-1/2">: {{ $balitaMemilikiKMSPerempuan }} P, {{ $balitaMemilikiKMSLakiLaki }} L</div>
                    </div>

                    <p class="font-bold">GIZI</p>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Balita Ditimbang (D)</div>
                        <div class="w-1/2">: {{ $ditimbang0_23Perempuan + $ditimbang24_59Perempuan }} P, {{ $ditimbang0_23LakiLaki + $ditimbang24_59LakiLaki }} L</div>
                    </div>
                    <ul class="pl-1">
                        <li class="flex flex-wrap items-center">
                            <div class="w-1/2 font-medium">0-23 Bulan yg Ditimbang</div>
                            <div class="w-1/2 text-left">: {{ $ditimbang0_23Perempuan }} P, {{ $ditimbang0_23LakiLaki }} L</div>
                        </li>
                        <li class="flex flex-wrap items-center">
                            <div class="w-1/2 font-medium">24-59 Bulan yg Ditimbang</div>
                            <div class="w-1/2 text-left">: {{ $ditimbang24_59Perempuan }} P, {{ $ditimbang24_59LakiLaki }} L</div>
                        </li>
                    </ul>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Balita Naik BB (N)</div>
                        <div class="w-1/2">: {{ $naikBBPerempuan }} P, {{ $naikBBLakiLaki }} L</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Balita Tetap BB (T)</div>
                        <div class="w-1/2">: {{ $tetapBBPerempuan }} P, {{ $tetapBBLakiLaki }} L</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Balita Pertama Kali Ditimbang (B)</div>
                        <div class="w-1/2">: {{ $pertamaKaliDitimbangPerempuan }} P, {{ $pertamaKaliDitimbangLakiLaki }} L</div>
                    </div>
            
                    <p class="font-bold">JUMLAH BAYI</p>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Bayi 0-5 Bulan</div>
                        <div class="w-1/2">: {{ $bayi_0_5_bulan }}</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Bayi 6-11 Bulan</div>
                        <div class="w-1/2">: {{ $bayi_6_11_bulan }}</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Bayi 12-23 Bulan</div>
                        <div class="w-1/2">: {{ $bayi_12_23_bulan }}</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Bayi 24-59 Bulan</div>
                        <div class="w-1/2">: {{ $bayi_24_59_bulan }}</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah Bayi 0-23 Bulan</div>
                        <div class="w-1/2">: {{ $bayi_0_5_bulan + $bayi_6_11_bulan +$bayi_12_23_bulan }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-2 space-y-4">
                <div class="space-y-2">
                    <p class="font-bold">VITAMIN</p>
                        <p class="font-medium">Jumlah Vitamin A bagi Balita</p>
                        <ul class="pl-1">
                            <li class="flex flex-wrap items-center">
                                <div class="w-1/2 font-medium">Vitamin A Merah</div>
                                <div class="w-1/2 text-left">: {{ $jumlahVitaminMerah }}</div>
                            </li>
                            <li class="flex flex-wrap items-center">
                                <div class="w-1/2 font-medium">Vitamin A Biru</div>
                                <div class="w-1/2 text-left">: {{ $jumlahVitaminBiru }}</div>
                            </li>
                        </ul>

                    <p class="font-bold">PMT</p>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Ada/Tidak</div>
                        <div class="w-1/2">: {{ $adaPMT }}</div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Keterangan</div>
                        <div class="w-1/2">: {{ $keteranganPMT }}</div>
                    </div>

                    <p class="font-bold">IMUNISASI</p>
                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi BCG</div>
                        <div class="w-1/2">: {{ $imunisasiBCGPerempuan }} P, {{ $imunisasiBCGLakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio I</div>
                        <div class="w-1/2">: {{ $imunisasiPolioIPerempuan }} P, {{ $imunisasiPolioILakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio II</div>
                        <div class="w-1/2">: {{ $imunisasiPolioIIPerempuan }} P, {{ $imunisasiPolioIILakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio III</div>
                        <div class="w-1/2">: {{ $imunisasiPolioIIIPerempuan }} P, {{ $imunisasiPolioIIILakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio IV</div>
                        <div class="w-1/2">: {{ $imunisasiPolioIVPerempuan }} P, {{ $imunisasiPolioIVLakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Campak</div>
                        <div class="w-1/2">: {{ $imunisasiCampakPerempuan }} P, {{ $imunisasiCampakLakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi DPT, Hb Com1</div>
                        <div class="w-1/2">: {{ $imunisasiHepatitisB1Perempuan }} P, {{ $imunisasiHepatitisB1LakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi DPT, Hb Com2</div>
                        <div class="w-1/2">: {{ $imunisasiHepatitisB2Perempuan }} P, {{ $imunisasiHepatitisB2LakiLaki }} L</div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <div class="w-1/2 font-medium">Jumlah yang Imunisasi DPT, Hb Com3</div>
                        <div class="w-1/2">: {{ $imunisasiHepatitisB3Perempuan }} P, {{ $imunisasiHepatitisB3LakiLaki }} L</div>
                    </div>


                </div>
            </div>
    </div>

    <p class="p-2 text-sm">Keterangan:</p>
    <div class="pl-3 text-sm">P: Perempuan</div>
    <div class="pl-3 text-sm">L: Laki-Laki</div>

    <div class="mt-3 font-bold pl-2 flex justify-end">Ekspor Data Mentah ke Excel</div>
    <div class="mt-2 w-full flex justify-end">
        <form action="{{ route('laporan.export') }}" method="get">
            <!-- Kirimkan semua data melalui input tersembunyi -->
            <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
            <input type="hidden" name="jumlahBayiUsia1P" value="{{ $jumlahBayiUsia1P }}">
            <input type="hidden" name="jumlahBayiUsia1L" value="{{ $jumlahBayiUsia1L }}">
            <input type="hidden" name="jumlahBayiUsia2P" value="{{ $jumlahBayiUsia2P }}">
            <input type="hidden" name="jumlahBayiUsia2L" value="{{ $jumlahBayiUsia2L }}">
            <input type="hidden" name="jumlahKaderHadir" value="{{ $jumlahKaderHadir ?? 0 }}">
            <input type="hidden" name="totalBalitaPerempuan" value="{{ $totalBalitaPerempuan }}">
            <input type="hidden" name="totalBalitaLakiLaki" value="{{ $totalBalitaLakiLaki }}">
            <input type="hidden" name="balitaMemilikiKMSPerempuan" value="{{ $balitaMemilikiKMSPerempuan }}">
            <input type="hidden" name="balitaMemilikiKMSLakiLaki" value="{{ $balitaMemilikiKMSLakiLaki }}">
            <input type="hidden" name="ditimbang0_23Perempuan" value="{{ $ditimbang0_23Perempuan }}">
            <input type="hidden" name="ditimbang0_23LakiLaki" value="{{ $ditimbang0_23LakiLaki }}">
            <input type="hidden" name="ditimbang24_59Perempuan" value="{{ $ditimbang24_59Perempuan }}">
            <input type="hidden" name="ditimbang24_59LakiLaki" value="{{ $ditimbang24_59LakiLaki }}">
            <input type="hidden" name="naikBBPerempuan" value="{{ $naikBBPerempuan }}">
            <input type="hidden" name="naikBBLakiLaki" value="{{ $naikBBLakiLaki }}">
            <input type="hidden" name="tetapBBPerempuan" value="{{ $tetapBBPerempuan }}">
            <input type="hidden" name="tetapBBLakiLaki" value="{{ $tetapBBLakiLaki }}">
            <input type="hidden" name="pertamaKaliDitimbangPerempuan" value="{{ $pertamaKaliDitimbangPerempuan }}">
            <input type="hidden" name="pertamaKaliDitimbangLakiLaki" value="{{ $pertamaKaliDitimbangLakiLaki }}">
            <input type="hidden" name="bayi_0_5_bulan" value="{{ $bayi_0_5_bulan }}">
            <input type="hidden" name="bayi_6_11_bulan" value="{{ $bayi_6_11_bulan }}">
            <input type="hidden" name="bayi_12_23_bulan" value="{{ $bayi_12_23_bulan }}">
            <input type="hidden" name="bayi_24_59_bulan" value="{{ $bayi_24_59_bulan }}">
            <input type="hidden" name="jumlahVitaminMerah" value="{{ $jumlahVitaminMerah }}">
            <input type="hidden" name="jumlahVitaminBiru" value="{{ $jumlahVitaminBiru }}">
            <input type="hidden" name="adaPMT" value="{{ $adaPMT }}">
            <input type="hidden" name="keteranganPMT" value="{{ $keteranganPMT }}">
            <input type="hidden" name="imunisasiBCGPerempuan" value="{{ $imunisasiBCGPerempuan }}">
            <input type="hidden" name="imunisasiBCGLakiLaki" value="{{ $imunisasiBCGLakiLaki }}">
            <input type="hidden" name="imunisasiPolioIPerempuan" value="{{ $imunisasiPolioIPerempuan }}">
            <input type="hidden" name="imunisasiPolioILakiLaki" value="{{ $imunisasiPolioILakiLaki }}">
            <input type="hidden" name="imunisasiPolioIIPerempuan" value="{{ $imunisasiPolioIIPerempuan }}">
            <input type="hidden" name="imunisasiPolioIILakiLaki" value="{{ $imunisasiPolioIILakiLaki }}">
            <input type="hidden" name="imunisasiPolioIIIPerempuan" value="{{ $imunisasiPolioIIIPerempuan }}">
            <input type="hidden" name="imunisasiPolioIIILakiLaki" value="{{ $imunisasiPolioIIILakiLaki }}">
            <input type="hidden" name="imunisasiPolioIVPerempuan" value="{{ $imunisasiPolioIVPerempuan }}">
            <input type="hidden" name="imunisasiPolioIVLakiLaki" value="{{ $imunisasiPolioIVLakiLaki }}">
            <input type="hidden" name="imunisasiCampakPerempuan" value="{{ $imunisasiCampakPerempuan }}">
            <input type="hidden" name="imunisasiCampakLakiLaki" value="{{ $imunisasiCampakLakiLaki }}">
            <input type="hidden" name="imunisasiHepatitisB1Perempuan" value="{{ $imunisasiHepatitisB1Perempuan }}">
            <input type="hidden" name="imunisasiHepatitisB1LakiLaki" value="{{ $imunisasiHepatitisB1LakiLaki }}">
            <input type="hidden" name="imunisasiHepatitisB2Perempuan" value="{{ $imunisasiHepatitisB2Perempuan }}">
            <input type="hidden" name="imunisasiHepatitisB2LakiLaki" value="{{ $imunisasiHepatitisB2LakiLaki }}">
            <input type="hidden" name="imunisasiHepatitisB3Perempuan" value="{{ $imunisasiHepatitisB3Perempuan }}">
            <input type="hidden" name="imunisasiHepatitisB3LakiLaki" value="{{ $imunisasiHepatitisB3LakiLaki }}">

            <button 
                id="generate-button"
                type="submit"
                style="background-color: #4EC3AF; color: #ffffff; padding: 10px 20px;
                    border-radius: 8px; font-size: 16px; cursor: pointer; font-weight: bold;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
                    transition: background-color 0.3s ease, transform 0.1s ease;">
                Ekspor
            </button>
        </form>

    </div>

    @endif
</x-layout-kader>
