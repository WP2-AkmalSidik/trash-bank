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

	// biome-ignore lint/complexity/useArrowFunction: <explanation>
	toggleBtn.addEventListener("click", function () {
		if (sidebar.classList.contains("-translate-x-full")) {
			openSidebar();
		} else {
			closeSidebar();
		}
	});

	// Klik di overlay = tutup sidebar
	// biome-ignore lint/complexity/useArrowFunction: <explanation>
	overlay.addEventListener("click", function () {
		closeSidebar();
	});
});
