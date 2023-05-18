<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DashboardController;
use App\Models\Product; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/  
Route::resource("/store/dashboard", DashboardController::class);
Route::resource("/store/categories", CategoriesController::class);
Route::resource("/store/Products", ProductsController::class);
Route::resource("/store/Orders", OrdersController::class);
Route::post('/store/products/search', [ProductsController::class, 'search'])->name('products.search');


