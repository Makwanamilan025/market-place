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


    Route::group(['prefix' => 'stores'], function () {
        Route::get('/',[StoresController::class,'index']);
        Route::post('/',[StoresController::class,'store']);
        // Route::get('/{stores}/edit',[StoresController::class,'edit']);
        Route::post('/{stores}/update',[StoresController::class,'update']);
        Route::delete('/{stores}/delete', [StoresController::class, 'destroy']);

    });
});