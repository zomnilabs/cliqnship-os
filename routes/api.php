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
    Route::group(['prefix' => 'v1/customers'], function () {
        Route::post('/', 'Customers\CustomersController@store');
        Route::get('/{userId}', 'Customers\CustomersController@show');
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
    });

    // Address book
    Route::group(['prefix' => 'v1/address-books'], function() {
        Route::get('/{userId}', 'AddressBookController@index');
    });
});