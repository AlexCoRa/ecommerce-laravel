<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\ContentController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ApiJsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContentController::class, 'getHome'])->name('home');

//Router Auth
Route::get('/login', [ConnectController::class, 'getLogin'])->name('login');
Route::get('/recover', [ConnectController::class, 'getRecover'])->name('recover');
Route::post('/recover', [ConnectController::class, 'postRecover'])->name('recover');
Route::get('/reset', [ConnectController::class, 'getReset'])->name('reset');
Route::post('/reset', [ConnectController::class, 'postReset'])->name('reset');

Route::post('/login', [ConnectController::class, 'postLogin'])->name('login');
Route::get('/logout', [ConnectController::class, 'logout'])->name('logout');

Route::get('/register', [ConnectController::class, 'getRegister'])->name('register');
Route::post('/register', [ConnectController::class, 'postRegister'])->name('register');

//Module User Actions
Route::get('/account/edit', [UserController::class, 'getAccountEdit'])->name('account_edit');
Route::post('/account/edit/avatar',[UserController::class, 'postAccountAvatar'])->name('account_avatar_edit');
Route::post('/account/edit/password',[UserController::class, 'postAccountPassword'])->name('account_password_edit');
Route::post('/account/edit/info',[UserController::class, 'postAccountInfo'])->name('account_info_edit');

//Ajax Api Routers
Route::get('/md/api/load/products/{section}', [ApiJsController::class, 'getProductsSection'])->name('apijs');

