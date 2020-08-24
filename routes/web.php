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

Route::group(['middleware' => ['auth', 'auto-check-permission'], 'prefix' => 'dashboard'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('government', 'GovernmentController');
    Route::resource('/{govern}/city', 'CityController')->except(['index', 'show']);
    Route::resource('category', 'CategoryController')->except('show');
    Route::resource('post', 'PostController')->except('show');
    Route::resource('client', 'ClientController')->only(['index', 'destroy', 'update']);
    Route::resource('setting', 'SettingController')->only(['index', 'edit', 'update']);
    Route::resource('message', 'ClientMessageController')->only(['index', 'destroy']);
    Route::resource('request', 'DonationRequestController')->only(['index', 'show', 'destroy']);
    Route::resource('user', 'UserController')->except(['show']);
    Route::resource('role', 'RoleController')->except(['show']);
    // Route::resource('permission', 'PermissionController')->except(['show']);
    Route::get('change-password', 'UserController@showPasswordForm')->name('change-password-form');
    Route::post('change-password', 'UserController@changePassword')->name('change-password');
});
Route::get('test', function () {
    dd(getHerokuDatabaseData('postgres://ekggzyrifaedbf:dc12cf0cce4817079764e9bd21f25370de9f7dc0d040e26029ce206b26a5e559@ec2-34-195-115-225.compute-1.amazonaws.com:5432/defro6us0ocs7s'));
});