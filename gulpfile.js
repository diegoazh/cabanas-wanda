const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.copy([
        './bower_components/bootstrap/fonts',
        './bower_components/dashicons/fonts',
        './bower_components/font-awesome/fonts',
    ], './public/fonts')
        .copy('./bower_components/editor.md', './public/lib/editor.md')
        .styles([
            './bower_components/bootstrap/dist/css/bootstrap.css',
            './bower_components/dashicons/css/dashicons.css',
            './bower_components/font-awesome/css/font-awesome.css'
        ], './public/css/app.css')
        .styles([
            './bower_components/clndr/demo/css/clndr.css'
        ], './public/css/clndr.css')
        .styles([
            './bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'
        ], './public/css/bootstrap.datetimepicker.css')
        .styles([
            './bower_components/selectize/dist/css/selectize.bootstrap3.css'
        ], './public/css/selectize.bootstrap3.css')
        .less([
            'frontend/frontend.less',
        ], './public/css/frontend.css')
        .less([
            'frontend/cottages.less',
        ], './public/css/cottages.css')
        .less([
            'frontend/profile.less',
        ], './public/css/profile.css')
        .less([
            'backend/backend.less',
        ], './public/css/backend.css')
        .combine([
            './bower_components/jquery/dist/jquery.min.js',
            './bower_components/moment/min/moment-with-locales.min.js',
            './bower_components/bootstrap/dist/js/bootstrap.min.js',
            './bower_components/clndr/clndr.min.js',
            './bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            './bower_components/selectize/dist/js/standalone/selectize.min.js',
        ], './public/js/app.js')
        .scripts([
            'backend/main-menu-backend.js',
            'backend/backend.js',
        ], './public/js/backend.js')
        .scripts([
            'frontend/frontend.js',
            'frontend/cottages-index.js',
            'frontend/cottage-show.js',
            'frontend/profile-edit.js',
        ], './public/js/frontend.js')
        .version([
            './public/css/app.css',
            './public/css/clndr.css',
            './public/css/bootstrap.datetimepicker.css',
            './public/css/selectize.bootstrap3.css',
            './public/css/frontend.css',
            './public/css/cottages.css',
            './public/css/profile.css',
            './public/css/backend.css',
            './public/js/app.js',
            './public/js/backend.js',
            './public/js/frontend.js',
        ])
        .browserSync({
            proxy: 'homestead.app'
        });
});
