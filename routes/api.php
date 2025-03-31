<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PostController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API routy pre PostController
Route::resource('admin/posts', PostController::class);
//API route pre moju pridanu metodu, pretoze Route::resource vidi len predpirpravene crud metody
Route::get('admin/posts-with-users', [PostController::class, 'postsWithUsers']);
Route::get('admin/users-with-posts-count', [PostController::class, 'usersWithPostsCount']);
Route::get('admin/searchPosts', [PostController::class, 'searchPosts']);