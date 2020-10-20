<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;



Route::prefix('/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'getDashboard'])->name('dashboard');
    Route::get('/users', [UserController::class, 'getUsers'])->name('users');

    //Module Products
    Route::get('/products', [ProductController::class, 'getHome'])->name('products');
    Route::get('/product/add', [ProductController::class, 'getProductAdd'])->name('addproducts');

    //Module Categories
    Route::get('/categories', [CategoryController::class, 'getHome'])->name('categories');
    Route::get('/category/add', [CategoryController::class, 'getCategoryAdd'])->name('addcategory');
});
