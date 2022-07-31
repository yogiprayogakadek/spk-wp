<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Main\DashboardController@index')->name('main')->middleware('auth');
Route::prefix('/')->namespace('Main')->middleware('auth')->group(function(){
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('index');
        // Route::post('/chart', 'DashboardController@chart')->name('chart');
    });

    Route::prefix('/kriteria')->name('kriteria.')->group(function(){
        Route::get('/', 'KriteriaController@index')->name('index');
        Route::get('/render', 'KriteriaController@render')->name('render');
    });

    Route::prefix('/alternatif')->name('alternatif.')->group(function(){
        Route::get('/', 'AlternatifController@index')->name('index');
        Route::get('/render', 'AlternatifController@render')->name('render');
        Route::get('/create', 'AlternatifController@create')->name('create');
        Route::post('/store', 'AlternatifController@store')->name('store');
        Route::get('/edit/{id}', 'AlternatifController@edit')->name('edit');
        Route::post('/update', 'AlternatifController@update')->name('update');
        Route::get('/delete/{id}', 'AlternatifController@delete')->name('delete');
    });
    
    Route::prefix('/nilai')->name('nilai.')->group(function(){
        Route::post('/store', 'NilaiController@store')->name('store');
        Route::get('/edit/{id}', 'NilaiController@edit')->name('edit');
    });

    Route::prefix('/perhitungan')->name('perhitungan.')->group(function(){
        Route::get('/', 'PerhitunganController@index')->name('index');
        Route::get('/render', 'PerhitunganController@render')->name('render');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

