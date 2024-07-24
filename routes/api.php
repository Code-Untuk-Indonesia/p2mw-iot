<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\RealtimeController;
use App\Http\Controllers\DashboardController;
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

// mobile apps
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::put('update', [AuthController::class, 'update'])->middleware('auth:api');
Route::get('history/{userApp}', [HistoryController::class, 'history'])->middleware('auth:api');
Route::get('realtime', [RealtimeController::class, 'index'])->middleware('auth:api');

// esp32
Route::post('history/{kodealat}', [HistoryController::class, 'store']);
Route::post('realtime/{kodealat}', [RealtimeController::class, 'store']);

// realtime data
Route::get('realtime-data', [DashboardController::class, 'getRealtimeData']);
