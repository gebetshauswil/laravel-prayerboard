const mix = require('laravel-mix');
require('mix-tailwindcss');
require('laravel-mix-purgecss');

mix
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind()
    .purgeCss();

mix.browserSync({
    proxy: 'https://prayerboard.test',
    notify: false,
    open: false,
});

mix.disableNotifications();

