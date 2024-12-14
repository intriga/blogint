<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\PostController;

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
});