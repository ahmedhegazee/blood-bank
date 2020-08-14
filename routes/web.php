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

use Illuminate\Support\Facades\DB;

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
