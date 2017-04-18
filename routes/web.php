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
Route::get('/terms-and-conditions', function () {
    return view('terms');
});
Route::get('/pricing', function () {
    return view('pricing');
});
Route::get('/faqs', function () {
    return view('faqs');
});

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'auth'], function() {
    Route::get('facebook', 'Auth\FacebookAuthController@redirectToProvider');
    Route::get('facebook/callback', 'Auth\FacebookAuthController@handleProviderCallback');
});

Route::group(['prefix' => 'customers', 'namespace' => 'Customers', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index');

    Route::group(['prefix' => 'item-requests', 'namespace' => 'ItemRequests'], function() {
        Route::get('/', 'ItemRequestsController@index');
        Route::post('/', 'ItemRequestsController@store');
        Route::put('/{itemRequestId}', 'ItemRequestsController@update');
        Route::delete('/{itemRequestId}', 'ItemRequestsController@destroy');
    });

    Route::group(['prefix' => 'addressbooks', 'namespace' => 'Addressbooks'], function() {
        Route::get('/', 'AddressbooksController@index');
        Route::post('/', 'AddressbooksController@store');
        Route::put('/{addressbookId}', 'AddressbooksController@update');
        Route::delete('/{addressbookId}', 'AddressbooksController@destroy');
    });

    Route::group(['prefix' => 'bookings', 'namespace' => 'Bookings'], function() {
        Route::get('/', 'BookingsController@index');
        Route::post('/import', 'BookingsController@importBookings');
        Route::delete('/{bookingId}', 'BookingsController@destroy');
    });

    Route::group(['prefix' => 'shipments', 'namespace' => 'Shipments'], function() {
        Route::get('/', 'ShipmentsController@index');
        Route::get('/returned', 'ReturnShipmentsController@index');
        Route::get('/preview', 'ShipmentsController@preview');
        Route::get('/cash-on-delivery', 'CodShipmentsController@index');
    });
});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin'],function(){
    Route::get('/', 'DashboardController@index');

    Route::group(['prefix' => 'dispatching', 'namespace' => 'Dispatching'], function() {
        Route::get('bookings', 'BookingsController@index');
        Route::get('shipments/all', 'ShipmentsController@all');
        Route::post('shipments/all', 'ShipmentsController@dispatchShipments');
        Route::get('shipments/returned', 'ShipmentsController@returned');
        Route::get('item-requests', 'ItemRequestsController@index');
    });

    Route::group(['prefix' => 'receiving', 'namespace' => 'Receiving'], function() {
        Route::get('rider', 'ShipmentsController@all');
        Route::get('rider/remit/{riderId}', 'ShipmentsController@remit');
        Route::post('rider/remit/{riderId}', 'ShipmentsController@doRemit');
        Route::get('item-requests', 'ItemRequestsController@index');
    });

    Route::group(['prefix' => 'cash-on-delivery', 'namespace' => 'COD'], function() {
        Route::get('all', 'ShipmentsController@all');
        Route::get('customer', 'CustomerController@index');
    });

    Route::group(['prefix' => 'riders', 'namespace' => 'Riders'], function() {
        Route::get('/', 'RidersController@index');
        Route::post('/', 'RidersController@store');
        Route::put('/{riderId}', 'RidersController@update');
        Route::delete('/{riderId}', 'RidersController@destroy');
    });

    Route::group(['prefix' => 'customers', 'namespace' => 'Customers'], function() {
        Route::get('/', 'CustomersController@index');
        Route::post('/', 'CustomersController@store');
        Route::put('/{customerId}', 'CustomersController@update');
        Route::delete('/{customerId}', 'CustomersController@destroy');
    });

    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function() {
        Route::get('/', 'UsersController@index');
        Route::get('/', 'UsersController@index');
        Route::post('/', 'UsersController@store');
        Route::put('/{userId}', 'UsersController@update');
        Route::delete('/{userId}', 'UsersController@destroy');
    });

    Route::group(['prefix' => 'bookings', 'namespace' => 'Bookings'], function() {
        Route::get('/', 'BookingsController@index');
    });

    Route::group(['prefix' => 'shipments', 'namespace' => 'Shipments'], function() {
        Route::get('/', 'ShipmentsController@index');
        Route::get('/preview', 'ShipmentsController@preview');
    });

    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function() {
        Route::get('/', 'ReportsController@index');
    });

    Route::group(['prefix' => 'cms', 'namespace' => 'CMS'], function() {
        Route::get('/', 'CMSController@index');
    });
});

Route::get('print-waybill', function(){
    return view('print.waybill');
});