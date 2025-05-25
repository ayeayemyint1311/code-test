<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\InventoryStockController;
use App\Models\Product;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Categories Management
    Route::resource('/categories', CategoryController::class);

    // Brands Management
    Route::resource('/brands', BrandController::class);

    // Products Management
    Route::resource('/products', ProductController::class);

    // Excel Exports
    Route::get('export', [ExportController::class, 'export'])->name('export');

    // CSV Exports
    Route::get('export-csv', [ExportController::class, 'exportCsv'])->name('export.csv');

    // Soft delete routes
    Route::put('products/{id}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');

    Route::delete('products/{id}/force-delete', [ProductController::class, 'forceDelete'])
        ->name('products.force-delete');
        
    // Stock Management
    Route::post('/products/{product}/increase-stock', [InventoryStockController::class, 'increaseStock'])
        ->name('products.increase-stock');

    Route::post('/products/{product}/decrease-stock', [InventoryStockController::class, 'decreaseStock'])
        ->name('products.decrease-stock');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
