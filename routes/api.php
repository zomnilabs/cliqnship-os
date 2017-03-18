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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {

    // users
    Route::group(['prefix' => 'customers'], function () {
        Route::group(['prefix' => 'bookings'], function () {
            Route::post('/', 'BookingController@store');
        });

        Route::group(['prefix' => 'shipments'], function () {
            Route::post('/', 'ShipmentsController@store');
        });
    });

    // Address book
    Route::group(['prefix' => 'address-books'], function() {
        Route::get('/{userId}', 'AddressBookController@index');
    });
});