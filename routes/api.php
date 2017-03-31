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
    Route::get('points', 'pointController@fetchAll');
    Route::get('points/{id}', 'pointController@fetch');
    Route::get('points/{long}/{lat}', 'pointController@singleGeomFetch');
    Route::get('points/{long}/{lat}/{distance?}', 'pointController@geomFetch');

    Route::get('reports', 'reportController@fetchAll');

    Route::post('reports', 'reportController@insert');

    Route::get('reports/point/{id}/{history?}', 'reportController@fetchReportsByPointId');

    Route::get('reports/geom/{long}/{lat}/{history?}', 'reportController@fetchReportsByPointGeom');

    Route::get('reports/{id}', 'reportController@fetchSingleReportById');

    Route::put('reports/{id}', 'reportController@updateReportById');

    Route::delete('reports/{id}', 'reportController@deleteReportById');

    Route::get('excluded-regions', 'excludedRegionsController@fetch');
    Route::post('excluded-regions', 'excludedRegionsController@insert');
    Route::delete('excluded-regions/{id}', 'excludedRegionsController@delete');

    Route::get('poi', 'poiController@fetch');
    Route::post('poi', 'poiController@insert');
    Route::delete('poi/{id}', 'poiController@delete');

    Route::post('oauth', 'oAuthController@endpoint');

    Route::post('firebase-update', 'firebaseController@tokenUpdate');

    Route::get('test', 'testController@test');

});