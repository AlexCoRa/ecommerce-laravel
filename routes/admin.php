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
    Route::post('/product/add', [ProductController::class, 'postProductAdd'])->name('addproducts');


    //Module Categories
    Route::get('/categories/{module}', [CategoryController::class, 'getHome'])->name('categories');
    Route::post('/category/add', [CategoryController::class, 'postCategoryAdd'])->name('addcategory');
    Route::get('/category/{id}/edit', [CategoryController::class, 'getCategoryEdit'])->name('editcategory');
    Route::post('/category/{id}/edit', [CategoryController::class, 'postCategoryEdit'])->name('editcategory');
    Route::get('/category/{id}/delete', [CategoryController::class, 'getCategoryDelete'])->name('deletecategory');

});
