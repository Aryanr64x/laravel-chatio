<?php

use App\Events\Message;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageContoller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->put('/user', [UserController::class, 'update']);




Route::middleware('auth:sanctum')->get('/chat', [ChatController::class, 'index']);
Route::middleware('auth:sanctum')->post('/chat', [ChatController::class, 'create']);


Route::middleware('auth:sanctum')->get('/message/{chat_id}', [MessageContoller::class, 'index']);
Route::middleware('auth:sanctum')->post('/message/{chat_id}', [MessageContoller::class, 'create']);


Route::get('/fire', function () {
   
    return response()->json("Event fired successfully");
});