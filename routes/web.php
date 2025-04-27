<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomeController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\AuthController;

// Úvodná stránka
Route::get('/', HomeController::class)->name('home');

// Cesty pre administráciu príspevkov (chránené autentifikáciou)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', PostController::class);
});

// Cesty pre autentifikáciu
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Príklad ďalších ciest
Route::get('/no-age', function () {
    return 'Chýba parameter vek!';
})->name('no.age');

Route::get('/profile', function (Illuminate\Http\Request $request) {
    return 'Váš vek je: ' . $request->input('age');
})->middleware('check.age');