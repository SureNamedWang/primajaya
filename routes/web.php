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

Route::post('/laporan/pemasukan', 'PembayaranController@showLaporanPemasukan')->name('laporanPemasukan');

Route::get('/log/pembayaran', 'PembayaranController@showLogPembayaran')->name('logPembayaran');

Route::resource('/produksi', 'ProduksiController');

Route::get('/produksi/ubahStatus/{id}', 'ProduksiController@ubahStatusProduksi')->name('ubahStatusProduksi');

Route::post('/laporan/gaji', 'ProduksiController@laporanGaji')->name('laporanGaji');

Route::post('/notify/{id}', 'ProduksiController@notifyOwner')->name('notifyOwner');

Route::get('/detailProduksi/{id}/{idBrg}', 'ProduksiController@showDetailProduksi')->name('detailProduksi');

Route::resource('/barang', 'BarangController');

Route::post('insertBarangProses', 'BarangController@storeBarang')->name('storeBarang');

Route::post('editBarang', 'BarangController@editBarang')->name('editBarang');

Route::get('/gambar/{id}', 'BarangController@gambar')->name('gambar');

Route::post('/gambar/tambah', 'BarangController@storeGambar')->name('storeGambar');

Route::post('/gambar/edit', 'BarangController@editGambar')->name('editGambar');

Route::get('/tipe/update/{id}', 'BarangController@updateTipeView')->name('updateTipeView');

Route::get('/ajaxTipe', 'BarangController@ajaxTipe')->name('ajaxTipe');

Route::get('/tipe/tambah/{id}', 'BarangController@storeTipeView')->name('tipe');

Route::post('/tipe/tambah', 'BarangController@storeTipe')->name('storeTipe');

Route::post('updateTipeProses', 'BarangController@updateTipeProses')->name('updateTipeProses');

Route::get('/ajaxBahan', 'BahanController@ajaxBahan')->name('ajaxBahan');

Route::get('/bahan/tambah/{id}', 'BahanController@storeBahanView')->name('storeBahanView');

Route::post('insertBahanProses', 'BahanController@storeBahan')->name('storeBahan');

Route::get('/bahan/update/{id}', 'BahanController@updateBahansView')->name('updateBahanView');

Route::post('updateBahanProses', 'BahanController@updateBahanProses')->name('updateBahanProses');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
