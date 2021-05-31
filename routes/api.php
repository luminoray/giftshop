<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items', [\App\Http\Controllers\ItemController::class, 'index']);
Route::get('/items/{id}', [\App\Http\Controllers\ItemController::class, 'show']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/items', [\App\Http\Controllers\ItemController::class, 'store']);
    Route::put('/items/{id}', [\App\Http\Controllers\ItemController::class, 'update']);
    Route::delete('/items/{id}', [\App\Http\Controllers\ItemController::class, 'destroy']);
});

