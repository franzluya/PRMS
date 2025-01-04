document.addEventListener("DOMContentLoaded", function () {
	const sidebar = document.getElementById("sidebar");
	const sidebarToggle = document.getElementById("sidebarToggle");

	// Toggle sidebar
	sidebarToggle.addEventListener("click", function () {
		sidebar.classList.toggle("hidden");
	});

	// Close sidebar on mobile when clicking outside
	document.addEventListener("click", function (event) {
		if (window.innerWidth <= 768) {
			if (
				!sidebar.contains(event.target) &&
				!sidebarToggle.contains(event.target)
			) {
				sidebar.classList.add("hidden");
			}
		}
	});

	// Handle window resize
	window.addEventListener("resize", function () {
		if (window.innerWidth > 768) {
			sidebar.classList.remove("hidden");
		} else {
			sidebar.classList.add("hidden");
		}
	});
});
