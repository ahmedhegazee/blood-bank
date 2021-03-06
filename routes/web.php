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


Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'MainController@home')->name('index');
    Route::get('/about', 'MainController@about')->name('about');
    Route::get('/contact', 'MainController@contact')->name('contact');
    Route::post('/contact', 'MainController@storeMessage')->name('contact.store');
    Route::get('/post/{post}', 'MainController@post')->name('post.show');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('front.login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('front.register');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::get('/post/{post}', 'MainController@post')->name('front.post');
    Route::get('/post', 'MainController@posts')->name('front.posts');
    Route::get('/donation', 'MainController@donation')->name('front.requests');


    Route::get('/donation-status/{request}', 'MainController@donation')->name('front.requests-status');

    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    Route::group(['middleware' => ['auth:client']], function () {
        Route::get('/donation/create', 'MainController@createRequest')->name('front.donation.create');
        Route::post('/donation', 'MainController@storeRequest')->name('front.donation.store');
        Route::get('/profile', 'MainController@profile')->name('front.profile');
        Route::put('/profile', 'MainController@updateProfile');
        Route::group(['prefix' => 'favourite'], function () {
            Route::post('post', 'MainController@toggleFavouritePosts');
            Route::get('/posts', 'MainController@favouritePosts')->name('front.favourite.posts');
        });
    });
});


Route::group(['prefix' => 'dashboard'], function () {
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);

    Route::group(['middleware' => ['auth', 'auto-check-permission'],], function () {
        Route::get('/', 'HomeController@index')->name('home');
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
});