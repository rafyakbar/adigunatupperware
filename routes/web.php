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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('tes', function (){
    return view('test.table');
})->name('tes');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('profil', 'UserController@tampilUbahProfil')->name('profil');

    Route::get('barang/{kategori}/{perhalaman}', 'BarangController@tampilDaftarBarang')->name('barang');

    Route::get('pesanan', 'PesananController@tampilForm')->name('pesanan');

    Route::get('pesanan/detail/{id}', 'PesananController@tampilDetail')->name('detailpesanan');

    Route::get('daftar/pesanan/{status}/{perhalaman}', 'PesananController@tampilDaftar')->name('daftarpesanan');

    Route::get('autocomplete/barang', 'BarangController@autocomplete')->name('acbarang');

    Route::get('pengumuman', 'PengumumanController@tampilTambahForm')->name('pengumuman');

    Route::group(['prefix' => 'edit'], function () {

        Route::post('password', [
            'uses' => 'UserController@ubahPassword',
            'as' => 'edit.password'
        ]);

        Route::post('profil', [
            'uses' => 'UserController@ubahProfil',
            'as' => 'edit.profil'
        ]);

        Route::post('barang', [
            'uses' => 'BarangController@ubahBarang',
            'as' => 'edit.barang'
        ]);

    });

    Route::group(['prefix' => 'hapus'], function () {

        Route::post('barang', [
            'uses' => 'BarangController@hapus',
            'as' => 'hapus.barang'
        ]);

    });

    Route::group(['prefix' => 'tambah'], function () {

        Route::post('barang', [
            'uses' => 'BarangController@tambah',
            'as' => 'tambah.barang'
        ]);

        Route::post('pesanan', [
            'uses' => 'PesananController@tambah',
            'as' => 'tambah.pesanan'
        ]);

        Route::post('pengumuman', [
            'uses'=>'PengumumanController@tambah',
            'as'=>'tambah.pengumuman'
        ]);

    });
});


