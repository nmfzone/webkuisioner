<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WebController@index')
    ->name('index')
    ->middleware('forbid_participant');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::domain(app_main_domain())->group(function () {
    Route::get('/auth/social/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');
});

Route::domain('{account}.' . app_main_domain())->group(function () {
    Route::get('/auth/social/{provider}', 'Auth\SocialiteController@redirectToProvider')
        ->middleware('guest');

    Route::get('/privacy-policy', 'WebController@privacyPolicy')
        ->name('privacy_policy');

    Route::post(
        '/register/participant',
        'Auth\ParticipantRegistrationController@existingUser'
    )
        ->name('register.participant')
        ->middleware('auth', 'forbid_participant');
});
