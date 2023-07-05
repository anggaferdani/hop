<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\LodgingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FoodAndBeverageController;

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

Route::middleware(['web', 'disableBackButton'])->group(function(){
    Route::middleware(['disableRedirectToLoginPage'])->group(function(){
        Route::get('login', [Controller::class, 'login'])->name('login');
        Route::post('post-login', [Controller::class, 'postLogin'])->name('post-login');
    });

    Route::get('logout', [Controller::class, 'logout'])->name('logout');
});

Route::prefix('superadmin')->name('superadmin.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'superadmin'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
        Route::resource('admin', AdminController::class);
        Route::resource('tag', TagController::class);
        Route::resource('update', UpdateController::class);
        Route::get('update/{id}', [UpdateController::class, 'deleteImage'])->name('update.delete-image');
        Route::resource('type', TypeController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/delete-image/{id}', [AgendaController::class, 'deleteImage'])->name('agenda.delete-image');
        Route::resource('food-and-beverage', FoodAndBeverageController::class);
        Route::get('food-and-beverage/delete-image/{id}', [FoodAndBeverageController::class, 'deleteImage'])->name('food-and-beverage.delete-image');
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('lodging', LodgingController::class);
        Route::get('lodging/delete-image/{id}', [LodgingController::class, 'deleteImage'])->name('lodging.delete-image');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'admin'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
        Route::resource('tag', TagController::class);
        Route::resource('update', UpdateController::class);
        Route::get('update/{id}', [UpdateController::class, 'deleteImage'])->name('update.delete-image');
        Route::resource('type', TypeController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/delete-image/{id}', [AgendaController::class, 'deleteImage'])->name('agenda.delete-image');
        Route::resource('food-and-beverage', FoodAndBeverageController::class);
        Route::get('food-and-beverage/delete-image/{id}', [FoodAndBeverageController::class, 'deleteImage'])->name('food-and-beverage.delete-image');
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('lodging', LodgingController::class);
        Route::get('lodging/delete-image/{id}', [LodgingController::class, 'deleteImage'])->name('lodging.delete-image');
    });
});

Route::prefix('vendor')->name('vendor.')->group(function(){
    Route::middleware(['auth:web', 'disableBackButton', 'vendor'])->group(function(){
        Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');
    });
});