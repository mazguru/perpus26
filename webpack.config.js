const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: 'production', // Mode produksi untuk optimasi
    entry: './src/js/alpine.js', // File utama
    output: {
        filename: 'app.min.js', // File JavaScript yang sudah di-minify
        path: path.resolve(__dirname, 'public/js'),
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()], // Minify JS
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/main.min.css', // Output CSS ke assets/css
        }),
    ],
};
