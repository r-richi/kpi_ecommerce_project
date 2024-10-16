<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('frontend.pages.index', compact('products'));
});

Route::get('/shop', [FrontendController::class, 'shop'])->name('pages.shop');



Route::prefix('admin-dashboard')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('backend.dashboard.index');
    });

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
