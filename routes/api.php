<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\VestigeController;
use App\Http\Controllers\API\BookmarkController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\RiceFieldController;
use App\Http\Controllers\API\IrrigationController;
use App\Http\Controllers\API\SocialMediaController;
use App\Http\Controllers\API\VerificationController;
use App\Http\Controllers\API\MakelarProfileController;
use App\Http\Controllers\API\UserSocialMediaController;

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
        Route::delete('delete/photo/{id}', [RiceFieldController::class, 'destroyPhoto']);

        Route::put('/{id}', [RiceFieldController::class, 'update']);
        Route::put('/ketersediaan/{id}', [RiceFieldController::class, 'updateKetersediaan']);

    });

});

Route::get('product/{id}', [RiceFieldController::class, 'product']);

//bookmark
Route::middleware(['auth:sanctum'])->prefix('bookmarks')->group(function () {

    Route::get('/', [BookmarkController::class, 'index']);
    Route::post('/{id}', [BookmarkController::class, 'store']);
    Route::delete('/{id}', [BookmarkController::class, 'destroy']);

});

//User
Route::prefix('users')->group(function () {

    //public
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/search/{search}', [UserController::class, 'search']);

    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::post('/logout', [LogoutController::class, 'store']);

        Route::put('/', [Usercontroller::class, 'update']);
        Route::delete('/', [Usercontroller::class, 'destroy']);
        Route::put('password/', [Usercontroller::class, 'updatePassword']);

    });

});

//protected
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/user/social-media')->group(function () {
        Route::get('/', [UserSocialMediaController::class, 'index']);
        Route::post('/', [UserSocialMediaController::class, 'store']);
        Route::delete('/{id}', [UserSocialMediaController::class, 'destroy']);
        Route::put('/{id}', [UserSocialMediaController::class, 'update']);
    });

});

//history
Route::middleware(['auth:sanctum'])->prefix('history')->group(function () {

    Route::get('/', [HistoryController::class, 'index']);
    Route::delete('/{id}', [HistoryController::class, 'destroy']);

});

Route::middleware(['auth:sanctum'])->prefix('makelar')->group(function () {
    
    Route::get('/{id}', [MakelarProfileController::class, 'index']);

});

Route::prefix('user')->group(function () {

    //protected
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/details', [UserController::class, 'details']);

    });

});
