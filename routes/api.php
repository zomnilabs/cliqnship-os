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

    // Frontend specific customer api
    Route::group(['prefix' => 'v1/customers'], function () {

        Route::group(['prefix' => 'bookings'], function () {
            Route::post('/', 'BookingController@store');
        });

        Route::group(['prefix' => 'shipments'], function () {
            Route::post('/', 'ShipmentsController@store');
            Route::get('/check/{waybillNumber}', 'ShipmentsController@checkWaybill');
        });
    });

    // Shipments
    Route::group(['prefix' => 'v1/shipments'], function () {
        Route::get('/check/{waybillNumber}', 'ShipmentsController@checkWaybill');
        Route::get('/{shipmentId}', 'ShipmentsController@show');
    });

    // Bookings
    Route::group(['prefix' => 'v1/bookings'], function () {
        Route::post('/{bookingId}/update-rider', 'BookingController@updateRider');
    });

    // Address book
    Route::group(['prefix' => 'v1/address-books'], function() {
        Route::get('/{userId}', 'AddressBookController@index');
    });
});