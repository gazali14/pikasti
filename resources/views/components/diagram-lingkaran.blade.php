<div class="chart bg-white p-4 rounded-lg shadow">
    <div class="flex justify-between items-center">
        <!-- Tombol untuk memilih tahun sebelumnya -->
        <button id="prevYear" class="text-gray-600" style="font-size: 1.8rem;">&lt;</button>
        
        <!-- Elemen untuk menampilkan bulan dan tahun -->
        <!-- Elemen untuk menampilkan bulan dan tahun -->
        <div class="text-center mb-0.3">
            <span id="monthYear" class="custom-month-year">March 2023</span>
        </div>

        <style>
            /* Mengatur font dan posisi elemen lebih ke bawah */
            .custom-month-year {
                font-size: 1.2rem;  /* Mengatur ukuran font */
                font-weight: 600;    /* Mengatur ketebalan font */
                margin-top: 20px;    /* Memberikan jarak lebih banyak di atas elemen */
                color: #616972; 
            }
        </style>

        <!-- Tombol untuk memilih tahun berikutnya -->
        <button id="nextYear" class="text-gray-600" style="font-size: 1.8rem;">&gt;</button>
    </div>

    <!-- Judul -->
    <head>
        <!-- Link ke Google Fonts untuk Poppins -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <!-- Elemen h3 dengan kelas custom-font -->
        <h3 class="custom-font text-center mt-12">
            Jumlah Pengunjung Bayi Posyandu Pikasti
        </h3>
        
        <style>
            /* Mengatur font, ukuran, dan ketebalan font untuk h3 dengan kelas custom-font */
            .custom-font {
                font-family: 'Poppins', sans-serif; /* Jenis font Poppins */
                font-size: 1.25rem;  /* Ukuran font */
                font-weight: 600;   /* Ketebalan font */
            }
        </style>
    </body>      

    <!-- Canvas untuk Chart -->
    <canvas id="circleChart" class="mt-8"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Inisialisasi bulan dan tahun
    let currentDate = new Date();  // Mendapatkan tanggal saat ini
    let currentMonth = currentDate.getMonth(); // Bulan (0-11)
    let currentYear = currentDate.getFullYear(); // Tahun (contoh: 2023)

    // Update tampilan bulan dan tahun
    function updateMonthYear() {
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const monthYear = document.getElementById("monthYear");
        monthYear.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    }

    // Event listener untuk tombol sebelumnya
    document.getElementById("prevYear").addEventListener("click", function() {
        // Mengurangi tahun dan update bulan
        if (currentMonth === 0) {
            currentMonth = 11; // Januari kembali ke Desember
            currentYear -= 1;  // Tahun berkurang
        } else {
            currentMonth -= 1; // Bulan sebelumnya
        }
        updateMonthYear();
    });

    // Event listener untuk tombol berikutnya
    document.getElementById("nextYear").addEventListener("click", function() {
        // Menambah tahun dan update bulan
        if (currentMonth === 11) {
            currentMonth = 0; // Desember kembali ke Januari
            currentYear += 1;  // Tahun bertambah
        } else {
            currentMonth += 1; // Bulan berikutnya
        }
        updateMonthYear();
    });

    // Memanggil fungsi untuk menampilkan bulan dan tahun saat ini
    updateMonthYear();

    // Fungsi untuk memuat chart (donut chart)
    function loadCircleChart(data) {
        const ctxCircle = document.getElementById('circleChart').getContext('2d');
        const total = data.reduce((a, b) => a + b, 0); // Hitung total nilai data

        new Chart(ctxCircle, {
            type: 'doughnut',
            data: {
                labels: ['Laki-Laki', 'Perempuan'], // Label untuk kategori
                datasets: [{
                    data: data,
                    backgroundColor: ['#4A90E2', '#E26AB3'] // Warna sesuai kategori
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom', // Tetap di bawah grafik donat
                        labels: {
                            usePointStyle: true, // Gunakan simbol bulat
                            padding: 20,
                            generateLabels: function (chart) {
                                const data = chart.data;
                                const percentages = data.datasets[0].data.map(value =>
                                    ((value / total) * 100).toFixed(1) + '%' // Hitung persentase
                                );

                                // Menggabungkan label dan persentase
                                return data.labels.map((label, i) => ({
                                    text: `${label} (${percentages[i]})`, // Label + Persentase
                                    fillStyle: data.datasets[0].backgroundColor[i], // Warna simbol
                                    strokeStyle: '#fff',
                                    lineWidth: 0,
                                    hidden: !chart.getDataVisibility(i),
                                    index: i,
                                    pointStyle: 'circle' // Simbol berbentuk bulat
                                }));
                            },
                            font: {
                                size: 14 // Ukuran font label
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        bottom: 40 // Jarak antara donat dan label
                    }
                }
            },
            plugins: [{
                id: 'customLegendVertical',
                beforeDraw: function (chart) {
                    const legend = chart.legend;
                    const ctx = chart.ctx;

                    // Sesuaikan tata letak vertikal
                    chart.legend.options.labels.boxWidth = 12; // Ukuran kotak simbol
                    chart.legend.options.labels.boxHeight = 12;
                    chart.legend.options.align = 'start'; // Letak label sejajar vertikal
                }
            }]
        });
    }

    // Memanggil fungsi untuk memuat chart dengan data dummy
    document.addEventListener("DOMContentLoaded", function () {
        const dummyData = [20, 80]; // Laki-Laki: 20%, Perempuan: 80%
        loadCircleChart(dummyData);
    });
</script>
