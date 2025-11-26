<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Small demo frontend pages wired to a controller
use App\Http\Controllers\FrontendController;

Route::get('/frontend', [FrontendController::class, 'index']);
Route::get('/frontend/items', [FrontendController::class, 'items']);
Route::get('/frontend/items/{id}', [FrontendController::class, 'show']);
