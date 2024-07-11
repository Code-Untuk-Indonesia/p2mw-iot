<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/user-management', function () {
        return view('admin.user-management');
    });
    Route::get('/user-history', function () {
        return view('admin.user-history');
    });
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
