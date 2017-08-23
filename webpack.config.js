const path = require('path');
const webpack = require('webpack');
const fontMagician = require('postcss-font-magician');

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
  },
  plugins: [
    new webpack.LoaderOptionsPlugin({
      options: {
        postcss: [
          fontMagician({
            variants: {
              'Roboto Slab': {
                '400': [],
              },
              'Raleway': {
                '400': [],
              },
            },
            foundries: ['google']
          })
        ]
      }
    })
  ]
};
