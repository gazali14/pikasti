<x-layout-kader>
    <div class="container">
        <h1 class="mb-4">Dashboard Kader</h1>

        <!-- Filter Tahun -->
        <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="tanggal_mulai">Pilih Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" onchange="this.form.submit()" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">Pilih Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" onchange="this.form.submit()" value="{{ request('tanggal_akhir') }}">
            </div>
        </form>



        <!-- Grafik Jumlah Kehadiran Berdasarkan Jenis Kelamin -->
        <div class="mb-4">
            <h3>Jumlah Kehadiran Berdasarkan Jenis Kelamin</h3>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <canvas id="kehadiranChart" class="w-100"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Rata-Rata Tinggi Badan Bayi Menurut Umur (Bulan) -->
        <div class="mb-4">
            <h3>Rata-Rata Tinggi Badan Bayi Menurut Umur (Bulan)</h3>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <canvas id="tinggiBadanChart" class="w-100"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Rata-Rata Berat Badan Bayi Menurut Umur (Bulan) -->
        <div class="mb-4">
            <h3>Rata-Rata Berat Badan Bayi Menurut Umur (Bulan)</h3>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <canvas id="beratBadanChart" class="w-100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Jumlah Kehadiran Berdasarkan Jenis Kelamin
        var ctx = document.getElementById('kehadiranChart').getContext('2d');
        var kehadiranChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: [{{ $lakiLaki }}, {{ $perempuan }}],
                    backgroundColor: ['#4e73df', '#e74a3b'],
                    borderColor: ['#4e73df', '#e74a3b'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Rata-Rata Tinggi Badan Bayi Menurut Umur (Bulan)
        var ctxTinggiBadan = document.getElementById('tinggiBadanChart').getContext('2d');
        var tinggiBadanChart = new Chart(ctxTinggiBadan, {
            type: 'bar',
            data: {
                labels: @json($umurKelompok), // Kelompok umur berdasarkan bulan
                datasets: [{
                    label: 'Tinggi Badan Laki-Laki (cm)',
                    data: @json($rataRataTinggiLaki),
                    backgroundColor: '#4e73df',
                    borderColor: '#4e73df',
                    borderWidth: 1
                },
                {
                    label: 'Tinggi Badan Perempuan (cm)',
                    data: @json($rataRataTinggiPerempuan),
                    backgroundColor: '#e74a3b',
                    borderColor: '#e74a3b',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Rata-Rata Berat Badan Bayi Menurut Umur (Bulan)
        var ctxBeratBadan = document.getElementById('beratBadanChart').getContext('2d');
        var beratBadanChart = new Chart(ctxBeratBadan, {
            type: 'bar',
            data: {
                labels: @json($umurKelompok), // Kelompok umur berdasarkan bulan
                datasets: [{
                    label: 'Berat Badan Laki-Laki (kg)',
                    data: @json($rataRataBeratLaki),
                    backgroundColor: '#4e73df',
                    borderColor: '#4e73df',
                    borderWidth: 1
                },
                {
                    label: 'Berat Badan Perempuan (kg)',
                    data: @json($rataRataBeratPerempuan),
                    backgroundColor: '#e74a3b',
                    borderColor: '#e74a3b',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout-kader>
