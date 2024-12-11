/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./**/*.php',
		'./template-parts/**/*.php',
		'./templates/**/*.php',
		'./inc/**/*.php'
	],
	important: true,
	theme: {
		extend: {
			colors: {
				red: {
					600: '#dc2626',
					800: '#991b1b'
				},
				gray: {
					200: '#e5e7eb',
					500: '#6b7280',
					700: '#374151',
					900: '#111827'
				}
			},
			fontFamily: {
				sans: ['Inter', 'system-ui', 'sans-serif']
			}
		}
	}
};
