const mix = require('laravel-mix')
require('./webpack.config')
require('laravel-mix-purgecss')
require('laravel-mix-tailwind')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .tailwind('./tailwind.config.js')
  .purgeCss()

mix.copy('node_modules/font-awesome/fonts', 'public/fonts/vendor/font-awesome')

if (mix.inProduction()) {
  mix.version()
}
