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
        './public/lib/bootstrap/fonts',
        './public/lib/dashicons/fonts',
        './public/lib/font-awesome/fonts',
    ], './public/fonts')
        .styles([
            './public/lib/bootstrap/dist/css/bootstrap.css',
            './public/lib/dashicons/css/dashicons.css',
            './public/lib/font-awesome/css/font-awesome.css'
        ], './public/css/app.css')
        .styles([
            './public/lib/clndr/demo/css/clndr.css'
        ], './public/css/clndr.css')
        .styles([
            './public/lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'
        ], './public/css/bootstrap.datetimepicker.css')
        .styles([
            './public/lib/selectize/dist/css/selectize.bootstrap3.css'
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
            './node_modules/lodash/lodash.min.js',
            './public/lib/jquery/dist/jquery.min.js',
            './public/lib/moment/min/moment-with-locales.min.js',
            './public/lib/bootstrap/dist/js/bootstrap.min.js',
            './public/lib/clndr/clndr.min.js',
            './public/lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            './public/lib/selectize/dist/js/standalone/selectize.min.js'
        ], './public/js/libraries.js')
        .scripts([
            'backend/main-menu-backend.js',
            'backend/backend.js',
        ], './public/js/backend.js')
        .scripts([
            'frontend/frontend.js',
            'frontend/cottages-index.js',
            'frontend/draftCottage-show.js',
            'frontend/profile-edit.js',
        ], './public/js/frontend.js')
        .scripts([
            'app.js'
        ], './public/js/app.js')
        .version([
            './public/css/app.css',
            './public/css/clndr.css',
            './public/css/bootstrap.datetimepicker.css',
            './public/css/selectize.bootstrap3.css',
            './public/css/frontend.css',
            './public/css/cottages.css',
            './public/css/profile.css',
            './public/css/backend.css',
            './public/js/libraries.js',
            './public/js/backend.js',
            './public/js/frontend.js',
            './public/js/app.js'
        ])
        .browserSync({
            proxy: 'homestead.app'
        });
});
