const path = require('path');
const webpack = require('webpack');

module.exports = {
  entry: {
    app: './js/app.js',
  },
  output: {
    path: path.resolve(__dirname, './public/js'),
    filename: '[name].js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ["env", {
                targets: {
                  browsers: ["last 2 versions"]
                }
              }]
            ]
          }
        }
      }
    ]
  }
};
