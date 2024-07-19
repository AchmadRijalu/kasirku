<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ItemController;


Route::post('/user/login', [AuthController::class, 'userLogin']);
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/user/logout', [AuthController::class, 'userLogout']);
    Route::get('/getItem', [ItemController::class, 'getAllItems']);
    Route::get('/getItem/{id}', [ItemController::class, 'getItemById']);
    Route::post('/createItem', [ItemController::class, 'createItem']);
    Route::post('/updateItem/{id}', [ItemController::class, 'updateItem']);
    Route::post('/deleteItem/{id}', [ItemController::class, 'deleteItem']);
});