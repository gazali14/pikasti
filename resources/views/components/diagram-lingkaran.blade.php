<div class="chart bg-white p-4 rounded-lg shadow overflow-auto">
    <div class="flex justify-between items-center">
        <!-- Tombol untuk memilih tahun sebelumnya -->
        <button id="prevYear" class="text-gray-600" style="font-size: 1.8rem;">&lt;</button>
        
        <!-- Elemen untuk menampilkan bulan dan tahun -->
        <div class="text-center mb-0.3">
            <span id="monthYear" class="custom-month-year">March 2023</span>
        </div>

        <style>
            .custom-month-year {
                font-size: 1.2rem;  
                font-weight: 600;    
                margin-top: 20px;    
                color: #616972; 
            }
        </style>

        <!-- Tombol untuk memilih tahun berikutnya -->
        <button id="nextYear" class="text-gray-600" style="font-size: 1.8rem;">&gt;</button>
    </div>

    <!-- Judul -->
    <h3 class="custom-font text-center mt-12">
        Jumlah Pengunjung Bayi Posyandu Pikasti
    </h3>
    
    <style>
        .custom-font {
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;  
            font-weight: 600;
        }
    </style>

    <!-- Canvas untuk Donut Chart -->
    <div class="relative h-64 w-full sm:h-72 lg:h-96 mt-8">
        <canvas id="circleChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let currentDate = new Date();  
    let currentMonth = currentDate.getMonth(); 
    let currentYear = currentDate.getFullYear(); 

    // Update tampilan bulan dan tahun
    function updateMonthYear() {
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const monthYear = document.getElementById("monthYear");
        monthYear.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    }

    // Event listener untuk tombol sebelumnya
    document.getElementById("prevYear").addEventListener("click", function() {
        if (currentMonth === 0) {
            currentMonth = 11; 
            currentYear -= 1;  
        } else {
            currentMonth -= 1; 
        }
        updateMonthYear();
    });

    // Event listener untuk tombol berikutnya
    document.getElementById("nextYear").addEventListener("click", function() {
        if (currentMonth === 11) {
            currentMonth = 0; 
            currentYear += 1;  
        } else {
            currentMonth += 1; 
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
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    data: data,
                    backgroundColor: ['#4A90E2', '#E26AB3']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            generateLabels: function (chart) {
                                const data = chart.data;
                                const percentages = data.datasets[0].data.map(value =>
                                    ((value / total) * 100).toFixed(1) + '%'
                                );
                                return data.labels.map((label, i) => ({
                                    text: `${label} (${percentages[i]})`,
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    strokeStyle: '#fff',
                                    lineWidth: 0,
                                    hidden: !chart.getDataVisibility(i),
                                    index: i,
                                    pointStyle: 'circle'
                                }));
                            },
                            font: {
                                size: 14
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
                        bottom: 40
                    }
                }
            },
            plugins: [{
                id: 'customLegendVertical',
                beforeDraw: function (chart) {
                    const legend = chart.legend;
                    const ctx = chart.ctx;

                    chart.legend.options.labels.boxWidth = 12; 
                    chart.legend.options.labels.boxHeight = 12;
                    chart.legend.options.align = 'start';
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
