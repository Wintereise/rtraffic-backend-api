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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1'], function ()
{
    Route::post('point', 'locationController@insert');

    Route::get('point/{id}', 'locationController@fetch');

    Route::get('test', function(Request $request){
        return "Hello world!";
    });

    Route::get('geom/{long}/{lat}', 'locationController@geomFetch');

    Route::get('markup', function(Request $request){
        return json_encode([
            'name' => 'Some Area A',
            'from_long' => -122,
            'to_long' => -122,
            'from_lat' => 37,
            'to_lat' => 37
        ]);
    });
});