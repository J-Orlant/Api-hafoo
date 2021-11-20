<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

Route::view('/', 'auth.login')->name('login');
Route::post('/login', [AuthController::class,'web_postlogin'])->name('post.login');

Route::middleware(['web', 'auth'])->group(function () {
    //Dashboard
    Route::get('/admin-panel', [DashboardController::class, 'index'])->name('dashboard');
    //Products
    Route::get('/admin-panel/products', [ProductController::class, 'index'])->name('products');
    Route::get('/admin-panel/products/createSlug', [ProductController::class, 'createSlug'])->name('products.createSlug');
    Route::get('/admin-panel/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin-panel/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin-panel/products/edit/{product:slug}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/admin-panel/products/update/{product:slug}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/admin-panel/products/delete/{product:slug}', [ProductController::class, 'delete'])->name('products.delete');
    //Category
    Route::get('/admin-panel/categories', [CategoryController::class, 'index'])->name('categories');
    Route::view('/admin-panel/categories/create', 'admin.category.create')->name('categories.create');
    Route::post('/admin-panel/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin-panel/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/admin-panel/categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/admin-panel/categories/delete/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
    //Transaction
    Route::get('/admin-panel/transactions', [CategoryController::class, 'index'])->name('transactions');
    //Log out
    Route::get('/logout', [AuthController::class, 'web_logout'])->name('get.logout');
});
