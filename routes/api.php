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
    Route::post('points', 'pointController@insert');

    Route::get('point/{id}', 'pointController@fetch');

    Route::get('point/{long}/{lat}', 'pointController@singleGeomFetch');

    Route::get('points/{long}/{lat}', 'pointController@geomFetch');

    Route::get('reports/all', 'reportController@fetchAll');

    Route::post('reports', 'reportController@insert');

    Route::get('reports/point/{id}/{history?}', 'reportController@fetchReportsByPointId');

    Route::get('reports/geom/{long}/{lat}/{history?}', 'reportController@fetchReportsByPointGeom');

    Route::get('reports/{id}', 'reportController@fetchSingleReportById');

    Route::put('reports/{id}', 'reportController@updateReportById');

    Route::delete('reports/{id}', 'reportController@deleteReportById');

    Route::get('oauth', 'oAuthController@endpoint');

  /*  Route::get('markup', function(Request $request){
        return json_encode([
            'title' => 'Shhh, no tears!',
            'info' => 'Only dreams now',
            'lat' => 45.3681,
            'lng' => 7.7681
            ]);
    });
  */
});