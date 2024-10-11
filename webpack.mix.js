const mix = require('laravel-mix');

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
    .js('resources/js/alert.js', 'public/js')
    .sass('resources/sass/alert.scss', 'public/css')
    .sass('resources/sass/backend.scss', 'public/css/backend')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/frontend/overrides.scss', 'public/css/frontend').options({
        processCssUrls: false
    })
    .sass('resources/sass/frontend/login.scss', 'public/css/frontend').options({
        processCssUrls: false
    });




