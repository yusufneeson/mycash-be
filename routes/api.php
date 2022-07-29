<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
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

Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('authgoogle', [GoogleAuthController::class, 'index'])->middleware('guest');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
