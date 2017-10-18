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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('produk', 'ProdukController');
	Route::get('admin', function(){
		echo "selamat datang admin" ;
	})->middleware('level') ;
	Route::resource('kategori', 'KategoriController');
	Route::get('datakategori', 'KategoriController@listData')->name('dataKategori');	
	Route::get('dataproduk', 'ProdukController@listData')->name('dataProduk');	
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
