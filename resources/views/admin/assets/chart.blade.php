<script>
    document.addEventListener('DOMContentLoaded', function() {
        const weeklyData = @json($weeklyData);
        const monthlyData = @json($monthlyData);
        const yearlyData = @json($yearlyData);
        let currentPeriod = 'weekly';
        let chartSampahMasuk;

        const updateWasteChart = (period) => {
            if (chartSampahMasuk) {
                chartSampahMasuk.destroy();
            }

            let chartData;
            switch (period) {
                case 'monthly':
                    chartData = monthlyData;
                    break;
                case 'yearly':
                    chartData = yearlyData;
                    break;
                default:
                    chartData = weeklyData;
            }

            document.querySelectorAll('.period-btn').forEach(btn => {
                if (btn.dataset.period === period) {
                    btn.classList.add('bg-emerald-100', 'dark:bg-emerald-900', 'text-emerald-700',
                        'dark:text-emerald-200');
                    btn.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700',
                        'dark:text-gray-300');
                } else {
                    btn.classList.remove('bg-emerald-100', 'dark:bg-emerald-900',
                        'text-emerald-700', 'dark:text-emerald-200');
                    btn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700',
                        'dark:text-gray-300');
                }
            });

            const ctxSampahMasuk = document.getElementById('chartSampahMasuk').getContext('2d');
            chartSampahMasuk = new Chart(ctxSampahMasuk, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: chartData.datasets.map(dataset => ({
                        label: dataset.label,
                        data: dataset.data,
                        borderColor: dataset.borderColor,
                        backgroundColor: dataset.backgroundColor,
                        tension: 0.3,
                        fill: true
                    }))
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 6
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        };

        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                updateWasteChart(this.dataset.period);
                currentPeriod = this.dataset.period;
            });
        });

        updateWasteChart('weekly');

        const ctxJenisSampah = document.getElementById('chartJenisSampah').getContext('2d');
        const wasteStatistics = @json($wasteStatistics);

        const isDarkMode = document.documentElement.classList.contains('dark');

        const chartJenisSampah = new Chart(ctxJenisSampah, {
            type: 'doughnut',
            data: {
                labels: wasteStatistics.map(item => item.name),
                datasets: [{
                    data: wasteStatistics.map(item => item.weight),
                    backgroundColor: [
                        '#10b981',
                        '#3b82f6',
                        '#f59e0b',
                        '#8b5cf6',
                        '#ef4444',
                        '#06b6d4',
                        '#ec4899',
                        '#14b8a6',
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 6,
                            color: isDarkMode ? '#ffffff' :
                                '#000000'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const value = context.raw;
                                label += value.toFixed(2) + ' kg';
                                return label;
                            }
                        },
                        bodyColor: isDarkMode ? '#ffffff' : '#ffffff',
                        titleColor: isDarkMode ? '#ffffff' : '#ffffff'
                    }
                },
                cutout: '70%'
            }
        });

        const darkModeObserver = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    const isNowDarkMode = document.documentElement.classList.contains('dark');
                    chartJenisSampah.options.plugins.legend.labels.color = isNowDarkMode ?
                        '#ffffff' : '#000000';
                    chartJenisSampah.options.plugins.tooltip.bodyColor = isNowDarkMode ?
                        '#ffffff' : '#000000';
                    chartJenisSampah.options.plugins.tooltip.titleColor = isNowDarkMode ?
                        '#ffffff' : '#000000';
                    chartJenisSampah.update();
                }
            });
        });

        darkModeObserver.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });

        const ctxPertumbuhanSaldo = document.getElementById('chartPertumbuhanSaldo').getContext('2d');
        const balanceData = @json($balanceGrowthData);

        const formatSaldo = (value) => {
            const maxValue = Math.max(...balanceData.deposits, ...balanceData.withdrawals);

            if (maxValue >= 1000000) {
                return (value / 1000000).toFixed(1) + ' jt';
            } else if (maxValue >= 1000) {
                return (value / 1000).toFixed(1) + ' rb';
            } else {
                return value.toLocaleString('id-ID');
            }
        };

        const chartPertumbuhanSaldo = new Chart(ctxPertumbuhanSaldo, {
            type: 'bar',
            data: {
                labels: balanceData.labels,
                datasets: [{
                    label: 'Total Saldo',
                    data: balanceData.deposits,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                }, {
                    label: 'Penarikan',
                    data: balanceData.withdrawals,
                    backgroundColor: 'rgba(245, 158, 11, 0.7)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 6
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const value = context.raw;
                                label += 'Rp ' + value.toLocaleString('id-ID');
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return formatSaldo(value);
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
