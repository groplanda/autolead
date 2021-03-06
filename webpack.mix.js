const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath('themes/'+ process.env.MIX_THEME + '/assets/');

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': __dirname + '/themes/' + process.env.MIX_THEME + '/assets',
      '@vue': __dirname + '/themes/' + process.env.MIX_THEME + '/assets/js',
      "@svg": __dirname + '/resources/svg',
    },
  },
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.(vue|js)$/,
        exclude: /(node_modules|bower_components)/,
        loader: 'eslint-loader',
        options: {
          fix: false,
          cache: false,
          formatter: require('eslint-friendly-formatter')
        }
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
            'pug': [
              'pug-bem-plain-loader'
            ]
          }
        }
      },
      {
        test: /\.pug$/,
        oneOf: [
           {
              resourceQuery: /^\?vue/,
              use: ['pug-bem-plain-loader']
           },
           {
              use: ['raw-loader', 'pug-bem-plain-loader']
           }
        ]
      }
    ]
  }
});

mix.js('./themes/'+ process.env.MIX_THEME + '/assets/js/index.js', 'dist')
.vue()
.sass('./themes/'+ process.env.MIX_THEME + '/assets/scss/index.scss', 'dist')
.version()
.sourceMaps()
.options({
  postCss: [
    require('postcss-url'),
    require('autoprefixer')({
      overrideBrowserslist: ['last 6 versions'],
          grid: true
    }),
    require('cssnano')({
        preset: ['default', {
            discardComments: {
                removeAll: true,
            },
        }]
    }),
  ]
})

mix.browserSync({
  proxy: process.env.MIX_HOST,
  host: process.env.MIX_HOST,
  notify: false,
  files: [
    "./themes/demo/assets/dist/css/*.css",
    "./themes/demo/assets/dist/js/*.js",
    "./themes/demo/**/*.htm",
  ]
});



// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.when(condition, function (mix) {}) <-- Call function if condition is true.
// mix.override(function (webpackConfig) {}) <-- Will be triggered once the webpack config object has been fully generated by Mix.
// mix.dump(); <-- Dump the generated webpack config object to the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relatimport { mix } from 'laravel-mix';
//    stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
