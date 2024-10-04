<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDashboard\PostController;
use App\Http\Controllers\ApiDashboard\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(PostController::class)->group(function(){
    Route::get('/post/index', 'index');
    Route::post('/post/store', 'store');
    Route::get('/post/show/{id}', 'show');
    Route::post('/post/update/{id}', 'update');
    Route::delete('/post/delete/{id}', 'destroy');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/index', 'index');
    Route::get('/category/post/{id}', 'postsCategory');
});