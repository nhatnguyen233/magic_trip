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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// User Page
mix.copy('resources/assets/js/main.js', 'public/js/front')
    .copy('resources/assets/js/moment.min.js', 'public/js/front')
    .copy('resources/assets/js/common_scripts.js', 'public/js/front')
    .copy('resources/assets/js/daterangepicker.js', 'public/js/front')
    .copy('resources/assets/js/input_qty.js', 'public/js/front')
    .copy('resources/assets/js/jquery-3.5.1.min.js', 'public/js/front');

mix.copy('resources/assets/other/validate.js', 'public/js/front');

mix.copy('resources/assets/css/custom.css', 'public/css/front/custom.css')
    .copy('resources/assets/css/style.css', 'public/css/front/style.css')
    .copy('resources/assets/css/vendors.css', 'public/css/front/vendors.css');

mix.copy('resources/assets/img/', 'public/img/');
mix.copy('resources/assets/icon_fonts/icon_fonts', 'public/css/front/icon_fonts');

// Admin Page
mix.copy('resources/assets/admin/css/', 'public/admin/css/')
    .copy('resources/assets/admin/vendor/bootstrap/css', 'public/admin/css/')
    .copy('resources/assets/admin/vendor/', 'public/admin/vendor/')
    .copy('resources/assets/admin/vendor/bootstrap/js', 'public/admin/js/')
    .copy('resources/assets/admin/js/', 'public/admin/js/')
    .copy('resources/assets/admin/img/', 'public/admin/img/')
    .copy('resources/js/attraction', 'public/js/attraction');

// Cropper Image
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css')
    .copy('node_modules/cropperjs/dist/cropper.js', 'public/js')
    .copy('node_modules/jquery-cropper/dist/jquery-cropper.min.js', 'public/js');

// User Page
mix.copy('resources/assets/js/main.js', 'public/js/front')
    .copy('resources/assets/js/moment.min.js', 'public/js/front');
