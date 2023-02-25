const mix = require('laravel-mix');
const path = require('path');

const domain = 'bedzevi.test'; // <= EDIT THIS
const homedir = require('os').homedir();


mix.browserSync({
    proxy: 'https://' + domain,
    host: domain,
    open: 'external',
    https: {
      key: homedir + '/.config/valet/Certificates/' + domain + '.key',
      cert: homedir + '/.config/valet/Certificates/' + domain + '.crt'
    },
    notify: false, //Enable or disable notifications
})

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');


mix.webpackConfig({
  resolve: {
      alias: {
          '@': path.resolve(__dirname, 'resources/js/components/')
      }
  }
}).version(['public/js/app.js']);