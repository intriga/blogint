<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', [AdminController::class, 'index'])->name('admin');



Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // posts
    Route::get('/admin/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/admin/post/create', [PostController::class, 'create']);
    Route::post('/admin/post/', [PostController::class, 'store']);
    Route::get('/admin/post/{slug}', [PostController::class, 'show']);
    Route::get('/admin/post/{id}/edit', [PostController::class, 'edit']);
    Route::post('/admin/post/{id}/edit', [PostController::class, 'update']);
    Route::delete('/admin/posts/{id}', [PostController::class, 'destroy']); 

    // Categories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/admin/category/create', [CategoryController::class, 'create']);
    Route::post('/admin/category/', [CategoryController::class, 'store']);
    Route::get('/admin/category/{slug}', [CategoryController::class, 'show']);
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::post('/admin/category/{id}/edit', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']); 

    // posts
    Route::get('/admin/users', [UserController::class, 'index'])->name('users');
    Route::get('/admin/user/create', [UserController::class, 'create']);
    Route::post('/admin/user/', [UserController::class, 'store']);
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit']);
    Route::post('/admin/user/{id}/edit', [UserController::class, 'update']);
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']); 
});