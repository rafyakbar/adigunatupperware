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

    Route::get('pesanan/{status}/{perhalaman}', 'PesananController@tampilDaftar')->name('daftarpesanan');

    Route::get('kategori', 'KategoriController@tampilForm')->name('kategori');

    Route::get('autocomplete/barang', 'BarangController@autocomplete')->name('acbarang');

    Route::get('pengumuman/{perhalaman}', [
        'middleware' => 'owner',
        'uses' => 'PengumumanController@tampilForm',
        'as' => 'pengumuman'
    ]);

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

        Route::post('pengumuman', [
            'middleware' => 'owner',
            'uses' => 'PengumumanController@edit',
            'as' => 'edit.pengumuman'
        ]);

        Route::post('kategori', [
            'uses' => 'KategoriController@ubah',
            'as' => 'edit.kategori'
        ]);

    });

    Route::group(['prefix' => 'hapus'], function () {

        Route::post('barang', [
            'uses' => 'BarangController@hapus',
            'as' => 'hapus.barang'
        ]);

        Route::post('pesanan', [
            'uses' => 'PesananController@hapus',
            'as' => 'hapus.pesanan'
        ]);

        Route::post('pengumuman', [
            'middleware' => 'owner',
            'uses' => 'PengumumanController@hapus',
            'as' => 'hapus.pengumuman'
        ]);

        Route::post('kategori', [
            'uses' => 'KategoriController@hapus',
            'as' => 'hapus.kategori'
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
        ])->middleware('owner');

        Route::post('kategori', [
            'uses' => 'KategoriController@tambah',
            'as' => 'tambah.kategori'
        ]);

    });
});


