<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'getDashboard'])->name('dashboard');
});
