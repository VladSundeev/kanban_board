<?php

use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::middleware('auth:api')->group(function () {
//    Route::resource('columns', ColumnController::class);
//    Route::resource('tasks', TaskController::class);
//});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/columns', [ColumnController::class, 'index']);
    Route::post('/columns', [ColumnController::class, 'store']);
    Route::post('/tasks', [TaskController::class, 'store']);
});

// Маршруты для аутентификации
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
