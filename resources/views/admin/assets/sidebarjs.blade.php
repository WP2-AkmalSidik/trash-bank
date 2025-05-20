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

    .light .nav-link.active {
        background-color: rgba(13, 114, 59, 0.1);
        border-left: 3px solid #0D723B;
        font-weight: 600;
    }

    .light .nav-link.active svg {
        color: #0D723B !important;
    }

    .dark .nav-link.active {
        background-color: rgba(247, 183, 49, 0.15);
        border-left: 3px solid #F7B731;
        font-weight: 600;
    }

    .dark .nav-link.active svg {
        color: #F7B731 !important;
    }

    .light .nav-link-child.active {
        background-color: rgba(13, 114, 59, 0.05);
        font-weight: 500;
    }

    .dark .nav-link-child.active {
        background-color: rgba(247, 183, 49, 0.1);
        font-weight: 500;
        color: #F7B731;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("mobile-sidebar-toggle");
        const overlay = document.getElementById("sidebar-overlay");

        function openSidebar() {
            sidebar.classList.remove("-translate-x-full");
            overlay.classList.remove("hidden");
        }

        function closeSidebar() {
            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
        }

        if (toggleBtn) {
            toggleBtn.addEventListener("click", function () {
                if (sidebar.classList.contains("-translate-x-full")) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
        }

        if (overlay) {
            overlay.addEventListener("click", function () {
                closeSidebar();
            });
        }

        function toggleDropdown(dropdownId, toggleButton) {
            const dropdown = document.getElementById(dropdownId);
            const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';

            toggleButton.setAttribute('aria-expanded', !isExpanded);

            dropdown.classList.toggle('active');
            
            const dropdownIcon = toggleButton.querySelector('.dropdown-icon');
            if (dropdownIcon) {
                dropdownIcon.classList.toggle('rotate-180');
            }
        }

        function isActiveRoute(routePattern) {
            const currentPath = window.location.pathname;
            
            if (currentPath === routePattern) {
                return true;
            }
            
            if (routePattern.endsWith('*')) {
                const basePattern = routePattern.slice(0, -1);
                return currentPath.startsWith(basePattern);
            }
            
            return false;
        }

        function setActiveMenu() {
            const currentPath = window.location.pathname;
            
            document.querySelectorAll('[data-collapse-toggle]').forEach(toggle => {
                const dropdownId = toggle.getAttribute('data-collapse-toggle');
                const dropdown = document.getElementById(dropdownId);
                
                const shouldBeOpen = Array.from(dropdown.querySelectorAll('a')).some(link => {
                    const href = link.getAttribute('href');
                    if (!href) return false;
                    
                    let path = href;
                    try {
                        const url = new URL(href, window.location.origin);
                        path = url.pathname;
                    } catch (e) {
                        // href was already a relative path
                    }
                    return currentPath === path || 
                           currentPath.startsWith(path.replace('/index', '/')) ||
                           (path.includes('admin/pengumuman') && currentPath.includes('admin/pengumuman')) ||
                           (path.includes('admin/lokasi') && currentPath.includes('admin/lokasi'));
                });
                
                if (shouldBeOpen) {
                    toggle.setAttribute('aria-expanded', 'true');
                    dropdown.classList.add('active');
                    
                    const dropdownIcon = toggle.querySelector('.dropdown-icon');
                    if (dropdownIcon) {
                        dropdownIcon.classList.add('rotate-180');
                    }
                    
                    toggle.classList.add('active');
                }
            });

            document.querySelectorAll('.nav-link, .nav-link-child').forEach(link => {
                if (link.hasAttribute('data-collapse-toggle')) return;
                
                const href = link.getAttribute('href');
                if (!href) return;
                
                let path = href;
                try {
                    const url = new URL(href, window.location.origin);
                    path = url.pathname;
                } catch (e) {
                }
                
                if (currentPath === path || currentPath.startsWith(path.replace('/index', '/'))) {
                    link.classList.add('active');
                    
                    if ((href.includes('pengumuman.index') && currentPath.includes('admin/pengumuman')) ||
                        (href.includes('lokasi.index') && currentPath.includes('admin/lokasi'))) {
                        link.classList.add('active');
                    }
                }
            });
        }

        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('hidden');
        });

        const dropdownToggles = document.querySelectorAll('[data-collapse-toggle]');
        
        dropdownToggles.forEach(toggle => {
            const targetId = toggle.getAttribute('data-collapse-toggle');
            
            const dropdown = document.getElementById(targetId);
            const isActive = dropdown.classList.contains('active');
            toggle.setAttribute('aria-expanded', isActive ? 'true' : 'false');
            
            toggle.addEventListener('click', function(event) {
                event.preventDefault();
                toggleDropdown(targetId, toggle);
            });
        });

        setActiveMenu();

        document.documentElement.style.setProperty('--color-primary', '#0D723B');
        document.documentElement.style.setProperty('--color-primary-rgb', '13, 114, 59');
        document.documentElement.style.setProperty('--color-secondary', '#F7B731');
        document.documentElement.style.setProperty('--color-secondary-rgb', '247, 183, 49');
    });

    function handleDarkModeChange() {
        const isDark = document.documentElement.classList.contains('dark');
        
        if (window.chartStatistik) {
            window.chartStatistik.options.plugins.legend.labels.color = isDark ? '#fff' : '#333';

            window.chartStatistik.options.scales.x.ticks.color = isDark ? '#aaa' : '#666';
            window.chartStatistik.options.scales.y.ticks.color = isDark ? '#aaa' : '#666';
            window.chartStatistik.options.scales.y.grid.color = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

            window.chartStatistik.update();
        }
    }

    if (typeof window.toggleDarkMode === 'function') {
        const originalToggleDarkMode = window.toggleDarkMode;
        window.toggleDarkMode = function() {
            originalToggleDarkMode();
            handleDarkModeChange();
        };
    }

    document.addEventListener('click', function(event) {
        const link = event.target.closest('a');
        if (link && link.classList.contains('nav-link-child')) {
        }
    });
</script>