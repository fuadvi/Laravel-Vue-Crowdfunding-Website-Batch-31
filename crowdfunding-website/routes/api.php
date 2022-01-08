<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegeneretController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\Tes;
use App\Http\Controllers\Auth\VerificationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/auth/register', RegisterController::class);
Route::post('/auth/login', LoginController::class);
Route::post('/auth/verification', VerificationController::class);
Route::post('/auth/generet-otp', RegeneretController::class);
