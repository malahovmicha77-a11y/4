<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;



Route::get('/', [MainController::class, 'index']);
Route::resource('categories', CategoryController::class);