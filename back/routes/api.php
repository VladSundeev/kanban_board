<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;
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


//Route::middleware('auth:api')->group(function () {

    Route::get('/columns', [ColumnController::class, 'index']);
    Route::post('/columns', [ColumnController::class, 'store']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::post('/update-task', [TaskController::class, 'update']);

//});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);
