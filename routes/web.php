<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'dashboard'])->name('home');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
Route::post('/edit-product', [ProductController::class, 'editProduct'])->name('edit.product');
Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete.product');

