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
Route::get('/scoreboard', 'HomeController@scoreboard');
Route::get('/login', 'HomeController@login')->name('login');

// login & logout
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

// admin
Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => '/admin'], function(){
        Route::get('/inbox', 'HomeController@inbox');

        // pengumuman
        Route::group(['prefix' => '/pengumuman'], function(){
            Route::get('/', 'PengumumanController@index');
            Route::get('/form', 'PengumumanController@form');
            Route::get('/detail/{id}', 'PengumumanController@detail');
            Route::get('/edit/{id}', 'PengumumanController@edit');
            Route::get('/active/{id}', 'PengumumanController@active');
            Route::get('/nonactive/{id}', 'PengumumanController@nonactive');
            Route::get('/delete/{id}', 'PengumumanController@delete');
            Route::post('/store', 'PengumumanController@store');
            Route::put('/update', 'PengumumanController@update');
        });
    });
});