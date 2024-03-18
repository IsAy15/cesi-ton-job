<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AbilityController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradeController;



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

//Users routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');


//Grades routes
Route::prefix('grade')->group(function(){
    Route::get('/', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/{id}/update', [GradeController::class, 'update'])->name('grades.update');
    Route::delete('/{id}/destroy', [GradeController::class, 'destroy'])->name('grades.destroy');
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

// Admin routes
Route::prefix('admin')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'users'])->name('admin.users.index');
    });
    Route::prefix('pilotes')->group(function () {
        Route::get('/', [UserController::class, 'pilotes'])->name('admin.pilotes.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.pilotes.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.pilotes.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.pilotes.edit');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('admin.pilotes.update');
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('admin.pilotes.destroy');
    });
});


//Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'dologin'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/register/confirmation', function () { return view('auth.confirmation');})->name('registration.confirmation');

// User routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/admin/users', [UserController::class, 'users'])->name('admin.users.index');


//Entreprise routes
Route::prefix('company')->group(function (){
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/{id}/update', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/{id}/destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');
    Route::get('/{id}/stats', [CompanyController::class, 'stats'])->name('companies.stats');
});




//Offres routes
Route::prefix('offer')->group(function(){
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');
    Route::get('/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/store', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/{id}/update', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/{id}/destroy', [OfferController::class, 'destroy'])->name('offers.destroy');
    Route::get('/{id}/apply', [OfferController::class, 'apply'])->name('offers.apply');
});



//Policy
Route::get('/policy', function () {
    return view('policy');
})->name('policy');

//Promotions routes
Route::prefix('promotion')->group(function(){
    Route::get('/', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/store', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/{id}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/{id}/update', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/{id}/destroy', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::get('/{id}/users', [PromotionController::class, 'showUsers'])->name('promotions.users');
});


