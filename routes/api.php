<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoresController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'signIn']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');


Route::group(['middleware' => ['auth:api']], function() {
    Route::post('/changePassword', [AuthController::class, 'changePassword']);
    Route::get('/profile', [AuthController::class, 'getProfile']);
    Route::get('/logout', [AuthController::class, 'logout']);


    Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
        Route::get('/',[StoresController::class,'index'])->name('index');
        Route::post('/',[StoresController::class,'store'])->name('store');

    });
});