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
    Route::get('/admin/post', [PostController::class, 'index'])->name('post');
});