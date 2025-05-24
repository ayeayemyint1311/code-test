<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryStockController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/categories', CategoryController::class);

    Route::resource('/brands', BrandController::class);

    Route::resource('/products', ProductController::class);

    Route::post('/products/{product}/increase-stock', [InventoryStockController::class, 'increaseStock'])
        ->name('products.increase-stock');
    
    Route::post('/products/{product}/decrease-stock', [InventoryStockController::class, 'decreaseStock'])
        ->name('products.decrease-stock');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
