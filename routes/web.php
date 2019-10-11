<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('catalogue');
});
Route::resource('/catalogue', 'ProductController');

Route::resource('/cart', 'KeranjangController');

Route::post('editKeranjang', 'KeranjangController@editKeranjang')->name('editKeranjang');

Route::resource('/orders', 'OrdersController');

Route::resource('/pembayaran', 'PembayaranController');

Route::resource('/produksi', 'ProduksiController');

Route::get('/detailProduksi/{id}/{idBrg}', 'ProduksiController@showDetailProduksi')->name('detailProduksi');

Route::resource('/barang', 'BarangController');

Route::get('/ajaxTipe', 'BarangController@ajaxTipe')->name('ajaxTipe');

Route::get('/tipe/{id}', 'BarangController@tipe')->name('tipe');

Route::get('/gambar/{id}', 'BarangController@gambar')->name('gambar');

Route::get('/update/tipe/{id}', 'BarangController@updateTipeView')->name('updateTipeView');

Route::post('/tambah/barang', 'BarangController@storeBarang')->name('storeBarang');

Route::post('editBarang', 'BarangController@editBarang')->name('editBarang');

Route::post('/tambah/tipe', 'BarangController@storeTipe')->name('storeTipe');

Route::post('updateTipeProses', 'BarangController@updateTipeProses')->name('updateTipeProses');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
