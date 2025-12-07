<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;

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

Route::prefix('review')->group(function () {
    Route::get('/list', [ReviewController::class, 'index']);      
    Route::post('/store', [ReviewController::class, 'store']);   
    Route::put('/{id}', [ReviewController::class, 'update']);     
    Route::delete('/{id}', [ReviewController::class, 'destroy']); 
});


Route::get('/livechat/messages', [LiveChatController::class, 'fetch']);
Route::post('/livechat/send', [LiveChatController::class, 'send']);
Route::post('/livechat/send-file', [LiveChatController::class, 'sendFile']);

Route::get('/transaction/{id}', function($id) {
    return \App\Models\Transaction::with('product')->find($id);
});
