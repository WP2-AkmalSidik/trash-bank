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
<!-- Style for smooth dropdown animation and active menu -->
<style>
    .dropdown-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, opacity 0.3s ease-out, padding 0.3s ease-out;
        opacity: 0;
        padding-top: 0;
        padding-bottom: 0;
    }

    .dropdown-menu.active {
        max-height: 200px;
        /* Adjust based on content size */
        opacity: 1;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .dropdown-icon {
        transition: transform 0.3s ease;
    }

    [aria-expanded="true"] .dropdown-icon {
        transform: rotate(180deg);
    }

    /* Active menu styling - Light mode */
    .light .nav-link.active {
        background-color: rgba(13, 114, 59, 0.1);
        border-left: 3px solid #0D723B;
        font-weight: 600;
    }

    .light .nav-link.active svg {
        color: #0D723B !important;
    }

    /* Active menu styling - Dark mode */
    .dark .nav-link.active {
        background-color: rgba(247, 183, 49, 0.15);
        border-left: 3px solid #F7B731;
        font-weight: 600;
    }

    .dark .nav-link.active svg {
        color: #F7B731 !important;
    }

    /* For dropdown child items - Light mode */
    .light .nav-link-child.active {
        background-color: rgba(13, 114, 59, 0.05);
        font-weight: 500;
    }

    /* For dropdown child items - Dark mode */
    .dark .nav-link-child.active {
        background-color: rgba(247, 183, 49, 0.1);
        font-weight: 500;
        color: #F7B731;
    }
</style>

<!-- Add JavaScript for dropdown functionality and active menu -->
<script>
    // Function to toggle dropdown visibility with animation
    function toggleDropdown(dropdownId, toggleButton) {
        const dropdown = document.getElementById(dropdownId);
        const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';

        // Toggle aria-expanded attribute
        toggleButton.setAttribute('aria-expanded', !isExpanded);

        // Toggle active class for animation
        dropdown.classList.toggle('active');
    }

    // Function to set active menu based on current URL
    function setActiveMenu() {
        // Get current path
        const currentPath = window.location.pathname;

        // Remove active class from all menu items
        document.querySelectorAll('.nav-link, .nav-link-child').forEach(item => {
            item.classList.remove('active');
        });

        // Find matching link and add active class
        const menuLinks = document.querySelectorAll('.nav-link, .nav-link-child');
        let activeFound = false;

        menuLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPath) {
                link.classList.add('active');
                activeFound = true;

                // If it's a dropdown child, expand parent dropdown
                if (link.classList.contains('nav-link-child')) {
                    const dropdownId = link.closest('.dropdown-menu').id;
                    const toggleButton = document.querySelector(`[data-collapse-toggle="${dropdownId}"]`);

                    if (toggleButton) {
                        toggleButton.setAttribute('aria-expanded', 'true');
                        document.getElementById(dropdownId).classList.add('active');
                    }
                }
            }
        });

        // If no exact match found, try to match by section
        if (!activeFound) {
            menuLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href !== '/' && currentPath.startsWith(href)) {
                    link.classList.add('active');

                    // If it's a dropdown child, expand parent dropdown
                    if (link.classList.contains('nav-link-child')) {
                        const dropdownId = link.closest('.dropdown-menu').id;
                        const toggleButton = document.querySelector(`[data-collapse-toggle="${dropdownId}"]`);

                        if (toggleButton) {
                            toggleButton.setAttribute('aria-expanded', 'true');
                            document.getElementById(dropdownId).classList.add('active');
                        }
                    }
                }
            });
        }
    }

    // Setup event listeners for all dropdown toggles
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggles = document.querySelectorAll('[data-collapse-toggle]');

        // Initialize all dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('hidden'); // Remove hidden class used for no-JS fallback
        });

        dropdownToggles.forEach(toggle => {
            const targetId = toggle.getAttribute('data-collapse-toggle');

            // Set initial aria-expanded state
            toggle.setAttribute('aria-expanded', 'false');

            toggle.addEventListener('click', function (event) {
                event.preventDefault();
                toggleDropdown(targetId, toggle);
            });
        });

        // Set active menu based on current URL
        setActiveMenu();

        // Add CSS variables for primary and secondary colors
        document.documentElement.style.setProperty('--color-primary', '#0D723B');
        document.documentElement.style.setProperty('--color-primary-rgb', '13, 114, 59');
        document.documentElement.style.setProperty('--color-secondary', '#F7B731');
        document.documentElement.style.setProperty('--color-secondary-rgb', '247, 183, 49');
    });

    // Update chart and menu colors when toggling dark mode
    function handleDarkModeChange() {
        // Re-run active menu styling based on current theme
        setActiveMenu();

        // Update chart colors if chart exists
        if (window.chartStatistik) {
            const isDark = document.documentElement.classList.contains('dark');

            // Update legend colors
            window.chartStatistik.options.plugins.legend.labels.color = isDark ? '#fff' : '#333';

            // Update axis colors
            window.chartStatistik.options.scales.x.ticks.color = isDark ? '#aaa' : '#666';
            window.chartStatistik.options.scales.y.ticks.color = isDark ? '#aaa' : '#666';
            window.chartStatistik.options.scales.y.grid.color = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

            window.chartStatistik.update();
        }
    }

    // Modify the toggleDarkMode function to call our handler
    const originalToggleDarkMode = window.toggleDarkMode;
    window.toggleDarkMode = function () {
        originalToggleDarkMode();
        handleDarkModeChange();
    };

    // Also call once on page load
    document.addEventListener('DOMContentLoaded', handleDarkModeChange);
</script>
