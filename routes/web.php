<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('pages.login');
// });

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::prefix('/')->middleware('auth')->group(function() {
    Route::get('/', 'App\Http\Controllers\DashboardController@index');
    Route::get('/setting', 'App\Http\Controllers\DashboardController@inSetting');
    Route::post('/setStore', 'App\Http\Controllers\DashboardController@setStore');

    Route::group(['prefix' => 'barang', 'as' => 'barang.'], function() {
        Route::get('/print', 'App\Http\Controllers\PdfController@generatePDF')->name('print');
        Route::get('/print/{id}', 'App\Http\Controllers\PdfController@generatePDFOne')->name('print.one');
    });
});

Route::prefix('/comodities')->middleware('auth')->group(function() {
    Route::get('/', 'App\Http\Controllers\ComodityController@index');
    Route::post('/store', 'App\Http\Controllers\ComodityController@store');
    Route::get('/edit/{id}', 'App\Http\Controllers\ComodityController@edit');
    Route::put('/update/{id}', 'App\Http\Controllers\ComodityController@update');
    Route::get('/show/{id}', 'App\Http\Controllers\ComodityController@show');
    Route::delete('/destroy/{id}', 'App\Http\Controllers\ComodityController@destroy');

    Route::get('/export', 'App\Http\Controllers\ComodityController@export');
    Route::post('/import', 'App\Http\Controllers\ComodityController@import')->name('import');
});

Route::prefix('/comodity_locations')->middleware('auth')->group(function() {
    Route::get('/', 'App\Http\Controllers\ComodityLocations@index');
    Route::post('/store', 'App\Http\Controllers\ComodityLocations@store');
    Route::get('/edit/{id}', 'App\Http\Controllers\ComodityLocations@edit');
    Route::put('/update/{id}', 'App\Http\Controllers\ComodityLocations@update');
    Route::get('/show/{id}', 'App\Http\Controllers\ComodityLocations@show');
    Route::delete('/destroy/{id}', 'App\Http\Controllers\ComodityLocations@destroy');
});

Route::prefix('/school_operationals')->middleware('auth')->group(function() {
    Route::get('/', 'App\Http\Controllers\SchoolOperationals@index');
    Route::post('/store', 'App\Http\Controllers\SchoolOperationals@store');
    Route::get('/edit/{id}', 'App\Http\Controllers\SchoolOperationals@edit');
    Route::put('/update/{id}', 'App\Http\Controllers\SchoolOperationals@update');
    Route::get('/show/{id}', 'App\Http\Controllers\SchoolOperationals@show');
    Route::delete('/destroy/{id}', 'App\Http\Controllers\SchoolOperationals@destroy');
});
