<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PostController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API routy pre PostController
Route::resource('admin/posts', PostController::class);














//Route::get('admin/posts-with-users', [PostController::class, 'postsWithUsers']);
//Route::get('admin/users-with-posts-count', [PostController::class, 'usersWithPostsCount']);
