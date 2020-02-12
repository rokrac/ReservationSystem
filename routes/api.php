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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/places', 'PlaceController@show');
Route::get('/places/{id}', 'PlaceController@showPlace');
Route::get('/reservation', 'ReservationController@index');
Route::post('/create', 'ReservationController@store');
