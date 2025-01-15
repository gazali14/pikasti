<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik KMS Posyandu</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @php
        $selectedBayi = $bayiList->firstWhere('nik', $selectedBayiNik);
    @endphp
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Grafik KMS Posyandu</h1>

        <!-- Grafik Berat Badan -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-8">
            <div class="chart-container relative h-96">
                <canvas id="beratBadanChart"></canvas>
            </div>
        </div>

        <!-- Grafik Tinggi Badan -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="chart-container relative h-96">
                <canvas id="tinggiBadanChart"></canvas>
            </div>
        </div>
    </div>

    @if($selectedBayi)
        <script>
            const bayiData = @json($kmsData); 
            const selectedBayi = @json($selectedBayi); 
            const bayiPointColor = 'rgba(0, 0, 255, 1)'; 
            const referensiKMS = {
                Perempuan: {
                    beratBadan: {
                        '-3SD': Array.from({ length: 60 }, (_, i) => 2 + (Math.sqrt(i / 59) * 6.5)),
                        '-2SD': Array.from({ length: 60 }, (_, i) => 2.2 + (Math.sqrt(i / 59) * 7.5)),
                        '-1SD': Array.from({ length: 60 }, (_, i) => 2.5 + (Math.sqrt(i / 59) * 9)),
                        'Median': Array.from({ length: 60 }, (_, i) => 3 + (Math.sqrt(i / 59) * 11.5)),
                        '+1SD': Array.from({ length: 60 }, (_, i) => 3.5 + (Math.sqrt(i / 59) * 15)),
                        '+2SD': Array.from({ length: 60 }, (_, i) => 4 + (Math.sqrt(i / 59) * 18.5)),
                        '+3SD': Array.from({ length: 60 }, (_, i) => 4.5 + (Math.sqrt(i / 59) * 23))
                    },
                    tinggiBadan: {
                        '-3SD': Array.from({ length: 60 }, (_, i) => 45 + (Math.sqrt(i / 59) * 49)),
                        '-2SD': Array.from({ length: 60 }, (_, i) => 47 + (Math.sqrt(i / 59) * 53)),
                        '-1SD': Array.from({ length: 60 }, (_, i) => 49 + (Math.sqrt(i / 59) * 56)),
                        'Median': Array.from({ length: 60 }, (_, i) => 51 + (Math.sqrt(i / 59) * 59)),
                        '+1SD': Array.from({ length: 60 }, (_, i) => 53 + (Math.sqrt(i / 59) * 62)),
                        '+2SD': Array.from({ length: 60 }, (_, i) => 54 + (Math.sqrt(i / 59) * 66)),
                        '+3SD': Array.from({ length: 60 }, (_, i) => 56 + (Math.sqrt(i / 59) * 70))
                    }
                },
                LakiLaki: {
                    beratBadan: {
                        '-3SD': Array.from({ length: 60 }, (_, i) => 2 + (Math.sqrt(i / 59) * 7.5)),
                        '-2SD': Array.from({ length: 60 }, (_, i) => 2.5 + (Math.sqrt(i / 59) * 8.5)),
                        '-1SD': Array.from({ length: 60 }, (_, i) => 3 + (Math.sqrt(i / 59) * 10)),
                        'Median': Array.from({ length: 60 }, (_, i) => 3.5 + (Math.sqrt(i / 59) * 12.5)),
                        '+1SD': Array.from({ length: 60 }, (_, i) => 4 + (Math.sqrt(i / 59) * 16)),
                        '+2SD': Array.from({ length: 60 }, (_, i) => 4.5 + (Math.sqrt(i / 59) * 19.5)),
                        '+3SD': Array.from({ length: 60 }, (_, i) => 5 + (Math.sqrt(i / 59) * 24))
                    },
                    tinggiBadan: {
                        '-3SD': Array.from({ length: 60 }, (_, i) => 47 + (Math.sqrt(i / 59) * 50)),
                        '-2SD': Array.from({ length: 60 }, (_, i) => 49 + (Math.sqrt(i / 59) * 54)),
                        '-1SD': Array.from({ length: 60 }, (_, i) => 51 + (Math.sqrt(i / 59) * 57)),
                        'Median': Array.from({ length: 60 }, (_, i) => 53 + (Math.sqrt(i / 59) * 60)),
                        '+1SD': Array.from({ length: 60 }, (_, i) => 54 + (Math.sqrt(i / 59) * 63)),
                        '+2SD': Array.from({ length: 60 }, (_, i) => 56 + (Math.sqrt(i / 59) *67)),
                        '+3SD': Array.from({ length: 60 }, (_, i) => 58 + (Math.sqrt(i / 59) * 71))
                    }
                }
            };

            const referensi = selectedBayi.jenis_kelamin === 'Perempuan' ? referensiKMS.Perempuan : referensiKMS.LakiLaki;
            const chartConfig = (canvasId, title, datasets, yLabel, yMin, yMax) => ({
                type: 'line',
                data: {
                    labels: Array.from({ length: 60 }, (_, i) => i + 1),
                    datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: { display: true, text: title }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Umur (bulan)' }, min: 1, max: 60 },
                        y: { title: { display: true, text: yLabel }, min: yMin, max: yMax }
                    }
                }
            });

            // Data Berat Badan
            const beratBadanChart = new Chart(document.getElementById('beratBadanChart'), {
                type: 'line',
                data: {
                    labels: Array.from({ length: 60 }, (_, i) => i + 1),
                    datasets: [
                        ...Object.entries(referensi.beratBadan).map(([label, data]) => ({
                            label: `Berat Badan ${label}`,
                            data,
                            borderColor: label === '-3SD' ? '#d90f0f' :
                                        label === '-2SD' ? 'rgba(144, 238, 144, 1)' :
                                        label === '-1SD' ? 'rgba(0, 128, 0, 1)' :
                                        label === 'Median' ? '#00FF00' :
                                        label === '+1SD' ? '#008000' :
                                        label === '+2SD' ? '#90EE90' : '#FFC107',
                            fill: false,
                            pointRadius: 0
                        })),
                        {
                            label: 'Data Berat Badan Bayi',
                            data: bayiData.map(kms => ({
                                x: Math.floor(kms.umur_bulan), 
                                y: kms.berat_badan 
                            })),
                            borderColor: bayiPointColor,
                            backgroundColor: bayiPointColor,
                            pointRadius: 5,
                            showLine: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: `Grafik Berat Badan Bayi (${selectedBayi.jenis_kelamin})`
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Berat Badan (kg)'
                            },
                            min: 0,
                            max: 30
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Umur (bulan)'
                            },
                            min: 1,
                            max: 60,
                            type: 'linear'
                        }
                    }
                }
            });

            const tinggiBadanChart = new Chart(document.getElementById('tinggiBadanChart'), {
                type: 'line',
                data: {
                    labels: Array.from({ length: 60 }, (_, i) => i + 1),
                    datasets: [
                        ...Object.entries(referensi.tinggiBadan).map(([label, data]) => ({
                            label: `Tinggi Badan ${label}`,
                            data,
                            borderColor: label === '-3SD' ? '#d90f0f' :
                                        label === '-2SD' ? 'rgba(144, 238, 144, 1)' :
                                        label === '-1SD' ? 'rgba(0, 128, 0, 1)' :
                                        label === 'Median' ? '#00FF00' :
                                        label === '+1SD' ? '#008000' :
                                        label === '+2SD' ? '#90EE90' : '#FFC107',
                            fill: false,
                            pointRadius: 0
                        })),
                        {
                            label: 'Data Tinggi Badan Bayi',
                            data: bayiData.map(kms => ({
                                x: Math.floor(kms.umur_bulan),
                                y: kms.tinggi_badan 
                            })),
                            borderColor: bayiPointColor,
                            backgroundColor: bayiPointColor,
                            pointRadius: 5,
                            showLine: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: `Grafik Tinggi Badan Bayi (${selectedBayi.jenis_kelamin})`
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Tinggi Badan (cm)'
                            },
                            min: 20,
                            max: 130
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Umur (bulan)'
                            },
                            min: 1,
                            max: 60,
                            type: 'linear' 
                        }
                    }
                }
            });

            // Render Charts
            new Chart(document.getElementById('beratBadanChart'), chartConfig('beratBadanChart', `Grafik Berat Badan Bayi (${selectedBayi.jenis_kelamin})`, beratBadanDatasets, 'Berat Badan (kg)', 2, 30));
            new Chart(document.getElementById('tinggiBadanChart'), chartConfig('tinggiBadanChart', `Grafik Tinggi Badan Bayi (${selectedBayi.jenis_kelamin})`, tinggiBadanDatasets, 'Tinggi Badan (cm)', 50, 150));
        </script>
    @else
        <p class="text-center text-red-500">Bayi tidak ditemukan.</p>
    @endif
</body>
</html>
