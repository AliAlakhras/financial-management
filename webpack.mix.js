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

mix.styles([
    'public/template/css/bootstrap.min.css',
    'public/template/css/bootstrap.rtl.css',
    'public/template/css/plugins/metisMenu/metisMenu.min.css',
    'public/template/css/plugins/timeline.css',
    'public/template/css/sb-admin-2.css',
    'public/template/css/plugins/morris.css'
],'public/css/style.css').version();

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


mix.scripts([
    'public/template/js/jquery-1.11.0.js',
    'public/template/js/bootstrap.min.js',
    'public/template/js/metisMenu/metisMenu.min.js',
    'public/template/js/raphael/raphael.min.js',
    'public/template/js/morris/morris.min.js',
    'public/template/js/sb-admin-2.js',
    'public/template/js/jquery/jquery.dataTables.min.js',
    'public/template/js/bootstrap/dataTables.bootstrap.min.js'
],'public/js/script.js').version();