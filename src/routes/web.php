<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get("/products", [ProductController::class, "index"])->name("index");

Route::get("/products/search", [ProductController::class,"search"])->name("search");

Route::get("/products/detail/{id}", [ProductController::class,"detail"])->name("products.detail");

route::put("/products/{id}/update", [ProductController::class,"update"])->name('products.update');

route::delete('/products/{id}/delete', [ProductController::class,'destroy'])->name('product.destroy');

route::get('/products/register', [ProductController::class,'register'])->name('register');

route::post('/products/register', [ProductController::class,'store'])->name('product.store');