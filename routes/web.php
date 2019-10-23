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

Route::group(['middleware' => ['guest']], function(){
    // home
    Route::get('/', 'HomeController@index');
    Route::get('/detail/{id}', 'HomeController@detail');
    Route::get('/scoreboard', 'ScoreboardController@scoreboard');
    Route::get('/scoreboarddetail', 'ScoreboardController@scoreboarddetail');
    
});

// login & logout
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

// admin
Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function(){
    Route::group(['prefix' => '/pesan'], function(){
        // inbox
        Route::get('/inbox', 'PesanController@inbox');
        Route::get('/inbox/detail/{pesan_id}', 'PesanController@detail');
        Route::get('/inbox/hapus/{pesan_id}', 'PesanController@hapus');
        Route::get('/inbox/hapuscek/{pesan_id}', 'PesanController@hapuscek');
        // post pesan
        Route::get('/form', 'PesanController@form');
        Route::post('/store', 'PesanController@store');
        Route::post('/storefwd', 'PesanController@storeFwd');
        Route::get('/forward/{pesan_Id}', 'PesanController@forward');

        // outbox
        Route::get('/outbox', 'OutboxController@index');
        Route::get('/outbox/detail/{pesan_id}', 'OutboxController@detail');
        Route::get('/outbox/hapus/{pesan_id}', 'OutboxController@hapus');
        Route::get('/outbox/hapuscek/{pesan_id}', 'OutboxController@hapuscek');

        // Tempat sampah
        Route::get('/trash', 'TrashController@index');
        Route::get('/trash/hapusout/{pesan_id}', 'TrashController@hapusout');
        Route::get('/trash/hapusin/{pesan_id}', 'TrashController@hapusin');
        Route::get('/trash/buInbox/{pesan_id}', 'TrashController@buInbox');
        Route::get('/trash/buOutbox/{pesan_id}', 'TrashController@buOutbox');
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

    // form hrd
    Route::group(['prefix' => '/formhrd'], function(){
        Route::get('/', 'FormHRDController@index');
        Route::get('/form', 'FormHRDController@form');
        Route::post('/store', 'FormHRDController@store');
        Route::get('/detail/{id}', 'FormHRDController@detail');
        Route::post('/accspv/{id}', 'FormHRDController@accspv');
    });
});


// Backend
Route::group(['prefix' => '/backend'], function(){
    Route::get('/', 'HomeController@backend');
    Route::post('/postlogin', 'AuthController@postloginbackend');

    Route::group(['middleware' => ['checkUser:it']], function(){
        Route::get('/logout', 'AuthController@logoutbackend');
    
        // scoreboard
        Route::group(['prefix' => '/scoreboard'], function(){
            Route::get('/', 'ScoreboardController@index');
            Route::post('/save', 'ScoreboardController@save');
        });

        // User
        Route::group(['prefix' => 'user'], function(){
            Route::get('/', 'UserController@index');
            Route::post('/save', 'UserController@save');
            Route::get('/reset/{id}', 'UserController@resetPassword');
            Route::get('/nonactive/{id}', 'UserController@nonactive');
            Route::get('/active/{id}', 'UserController@active');
        });

        // Karyawan
        Route::group(['prefix' => 'karyawan'], function(){
            Route::get('/', 'KaryawanAllController@index');
            Route::post('/save', 'KaryawanAllController@save');
            Route::get('/edit/{id}', 'KaryawanAllController@edit');
            Route::put('/update', 'KaryawanAllController@update');
            Route::get('/delete/{id}', 'KaryawanAllController@delete');
        });

        // cabang
        Route::group(['prefix' => 'cabang'], function(){
            Route::get('/', 'CabangController@index');
            Route::post('/save', 'CabangController@save');
            Route::get('/edit/{id}', 'CabangController@edit');
            Route::put('/update', 'CabangController@update');
            Route::get('/delete/{id}', 'CabangController@delete');
        });

        // kodebarang
        Route::group(['prefix' => 'kodebarang'], function(){
            Route::get('/', 'KodeBarangController@index');
            Route::post('/save', 'KodeBarangController@save');
        });

        // ultah
        Route::group(['prefix' => 'ultah'], function(){
            Route::get('/', 'UltahController@index');
            Route::post('/save', 'UltahController@save');
        });
    });
});