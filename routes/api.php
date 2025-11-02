<?php

use App\Http\Controllers\Api\CommonApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Public API endpoints
Route::get('abouts', [CommonApiController::class, 'abouts']);
Route::get('branches', [CommonApiController::class, 'branches']);
Route::get('banners', [CommonApiController::class, 'banners']);
Route::get('headlines', [CommonApiController::class, 'headlines']);
Route::get('food-categories', [CommonApiController::class, 'foodCategories']);
Route::get('food-items', [CommonApiController::class, 'foodItems']);
Route::get('food-galleries', [CommonApiController::class, 'foodGalleries']);
Route::get('settings', [CommonApiController::class, 'settings']);
