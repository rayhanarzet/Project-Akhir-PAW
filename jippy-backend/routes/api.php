<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MidtransController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LiveChatController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn(Request $request) => $request->user());
});


Route::get('/preorder', [ProductController::class, 'index']);
Route::post('/preorder', [ProductController::class, 'store']);
Route::get('/preorder/{id}', [ProductController::class, 'show']);
Route::put('/preorder/{id}', [ProductController::class, 'update']);
Route::post('/preorder/{id}', [ProductController::class, 'update']); 
Route::delete('/preorder/{id}', [ProductController::class, 'destroy']);

Route::post('/checkout', [MidtransController::class, 'checkout']);

Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::put('/reviews/{id}', [ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

Route::get('/livechat/messages', [LiveChatController::class, 'fetch']);
Route::post('/livechat/send', [LiveChatController::class, 'send']);
Route::post('/livechat/send-file', [LiveChatController::class, 'sendFile']);
