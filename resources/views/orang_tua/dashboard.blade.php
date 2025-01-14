<x-layout>

    <p class="text-white mb-4">Selamat Datang Kembali!
    <p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 justify-between">
        {{-- Data Bayi --}}
        <div class="p-4 border rounded-lg shadow-md bg-[#ffff]">
            <div class="flex items-center justify-between text-sm">
                <div class="font-bold text-lg">
                    Data Bayi
                </div>
                <img src="{{ asset('img/ikon_dashboard.png') }}" alt="ikon" class="w-4 h-auto">
            </div>

            {{-- Data Diri Bayi --}}
            <div class="space-y-2 mt-6">
                <div class="flex items-center">
                    <div class="w-1/2 font-medium">Nama</div>
                    <div class="w-1/2">: {{ $selectedBayi->nama }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/2 font-medium">Tanggal Lahir</div>
                    <div class="w-1/2">:
                        {{ \Carbon\Carbon::parse($selectedBayi->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/2 font-medium">Nama Ibu</div>
                    <div class="w-1/2">: {{ $selectedBayi->nama_ibu }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/2 font-medium">Jenis Kelamin</div>
                    <div class="w-1/2">: {{ $selectedBayi->jenis_kelamin }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/2 font-medium">Berat Lahir</div>
                    <div class="w-1/2">: {{ $selectedBayi->berat_badan_lahir }} kg</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/2 font-medium">Panjang Lahir</div>
                    <div class="w-1/2">: {{ $selectedBayi->tinggi_badan_lahir }} cm</div>
                </div>
            </div>
        </div>

        {{-- Grafik Tinggi Badan Bayi --}}
        <div class="p-4 border rounded-lg shadow-md bg-[#ffff]">
            <div class="flex items-center justify-between text-sm">
                <div class="text-left font-bold text-lg">
                    Tinggi Badan
                </div>
                <img src="{{ asset('img/ikon_trend.png') }}" alt="ikon" class="w-4 h-auto">
            </div>
            <p class="text-sm">Bulan ini:
                <span class="text-lg font-semibold">{{ $kmsData->last()?->tinggi_badan ?? '-' }} cm</span>
            </p>
            <div class="bg-white p-3 rounded-lg border-2 border-[#f3f3f3]" >
                <div class="overflow-x-auto">
                    <canvas id="heightChart" class="w-full max-h-[400px]"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const kmsData = @json($kmsData);
                
                        // Ambil data untuk grafik tinggi badan
                        const labels = kmsData.map(data => Math.floor(data.umur_bulan)); // Label X berupa umur dalam bulan
                        const heightValues = kmsData.map(data => data.tinggi_badan); // Nilai Y berupa tinggi badan
                
                        const canvas = document.getElementById('heightChart');
                        const ctx = canvas.getContext('2d');
                        let heightChart;
                
                        const createChart = () => {
                            if (heightChart) {
                                heightChart.destroy(); // Hapus grafik sebelumnya
                            }
                            heightChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels, // Sumbu X (umur dalam bulan)
                                    datasets: [{
                                        label: 'Tinggi Badan (cm)',
                                        data: heightValues, // Sumbu Y (tinggi badan)
                                        borderColor: 'green',
                                        borderWidth: 2,
                                        fill: false,
                                        pointRadius: 4,
                                        pointBackgroundColor: 'green'
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false, // Supaya grafik berubah ukuran sesuai container
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Umur (bulan)'
                                            },
                                            ticks: {
                                                stepSize: 5 // Interval label pada sumbu X
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Tinggi Badan (cm)'
                                            },
                                            beginAtZero: true // Grafik dimulai dari nol
                                        }
                                    }
                                }
                            });
                        };
                
                        // Buat grafik pertama kali
                        createChart();
                    });
                </script>
                
                <style>
                    #heightChart, #weightChart {
                        aspect-ratio: 2 / 1; /* Rasio lebar dan tinggi tetap */
                    }
                </style>
            </div>
        </div>

        {{-- Grafik Berat Badan Bayi --}}
        <div class="p-4 border rounded-lg shadow-md bg-[#ffff]">
            <div class="flex items-center justify-between text-sm">
                <div class="text-left font-bold text-lg">
                    Berat Badan
                </div>
                <img src="{{ asset('img/ikon_trend.png') }}" alt="ikon" class="w-4 h-auto">
            </div>
            <p class="text-sm">Bulan ini: <span
                    class="text-lg font-semibold">{{ $kmsData->last()?->berat_badan ?? '-' }} kg</span>
            </p>
            <div>
                <!--Grafik BB -->
                <div class="bg-white p-3 rounded-lg border-2 border-[#f3f3f3]">
                    <canvas id="weightChart"></canvas>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const kmsData = @json($kmsData);

                        // Ambil data untuk grafik tinggi badan
                        const labels = kmsData.map(data => Math.floor(data.umur_bulan)); // Label X berupa umur dalam bulan
                        const weightValues = kmsData.map(data => data.berat_badan); // Nilai Y berupa tinggi badan

                        // Inisialisasi grafik tinggi badan
                        const weightCtx = document.getElementById('weightChart').getContext('2d');
                        new Chart(weightCtx, {
                            type: 'line',
                            data: {
                                labels: labels, // Sumbu X (umur dalam bulan)
                                datasets: [{
                                    label: 'Berat Badan (kg)',
                                    data: weightValues, // Sumbu Y (tinggi badan)
                                    borderColor: 'green',
                                    borderWidth: 2,
                                    fill: false,
                                    pointRadius: 4,
                                    pointBackgroundColor: 'green'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false, // Supaya grafik berubah ukuran sesuai container
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Umur (bulan)'
                                        },
                                        ticks: {
                                            stepSize: 5 // Interval label pada sumbu X
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Berat Badan (kg)'
                                        },
                                        beginAtZero: true // Grafik dimulai dari nol
                                    }
                                }
                            }
                        });
                    });
                </script>


            </div>
        </div>
    </div>


    {{-- KMS
    <div class="text-lg font-bold text-left mt-8 text-[#353535]">Kartu Menuju Sehat (KMS)</div> --}}

    <!-- Grafik KMS -->
    <x-grafik-kms :bayiList="$bayiList" :kmsData="$kmsData" :selectedBayiNik="$selectedBayiNik" />

</x-layout>

{{-- FOOTER --}}
<x-footer-home></x-footer-home>
