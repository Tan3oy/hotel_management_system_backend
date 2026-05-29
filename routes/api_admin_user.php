<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\RoomMetaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => 'admin.user.super'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::group(['prefix' => '/room-type'], function () {
            Route::post('/create', [MetaController::class, 'createRoomType']);
            Route::post('list', [MetaController::class, 'createRoomType']);
            Route::post('/dropdown', [MetaController::class, 'createRoomType']);
            Route::post('/create', [MetaController::class, 'createRoomType']);

        });
        Route::group(['prefix' => '/bed-type'], function () {
            Route::post('/create', [RoomMetaController::class, 'createBedType']);

        });
    });
});
