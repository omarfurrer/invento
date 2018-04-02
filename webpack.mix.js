let mix = require('laravel-mix');

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

mix
        .styles([
            'node_modules/font-awesome/css/font-awesome.min.css',
            'node_modules/bootstrap/dist/css/bootstrap.min.css',
            'node_modules/ionicons/dist/css/ionicons.min.css'
        ], 'public/adminlte/css/all.css')
        .scripts([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/bootstrap/dist/js/bootstrap.min.js'
        ], 'public/adminlte/js/all.js')
        .copyDirectory('node_modules/admin-lte/dist', 'public/adminlte/dist')
        .copyDirectory('node_modules/font-awesome/fonts', 'public/adminlte/fonts');
