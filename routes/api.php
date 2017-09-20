<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function() {

    // customers api
    // Register
    Route::post('/v1/customers', 'Customers\CustomersController@store');
    Route::group(['prefix' => 'v1/customers', 'middleware' => 'auth:api'], function () {
        Route::get('/{userId}', 'Customers\CustomersController@show');
        Route::put('/{userId}', 'Customers\CustomersController@update');

        // Customer Addressbooks
        Route::get('/{userId}/addressbooks', 'Customers\AddressbooksController@all');
        Route::post('/{userId}/addressbooks', 'Customers\AddressbooksController@store');
        Route::get('/{userId}/addressbooks/{addressbookId}', 'Customers\AddressbooksController@show');
        Route::put('/{userId}/addressbooks/{addressbookId}', 'Customers\AddressbooksController@update');

        // Customer Bookings
        Route::get('/{userId}/bookings', 'Customers\BookingsController@all');
        Route::post('/{userId}/bookings', 'Customers\BookingsController@store');
        Route::get('/{userId}/bookings/{bookingId}', 'Customers\BookingsController@show');
        Route::put('/{userId}/bookings/{bookingId}', 'Customers\BookingsController@update');

        // Customer Shipments
        Route::get('/{userId}/shipments', 'Customers\ShipmentsController@all');
        Route::post('/{userId}/shipments', 'Customers\ShipmentsController@store');
        Route::get('/{userId}/shipments/{shipmentId}', 'Customers\ShipmentsController@show');
        Route::put('/{userId}/shipments/{shipmentId}', 'Customers\ShipmentsController@update');

    });

    Route::group(['prefix' => 'v1/tracking'], function () {
        Route::get('/{trackingNumber}', 'Customers\ShipmentsController@tracking');
    });

    // admin api endpoints
    Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
        Route::get('/customers', 'Admin\CustomersController@show');
        Route::get('/customers/{userId}', 'Admin\CustomersController@show');
        Route::put('/customers/{userId}', 'Admin\CustomersController@update');

        // Customer Addressbooks
        Route::get('/{userId}/addressbooks', 'Admin\AddressbooksController@all');
        Route::post('/{userId}/addressbooks', 'Admin\AddressbooksController@store');
        Route::get('/{userId}/addressbooks/{addressbookId}', 'Admin\AddressbooksController@show');
        Route::put('/{userId}/addressbooks/{addressbookId}', 'Admin\AddressbooksController@update');

        // Customer Bookings
        Route::get('/{userId}/bookings', 'Admin\BookingsController@all');
        Route::post('/{userId}/bookings', 'Admin\BookingsController@store');
        Route::get('/{userId}/bookings/{bookingId}', 'Admin\BookingsController@show');
        Route::put('/{userId}/bookings/{bookingId}', 'Admin\BookingsController@update');

        // Customer Shipments
        Route::get('/{userId}/shipments', 'Admin\ShipmentsController@all');
        Route::post('/{userId}/shipments', 'Admin\ShipmentsController@store');
        Route::get('/{userId}/shipments/{shipmentId}', 'Admin\ShipmentsController@show');
        Route::put('/{userId}/shipments/{shipmentId}', 'Admin\ShipmentsController@update');

    });

    // Frontend specific customer api
    Route::group(['prefix' => 'web/customers'], function () {

        Route::group(['prefix' => 'bookings'], function () {
            Route::post('/', 'BookingController@store');
        });

        Route::group(['prefix' => 'shipments'], function () {
            Route::post('/', 'ShipmentsController@store');
            Route::get('/check/{waybillNumber}', 'ShipmentsController@checkWaybill');
        });
    });

    // Shipments
    Route::group(['prefix' => 'web/shipments'], function () {
        Route::get('/check/{waybillNumber}', 'ShipmentsController@checkWaybill');
        Route::get('/{shipmentId}', 'ShipmentsController@show');
    });

    // Resolution
    Route::group(['prefix' => 'web/resolutions'], function () {
        Route::get('/check/{waybillNumber}', 'ResolutionsController@checkWaybill');
    });

    // Bookings
    Route::group(['prefix' => 'web/bookings'], function () {
        Route::post('/{bookingId}/update-rider', 'BookingController@updateRider');
    });

    // Address book
    Route::group(['prefix' => 'web/address-books'], function() {
        Route::get('/{userId}', 'AddressBookController@index');
    });
});