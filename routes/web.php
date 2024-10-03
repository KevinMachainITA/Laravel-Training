<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('/post', PostController::class);
Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/update/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/destroy/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');