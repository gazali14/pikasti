<div class="bg-white p-2 shadow rounded-md">
    <div class="relative w-full sm:w-1/4">
        <label for="year" class="block text-sm font-medium text-gray-700">Tahun:</label>
        <div class="mt-2">
            <select name="year" id="year"
                class="w-full py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm z-10">
            </select>
        </div>
    </div>
</div>

<div class="chart bg-white p-4 rounded-lg shadow mt-5">
    <h3 class="font-semibold text-lg text-center">Jumlah Kader yang Hadir</h3>
    <div class="relative w-full" style="height: 300px;">
        <canvas id="kaderBarChart" class="w-full h-full"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('kaderBarChart').getContext('2d');
        let kaderBarChart;

        // Fungsi untuk membuat atau memperbarui grafik
        function updateChart(labels, data) {
            if (kaderBarChart) {
                kaderBarChart.destroy(); 
            }
            kaderBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Kader',
                        data: data,
                        backgroundColor: '#E26AB3',
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Membuat grafik menyesuaikan ukuran container
                    plugins: {
                        legend: {
                            display: false 
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
        }

        // Fungsi untuk mengambil data jumlah kader dari backend
        function fetchData(year) {
            axios.get(`/admin/count-by-month?year=${year}`)
                .then(response => {
                    const result = response.data.data;
                    const labels = Object.keys(result);
                    const data = Object.values(result); 
                    updateChart(labels, data); 
                })
                .catch(error => {
                    console.error('Gagal memuat data:', error);
                });
        }

        // Inisialisasi daftar tahun dan ambil data awal
        const currentYear = new Date().getFullYear();
        const yearSelect = document.getElementById('year');
        for (let i = currentYear; i >= 2000; i--) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }
        yearSelect.value = currentYear;

        // Ambil data untuk tahun saat ini
        fetchData(currentYear);

        // Event listener untuk mengubah data berdasarkan tahun
        yearSelect.addEventListener('change', function() {
            fetchData(this.value);
        });
    });
</script>
