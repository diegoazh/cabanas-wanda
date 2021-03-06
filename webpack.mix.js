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

mix.copy([
        './public/lib/dashicons/fonts',
    ], './public/fonts')
    .copy([
        './public/lib/font-awesome/web-fonts-with-css',
    ], './public/font-awesome')
    .styles([
        './node_modules/bootstrap/dist/css/bootstrap.css',
        './public/lib/animate.css/animate.css',
        './public/lib/dashicons/css/dashicons.css',
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
    .less('resources/assets/less/frontend/frontend.less', './public/css/frontend.css')
    .less('resources/assets/less/frontend/cottages.less', './public/css/cottages.css')
    .less('resources/assets/less/frontend/profile.less', './public/css/profile.css')
    .less('resources/assets/less/backend/backend.less', './public/css/backend.css')
    .combine([
        './node_modules/lodash/lodash.min.js',
        './public/lib/moment/min/moment-with-locales.min.js',
        './public/lib/jquery/dist/jquery.min.js',
        './node_modules/popper.js/dist/umd/popper.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './public/lib/clndr/clndr.min.js',
        './public/lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        './public/lib/selectize/dist/js/standalone/selectize.min.js'
    ], './public/js/libraries.js')
    .js([
        'resources/assets/js/backend/main-menu-backend.js',
        'resources/assets/js/backend/backend.js',
    ], './public/js/backend.js')
    .js([
        'resources/assets/js/frontend/frontend.js',
        'resources/assets/js/frontend/cottages-index.js',
        'resources/assets/js/frontend/cottage-show.js',
        'resources/assets/js/frontend/profile-edit.js',
    ], './public/js/frontend.js')
    .js('resources/assets/js/vue-rentals-app/vue-rentals.js', 'public/js')
    .js('resources/assets/js/vue-rentals-edit-app/vue-rentals-edit.js', 'public/js')
    .js('resources/assets/js/vue-admin-food-app/vue-admin-food.js', 'public/js')
    .js('resources/assets/js/vue-orders-app/vue-orders.js', 'public/js')
    .js('resources/assets/js/vue-orders-edit-app/vue-orders-edit.js', 'public/js')
    .js('resources/assets/js/vue-liquidation-app/vue-liquidation.js', 'public/js')
    .js('resources/assets/js/vue-reports-app/vue-reports.js', 'public/js')
    .js('resources/assets/js/vue-dash-app/vue-dash.js', 'public/js')
    .js('resources/assets/js/vue-profile-rentals-app/vue-profile-rentals.js', 'public/js')
    .js('resources/assets/js/vue-promotions-store-app/vue-promotions-store.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
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
        './public/js/vue-rentals.js'
    ])
    .browserSync({
        proxy: 'homestead.app'
    });
