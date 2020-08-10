<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('governments', 'MainController@getGovernments');
    Route::get('cities', 'MainController@getCities');
    Route::get('blood-types', 'MainController@getBloodTypes');
    Route::get('settings', 'MainController@getSettings');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('send-code', 'AuthController@sendResetCode');
    Route::post('reset', 'AuthController@resetPassword');
    // auth is the middleware , client_api is the guard we defined it in the auth file
    Route::group(['middleware' => 'auth:client_api'], function () {
        Route::patch('profile', 'AuthController@updateProfele');
        Route::group(['prefix' => 'favourite'], function () {
            Route::get('blood-type', 'AuthController@getFavouriteBloodTypes');
            Route::post('blood-type', 'AuthController@addFavouriteBloodTypes');
            Route::get('city', 'AuthController@getFavouriteCities');
            Route::post('city', 'AuthController@addFavouriteCities');
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
