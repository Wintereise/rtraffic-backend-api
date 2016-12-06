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
    Route::post('points', 'locationController@insert');

    Route::get('point/{id}', 'locationController@fetch');

    Route::get('point/{long}/{lat}', 'locationController@singleGeomFetch');

    Route::get('points/{long}/{lat}', 'locationController@geomFetch');

    Route::post('reports', 'reportController@insert');

    Route::get('reports/point/{id}/{history?}', 'reportController@fetchReportsByPointId');

    Route::get('reports/geom/{long}/{lat}/{history?}', 'reportController@fetchReportsByPointGeom');

    Route::get('reports/{id}', 'reportController@fetchSingleReportById');

    Route::put('reports/{id}', 'reportController@updateReportById');

    Route::delete('reports/{id}', 'reportController@deleteReportById');

    Route::get('oauth', 'oAuthController@endpoint');

    Route::get('markup', function(Request $request){
        return json_encode([
            'id' => 3,
            'severity' => 'gridlock',
            'comment' => 'Been stuck here for the past 20 minutes!',
            'media' => [2, 50],
            ]);
    });
});