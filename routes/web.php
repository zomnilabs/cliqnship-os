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

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'customers', 'namespace' => 'Customers', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index');

    Route::group(['prefix' => 'bookings', 'namespace' => 'Bookings'], function() {
        Route::get('/', 'BookingsController@index');
    });
});