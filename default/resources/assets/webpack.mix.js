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

/* murloc87: Заменил
const { mix } = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');*/

// Стандартное начало
const { mix } = require('laravel-mix');

// Плагины сжатия изображений
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const imageminMozjpeg = require('imagemin-mozjpeg');

mix.webpackConfig({
    plugins: [
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 80,
                })
            ]
        })
    ]
});
// Установка Image Min:
// npm install --save-dev imagemin-webpack-plugin imagemin-mozjpeg
//----------------------------------------------------------------------------------------------------------------------
// Чистим папку
var rimraf = require('rimraf');
rimraf('public/frontend', function () {});
//----------------------------------------------------------------------------------------------------------------------
// Картинки, favicon, копирование с сохранением структуры вложенных папок
mix
    .copy('resources/assets/images',
        'public/frontend/img', false)
    .copy('resources/assets/favicons',
        'public', false)
;
//----------------------------------------------------------------------------------------------------------------------
// jQuery
mix
    .copy('resources/assets/vendor/mazhurnyy/plugins/jquery',
        'public/frontend/plugins/jquery', false)
;
//----------------------------------------------------------------------------------------------------------------------
// Общее App v3, объеденяем массив JS файлов в один
mix
    .scripts([
        'resources/assets/vendor/mazhurnyy/plugins/bootswatch/bower_components/bootstrap-sass-official' +
            '/assets/javascripts/bootstrap/transition.js',
        'resources/assets/vendor/mazhurnyy/plugins/bootswatch/bower_components/bootstrap-sass-official' +
            '/assets/javascripts/bootstrap/dropdown.js',
        'resources/assets/vendor/mazhurnyy/plugins/bootswatch/bower_components/bootstrap-sass-official' +
            '/assets/javascripts/bootstrap/collapse.js',
        'resources/assets/vendor/mazhurnyy/partials/empty-links.js',
        'resources/assets/vendor/mazhurnyy/partials/footer.js',
        'resources/assets/vendor/mazhurnyy/partials/search.js',
    ], 'public/frontend/app-v3.js')
// Компилируем файл sass (в нем подключаются файлы темы, стилей)
    .sass('resources/assets/styles/init-v3.scss',
        'public/frontend/app-v3.css')
;
//----------------------------------------------------------------------------------------------------------------------
// Bootstrap v3 Modal
mix
    .scripts([
        'resources/assets/vendor/mazhurnyy/plugins/bootswatch/bower_components/bootstrap-sass-official' +
            '/assets/javascripts/bootstrap/modal.js',
    ], 'public/frontend/plugins/bootstrap-v3/modal.js')
;
//----------------------------------------------------------------------------------------------------------------------
// Плагины

// Phone Inputmask
mix
    .scripts([
        'resources/assets/vendor/mazhurnyy/plugins/inputmask/dist/inputmask/inputmask.js',
        'resources/assets/vendor/mazhurnyy/plugins/inputmask/dist/inputmask/inputmask.phone.extensions.js',
        'resources/assets/vendor/mazhurnyy/plugins/inputmask/dist/inputmask/jquery.inputmask.js',
        'resources/assets/vendor/mazhurnyy/plugins/inputmask/dist/inputmask/phone-codes/phone.js',
        'resources/assets/vendor/mazhurnyy/init/inputmask.js',
    ], 'public/frontend/plugins/inputmask/inputmask.js')
;
// Editor Summernote
mix
    .copy('resources/assets/vendor/mazhurnyy/plugins/summernote/font',
        'public/frontend/plugins/summernote/font', false)
    .styles([
        'resources/assets/vendor/mazhurnyy/plugins/summernote/summernote.css'
    ], 'public/frontend/plugins/summernote/summernote.css')
    .scripts([
        'resources/assets/vendor/mazhurnyy/plugins/bootswatch/bower_components/bootstrap-sass-official' +
        '/assets/javascripts/bootstrap/tooltip.js',
        'resources/assets/vendor/mazhurnyy/plugins/summernote/summernote.js',
        'resources/assets/vendor/mazhurnyy/plugins/summernote/lang/summernote-ru-RU.js',
        'resources/assets/vendor/mazhurnyy/init/summernote.js',
    ], 'public/frontend/plugins/summernote/summernote.js')
;
// Slider JSSOR
mix
    .copy('resources/assets/vendor/mazhurnyy/plugins/jssor/circles.svg',
        'public/frontend/plugins/jssor/circles.svg')
    .scripts([
        'resources/assets/vendor/mazhurnyy/plugins/jssor/jssor.slider.min.js',
        'resources/assets/vendor/mazhurnyy/init/jssor.js',
    ], 'public/frontend/plugins/jssor/jssor.js')
    .styles([
        'resources/assets/vendor/mazhurnyy/plugins/jssor/jssor.css',
        'resources/assets/vendor/mazhurnyy/styles/jssor.css',
    ], 'public/frontend/plugins/jssor/jssor.css')
;
//----------------------------------------------------------------------------------------------------------------------
// Наши фрагменты
mix
    .sass('resources/assets/vendor/mazhurnyy/styles/gallery.scss',
        'public/frontend/styles/gallery.css')
    .scripts([
        'resources/assets/vendor/mazhurnyy/partials/gallery.js',
    ], 'public/frontend/partials/gallery.js')
    .scripts([
        'resources/assets/vendor/mazhurnyy/partials/password.js',
    ], 'public/frontend/partials/password.js')
    .scripts([
        'resources/assets/vendor/mazhurnyy/partials/more-button.js',
    ], 'public/frontend/partials/more-button.js')
    .scripts([
        'resources/assets/vendor/mazhurnyy/partials/more-scroll.js',
    ], 'public/frontend/partials/more-scroll.js')
;
//----------------------------------------------------------------------------------------------------------------------
// Версионирование
mix.version();
