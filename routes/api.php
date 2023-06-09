<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
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

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('user/current', [UserController::class, 'getCurrentUser']);
    Route::put('user/current', [UserController::class, 'updateCurrentUser']);
    Route::put('user/currentSocial', [UserController::class, 'updateCurrentUserSocial']);
    Route::apiResource('user', UserController::class);
});