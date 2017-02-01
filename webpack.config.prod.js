var path = require('path');
var webpack = require('webpack');

module.exports = {
    entry: [
        'babel-polyfill',
        './assets/js/base'
    ],
    output: {
        path: path.join(__dirname, 'compiled-scripts'),
        filename: 'bundle.js',
        publicPath: ''
    },
    devtool: "#inline-source-map",
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel',
                //include: path.join(__dirname, 'js'),
                query: {
                    compact: false,
                    presets: ['es2015']
                }
            }
        ]
    }
};


