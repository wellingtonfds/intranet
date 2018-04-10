const { mix } = require('laravel-mix');

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

mix.js(
    [
        'resources/assets/js/app.js',
        'resources/assets/js/angular/app.module.js',
        'resources/assets/js/angular/pattern.controller.js',
        'node_modules/jquery/dist/jquery.min.js',
    ],  'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'node_modules/sweetalert2/dist/sweetalert2.min.css',
    ], 'public/css/all.css')
    .js(['node_modules/sweetalert2/dist/sweetalert2.js'],'public/js/all.js')
    .scripts([
        'node_modules/medium-editor/dist/js/medium-editor.min.js',
        'node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js',
        'node_modules/blueimp-file-upload/js/jquery.iframe-transport.js',
        'node_modules/blueimp-file-upload/js/jquery.fileupload.js',
        'node_modules/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.min.js',
        'node_modules/medium-editor-tables/dist/js/medium-editor-tables.js'
    ],'public/js/editor.js')
    .copyDirectory('node_modules/handlebars/', 'public/js/handlebars')
    .copyDirectory('node_modules/jquery-sortable/', 'public/js/jquery-sortable')
    .copyDirectory('node_modules/medium-editor-insert-plugin/', 'public/js/medium-editor-insert-plugin')
    .styles([
        'node_modules/medium-editor/dist/css/medium-editor.min.css',
        'node_modules/medium-editor/dist/css/themes/default.css',
        'node_modules/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.min.css',
        'node_modules/medium-editor-tables/dist/css/medium-editor-tables.css'

    ],'public/css/editor.css');
//mix.js('resources/assets/js/angular/*.js', 'public/js/angular.js');

