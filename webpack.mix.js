let mix = require('laravel-mix')

mix.setPublicPath('dist')
    .js('resources/js/banner.js', 'js/banner.js')

mix.setPublicPath('dist')
    .js('resources/js/carousel.js', 'js/carousel.js')
    //.sass('resources/sass/field.scss', 'css')
