<?php

use Illuminate\Support\Facades\Route;

// Make the frontend demo the app's landing page
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index']);

// Additional frontend pages
Route::get('/frontend', [FrontendController::class, 'index']);
Route::get('/frontend/items', [FrontendController::class, 'items']);
Route::get('/frontend/items/{id}', [FrontendController::class, 'show']);
