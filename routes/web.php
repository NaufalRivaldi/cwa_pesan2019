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

// home
Route::get('/', 'HomeController@index');
Route::get('/detail/{id}', 'HomeController@detail');
Route::get('/scoreboard', 'ScoreboardController@scoreboard');
Route::get('/scoreboarddetail', 'ScoreboardController@scoreboarddetail');
Route::get('/login', 'HomeController@login')->name('login');

// login & logout
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

// admin
Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function(){
    Route::group(['prefix' => '/pesan'], function(){
        // inbox
        Route::get('/inbox', 'PesanController@inbox');
        Route::get('/inbox/detail/{pesan_id}', 'PesanController@detail');
        Route::get('/inbox/hapus/{pesan_id}', 'PesanController@hapus');

        // post pesan
        Route::get('/form', 'PesanController@form');
        Route::post('/store', 'PesanController@store');
        Route::get('/balas/{pesan_Id}', 'PesanController@balas');
        Route::get('/forward/{pesan_Id}', 'PesanController@forward');
    });

    // pengumuman
    Route::group(['prefix' => '/pengumuman'], function(){
        Route::get('/', 'PengumumanController@index');
        Route::get('/form', 'PengumumanController@form');
        Route::get('/detail/{id}', 'PengumumanController@detail');
        Route::get('/edit/{id}', 'PengumumanController@edit');
        Route::get('/active/{id}', 'PengumumanController@active');
        Route::get('/nonactive/{id}', 'PengumumanController@nonactive');
        Route::get('/delete/{id}', 'PengumumanController@delete');
        Route::get('/delattc/{id}', 'PengumumanController@delattc');
        Route::post('/store', 'PengumumanController@store');
        Route::put('/update', 'PengumumanController@update');
    });

    // scoreboard
    Route::get('/scoreboard', 'ScoreboardController@scoreboard');
    Route::get('/scoreboarddetail', 'ScoreboardController@scoreboarddetail');

    // penjualan PU
    Route::group(['prefix' => '/penjualanpu', 'middleware' => ['checkDep:IT,SCM']], function(){
        Route::get('/', 'PenjualanPUController@index');
        Route::get('/detail', 'PenjualanPUController@detail');
        Route::get('/expall', 'PenjualanPUController@expall');
    });

    // ubah password
    Route::group(['prefix' => '/repassword'], function(){
        Route::get('/', 'RepasswordController@index');
        Route::post('/save', 'repasswordController@save');
    });

    // Update Master
    Route::group(['prefix' => '/master', 'middleware' => ['checkDep:IT,Gudang,Cabang']], function(){
        Route::get('/', 'UpdateMasterController@index');
        Route::post('/save', 'UpdateMastercontroller@save');
    });

    // Finance
    Route::group(['prefix' => '/finance', 'middleware' => ['checkDep:IT,Finance,Cabang']], function(){
        Route::get('/', 'FinanceController@index');
        Route::post('/save', 'FinanceController@save');
        Route::get('/detail/{nama}', 'FinanceController@detail');
    });
});


// Backend
Route::group(['prefix' => '/backend'], function(){
    Route::get('/', 'HomeController@backend');
    Route::post('/postlogin', 'AuthController@postloginbackend');
    Route::get('/logout', 'AuthController@logoutbackend');
    
    // scoreboard
    Route::group(['prefix' => '/scoreboard'], function(){
        Route::get('/', 'ScoreboardController@index');
        Route::post('/save', 'ScoreboardController@save');
    });
});