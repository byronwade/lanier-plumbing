/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./*.php", "./inc/**/*.php", "./template-parts/**/*.php", "./js/**/*.js"],
	theme: {
		extend: {},
	},
	plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
	corePlugins: {
		preflight: true, // Enable Tailwind's base styles
	},
};
