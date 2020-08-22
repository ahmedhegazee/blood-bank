<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::resource('client', 'ClientController');
// Route::resource('government', 'GovernmentController');
// Route::resource('city', 'CityController');
// Route::resource('bloodtype', 'BloodTypeController');
// Route::resource('category', 'CategoryController');
// Route::resource('post', 'PostController');
// Route::resource('donationrequest', 'DonationRequestController');
// Route::resource('clientmessage', 'ClientMessageController');
// Route::resource('notification', 'NotificationController');
// Route::resource('settings', 'SettingsController');
// Route::resource('clientables', 'ClientablesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::resource('government', 'GovernmentController');
    Route::resource('/{govern}/city', 'CityController')->except(['index', 'show']);
    Route::resource('category', 'CategoryController')->except('show');
    Route::resource('post', 'PostController')->except('show');
    Route::resource('client', 'ClientController')->only(['index', 'destroy', 'update']);
    Route::resource('setting', 'SettingController')->only(['index', 'edit', 'update']);
    Route::resource('message', 'ClientMessageController')->only(['index', 'destroy']);
    Route::resource('request', 'DonationRequestController')->only(['index', 'show', 'destroy']);
    Route::resource('user', 'UserController')->except(['show']);
    Route::get('change-password', 'UserController@showPasswordForm')->name('change-password-form');
    Route::post('change-password', 'UserController@changePassword')->name('change-password');
});