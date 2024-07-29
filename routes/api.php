<?php

use App\Http\Controllers\Api\ActiveModuleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoresController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

//  👉 Route For Login, Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'signIn']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');

//  👉 Route For Auth
Route::group(['middleware' => ['auth:api']], function() {
    Route::post('/changePassword', [AuthController::class, 'changePassword']);
    Route::get('/profile', [AuthController::class, 'getProfile']);
    Route::get('/logout', [AuthController::class, 'logout']);

//  👉 Route For Stores
    Route::group(['prefix' => 'stores'], function () {
        Route::get('/',[StoresController::class,'index']);
        Route::post('/',[StoresController::class,'store']);
        Route::post('/{id}/update',[StoresController::class,'update']);
        Route::delete('/{id}/delete', [StoresController::class, 'destroy']);

    });

//  👉 Route For Active Module
    Route::group(['prefix' => 'active-modules'], function () {
        Route::get('/',[ActiveModuleController::class,'index']);
        Route::post('/',[ActiveModuleController::class,'store']);
        Route::post('/{id}/update',[ActiveModuleController::class,'update']);
        Route::delete('/{id}/delete', [ActiveModuleController::class, 'destroy']);

    });

});