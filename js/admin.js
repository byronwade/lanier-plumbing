/* global jQuery, wp */
jQuery(($) => {
	"use strict";

	// Tab functionality
	$(".nav-tab").on("click", function (e) {
		e.preventDefault();
		const target = $(this).attr("href");

		// Update tabs
		$(".nav-tab").removeClass("nav-tab-active");
		$(this).addClass("nav-tab-active");

		// Show corresponding section
		$(".tab-content").hide();
		$(target).show();
	});

	// Image upload functionality
	let mediaFrame;
	$(document).on("click", ".upload-image", function (e) {
		e.preventDefault();
		const button = $(this);
		const imageField = button.closest(".space-y-4");
		const imageInput = imageField.find('input[type="hidden"]');
		const imagePreview = imageField.find(".image-preview");

		// Create the media frame
		mediaFrame = wp.media({
			title: "Select or Upload Image",
			library: {
				type: "image",
			},
			button: {
				text: "Use this image",
			},
			multiple: false,
		});

		// When an image is selected, run a callback
		mediaFrame.on("select", () => {
			const attachment = mediaFrame.state().get("selection").first().toJSON();
			imageInput.val(attachment.id);

			// Update preview with medium size if available, otherwise use full size
			const previewUrl = attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
			imagePreview.html('<img src="' + previewUrl + '" alt="" class="max-w-xs rounded-lg shadow-sm">');

			button.text("Change Image");
			imageField.find(".remove-image").show();
		});

		// Open the modal
		mediaFrame.open();
	});

	// Handle image removal
	$(document).on("click", ".remove-image", function (e) {
		e.preventDefault();
		const button = $(this);
		const imageField = button.closest(".space-y-4");
		const imageInput = imageField.find('input[type="hidden"]');
		const imagePreview = imageField.find(".image-preview");

		imageInput.val("");
		imagePreview.empty();
		imageField.find(".upload-image").text("Select Image");
		button.hide();
	});
});