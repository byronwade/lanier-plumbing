/* global jQuery, wp */
jQuery(function ($) {
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
	$(".upload-image").on("click", function (e) {
		e.preventDefault();
		const button = $(this);
		const field = button.siblings('input[type="hidden"]');
		const preview = button.siblings(".image-preview");
		const removeButton = button.siblings(".remove-image");

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
		mediaFrame.on("select", function () {
			const attachment = mediaFrame.state().get("selection").first().toJSON();
			field.val(attachment.id);
			preview.html('<img src="' + attachment.sizes.medium.url + '" alt="">');
			button.text("Change Image");

			// Show remove button if it doesn't exist
			if (removeButton.length === 0) {
				$('<button type="button" class="button remove-image">Remove Image</button>').insertAfter(button);
			} else {
				removeButton.show();
			}
		});

		// Open the modal
		mediaFrame.open();
	});

	// Remove image functionality
	$(document).on("click", ".remove-image", function (e) {
		e.preventDefault();
		const button = $(this);
		const field = button.siblings('input[type="hidden"]');
		const preview = button.siblings(".image-preview");
		const uploadButton = button.siblings(".upload-image");

		field.val("");
		preview.empty();
		uploadButton.text("Select Image");
		button.hide();
	});
});
