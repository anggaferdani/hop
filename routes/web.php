<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\LodgingController;
use App\Http\Controllers\SeatingController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\FoodAndBeverageController;
use App\Http\Controllers\ActivityManajemenController;
use App\Http\Controllers\EntertaimentController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PublicAreaController;
use App\Http\Controllers\ScannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/index', [FrontController::class, 'index'])->name('index');
Route::get('/updates', [FrontController::class, 'updates'])->name('updates');
Route::get('/update/{slug}', [FrontController::class, 'update'])->name('update');
Route::get('/tags/{slug}', [FrontController::class, 'tags'])->name('tags');
Route::get('/agendas', [FrontController::class, 'agendas'])->name('agendas');
Route::get('/agenda/{slug}', [FrontController::class, 'agenda'])->name('agenda');
Route::get('/sportstainments', [FrontController::class, 'sportainments'])->name('sportainments');
Route::get('/sportstainment/{slug}', [FrontController::class, 'sportainment'])->name('sportainment');
Route::get('/resto-and-cafes', [FrontController::class, 'food_and_beverages'])->name('food-and-beverages');
Route::get('/resto-and-cafe/{slug}', [FrontController::class, 'food_and_beverage'])->name('food-and-beverage');
Route::get('/hotels', [FrontController::class, 'lodgings'])->name('lodgings');
Route::get('/hotel/{slug}', [FrontController::class, 'lodging'])->name('lodging');
Route::get('/public-areas', [FrontController::class, 'public_areas'])->name('public-areas');
Route::get('/public-area/{slug}', [FrontController::class, 'public_area'])->name('public-area');
Route::get('/communitys', [FrontController::class, 'activity_manajemens'])->name('activity-manajemens');
Route::get('/community/{slug}', [FrontController::class, 'activity_manajemen'])->name('activity-manajemen');
Route::get('/kategoris/{slug}', [FrontController::class, 'kategoris'])->name('kategoris');
Route::get('/about-us', [FrontController::class, 'about_us'])->name('about-us');
Route::get('/autocomplete', [FrontController::class, 'autocomplete'])->name('autocomplete');
Route::post('/search', [FrontController::class, 'search'])->name('search');
Route::get('/pendaftar/search', [ScannerController::class, 'search'])->name('pendaftar.search');

Route::get('/kabupaten/{id}', [LokasiController::class, 'kabupaten'])->name('kabupaten');
Route::get('/kecamatan/{id}', [LokasiController::class, 'kecamatan'])->name('kecamatan');

Route::middleware(['web', 'disableBackButton'])->group(function(){
    Route::middleware(['disableRedirectToLoginPage'])->group(function(){
        Route::get('login', [Controller::class, 'login'])->name('login');
        Route::post('post-login', [Controller::class, 'postLogin'])->name('post-login');
        Route::get('register', [Controller::class, 'register'])->name('register');
        Route::post('post-register2', [Controller::class, 'postRegister'])->name('post-register2');

        Route::get('share/udpate/{id}', [FrontController::class, 'udpate'])->name('share.udpate');
    });
    
    Route::get('confirmation/{email}', [Controller::class, 'confirmation'])->name('confirmation');
    Route::get('verifikasi/{user_id}', [Controller::class, 'verifikasi'])->name('verifikasi');
    Route::post('post-register', [DaftarController::class, 'postRegister'])->name('post-register');
    Route::get('logout', [Controller::class, 'logout'])->name('logout');
});

Route::prefix('superadmin')->name('superadmin.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'superadmin'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('post-profile', [Controller::class, 'postProfile'])->name('post-profile');
        Route::resource('admin', AdminController::class);
        Route::resource('vendor', VendorController::class);
        Route::get('vendor/pulihkan/{id}', [VendorController::class, 'pulihkan'])->name('vendor.pulihkan');
        Route::resource('tag', TagController::class);
        Route::resource('update', UpdateController::class);
        Route::get('update/delete-image/{id}', [UpdateController::class, 'deleteImage'])->name('update.delete-image');
        Route::resource('type', TypeController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/{agenda_id}/pendaftar/', [PendaftarController::class, 'index'])->name('pendaftar.index');
        Route::get('agenda/delete-image/{id}', [AgendaController::class, 'deleteImage'])->name('agenda.delete-image');
        Route::resource('food-and-beverage', FoodAndBeverageController::class);
        Route::resource('seating', SeatingController::class);
        Route::resource('feature', FeatureController::class);
        Route::resource('entertaiment', EntertaimentController::class);
        Route::get('food-and-beverage/delete-image/{id}', [FoodAndBeverageController::class, 'deleteImage'])->name('food-and-beverage.delete-image');
        Route::get('food-and-beverage/delete-logo/{id}', [FoodAndBeverageController::class, 'deleteLogo'])->name('food-and-beverage.delete-logo');
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('lodging', LodgingController::class);
        Route::get('lodging/delete-image/{id}', [LodgingController::class, 'deleteImage'])->name('lodging.delete-image');
        Route::resource('kategori', KategoriController::class);
        Route::resource('activity-manajemen', ActivityManajemenController::class);
        Route::get('activity-manajemen/delete-image/{id}', [ActivityManajemenController::class, 'deleteImage'])->name('activity-manajemen.delete-image');
        Route::resource('public-area', PublicAreaController::class);
        Route::get('public-area/delete-image/{id}', [PublicAreaController::class, 'deleteImage'])->name('public-area.delete-image');
        Route::resource('banner', BannerController::class);
        Route::get('banner/kosongkan/{id}', [BannerController::class, 'kosongkan'])->name('banner.kosongkan');
        Route::get('scanner', [ScannerController::class, 'scanner'])->name('scanner');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'admin'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('post-profile', [Controller::class, 'postProfile'])->name('post-profile');
        Route::resource('vendor', VendorController::class);
        Route::get('vendor/pulihkan/{id}', [VendorController::class, 'pulihkan'])->name('vendor.pulihkan');
        Route::resource('tag', TagController::class);
        Route::resource('update', UpdateController::class);
        Route::get('update/delete-image/{id}', [UpdateController::class, 'deleteImage'])->name('update.delete-image');
        Route::resource('type', TypeController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/{agenda_id}/pendaftar/', [PendaftarController::class, 'index'])->name('pendaftar.index');
        Route::get('agenda/delete-image/{id}', [AgendaController::class, 'deleteImage'])->name('agenda.delete-image');
        Route::resource('food-and-beverage', FoodAndBeverageController::class);
        Route::resource('seating', SeatingController::class);
        Route::resource('feature', FeatureController::class);
        Route::resource('entertaiment', EntertaimentController::class);
        Route::get('food-and-beverage/delete-image/{id}', [FoodAndBeverageController::class, 'deleteImage'])->name('food-and-beverage.delete-image');
        Route::get('food-and-beverage/delete-logo/{id}', [FoodAndBeverageController::class, 'deleteLogo'])->name('food-and-beverage.delete-logo');
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('lodging', LodgingController::class);
        Route::get('lodging/delete-image/{id}', [LodgingController::class, 'deleteImage'])->name('lodging.delete-image');
        Route::resource('kategori', KategoriController::class);
        Route::resource('activity-manajemen', ActivityManajemenController::class);
        Route::get('activity-manajemen/delete-image/{id}', [ActivityManajemenController::class, 'deleteImage'])->name('activity-manajemen.delete-image');
        Route::resource('public-area', PublicAreaController::class);
        Route::get('public-area/delete-image/{id}', [PublicAreaController::class, 'deleteImage'])->name('public-area.delete-image');
        Route::resource('banner', BannerController::class);
        Route::get('banner/kosongkan/{id}', [BannerController::class, 'kosongkan'])->name('banner.kosongkan');
        Route::get('scanner', [ScannerController::class, 'scanner'])->name('scanner');
    });
});

Route::prefix('vendor')->name('vendor.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'vendor'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
        Route::get('profile', [Controller::class, 'profile'])->name('profile');
        Route::put('post-profile', [Controller::class, 'postProfile'])->name('post-profile');
        Route::resource('activity-manajemen', ActivityManajemenController::class);
        Route::get('activity-manajemen/delete-image/{id}', [ActivityManajemenController::class, 'deleteImage'])->name('activity-manajemen.delete-image');
    });
});