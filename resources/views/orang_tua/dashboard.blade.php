<x-layout>

  <p class="text-white mb-4">Selamat Datang Kembali!<p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-3 justify-between">
  {{-- Data Bayi --}}
  <div class="p-4 border rounded-lg shadow-md bg-[#f3f3f3]">
    <div class="flex items-center justify-between text-sm">
        <div class="font-bold text-lg">
            Data Bayi
        </div>
        <img 
            src="{{ asset('img/ikon_dashboard.png') }}" 
            alt="ikon"
            class="w-4 h-auto"
        >
    </div>
        <div class="space-y-2 mt-6">
            <div class="flex items-center">
                <div class="w-1/2 font-medium">Nama</div>
                <div class="w-1/2">: Aliando Syarif</div>
            </div>
            <div class="flex items-center">
                <div class="w-1/2 font-medium">Tanggal Lahir</div>
                <div class="w-1/2">: 11 Mei 2024</div>
            </div>
            <div class="flex items-center">
                <div class="w-1/2 font-medium">Nama Ibu</div>
                <div class="w-1/2">: Masna Hafidzah</div>
            </div>
            <div class="flex items-center">
                <div class="w-1/2 font-medium">Berat Lahir</div>
                <div class="w-1/2">: 2,11 kg</div>
            </div>
            <div class="flex items-center">
                <div class="w-1/2 font-medium">Panjang Lahir</div>
                <div class="w-1/2">: 53 cm</div>
            </div>
        </div>
  </div>

  {{-- Grafik Tinggi Badan Bayi --}}
  <div class="p-4 border rounded-lg shadow-md bg-[#f3f3f3]">
    <div class="flex items-center justify-between text-sm">
        <div class="text-left font-bold text-lg">
            Tinggi Badan
        </div>
        <img 
            src="{{ asset('img/ikon_trend.png') }}" 
            alt="ikon"
            class="w-4 h-auto"
        >
    </div>
        <p class="text-sm">Bulan ini: <span class="text-lg font-semibold">65 cm</span>
        </p>
        <div class="bg-white p-3 rounded-lg">
            <div class="overflow-x-auto">
                <canvas id="trendChart" class="w-full max-h-[400px]"></canvas>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const ctx = document.getElementById('trendChart').getContext('2d');
            
                    const trendChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: Array.from({ length: 61 }, (_, i) => i), // Sumbu X (0-60)
                            datasets: [{
                                label: '', // Kosongkan label agar tidak ada teks tambahan
                                data: [47, 51, 55, 58, 60, 62, 64, 65, 67, 68, 69, 70, 71, 73, 74, 75, 75, 76, 77, 78, 79, 80, 81, 81, 82, 83, 83, 85, 85, 86, 87, 88, 89, 90, 90, 91, 92, 94, 95, 95, 96, 97, 97, 98, 99, 100, 101, 102, 103, 103, 104, 105, 105, 106, 107, 108, 109, 110, 110, 112,113], // Data tinggi badan (sesuaikan)
                                borderColor: '#000', // Garis hitam
                                borderWidth: 2, // Ketebalan garis
                                fill: false, // Tidak ada warna di bawah garis
                                pointRadius: 0, // Titik data tidak terlihat
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: false } // Sembunyikan legenda
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Bulan', // Kosongkan teks X
                                    },
                                    ticks: {
                                        stepSize: 6, // Interval 6 pada sumbu X
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Tinggi Badan (cm)', // Label sumbu Y
                                    },
                                    min: 20, // Mulai dari 50
                                    max: 130, // Batas atas 130
                                    ticks: {
                                        stepSize: 25, // Interval sumbu Y
                                    },
                                    grid: {
                                        drawTicks: false, // Hilangkan tick marks
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
            
        </div>
        
        
  </div>

  {{-- Grafik Berat Badan Bayi --}}
  <div class="p-4 border rounded-lg shadow-md bg-[#f3f3f3]">
    <div class="flex items-center justify-between text-sm">
        <div class="text-left font-bold text-lg">
            Berat Badan
        </div>
        <img 
            src="{{ asset('img/ikon_trend.png') }}" 
            alt="ikon"
            class="w-4 h-auto"
        >
    </div>
    <p class="text-sm">Bulan ini: <span class="text-lg font-semibold">6,5 kg</span>
    </p>
    <div>
        <!--Grafik BB -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="bg-white p-3 rounded-lg">
            <canvas id="weightChart"></canvas>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.getElementById('weightChart').getContext('2d');
        
                const trendChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Array.from({ length: 61 }, (_, i) => i), // Sumbu X (0-60)
                        datasets: [{
                            label: '', // Kosongkan label agar tidak ada teks tambahan
                            data: [2.5, 3.4, 4.3, 5, 5.6, 6, 6.4, 6.7, 6.9, 7.1, 7.4, 7.6, 7.7, 7.9, 8.1, 8.3, 8.4, 8.6, 8.8, 8.9, 9.1, 9.2, 9.4, 9.5, 9.7, 9.8, 10, 10.1, 10.2, 10.4, 10.5, 10.7, 10.8, 10.9, 11, 11.2, 11.3, 11.4, 11.5, 11.6, 11.8, 11.9, 12, 12.1, 12.2, 12.4, 12.5, 12.6, 12.7, 12.8, 12.9, 13.1, 13.2, 13.3, 13.4, 13.5, 13.6, 13.7, 13.8, 14, 15], // Data berat badan (sesuaikan)
                            borderColor: '#000', // Garis hitam
                            borderWidth: 2, // Ketebalan garis
                            fill: false, // Tidak ada warna di bawah garis
                            pointRadius: 0, // Titik data tidak terlihat
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false } // Sembunyikan legenda
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan', // Kosongkan teks X
                                },
                                ticks: {
                                    stepSize: 6, // Interval 6 pada sumbu X
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Berat Badan (kg)', // Label sumbu Y
                                },
                                min: 0, // Mulai dari 50
                                max: 25, // Batas atas 130
                                ticks: {
                                    stepSize: 3, // Interval sumbu Y
                                },
                                grid: {
                                    drawTicks: false, // Hilangkan tick marks
                                }
                            }
                        }
                    }
                });
            });
        </script>

    </div>
  </div>
</div>
  

  {{-- KMS --}}
  <div class="text-lg font-bold text-left mt-8 text-[#353535]">Kartu Menuju Sehat (KMS)</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 20px auto;
        }
        .chart-container {
            position: relative;
            margin-bottom: 30px;
            height: 400px;
        }
        @media (max-width: 768px) {
            .chart-container {
                height: 300px;
            }
        }
        #beratBadanChart {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        #tinggiBadanChart{
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <canvas id="beratBadanChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="tinggiBadanChart"></canvas>
        </div>
    </div>

    <script>
        //KMS PEREMPUAN
        // Data untuk grafik berat badan
        /*keterangan:
            -3 SD: Ini adalah batas bawah yang menunjukkan anak dengan pertumbuhan yang sangat lambat, mungkin mengalami kekurangan gizi atau masalah kesehatan.
            -2 SD: Ini adalah batas bawah yang lebih ringan, anak mungkin mengalami pertumbuhan lebih lambat dari rata-rata tetapi tidak seberat -3 SD.
            -1 SD: Ini menunjukkan anak yang sedikit di bawah rata-rata, tetapi masih dalam batas normal untuk pertumbuhan.
            Median (0 SD): Ini adalah rata-rata pertumbuhan anak dalam kelompok usia tersebut. Ini dianggap sebagai standar "normal" untuk pertumbuhan.
            +1 SD: Ini menunjukkan anak yang sedikit lebih tinggi dari rata-rata.
            +2 SD dan +3 SD: Ini menunjukkan anak dengan pertumbuhan yang sangat baik, lebih tinggi dari rata-rata.
        */
        const beratBadanChart = new Chart(
            document.getElementById('beratBadanChart'),
            {
                type: 'line',
                data: {
                    labels: Array.from({ length: 60 }, (_, i) => i + 1), // Umur bayi sampai 60 bulan
                    datasets: [
                        {
                            label: 'Berat Badan -3 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2 + (Math.sqrt(i / 59) * 6)), // Rentang 2 sampai 8
                            borderColor: '#d90f0f', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan -2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.2 + (Math.sqrt(i / 59) * 6.8)), // Rentang 2.2 sampai 9
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan -1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.5 + (Math.sqrt(i / 59) * 7.6)), // Rentang 2.5 sampai 10.1
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan Median',
                            data: Array.from({ length: 60 }, (_, i) => 3 + (Math.sqrt(i / 59) * 8.5)), // Rentang 3 sampai 11.5
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan +1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 3.5 + (Math.sqrt(i / 59) * 9.5)), // Rentang 3.5 sampai 13
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan +2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4 + (Math.sqrt(i / 59) * 11)), // Rentang 4 sampai 15
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan +3 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4.5 + (Math.sqrt(i / 59) * 12.4)), // Rentang 4.5 sampai 16.9
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Berat Badan Bayi (Perempuan)'
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Berat Badan (kg)'
                            },
                            min: 2,  // Minimum berat badan
                            max: 18  // Maximum berat badan
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Umur (bulan)'
                            },
                            min: 1,  // Umur dimulai dari 1 bulan
                            max: 60  // Sampai 60 bulan
                        }
                    }
                }
            }
        );

        // Data untuk grafik tinggi badan
        const tinggiBadanChart = new Chart(
            document.getElementById('tinggiBadanChart'),
            {
                type: 'line',
                data: {
                    labels: Array.from({length: 60}, (_, i) => i + 1), // Umur bayi sampai 60 bulan
                    datasets: [ //Tolong sesuaikan dengan perhitungan di kms ya backend
                        {
                            label: 'Tinggi Badan -3 SD',
                            data: Array(60).fill(8).map((v, i) => v + (i * (4 / 59))),
                            borderColor: '#d90f0f', // Kuning
                            fill: false,
                            pointRadius: 0
                        },
                        {
                            label: 'Tinggi Badan -2 SD',
                            data: Array(60).fill(9).map((v, i) => v + (i * (4.9 / 59))), // Rentang 9 sampai 13.9
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan -1 SD',
                            data: Array(60).fill(10).map((v, i) => v + (i * (5.9 / 59))), // Rentang 10 sampai 15.9
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan Median',
                            data: Array(60).fill(11.5).map((v, i) => v + (i * (6.9 / 59))), // Rentang 11.5 sampai 18.4
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan +1 SD',
                            data: Array(60).fill(13).map((v, i) => v + (i * (8.5 / 59))), // Rentang 13 sampai 21.5
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan +2 SD',
                            data: Array(60).fill(14.5).map((v, i) => v + (i * (10 / 59))), // Rentang 14.5 sampai 25
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan +3 SD',
                            data: Array(60).fill(16.5).map((v, i) => v + (i * (12.4 / 59))), // Rentang 16.5 sampai 28.9
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Tinggi Badan Bayi (Perempuan)'
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Tinggi Badan (cm)'
                            },
                            min: 25,  // Minimum tinggi badan
                            max: 150  // Maximum tinggi badan untuk rentang yang lebih luas
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Umur (bulan)'
                            },
                            min: 1,  // Umur dimulai dari 1 bulan
                            max: 60  // Sampai 60 bulan
                        }
                    }
                }
            }
        );
    

        //KMS LAKI-LAKI
        // Data untuk grafik berat badan
        /*const beratBadanChart = new Chart(
            document.getElementById('beratBadanChart'),
            {
                type: 'line',
                data: {
                    labels: Array.from({ length: 60 }, (_, i) => i + 1), // Umur bayi sampai 60 bulan
                    datasets: [
                        {
                            label: 'Berat Badan -3 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2 + (Math.sqrt(i / 59) * 6.9)), // Rentang 2 sampai 8.9
                            borderColor: '#d90f0f', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan -2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.2 + (Math.sqrt(i / 59) * 7.7)), // Rentang 2.2 sampai 9.9
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan -1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.5 + (Math.sqrt(i / 59) * 8.5)), // Rentang 2.5 sampai 11
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan Median',
                            data: Array.from({ length: 60 }, (_, i) => 3 + (Math.sqrt(i / 59) * 9.1)), // Rentang 3 sampai 12.1
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan +1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 3.5 + (Math.sqrt(i / 59) * 10.3)), // Rentang 3.5 sampai 13.8
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan +2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4 + (Math.sqrt(i / 59) * 11.2)), // Rentang 4 sampai 15.2
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Berat Badan +3 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4.5 + (Math.sqrt(i / 59) * 12.5)), // Rentang 4.5 sampai 17
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Berat Badan Bayi (Laki-laki)'
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Berat Badan (kg)'
                            },
                            min: 2,  // Minimum berat badan
                            max: 17  // Maximum berat badan
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Umur (bulan)'
                            },
                            min: 1,  // Umur dimulai dari 1 bulan
                            max: 60  // Sampai 60 bulan
                        }
                    }
                }
            }
        );

        // Data untuk grafik tinggi badan
        const tinggiBadanChart = new Chart(
            document.getElementById('tinggiBadanChart'),
            {
                type: 'line',
                data: {
                    labels: Array.from({length: 60}, (_, i) => i + 1), // Umur bayi sampai 60 bulan
                    datasets: [
                        {
                            label: 'Tinggi Badan -3 SD',
                            data: Array(60).fill(8.5).map((v, i) => v + (i * (3.7 / 59))), // Rentang 8.5 sampai 12.2
                            borderColor: '#d90f0f', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan -2 SD',
                            data: Array(60).fill(9.5).map((v, i) => v + (i * (4.5 / 59))), // Rentang 9.5 sampai 14
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan -1 SD',
                            data: Array(60).fill(10.8).map((v, i) => v + (i * (5.2 / 59))), // Rentang 10.8 sampai 16
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan Median',
                            data: Array(60).fill(12).map((v, i) => v + (i * (6.9 / 59))), // Rentang 12 sampai 18.4
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan +1 SD',
                            data: Array(60).fill(13.5).map((v, i) => v + (i * (7.5 / 59))), // Rentang 13.5 sampai 21
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan +2 SD',
                            data: Array(60).fill(15).map((v, i) => v + (i * (9 / 59))), // Rentang 15 sampai 24
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        },
                        {
                            label: 'Tinggi Badan +3 SD',
                            data: Array(60).fill(16.9).map((v, i) => v + (i * (10.3 / 59))), // Rentang 16.5 sampai 28.9
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false,
                            pointRadius: 0 // Menghilangkan titik data
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Grafik Tinggi Badan Bayi (Laki-laki)'
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Tinggi Badan (cm)'
                            },
                            min: 25,  // Minimum tinggi badan
                            max: 150  // Maximum tinggi badan untuk rentang yang lebih luas
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Umur (bulan)'
                            },
                            min: 1,  // Umur dimulai dari 1 bulan
                            max: 60  // Sampai 60 bulan
                        }
                    }
                }
            }
        );*/

    </script>
</body>
</html>

</x-layout>

{{-- FOOTER --}}
<x-footer-home></x-footer-home>