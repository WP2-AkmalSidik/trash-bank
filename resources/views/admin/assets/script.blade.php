<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif']
                },
                colors: {
                    primary: '#0D723B',
                    secondary: '#F7B731',
                    accent: '#D32F2F',
                    light: '#F0F4F8',
                    dark: '#1A202C',
                }
            }
        }
    }

    // Toggle dark mode
    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.remove('light');
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }

    // Check for saved theme preference or respect OS preference
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.add('light');
    }
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('chartStatistik').getContext('2d');

        const chartStatistik = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Surat Masuk',
                        data: [65, 70, 82, 75, 92, 87, 96, 85, 90, 95, 110, 125],
                        borderColor: '#0D723B',
                        backgroundColor: 'rgba(13, 114, 59, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Surat Disetujui',
                        data: [50, 55, 65, 62, 75, 70, 82, 70, 75, 78, 88, 98],
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Surat Ditolak',
                        data: [15, 15, 17, 13, 17, 17, 14, 15, 15, 17, 22, 27],
                        borderColor: '#D32F2F',
                        backgroundColor: 'rgba(211, 47, 47, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 10,
                            color: document.documentElement.classList.contains('dark') ? '#fff' : '#333'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: document.documentElement.classList.contains('dark') ? '#aaa' : '#666'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            color: document.documentElement.classList.contains('dark') ? '#aaa' : '#666'
                        }
                    }
                }
            }
        });

        // Update chart colors when toggling dark mode
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('-translate-x-full');
            });

            document.getElementById('mobile-sidebar-toggle').addEventListener('click', function () {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    });
</script>