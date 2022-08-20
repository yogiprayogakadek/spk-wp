<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Main\DashboardController@index')->name('main')->middleware('auth');

Route::prefix('/pendaftaran')->namespace('Main')->name('pendaftaran.')->group(function(){
    Route::get('/', 'RegisterController@index')->name('index');
    Route::post('/proses', 'RegisterController@register')->name('proses');
});

Route::prefix('/')->namespace('Main')->middleware('auth')->group(function(){

    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('index');
    });

    Route::prefix('/user')->name('user.')->group(function(){
        Route::get('/', 'UserController@index')->name('index');
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
        Route::get('/', 'NilaiController@index')->name('index');
        Route::get('/render', 'NilaiController@render')->name('render');
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

