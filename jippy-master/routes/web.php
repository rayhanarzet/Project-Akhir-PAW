<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;

// ======================================================================
// FRONTEND USER PAGE → DASHBOARD (PAKAI PRODUK PO DARI TABLE `products`)
// ======================================================================

Route::get('/', function () {

    // Produk terbaru (untuk New Arrivals)
    $featuredProducts = Product::latest()->take(4)->get();


    // Produk per kategori (pastikan category_id di db kamu benar)
    $beautyProducts  = Product::where('category', 'Korean Beauty')->take(4)->get();
$fashionProducts = Product::where('category', 'Korean Fashion')->take(4)->get();
$kpopProducts    = Product::where('category', 'KPOP Merchandise')->take(4)->get();
$foodProducts    = Product::where('category', 'Korean Food')->take(4)->get();


    return view('dashboard', compact(
        'featuredProducts',
        'beautyProducts',
        'fashionProducts',
        'kpopProducts',
        'foodProducts'
    ));
});

// ======================================================================
// LIST PRODUCTS (SEMUA PRODUK)
// ======================================================================

Route::get('/list-products', function () {
    $categories = Category::all();
    $products   = Product::all();
    return view('livewire.list-products', compact('categories', 'products'));
});

// ======================================================================
// FILAMENT ADMIN → otomatis tersedia di /admin
// ======================================================================
