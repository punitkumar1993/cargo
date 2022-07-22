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
    .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/frappe-charts/dist/frappe-charts.min.iife.js', 'public/js/frappe-charts.min.iife.js');
mix.copy('node_modules/@lgaitan/pace-progress/dist/themes/', 'public/vendor/pace-progress/themes/');
mix.copy('node_modules/summernote-image-attributes-editor/summernote-image-attributes.js', 'public/vendor/summernote-image-attributes-editor/summernote-image-attributes.js');
mix.copy('node_modules/summernote-image-attributes-editor/lang/en-us.js', 'public/vendor/summernote-image-attributes-editor/lang/en-us.js');
