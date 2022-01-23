<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegeneretController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Profile\GetProfileController;
use App\Http\Controllers\Profile\UpdateProfileController;
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


Route::prefix('/auth')
    ->group(function () {
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class);
        Route::post('verification', VerificationController::class);
        Route::post('generet-otp', RegeneretController::class);
        Route::post('update-password', UpdatePasswordController::class);
    });

Route::prefix('/profile')
    ->middleware(['auth:api', 'email.verifikasi'])
    ->group(function () {
        Route::get('get-profile', GetProfileController::class);
        Route::post('update-profile', UpdateProfileController::class);
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'campaign'
], function () {
    Route::get('random/{count}', [CampaignController::class, 'random']);
    Route::post('store', [CampaignController::class, 'store']);
    Route::get('/', [CampaignController::class, 'index']);
    Route::get('/{id}', [CampaignController::class, 'detail']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog'
], function () {
    Route::get('random/{count}', [BlogController::class, 'random']);
    Route::post('store', [BlogController::class, 'store']);
});
