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

mix.copy("node_modules/@coreui/icons/css/coreui-icons.min.css",'public/css')
.copy("node_modules/flag-icon-css/css/flag-icon.min.css",'public/css')
.copy("node_modules/font-awesome/css/font-awesome.min.css",'public/css')
.copy("node_modules/simple-line-icons/css/simple-line-icons.css",'public/css')
.copy("node_modules/jquery/dist/jquery.min.js",'public/js')
.copy("node_modules/popper.js/dist/umd/popper.min.js",'public/js')
.copy("node_modules/bootstrap/dist/js/bootstrap.min.js",'public/js')
.copy("node_modules/pace-progress/pace.min.js",'public/js')
.copy("node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js",'public/js')
.copy("node_modules/@coreui/coreui/dist/js/coreui.min.js",'public/js')
.copy("node_modules/chart.js/dist/Chart.min.js",'public/js')
.copy("node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js",'public/js')
.copy("node_modules/simple-line-icons/fonts/*",'public/fonts')
.copy("node_modules/font-awesome/fonts/*",'public/fonts')
;
