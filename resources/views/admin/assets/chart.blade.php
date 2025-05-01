<script>
    // Data untuk chart sampah masuk
    const ctxSampahMasuk = document.getElementById('chartSampahMasuk').getContext('2d');
    const chartSampahMasuk = new Chart(ctxSampahMasuk, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Plastik (kg)',
                data: [65, 78, 90, 85, 95, 110, 125, 130, 140, 155, 165, 180],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.3,
                fill: true
            }, {
                label: 'Kertas (kg)',
                data: [45, 55, 60, 70, 85, 90, 100, 95, 105, 115, 120, 125],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                fill: true
            }, {
                label: 'Logam (kg)',
                data: [15, 20, 25, 18, 22, 30, 35, 32, 38, 42, 40, 45],
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.3,
                fill: true
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

    // Data untuk chart jenis sampah
    const ctxJenisSampah = document.getElementById('chartJenisSampah').getContext('2d');
    const chartJenisSampah = new Chart(ctxJenisSampah, {
        type: 'doughnut',
        data: {
            labels: ['Plastik', 'Kertas', 'Logam', 'Kaca', 'Elektronik'],
            datasets: [{
                data: [42, 23, 15, 12, 8],
                backgroundColor: [
                    '#10b981', // Emerald
                    '#3b82f6', // Blue
                    '#f59e0b', // Amber
                    '#8b5cf6', // Purple
                    '#ef4444'  // Red
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
                        boxWidth: 6
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Data untuk chart pertumbuhan saldo nasabah
    const ctxPertumbuhanSaldo = document.getElementById('chartPertumbuhanSaldo').getContext('2d');
    const chartPertumbuhanSaldo = new Chart(ctxPertumbuhanSaldo, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Total Saldo (Juta Rupiah)',
                data: [12.5, 15.8, 18.2, 22.4, 25.6, 30.2],
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
            }, {
                label: 'Penarikan (Juta Rupiah)',
                data: [5.2, 6.5, 7.8, 8.4, 9.1, 10.5],
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
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        callback: function (value) {
                            return value + ' jt';
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
</script>
