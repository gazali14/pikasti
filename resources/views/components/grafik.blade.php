<!-- Grafik Rata-Rata Tinggi Badan Bayi -->
<div class="chart bg-white p-4 rounded-lg shadow mb-6">
    <h3 class="font-semibold text-lg text-center">Rata-Rata Tinggi Badan Bayi Menurut Umur (Bulan)</h3>
    <div class="relative h-64 w-full sm:h-72 lg:h-96"> <!-- Responsif di sini -->
        <canvas id="heightBarChart"></canvas>
    </div>
</div>

<!-- Grafik Rata-Rata Berat Badan Bayi -->
<div class="chart bg-white p-4 rounded-lg shadow mt-6">
    <h3 class="font-semibold text-lg text-center">Rata-Rata Berat Badan Bayi Menurut Umur (Bulan)</h3>
    <div class="relative h-64 w-full sm:h-72 lg:h-96"> <!-- Responsif di sini -->
        <canvas id="weightBarChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function loadBarChart(ctxId, labels, maleData, femaleData, title) {
        const ctxBar = document.getElementById(ctxId).getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Laki-Laki',
                        data: maleData,
                        backgroundColor: '#4A90E2'
                    },
                    {
                        label: 'Perempuan',
                        data: femaleData,
                        backgroundColor: '#E26AB3'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: title
                        }
                    }
                }
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const ageGroups = @json($ageGroups); // Ambil data kelompok umur dari controller
        const heightMaleData = @json($heightMaleAverage);
        const heightFemaleData = @json($heightFemaleAverage);
        const weightMaleData = @json($weightMaleAverage);
        const weightFemaleData = @json($weightFemaleAverage);

        // Load height chart
        loadBarChart('heightBarChart', ageGroups, heightMaleData, heightFemaleData, 'Tinggi (cm)');

        // Load weight chart
        loadBarChart('weightBarChart', ageGroups, weightMaleData, weightFemaleData, 'Berat (kg)');
    });
</script>
