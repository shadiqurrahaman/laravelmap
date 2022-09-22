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


Route::view('/{app?}', 'welcome')->where('app','.*');

// Route::get('passwordreset/{token}','App\Http\Controllers\Api\PasswordResetController@showResetPasswordForm')->name('passwordreset');
// Route::post('resetpasswordpost','App\Http\Controllers\Api\PasswordResetController@submitResetPasswordForm')->name('resetpasswordpost');