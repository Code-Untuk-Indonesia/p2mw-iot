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
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::put('update', [AuthController::class, 'update']);
    Route::get('history/{userApp}', [HistoryController::class, 'history']);
    Route::get('realtime', [RealtimeController::class, 'index']);
});
Route::post('/validate_token', [AuthController::class, 'validateToken']);

// end alert mobile apps
Route::post('realtime/{id}/update', [RealtimeController::class, 'updateStatus']);

// esp32
Route::post('history-esp32/{kodealat}', [HistoryController::class, 'store']);
Route::post('realtime/{kodealat}', [RealtimeController::class, 'store']);

// realtime data
Route::get('realtime-data', [DashboardController::class, 'getRealtimeData']);
