var path = require('path');
var webpack = require("webpack");

module.exports = {
	entry: './js/src/index.js',
	output: {
		filename: 'main.js',
		path: path.resolve(__dirname, 'js')
	},
	plugins: [
		new webpack.ProvidePlugin({$: "jquery"})
	],
	mode: 'production',
	watch: true
};