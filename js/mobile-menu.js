document.addEventListener("DOMContentLoaded", () => {
	const menuToggle = document.querySelector(".menu-toggle");
	const navigation = document.querySelector("#site-navigation");
	const mobileMenuClasses = ["flex", "flex-col", "absolute", "top-16", "left-0", "right-0", "bg-white", "p-4", "border-t", "border-gray-200", "shadow-lg", "z-50"];

	if (menuToggle && navigation) {
		menuToggle.addEventListener("click", () => {
			const expanded = menuToggle.getAttribute("aria-expanded") === "true";
			menuToggle.setAttribute("aria-expanded", !expanded);

			// Toggle mobile menu visibility with animation
			if (expanded) {
				navigation.classList.add("hidden");
				navigation.classList.remove(...mobileMenuClasses);
			} else {
				navigation.classList.remove("hidden");
				navigation.classList.add(...mobileMenuClasses);
			}
		});

		// Close menu when clicking outside
		document.addEventListener("click", (event) => {
			if (!navigation.contains(event.target) && !menuToggle.contains(event.target)) {
				menuToggle.setAttribute("aria-expanded", "false");
				navigation.classList.add("hidden");
				navigation.classList.remove(...mobileMenuClasses);
			}
		});

		// Handle escape key
		document.addEventListener("keydown", (event) => {
			if (event.key === "Escape" && menuToggle.getAttribute("aria-expanded") === "true") {
				menuToggle.setAttribute("aria-expanded", "false");
				navigation.classList.add("hidden");
				navigation.classList.remove(...mobileMenuClasses);
			}
		});
	}
});
