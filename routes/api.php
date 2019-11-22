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

Route::match(['get', 'post'], '/login', 'Api\KontakController@login');
Route::group(['middleware' => ['auth:kontak']], function () {
    Route::match(['get', 'post'], '/register', 'Api\UserController@register');
    Route::group(['middleware' => ['auth:api']], function () {
        Route::match(['get', 'post'], '/details', 'Api\UserController@details');
        Route::match(['get', 'post'], '/logout', 'Api\OutController@logout');
    });
});




