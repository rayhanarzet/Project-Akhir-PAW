<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
