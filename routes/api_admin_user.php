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
            Route::get('/list', [RoomMetaController::class, 'listRoomType']);
            Route::get('/details', [RoomMetaController::class, 'viewRoomType']);
            Route::get('/dropdown', [RoomMetaController::class, 'roomTypeDropdown']);
            Route::post('/update', [RoomMetaController::class, 'updateRoomType']);
            Route::post('/update/status', [RoomMetaController::class, 'toggleRoomTypeStatus']);
            Route::post('/delete', [RoomMetaController::class, 'deleteRoomType']);

        });
        Route::group(['prefix' => '/bed-type'], function () {
            Route::post('/create', [RoomMetaController::class, 'createBedType']);
            Route::get('/list', [RoomMetaController::class, 'listBedType']);
            Route::get('/details', [RoomMetaController::class, 'viewBedType']);
            Route::get('/dropdown', [RoomMetaController::class, 'bedTypeDropdown']);
            Route::post('/update', [RoomMetaController::class, 'updateBedType']);
            Route::post('/update/status', [RoomMetaController::class, 'toggleBedTypeStatus']);
            Route::post('/delete', [RoomMetaController::class, 'deleteBedType']);
        });
    });
});
