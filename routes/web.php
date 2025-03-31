<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomeController;


//Route::get('/', [PageController::class, 'index']);
Route::get('/',HomeController::class);

