<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


Route::get('/', function () {
    return view('storefront.index');
})->name('home');
// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Portal
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('categories/{category}/subcategories', [AdminProductController::class, 'getSubcategories'])->name('categories.subcategories');

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('subcategories', AdminSubcategoryController::class);
    Route::resource('products', AdminProductController::class);
});
