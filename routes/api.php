<?php

use App\Http\Controllers\Api\ActiveModuleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoresController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\StudentModelController;
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

    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/',[WarehouseController::class,'index']);
        Route::post('/',[WarehouseController::class,'store']);
        Route::get('/{stores}/edit',[WarehouseController::class,'edit']);
        Route::post('/{stores}/update',[WarehouseController::class,'update']);
        Route::delete('/{store}/delete', [WarehouseController::class, 'destroy']);

    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/',[CustomerController::class,'index']);
        Route::post('/',[CustomerController::class,'store']);
        Route::get('/{Customer}/edit',[CustomerController::class,'edit']);
        Route::post('/{Customer}/update',[CustomerController::class,'update']);
        Route::delete('/{Customer}/delete', [CustomerController::class, 'destroy']);

    });


    Route::group(['prefix' => 'wallet'], function () {
        Route::get('/',[WalletController::class,'index']);
        Route::post('/',[WalletController::class,'store']);
        Route::get('/{stores}/edit',[WalletController::class,'edit']);
        Route::post('/{stores}/update',[WalletController::class,'update']);
        Route::delete('/{store}/delete', [WalletController::class, 'destroy']);

    });


    
    Route::group(['prefix' => 'students'], function () {
        Route::get('/',[StudentModelController::class,'index']);
        Route::post('/',[StudentModelController::class,'store']);
        Route::post('/{stores}/update',[StudentModelController::class,'update']);
        Route::delete('/{store}/delete', [StudentModelController::class, 'destroy']);

    });


});