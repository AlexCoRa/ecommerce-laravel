<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;



Route::prefix('/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'getDashboard'])->name('dashboard');

    //Module Users
    Route::get('/users/{status}', [UserController::class, 'getUsers'])->name('users_list');
    Route::get('/user/{id}/edit', [UserController::class, 'getUsersEdit'])->name('users_edit');


    //Module Products
    Route::get('/products', [ProductController::class, 'getHome'])->name('products');
    Route::get('/product/add', [ProductController::class, 'getProductAdd'])->name('products_add');
    Route::post('/product/add', [ProductController::class, 'postProductAdd'])->name('products_add');
    Route::get('/product/{id}/edit', [ProductController::class, 'getProductEdit'])->name('products__edit');
    Route::post('/product/{id}/edit', [ProductController::class, 'postProductEdit'])->name('products__edit');
    Route::post('/product/{id}/gallery/add', [ProductController::class, 'postProductGalleryAdd'])->name('product_gallery_add');
    Route::get('/product/{id}/gallery/{gid}/delete', [ProductController::class, 'getProductGalleryDelete'])->name('product_gallery_delete');

    //Module Categories
    Route::get('/categories/{module}', [CategoryController::class, 'getHome'])->name('categories');
    Route::post('/category/add', [CategoryController::class, 'postCategoryAdd'])->name('category_add');
    Route::get('/category/{id}/edit', [CategoryController::class, 'getCategoryEdit'])->name('category__edit');
    Route::post('/category/{id}/edit', [CategoryController::class, 'postCategoryEdit'])->name('category_edit');
    Route::get('/category/{id}/delete', [CategoryController::class, 'getCategoryDelete'])->name('category_delete');

});
