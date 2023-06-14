<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\TravelController;
use App\Http\Controllers\Api\V1\TourController;
use App\Models\Tour;

use App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Middleware\RoleMiddleware;
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


Route::get('travels', [TravelController::class, 'index']);
Route::get('travels/{travel:slug}/tours', [TourController::class, 'index']);


Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('travels', Admin\TravelController::class);
    Route::apiResource('travels/{travel}/tours', Admin\TourController::class);
});


Route::post('login', LoginController::class);

