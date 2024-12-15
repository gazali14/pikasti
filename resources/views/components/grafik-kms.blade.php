<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik KMS Posyandu</title>
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
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
                        },
                        {
                            label: 'Berat Badan -2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.2 + (Math.sqrt(i / 59) * 6.8)), // Rentang 2.2 sampai 9
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Berat Badan -1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.5 + (Math.sqrt(i / 59) * 7.6)), // Rentang 2.5 sampai 10.1
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Berat Badan Median',
                            data: Array.from({ length: 60 }, (_, i) => 3 + (Math.sqrt(i / 59) * 8.5)), // Rentang 3 sampai 11.5
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Berat Badan +1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 3.5 + (Math.sqrt(i / 59) * 9.5)), // Rentang 3.5 sampai 13
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Berat Badan +2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4 + (Math.sqrt(i / 59) * 11)), // Rentang 4 sampai 15
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Berat Badan +3 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4.5 + (Math.sqrt(i / 59) * 12.4)), // Rentang 4.5 sampai 16.9
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
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
                            data: Array(60).fill(8).map((v, i) => v + (i * (4 / 59))), // Rentang 8 sampai 12
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan -2 SD',
                            data: Array(60).fill(9).map((v, i) => v + (i * (4.9 / 59))), // Rentang 9 sampai 13.9
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan -1 SD',
                            data: Array(60).fill(10).map((v, i) => v + (i * (5.9 / 59))), // Rentang 10 sampai 15.9
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan Median',
                            data: Array(60).fill(11.5).map((v, i) => v + (i * (6.9 / 59))), // Rentang 11.5 sampai 18.4
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan +1 SD',
                            data: Array(60).fill(13).map((v, i) => v + (i * (8.5 / 59))), // Rentang 13 sampai 21.5
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan +2 SD',
                            data: Array(60).fill(14.5).map((v, i) => v + (i * (10 / 59))), // Rentang 14.5 sampai 25
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan +3 SD',
                            data: Array(60).fill(16.5).map((v, i) => v + (i * (12.4 / 59))), // Rentang 16.5 sampai 28.9
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
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
                            min: 8,  // Minimum tinggi badan
                            max: 30  // Maximum tinggi badan untuk rentang yang lebih luas
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
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
                        },
                        {
                            label: 'Berat Badan -2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.2 + (Math.sqrt(i / 59) * 7.7)), // Rentang 2.2 sampai 9.9
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Berat Badan -1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 2.5 + (Math.sqrt(i / 59) * 8.5)), // Rentang 2.5 sampai 11
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Berat Badan Median',
                            data: Array.from({ length: 60 }, (_, i) => 3 + (Math.sqrt(i / 59) * 9.1)), // Rentang 3 sampai 12.1
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Berat Badan +1 SD',
                            data: Array.from({ length: 60 }, (_, i) => 3.5 + (Math.sqrt(i / 59) * 10.3)), // Rentang 3.5 sampai 13.8
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Berat Badan +2 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4 + (Math.sqrt(i / 59) * 11.2)), // Rentang 4 sampai 15.2
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Berat Badan +3 SD',
                            data: Array.from({ length: 60 }, (_, i) => 4.5 + (Math.sqrt(i / 59) * 12.5)), // Rentang 4.5 sampai 17
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
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
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan -2 SD',
                            data: Array(60).fill(9.5).map((v, i) => v + (i * (4.5 / 59))), // Rentang 9.5 sampai 14
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan -1 SD',
                            data: Array(60).fill(10.8).map((v, i) => v + (i * (5.2 / 59))), // Rentang 10.8 sampai 16
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan Median',
                            data: Array(60).fill(12).map((v, i) => v + (i * (6.9 / 59))), // Rentang 12 sampai 18.4
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan +1 SD',
                            data: Array(60).fill(13.5).map((v, i) => v + (i * (7.5 / 59))), // Rentang 13.5 sampai 21
                            borderColor: 'rgba(0, 128, 0, 1)', // Hijau Tua
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan +2 SD',
                            data: Array(60).fill(15).map((v, i) => v + (i * (9 / 59))), // Rentang 15 sampai 24
                            borderColor: 'rgba(144, 238, 144, 1)', // Hijau Muda
                            fill: false
                        },
                        {
                            label: 'Tinggi Badan +3 SD',
                            data: Array(60).fill(16.9).map((v, i) => v + (i * (10.3 / 59))), // Rentang 16.5 sampai 28.9
                            borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                            fill: false
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
                            min: 8,  // Minimum tinggi badan
                            max: 30  // Maximum tinggi badan untuk rentang yang lebih luas
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

    <div style="display: flex; justify-content: flex-end; margin-right: 30px;">
        <button type="submit"
            class="px-4 py-2 bg-teal-500 text-white rounded shadow hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
            Simpan
        </button>
    </div>
</body>
</html>