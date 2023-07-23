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
Route::get('/update/{id}', [FrontController::class, 'update'])->name('update');
Route::get('/tags/{id}', [FrontController::class, 'tags'])->name('tags');
Route::get('/agendas', [FrontController::class, 'agendas'])->name('agendas');
Route::get('/agenda/{id}', [FrontController::class, 'agenda'])->name('agenda');
Route::get('/food-and-beverages', [FrontController::class, 'food_and_beverages'])->name('food-and-beverages');
Route::get('/food-and-beverage/{id}', [FrontController::class, 'food_and_beverage'])->name('food-and-beverage');
Route::get('/lodgings', [FrontController::class, 'lodgings'])->name('lodgings');
Route::get('/lodging/{id}', [FrontController::class, 'lodging'])->name('lodging');
Route::get('/activity-manajemens', [FrontController::class, 'activity_manajemens'])->name('activity-manajemens');
Route::get('/activity-manajemen/{id}', [FrontController::class, 'activity_manajemen'])->name('activity-manajemen');
Route::get('/kategoris/{id}', [FrontController::class, 'kategoris'])->name('kategoris');
Route::get('/about-us', [FrontController::class, 'about_us'])->name('about-us');
Route::get('/autocomplete', [FrontController::class, 'autocomplete'])->name('autocomplete');
Route::post('/search', [FrontController::class, 'search'])->name('search');

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
        Route::resource('admin', AdminController::class);
        Route::resource('vendor', VendorController::class);
        Route::resource('tag', TagController::class);
        Route::resource('update', UpdateController::class);
        Route::get('update/dalata-image/{id}', [UpdateController::class, 'deleteImage'])->name('update.delete-image');
        Route::resource('type', TypeController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/{agenda_id}/pendaftar/', [PendaftarController::class, 'index'])->name('pendaftar.index');
        Route::get('agenda/delete-image/{id}', [AgendaController::class, 'deleteImage'])->name('agenda.delete-image');
        Route::resource('food-and-beverage', FoodAndBeverageController::class);
        Route::resource('seating', SeatingController::class);
        Route::get('food-and-beverage/delete-image/{id}', [FoodAndBeverageController::class, 'deleteImage'])->name('food-and-beverage.delete-image');
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('lodging', LodgingController::class);
        Route::get('lodging/delete-image/{id}', [LodgingController::class, 'deleteImage'])->name('lodging.delete-image');
        Route::resource('kategori', KategoriController::class);
        Route::resource('activity-manajemen', ActivityManajemenController::class);
        Route::get('activity-manajemen/delete-image/{id}', [ActivityManajemenController::class, 'deleteImage'])->name('activity-manajemen.delete-image');
        Route::resource('banner', BannerController::class);
        Route::get('banner/kosongkan/{id}', [BannerController::class, 'kosongkan'])->name('banner.kosongkan');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'admin'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
        Route::resource('vendor', VendorController::class);
        Route::resource('tag', TagController::class);
        Route::resource('update', UpdateController::class);
        Route::get('update/dalata-image/{id}', [UpdateController::class, 'deleteImage'])->name('update.delete-image');
        Route::resource('type', TypeController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/{agenda_id}/pendaftar/', [PendaftarController::class, 'index'])->name('pendaftar.index');
        Route::get('agenda/delete-image/{id}', [AgendaController::class, 'deleteImage'])->name('agenda.delete-image');
        Route::resource('food-and-beverage', FoodAndBeverageController::class);
        Route::resource('seating', SeatingController::class);
        Route::get('food-and-beverage/delete-image/{id}', [FoodAndBeverageController::class, 'deleteImage'])->name('food-and-beverage.delete-image');
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('lodging', LodgingController::class);
        Route::get('lodging/delete-image/{id}', [LodgingController::class, 'deleteImage'])->name('lodging.delete-image');
        Route::resource('kategori', KategoriController::class);
        Route::resource('activity-manajemen', ActivityManajemenController::class);
        Route::get('activity-manajemen/delete-image/{id}', [ActivityManajemenController::class, 'deleteImage'])->name('activity-manajemen.delete-image');
        Route::resource('banner', BannerController::class);
        Route::get('banner/kosongkan/{id}', [BannerController::class, 'kosongkan'])->name('banner.kosongkan');
    });
});

Route::prefix('vendor')->name('vendor.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'vendor'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
    });
});