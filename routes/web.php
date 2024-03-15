<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AbilityController;



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

Route::get('/', function () {
    return view('welcome');
});

// Policy
Route::get('/policy', function () {
    return view('policy');
})->name('policy');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::prefix('pilotes')->group(function () {
        Route::get('/', [UserController::class, 'pilotes'])->name('admin.pilotes.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.pilotes.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.pilotes.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.pilotes.edit');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('admin.pilotes.update');
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('admin.pilotes.destroy');
    });
});

//Entreprise routes

Route::prefix('company')->group(function (){
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/{id}/update', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/{id}/destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');
});


//Offres routes
Route::prefix('offer')->group(function(){
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');
    Route::get('/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/store', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/{id}/update', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/{id}/destroy', [OfferController::class, 'destroy'])->name('offers.destroy');
});

//Abilities routes

Route::prefix('ability')->group(function(){
    Route::get('/', [AbilityController::class, 'index'])->name('abilities.index');
    Route::get('/create',[AbilityController::class, 'create'])->name('abilities.create');
    Route::post('/store', [AbilityController::class, 'store'])->name('abilities.store');
    Route::get('/{id}/edit', [AbilityController::class, 'edit'])->name('abilities.edit');
    Route::put('/{id}/update', [AbilityController::class, 'update'])->name('abilities.update');
    Route::delete('/{id}/destroy', [AbilityController::class, 'destroy'])->name('abilities.destroy');
});