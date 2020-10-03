const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");

module.exports = {
    devtool: "source-map",
    entry : './src/index.js',
    output : {
        path : path.join(__dirname, '/dist'),
        filename : 'index_bundle.js'
    },
    module : {
        rules : [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use : {
                    loader : 'babel-loader'
                }
            },
            {
                test: /\.scss$/,
                use: [
                    "style-loader",
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                          postcssOptions: {
                            plugins: [
                              [
                                require('autoprefixer')
                              ],
                            ],
                          },
                        },
                    },
                    "sass-loader",    
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            }
        ]
    },
    plugins : [
        new HtmlWebpackPlugin({
            template : './src/index.html'
        })
    ]
}