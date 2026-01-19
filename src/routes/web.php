<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get("/products", [ProductController::class, "index"])->name("index");

Route::get("/products/search", [ProductController::class,"search"])->name("search");

Route::get("/products/detail/{id}", [ProductController::class,"detail"])->name("products.detail");