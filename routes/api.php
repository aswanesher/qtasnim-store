<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JenisBarangController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;

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

Route::post('/register', [AuthController::class, 'register'])->name('register.user');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.user');
    Route::apiResource('jenis-barang', JenisBarangController::class);
    Route::apiResource('barang', BarangController::class);
    Route::apiResource('order', OrderController::class);
});
