<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\VestigeController;
use App\Http\Controllers\API\IrrigationController;
use App\Http\Controllers\API\SocialMediaController;
use App\Http\Controllers\API\VerificationController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {

    //Regions
    Route::prefix('regions')->group(function () {

        Route::get('/', [RegionController::class, 'index']);
        Route::get('/{id}', [RegionController::class, 'show']);
        Route::get('/search/{search}', [RegionController::class, 'search']);

    });

    //Regions
    Route::prefix('irrigations')->group(function () {

        Route::get('/', [IrrigationController::class, 'index']);
        Route::get('/{id}', [IrrigationController::class, 'show']);
        Route::get('/search/{search}', [IrrigationController::class, 'search']);

    });

    //Vestiges
    Route::prefix('vestiges')->group(function () {

        Route::get('/', [VestigeController::class, 'index']);
        Route::get('/{id}', [VestigeController::class, 'show']);
        Route::get('/search/{search}', [VestigeController::class, 'search']);

    });

    //Verifications
    Route::prefix('verifications')->group(function () {

        Route::get('/', [VerificationController::class, 'index']);
        Route::get('/{id}', [VerificationController::class, 'show']);
        Route::get('/search/{search}', [VerificationController::class, 'search']);

    });

    //Social Media
    Route::prefix('socialMedias')->group(function () {

        Route::get('/', [SocialMediaController::class, 'index']);
        Route::get('/{id}', [SocialMediaController::class, 'show']);
        Route::get('/search/{search}', [SocialMediaController::class, 'search']);

    });
});
