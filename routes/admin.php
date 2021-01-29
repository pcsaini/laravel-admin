<?php

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
Route::middleware('guest')->group(function () {
    Route::get('auth/login', 'AuthController@login')->name('admin.login');
    Route::post('auth/login', 'AuthController@postLogin')->name('admin.login.post');

    Route::get('auth/forgot-password', 'AuthController@forgotPassword')->name('admin.forgot_password');
    Route::post('auth/forgot-password', 'AuthController@forgotPasswordPost')->name('admin.forgot_password.post');

    Route::get('auth/reset-password', 'AuthController@resetPassword')->name('admin.reset_password');
    Route::post('auth/reset-password', 'AuthController@resetPasswordPost')->name('admin.reset_password.post');
});
Route::middleware('auth')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('profile', 'ProfileController@index')->name('admin.profile');
    Route::post('profile', 'ProfileController@update')->name('admin.profile.save');
    Route::post('ajax/change-password', 'ProfileController@changePasswordAjax')->name('admin.change_password');
    Route::get('logout', 'ProfileController@logout')->name('logout');
});
