<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/admin', [MainController::class, 'index'])->name('admin.index');

Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::resource('posts', PostController::class);