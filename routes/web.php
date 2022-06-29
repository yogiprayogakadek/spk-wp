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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

