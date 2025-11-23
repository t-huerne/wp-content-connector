/**
 * Webpack configuration
 * 
 * Extends @wordpress/scripts default config to support multiple entry points:
 * - src/js/index.js → build/index.js (editor)
 * - src/js/view.js → build/view.js (frontend)
 * - src/style.scss → build/style.css (editor/frontend styles)
 */

const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: {
		index: './src/js/index.js',
		view: './src/js/view.js',
		style: './src/style.scss',
	},
};
