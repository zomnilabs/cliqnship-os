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

    Route::group(['prefix' => 'addressbooks', 'namespace' => 'Addressbooks'], function() {
        Route::get('/', 'AddressbooksController@index');
        Route::post('/', 'AddressbooksController@store');
    });

    Route::group(['prefix' => 'bookings', 'namespace' => 'Bookings'], function() {
        Route::get('/', 'BookingsController@index');
        Route::post('/import', 'BookingsController@importBookings');
    });

    Route::group(['prefix' => 'shipments', 'namespace' => 'Shipments'], function() {
        Route::get('/', 'ShipmentsController@index');
        Route::get('/returned', 'ReturnShipmentsController@index');
        Route::get('/cash-on-delivery', 'CodShipmentsController@index');
    });
});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin'],function(){
    Route::get('/', 'DashboardController@index');

    Route::group(['prefix' => 'dispatching', 'namespace' => 'Dispatching'], function() {
        Route::get('/', 'DispatchingController@index');
    });
    Route::group(['prefix' => 'riders', 'namespace' => 'Riders'], function() {
        Route::get('/', 'RidersController@index');
    });
    Route::group(['prefix' => 'customers', 'namespace' => 'Customers'], function() {
        Route::get('/', 'CustomersController@index');
    });
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function() {
        Route::get('/', 'UsersController@index');
    });
    Route::group(['prefix' => 'bookings', 'namespace' => 'Bookings'], function() {
        Route::get('/', 'BookingsController@index');
    });
    Route::group(['prefix' => 'shipments', 'namespace' => 'Shipments'], function() {
        Route::get('/', 'ShipmentsController@index');
    });
    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function() {
        Route::get('/', 'ReportsController@index');
    });
    Route::group(['prefix' => 'cms', 'namespace' => 'CMS'], function() {
        Route::get('/', 'CMSController@index');
    });
});