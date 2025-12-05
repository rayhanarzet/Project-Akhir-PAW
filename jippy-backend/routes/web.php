<?php

use Illuminate\Support\Facades\Route;

// tambahan nindy
use App\Http\Controllers\PreorderController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ReviewController;

Route::get('/preorder', [PreorderController::class, 'index'])->name('preorder');

// Tracking (GET = tampil semua)
Route::get('/tracking', [TransactionController::class, 'index'])->name('track.order');

// Tracking (POST = hasil pencarian)
Route::post('/tracking/check', [TransactionController::class, 'index'])->name('track.check');

// Checkout
Route::get('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::post('/checkout/store', [TransactionController::class, 'store'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


// Live Chat (PASTI BERHASIL)
Route::get('/livechat', function () {
    return response()->file(public_path('frontend/LiveChat.html'));
})->name('livechat');


// ------------------------------------------------------------------------------

Route::get('/', function () {
    return redirect('/admin');
});


Route::get('/admin/preorder', function () {
    return view('admin.preorder');
});

Route::get('/admin/product/add', function () {
    return view('admin.product_form');
});

Route::get('/admin/preorder/{id}/edit', function ($id) {
    return view('admin.product_form', ['id' => $id]);
});

Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::post('/admin/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update');


Route::get('/nilai/{transaction}', function ($transaction) {
    return view('frontend.nilai', ['transaction_id' => $transaction]);
})->name('nilai');

Route::post('/nilai/store', [ReviewController::class, 'store'])->name('nilai.store');
Route::delete('/admin/orders/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])
    ->name('admin.orders.destroy');
