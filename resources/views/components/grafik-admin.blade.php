<div class="chart bg-white p-4 rounded-lg shadow">
    <h3 class="font-semibold text-lg text-center">Jumlah Kader yang Hadir</h3>
    <canvas id="kaderBarChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data dummy untuk grafik jumlah kader
        const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const jumlahKader = [15, 10, 11, 7, 15, 13, 15, 8, 12, 9, 15, 10]; // Jumlah kader tiap bulan

        // Membuat grafik batang
        const ctx = document.getElementById('kaderBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: [{
                    label: 'Jumlah Kader',
                    data: jumlahKader,
                    backgroundColor: '#E26AB3',
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false // Tidak menampilkan legenda
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Kader'
                        }
                    }
                }
            }
        });
    });
</script>
