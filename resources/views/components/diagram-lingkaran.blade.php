@props(['dataChart'])

<div class="chart bg-white p-4 rounded-lg shadow overflow-auto">
    <h3 class="custom-font text-center mt-12 font-bold">
        Jumlah Pengunjung Bayi Posyandu Pikasti
    </h3>
    <div class="relative h-64 w-full sm:h-72 lg:h-96 mt-8">
        <canvas id="circleChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dataFromServer = @json($dataChart);

        if (!dataFromServer || Object.keys(dataFromServer).length === 0) {
            console.error("DataChart kosong atau tidak valid:", dataFromServer);
            return;
        }

        const chartData = Object.values(dataFromServer);

        // Memuat chart
        const ctxCircle = document.getElementById('circleChart').getContext('2d');
        const total = chartData.reduce((a, b) => a + b, 0);

        new Chart(ctxCircle, {
            type: 'doughnut',
            data: {
                labels: Object.keys(dataFromServer),
                datasets: [{
                    data: chartData,
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
            }
        });
    });
</script>
