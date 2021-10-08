const mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
*/

//Proses Mengcompile file css dan js blanjaloka menjadi 1 file

mix.styles([
    'public/template/blanjaloka/bootstrap/css/bootstrap.min.css',
	'public/template/blanjaloka/css/style.css',
],  'public/assets/blanjaloka/css/blanjaloka.css').version();

mix.scripts([
	'public/template/blanjaloka/bootstrap/js/bootstrap.min.js',
	'public/template/blanjaloka/jquery/jquery.min.js',
	'public/template/blanjaloka/js/interaksiTransaksiProduct.js',
	'public/template/blanjaloka/js/loadImgProduct.js',
],  'public/assets/blanjaloka/js/blanjaloka.js').version();
