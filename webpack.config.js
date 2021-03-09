const currentTask = process.env.npm_lifecycle_event;
const path = require("path");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const fse = require("fs-extra");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

//cssnano plugin für minfied
//fs-extra für mehrere html files und copied folder
//babel/core babel/preset-env babel-loader für leute mit älteren brwoser nur js

const postCSSPlugins = [
  require("postcss-import"),
  require("postcss-mixins"),
  require("postcss-simple-vars"),
  require("postcss-nested"),
  require("postcss-hexrgba"),
  require("postcss-color-function"),
  require("autoprefixer"),
];

class RunAfterCompile {
  apply(compiler) {
    compiler.hooks.done.tap("Copy something", function () {
      fse.copySync("./website/assets/images", "./dist/assets/images"),
        fse.copySync("./website/assets/fonts", "./dist/assets/fonts");
    });
  }
}

let cssConfig = {
  test: /\.css$/i,
  use: [
    "css-loader",
    {
      loader: "postcss-loader",
      options: { postcssOptions: { plugins: postCSSPlugins } },
    },
  ],
};

let pages = fse.readdirSync('./website').filter(function(file) {
  return file.endsWith('.html')
}).map(function(page) {
  return new HtmlWebpackPlugin({
    filename: page,
    template: `./website/${page}`
  });
});

let config = {
  entry: "./website/assets/scripts/app.js",
  plugins: pages,
    // new HtmlWebpackPlugin({
    //   filename: "index.html",
    //   template: "./website/index.html",
    // }),
  
  module: {
    rules: [
      cssConfig,
      {
        test: /\.(jpg|webp)$/,
        use: [
          {
            loader: "url-loader",
            options: {
              limit: 10000,
              name: "[name].[ext]",
              outputPath: 'assets/images'
            },
          },
        ],
      },
      {
        test: /\.(woff|woff2|eot|ttf|svg)$/,
        use: [
          {
            loader: "url-loader",
            options: {
              limit: 10000,
              name: "[name].[ext]",
              outputPath: 'assets/fonts'
            },
          },
        ],
      },
    ],
  },
};

if (currentTask == "dev") {
  cssConfig.use.unshift("style-loader");
  config.output = {
    filename: "bundle.js",
    path: path.resolve(__dirname, "website"),
  };
  config.devServer = {
    before: function (app, server) {
      server._watch("./website/**/*.html");
    },
    contentBase: path.join(__dirname, "website"),
    port: 1234,
    hot: true,
    host: "0.0.0.0",
  };
  config.mode = "development";
}

if (currentTask == "build") {
  cssConfig.use.unshift(MiniCssExtractPlugin.loader);
  config.output = {
    filename: "[name].[chunkhash].js",
    chunkFilename: "[name].[chunkhash].js",
    path: path.resolve(__dirname, "dist"),
    publicPath: "",
  };
  config.mode = "production";
  config.optimization = {
    splitChunks: { chunks: "all" },
    minimize: true,
    minimizer: [`...`, new CssMinimizerPlugin({ parallel: true })],
  };
  config.plugins.push(
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: "styles.[chunkhash].css",
      linkType: "text/css",
    }),
    new RunAfterCompile()
  );
}

module.exports = config;
