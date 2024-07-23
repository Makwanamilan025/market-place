<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


 
Route::get('reset-password', 'App\Http\Controllers\Api\AuthController@resetPassword')->name('reset-password');
Route::post('/set-password', 'App\Http\Controllers\Api\AuthController@setpassword')->name('set-password');

Route::get('user/reset-password', [AuthController::class, 'userResetPassword'])->name('user-reset-password');
Route::post('user/set-password', [AuthController::class, 'userSetpassword'])->name('user-set-password');