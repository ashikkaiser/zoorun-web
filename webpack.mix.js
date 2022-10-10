const mix = require('laravel-mix');

const domain = 'courier.khata.cloud';

mix.browserSync({
    proxy: 'https://' + domain,
    host: domain,
    open: 'external',
    https: {
        key: '/etc/letsencrypt/live/courier.khata.cloud/privkey.pem',
        cert: '/etc/letsencrypt/live/courier.khata.cloud/fullchain.pem',
    },
});
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

mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css');
