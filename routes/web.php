<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

// ==================== STOREFRONT ROUTES ====================
Route::get('/', [StorefrontController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [StorefrontController::class, 'category'])->name('storefront.category');
Route::get('/category/{category:slug}/{subcategory:slug}', [StorefrontController::class, 'category'])->name('storefront.subcategory');
Route::get('/products/{product:slug}', [StorefrontController::class, 'product'])->name('storefront.product');

// ==================== AUTHENTICATION ROUTES ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== PROTECTED ADMIN PORTAL ====================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('categories/{category}/subcategories', [AdminProductController::class, 'getSubcategories'])->name('categories.subcategories');

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('subcategories', AdminSubcategoryController::class);
    Route::resource('products', AdminProductController::class);
});
