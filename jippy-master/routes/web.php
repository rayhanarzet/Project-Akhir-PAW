<?php

use App\Livewire\ListProducts;
use Illuminate\Support\Facades\Route;

// Dashboard jadi homepage
Route::get('/', fn() => view('dashboard'))->name('dashboard');

// Dashboard explicit
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard.page');

// Halaman produk (Livewire)
Route::get('/products', ListProducts::class)->name('products.list');
