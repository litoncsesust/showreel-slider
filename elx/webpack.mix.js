// webpack.mix.js

let mix = require('laravel-mix');

mix.sass('assets/styles/style.scss', 'css')
   .setPublicPath('public');