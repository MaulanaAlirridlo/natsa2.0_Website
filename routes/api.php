<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\VestigeController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\RiceFieldController;
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

//Regions
Route::prefix('regions')->group(function () {
    //public
    Route::get('/', [RegionController::class, 'index']);
    Route::get('/{id}', [RegionController::class, 'show']);
    Route::get('/search/{search}', [RegionController::class, 'search']);

});

//Regions
Route::prefix('irrigations')->group(function () {

    //public
    Route::get('/', [IrrigationController::class, 'index']);
    Route::get('/{id}', [IrrigationController::class, 'show']);
    Route::get('/search/{search}', [IrrigationController::class, 'search']);

});

//Vestiges
Route::prefix('vestiges')->group(function () {

    //public
    Route::get('/', [VestigeController::class, 'index']);
    Route::get('/{id}', [VestigeController::class, 'show']);
    Route::get('/search/{search}', [VestigeController::class, 'search']);

});

//Verifications
Route::prefix('verifications')->group(function () {

    //public
    Route::get('/', [VerificationController::class, 'index']);
    Route::get('/{id}', [VerificationController::class, 'show']);
    Route::get('/search/{search}', [VerificationController::class, 'search']);

});

//Social Media
Route::prefix('social-media')->group(function () {

    //public
    Route::get('/', [SocialMediaController::class, 'index']);
    Route::get('/{id}', [SocialMediaController::class, 'show']);
    Route::get('/search/{search}', [SocialMediaController::class, 'search']);

});

//Sawah / RiceField
Route::prefix('riceFields')->group(function () {

    //public
    Route::get('/', [RiceFieldController::class, 'index']);
    Route::get('/{id}', [RiceFieldController::class, 'show']);
    Route::get('/search/{search}', [RiceFieldController::class, 'search']);

    //protected
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [RiceFieldController::class, 'store']);
        Route::delete('/{id}', [RiceFieldController::class, 'destroy']);
        Route::put('/{id}', [RiceFieldController::class, 'update']);
    });

});

//User
Route::prefix('users')->group(function () {

    //public
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/search/{search}', [UserController::class, 'search']);

    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/register', [RegisterController::class, 'store']);

    //protected
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [LogoutController::class, 'store']);
        Route::put('/update', [UserController::class, 'update']);
        Route::delete('/delete', [UserController::class, 'destroy']);
        Route::get('/details', [UserController::class, 'details']);

    });

});

Route::prefix('user')->group(function () {

    //protected
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/details', [UserController::class, 'details']);

    });

});
