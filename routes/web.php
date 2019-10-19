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

Route::resource('/karyawan', 'KaryawanController');

Route::post('editKeranjang', 'KeranjangController@editKeranjang')->name('editKeranjang');

Route::resource('/orders', 'OrdersController');

Route::resource('/pembayaran', 'PembayaranController');

Route::resource('/produksi', 'ProduksiController');

Route::get('/detailProduksi/{id}/{idBrg}', 'ProduksiController@showDetailProduksi')->name('detailProduksi');

Route::resource('/barang', 'BarangController');

Route::get('/ajaxTipe', 'BarangController@ajaxTipe')->name('ajaxTipe');

Route::get('/insert/tipe/{id}', 'BarangController@tipe')->name('tipe');

Route::get('/gambar/{id}', 'BarangController@gambar')->name('gambar');

Route::post('/tambah/gambar', 'BarangController@storeGambar')->name('storeGambar');

Route::post('/edit/gambar', 'BarangController@editGambar')->name('editGambar');

Route::get('/update/tipe/{id}', 'BarangController@updateTipeView')->name('updateTipeView');

Route::post('/tambah/barang', 'BarangController@storeBarang')->name('storeBarang');

Route::post('editBarang', 'BarangController@editBarang')->name('editBarang');

Route::post('/tambah/tipe', 'BarangController@storeTipe')->name('storeTipe');

Route::post('updateTipeProses', 'BarangController@updateTipeProses')->name('updateTipeProses');

Route::get('/ajaxBahan', 'BahanController@ajaxBahan')->name('ajaxBahan');

Route::get('/insert/bahan/{id}', 'BahanController@insertBahan')->name('insertBahanView');

Route::post('/tambah/bahan', 'BahanController@storeBahan')->name('storeBahan');

Route::get('/bahan/update/{id}', 'BahanController@updateBahansView')->name('updateBahansView');

Route::post('updateBahanProses', 'BahanController@updateBahanProses')->name('updateBahanProses');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
