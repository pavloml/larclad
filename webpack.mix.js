const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .js('resources/js/fonts.js', 'public/js')
    .js('resources/js/editor.js', 'public/js')
    .js('resources/js/charts.js', 'public/js')
    .js('resources/js/lightbox.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/admin.scss', 'public/css')
    .sass('resources/scss/bootstrap.scss', 'public/css')
    .sass('resources/scss/lightbox.scss', 'public/css')
    .version()
    .sourceMaps();
