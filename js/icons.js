// Initialize icons when the DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
	// Function to initialize icons
	const initIcons = () => {
		if (typeof lucide !== "undefined" && typeof lucide.createIcons === "function") {
			lucide.createIcons();
			console.log("Lucide icons initialized");
		} else {
			console.log("Waiting for Lucide to load...");
			setTimeout(initIcons, 100);
		}
	};

	// Start initialization
	initIcons();
});

// Helper function to create icon HTML
window.getLucideIcon = (iconName, classes = "") => {
	return `<i data-lucide="${iconName}" class="${classes}"></i>`;
};
