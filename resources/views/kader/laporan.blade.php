<x-layout-kader>
  <p class="font-bold text-2xl text-[#353535] text-center mb-10">Laporan Summary</p>
    <!-- Tanggal -->
     <div>
      <div class="font-bold text-xl text-left mb-4">Pilih Tanggal:</div>
        <input type="date" id="search-date" class="w-full p-2 border border-[#62BCB1] rounded-lg">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-0 bg-[#a1c47b] w-full border shadow-md rounded-lg p-4">
      {{-- Summary --}}
      <div class="space-y-4">
        <div class="space-y-2">
          <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Kader yang Hadir </div>
              <div class="w-1/2">: </div>
          </div>

            <p class="font-medium">Jumlah Vitamin A bagi Balita</p>
              <ul class="pl-1">
                <li class="flex flex-wrap items-center">
                  <div class="w-1/2 font-medium">Vitamin A Merah</div>
                  <div class="w-1/2 text-left">: </div>
              </li>
              <li class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">Vitamin A Merah (12-59 Bulan)</div>
                <div class="w-1/2 text-left">: </div>
            </li>
              <li class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">Vitamin A Biru</div>
                <div class="w-1/2 text-left">: </div>
            </li>
            <li class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Vitamin A Biru (6-11 Bulan)</div>
              <div class="w-1/2 text-left">: </div>
          </li>
              </ul>

          <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Seluruh Balita (S)</div>
              <div class="w-1/2">: 0 P 13 L </div>
          </div>
          <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Balita Memiliki KMS (K)</div>
              <div class="w-1/2">: 0 P 0 L </div>
          </div>
          <p class="font-bold">GIZI</p>
          <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Balita Ditimbang (D)</div>
              <div class="w-1/2">: 1 P 1 L</div>
            </div>
              <ul class="pl-1">
                <li class="flex flex-wrap items-center">
                  <div class="w-1/2 font-medium">0-23 Bulan yg Ditimbang</div>
                  <div class="w-1/2 text-left">: </div>
              </li>
              <li class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">24-59 Bulan yg Ditimbang</div>
                <div class="w-1/2 text-left">: </div>
            </li>
              </ul>
          
          <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Balita Naik BB (N)</div>
              <div class="w-1/2">: 12 P 13 L</div>
          </div>

          <div class="flex flex-wrap items-center">
            <div class="w-1/2 font-medium">Jumlah Balita Tetap BB (T)</div>
            <div class="w-1/2">: 12 P 13 L</div>
          </div>
          <div class="flex flex-wrap items-center">
            <div class="w-1/2 font-medium">Jumlah Balita Pertama Kali Ditimbang (B)</div>
            <div class="w-1/2">: 12 P 13 L</div>
          </div>

          <div class="flex flex-wrap items-center">
            <div class="w-1/2 font-medium">Jumlah Balita Stunting (BGM)</div>
            <div class="w-1/2">: 12 P 13 L</div>
          </div>

              <p class="font-bold">JUMLAH BAYI</p>
              <div class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">Jumlah Bayi 0-5 Bulan</div>
                <div class="w-1/2">: 16 </div>
            </div>
              <div class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">Jumlah Bayi 6-11 Bulan</div>
                <div class="w-1/2">: 16 </div>
            </div>
              <div class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">Jumlah Bayi 12-23 Bulan</div>
                <div class="w-1/2">: 16 </div>
            </div>
              <div class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">Jumlah Bayi 24-59 Bulan</div>
                <div class="w-1/2">: 16 </div>
            </div>
            <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Bayi 0-23 Bulan</div>
              <div class="w-1/2">: 16 </div>
          </div>
            <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Bayi < 1 Tahun Ditimbang</div>
              <div class="w-1/2">: 16 </div>
          </div>
            <div class="flex flex-wrap items-center">
              <div class="w-1/2 font-medium">Jumlah Balita 1-4 Tahun Ditimbang</div>
              <div class="w-1/2">: 16 </div>
          </div>      
      </div>
    </div>
    <div class="mt-2 space-y-4">
      <div class="space-y-2">
    <p class="font-bold">PMT</p>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Ada/Tidak</div>
        <div class="w-1/2">: </div>
    </div>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Keterangan</div>
        <div class="w-1/2">: </div>
    </div>

    <p class="font-bold">IMUNISASI</p>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Jumlah yang Imunisasi BCG</div>
        <div class="w-1/2">: 3 P 10 L </div>
    </div>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio I</div>
        <div class="w-1/2">: 3 P 10 L </div>
    </div>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio II</div>
        <div class="w-1/2">: 3 P 10 L </div>
    </div>
    <div class="flex flex-wrap items-center">
      <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio III</div>
      <div class="w-1/2">: 3 P 10 L </div>
    </div>
    <div class="flex flex-wrap items-center">
      <div class="w-1/2 font-medium">Jumlah yang Imunisasi Polio IV</div>
      <div class="w-1/2">: 3 P 10 L </div>
    </div>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Campak</div>
        <div class="w-1/2">: 3 P 10 L </div>
    </div>
      <div class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Jumlah yang Imunisasi Hepatitis B 1</div>
        <div class="w-1/2">: 3 P 10 L </div>
    </div>
    <div class="flex flex-wrap items-center">
      <div class="w-1/2 font-medium">Jumlah yang Imunisasi Hepatitis B 2</div>
      <div class="w-1/2">: 3 P 10 L </div>
  </div>
    <div class="flex flex-wrap items-center">
      <div class="w-1/2 font-medium">Jumlah yang Imunisasi Hepatitis B 3</div>
      <div class="w-1/2">: 3 P 10 L </div>
  </div>

    <p class="font-bold">JUMLAH PENGUNJUNG</p>
    <p class="font-medium">Bayi</p>
              <ul class="pl-1">
                <li class="flex flex-wrap items-center">
                  <div class="w-1/2 font-medium">0-12 Bulan yang Baru</div>
                  <div class="w-1/2 text-left">: 1 P 1 L </div>
              </li>
              <li class="flex flex-wrap items-center">
                <div class="w-1/2 font-medium">0-12 Bulan yang Lama</div>
                <div class="w-1/2 text-left">: 3 P 5 L </div>
            </li>
        </ul>
        <p class="font-medium">Petugas yang Hadir</p>
        <ul class="pl-1">
          <li class="flex flex-wrap items-center">
            <div class="w-1/2 font-medium">Kader</div>
            <div class="w-1/2 text-left">: </div>
        </li>
          <li class="flex flex-wrap items-center">
            <div class="w-1/2 font-medium">PLKB</div>
            <div class="w-1/2 text-left">: </div>
        </li>
        <li class="flex flex-wrap items-center">
          <div class="w-1/2 font-medium">Medis</div>
          <div class="w-1/2 text-left">: </div>
      </li>
      <li class="flex flex-wrap items-center">
        <div class="w-1/2 font-medium">Para Medis</div>
        <div class="w-1/2 text-left">: </div>
    </li>
        </ul>
      </div>
    </div>
  </div>
  <p class="p-2 text-sm">Keterangan:</p>
    <div class="pl-3 text-sm">P: Perempuan</div>
    <div class="pl-3 text-sm">L: Laki-Laki</div>

  <div class="mt-3 font-bold pl-2 flex justify-end">Generate Data Mentah ke Excel</div>
  <div class="mt-2 w-full flex justify-end">
    <button id="generate-button" 
        type="submit"
        style="background-color: #4EC3AF; color: #ffffff; padding: 10px 20px;
        border-radius: 8px; font-size: 16px; cursor: pointer; font-weight: bold;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
        transition: background-color 0.3s ease, transform 0.1s ease;">
        Generate
    </button>
    <!-- Kalau bisa generatenya dengan data presensi kadernya ya-->
  </div>

  <script>
      // Fungsi Generate
      document.getElementById('generate-button').addEventListener('mousedown', function() {
          this.style.transform = 'scale(0.98)';
      });

      document.getElementById('generate-button').addEventListener('mouseup', function() {
          this.style.transform = 'scale(1)';
      });

      document.getElementById('generate-button').addEventListener('mouseleave', function() {
          this.style.transform = 'scale(1)';
      });
  </script>

</x-layout-kader>
