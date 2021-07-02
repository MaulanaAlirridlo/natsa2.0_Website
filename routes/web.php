<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\SellController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SocialMediaController as SocialMediaController;
use App\Http\Controllers\User\SocialMediaController as UserSocialMediaController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\VestigeController;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\Admin\RiceFieldController;
use App\Http\Controllers\Admin\IrrigationController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\User\MakelarProfileController;
use App\Http\Controllers\RiceFieldPhotoUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome')->middleware('guest');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//home user
Route::get('/', [HomeController::class, 'index'])->name('home');

//halaman kategori
Route::get('/categories', function(){
    return view('user.categories');
})->name('categories');

// halaman about
Route::get('/about', function () {
    return view('user.about');
})->name('about');

//halaman contact
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');

//halaman FAQ
Route::get('/faq', function () {
    return view('user.faq');
})->name('faq');



//product
Route::prefix('products')->group(function () {
    
    //public
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('search/', [ProductController::class, 'search'])->name('products.search');
    Route::get('/{id}', [ProductController::class, 'show'])->name('product');

    //protected -> khusus kalau sudah login
    Route::middleware(['auth'])->group(function () {
    
        Route::post('/{riceField}/bookmark', [BookmarkController::class, 'store'])->name('product.bookmark');
    
    });
    

});

//bookmark
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::post('/product/{riceField}/bookmark', [BookmarkController::class, 'store'])->name('product.bookmark');
    
    //bookmark
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmarks');
    Route::delete('/bookmark/delete/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmark.delete');
    Route::delete('/product/bookmark/delete/{id}', [BookmarkController::class, 'destroyFromProduct'])->name('product.bookmark.delete');
    

    // halaman histori pakai histori controller
    Route::prefix('/user-history')->group(function () {
        
        Route::get('/', [HistoryController::class, 'index'])->name('user.history');
        Route::delete('/delete/{id}', [HistoryController::class, 'destroy'])->name('user.history.delete');

    });

    // halaman jual pakai sell controller
    Route::prefix('/user-sell')->group(function () {
        
        Route::get('/', [SellController::class, 'index'])->name('user.sell');
        Route::delete('/{riceField}', [SellController::class, 'destroy'])->name('user.sell.delete');
        Route::get('/add', [SellController::class, 'showStore'])->name('user.sell.add');
        Route::post('/', [SellController::class, 'store'])->name('user.sell.store');
        Route::get('/edit/{riceField}', [SellController::class, 'showPut'])->name('user.sell.edit');
        Route::put('/{riceField}', [SellController::class, 'put'])->name('user.sell.update');

        Route::put('/ketersediaan/{riceField}', [SellController::class, 'putKetersediaan'])->name('user.sell.ketersediaan.update');

    });

    // halaman profile profile controller
    Route::prefix('/user-profile')->group(function () {
        
        Route::get('/', [ProfileController::class,'index'])->name('user.profile');
        Route::put('update/profile', [ProfileController::class,'updateProfile'])->name('user.profile.update');
        Route::put('update/password', [ProfileController::class,'updatePassword'])->name('user.profile.update.password');
        Route::delete('/delete', [ProfileController::class,'destroy'])->name('user.profile.delete');
        
        Route::prefix('/social-media')->group(function () {
            
            Route::post('/', [UserSocialMediaController::class, 'store'])->name('user.sosmed.add');
            Route::delete('/{userSocialMedia}', [UserSocialMediaController::class, 'destroy'])->name('user.sosmed.delete');
            Route::put('/{userSocialMedia}', [UserSocialMediaController::class, 'update'])->name('user.sosmed.update');
        
        });
    });

        


});

//profile makelar
Route::get('users/{user:name}', [MakelarProfileController::class, 'index'])->name('makelar.profile');

//Admin
Route::middleware(['auth'])->group(function () {

    Route::prefix('/admin')->middleware('role:admin')->group(function () {
        //dashboard
        Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //region
        Route::get('/regions', [RegionController::class, 'index'])->name('admin.regions');
        Route::post('/regions', [RegionController::class, 'store']);
        Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('admin.regions.delete');
        Route::put('/regions/{region}', [RegionController::class, 'put'])->name('admin.regions.update');
        Route::get('/regions/add', [RegionController::class, 'showStore'])->name('admin.regions.add');
        Route::get('/regions/put/{region}', [RegionController::class, 'showPut'])->name('admin.regions.put');
        Route::get('/regions/search/', [RegionController::class, 'search'])->name('admin.regions.search');

        //irrigation
        Route::get('/irrigations', [IrrigationController::class, 'index'])->name('admin.irrigations');
        Route::post('/irrigations', [IrrigationController::class, 'store']);
        Route::delete('/irrigations/{irrigation}', [IrrigationController::class, 'destroy'])->name('admin.irrigations.delete');
        Route::put('/irrigations/{irrigation}', [IrrigationController::class, 'put'])->name('admin.irrigations.update');
        Route::get('/irrigations/add', [IrrigationController::class, 'showStore'])->name('admin.irrigations.add');
        Route::get('/irrigations/put/{irrigation}', [IrrigationController::class, 'showPut'])->name('admin.irrigations.put');
        Route::get('/irrigations/search/', [IrrigationController::class, 'search'])->name('admin.irrigations.search');

        //vesitge -> bekas
        Route::get('/vestiges', [VestigeController::class, 'index'])->name('admin.vestiges');
        Route::post('/vestiges', [VestigeController::class, 'store']);
        Route::delete('/vestiges/{vestige}', [VestigeController::class, 'destroy'])->name('admin.vestiges.delete');
        Route::put('/vestiges/{vestige}', [VestigeController::class, 'put'])->name('admin.vestiges.update');
        Route::get('/vestiges/add', [VestigeController::class, 'showStore'])->name('admin.vestiges.add');
        Route::get('/vestiges/put/{vestige}', [VestigeController::class, 'showPut'])->name('admin.vestiges.put');
        Route::get('/vestiges/search/', [VestigeController::class, 'search'])->name('admin.vestiges.search');

        //social media
        Route::get('/socialMedias', [SocialMediaController::class, 'index'])->name('admin.socialMedias');
        Route::post('/socialMedias', [SocialMediaController::class, 'store']);
        Route::delete('/socialMedias/{socialMedia}', [SocialMediaController::class, 'destroy'])->name('admin.socialMedias.delete');
        Route::put('/socialMedias/{socialMedia}', [SocialMediaController::class, 'put'])->name('admin.socialMedias.update');
        Route::get('/socialMedias/add', [SocialMediaController::class, 'showStore'])->name('admin.socialMedias.add');
        Route::get('/socialMedias/put/{socialMedia}', [SocialMediaController::class, 'showPut'])->name('admin.socialMedias.put');
        Route::get('/socialMedias/search/', [SocialMediaController::class, 'search'])->name('admin.socialMedias.search');

        //user
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/users', [UserController::class, 'store']);
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');
        Route::put('/users/{user}', [UserController::class, 'put'])->name('admin.users.update');
        Route::get('/users/add', [UserController::class, 'showStore'])->name('admin.users.add');
        Route::get('/users/put/{user}', [UserController::class, 'showPut'])->name('admin.users.put');
        Route::get('/users/search/', [UserController::class, 'search'])->name('admin.users.search');


        //rice field -> sawah
        Route::get('/riceFields', [RiceFieldController::class, 'index'])->name('admin.riceFields');
        Route::post('/riceFields', [RiceFieldController::class, 'store']);
        Route::delete('/riceFields/{riceField}', [RiceFieldController::class, 'destroy'])->name('admin.riceFields.delete');
        Route::put('/riceFields/{riceField}', [RiceFieldController::class, 'put'])->name('admin.riceFields.update');
        Route::get('/riceFields/add', [RiceFieldController::class, 'showStore'])->name('admin.riceFields.add');
        Route::get('/riceFields/put/{riceField}', [RiceFieldController::class, 'showPut'])->name('admin.riceFields.put');
        Route::get('/riceFields/{riceField}', [RiceFieldController::class, 'show'])->name('admin.riceFields.show');

        //verification
        Route::get('/verifications', [VerificationController::class, 'index'])->name('admin.verifications');
        Route::post('/verifications', [VerificationController::class, 'store']);
        Route::delete('/verifications/{verification}', [VerificationController::class, 'destroy'])->name('admin.verifications.delete');
        Route::put('/verifications/{verification}', [VerificationController::class, 'put'])->name('admin.verifications.update');
        Route::get('/verifications/add', [VerificationController::class, 'showStore'])->name('admin.verifications.add');
        Route::get('/verifications/put/{verification}', [VerificationController::class, 'showPut'])->name('admin.verifications.put');
        Route::get('/verifications/search/', [VerificationController::class, 'search'])->name('admin.verifications.search');

        
        Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
            // Route::view('dashboard', 'dashboard')->name('dashboard');
            Route::view('admin.forms', 'admin.forms')->name('forms');
            Route::view('admin.cards', 'admin.cards')->name('cards');
            Route::view('admin.charts', 'admin.charts')->name('charts');
            Route::view('admin.buttons', 'admin.buttons')->name('buttons');
            Route::view('admin.modals', 'admin.modals')->name('modals');
            Route::view('admin.tables', 'admin.tables')->name('tables');
            Route::view('admin.calendar', 'admin.calendar')->name('calendar');
        });
    });

});

//Upload foto sawah
Route::prefix('/riceField/upload')->middleware(['auth'])->group(function () {
    
    Route::post('/add', [RiceFieldPhotoUploadController::class, 'store']);

    Route::delete('/delete', [RiceFieldPhotoUploadController::class, 'destroy']);


});
