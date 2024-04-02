<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AbilityController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;




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
})->name('welcome');

//Policy
Route::get('/policy', function () {
    return view('policy');
})->name('policy');


//Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//About
Route::get('/about', function () {
    return view('about');
})->name('about');


//Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'dologin'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'doregister'])->name('auth.register');
Route::get('/register/confirmation', [AuthController::class, 'confirmation'])->name('auth.confirmation');


Route::middleware('auth')->group(function(){

Route::post('/wishlist/add/{offer}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{offerId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');


//Profiles routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/add', [ProfileController::class, 'add'])->name('profile.add');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile/offers', [ProfileController::class, 'offers'])->name('profile.offers');
Route::get('/profile/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
Route::get('/profile/pending', [ProfileController::class, 'pending'])->name('profile.pending');
Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');


//Offres routes
Route::prefix('offer')->group(function(){
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');
    Route::get('/stats', [OfferController::class, 'stats'])->name('offers.stats');
    Route::get('/create', [OfferController::class, 'create'])->name('offers.create');
    Route::get('/{id}', [OfferController::class, 'show'])->name('offers.show');
    Route::post('/store', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/{id}/update', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/{id}/destroy', [OfferController::class, 'destroy'])->name('offers.destroy');
    Route::post('/{id}/apply', [OfferController::class, 'apply'])->name('offers.apply');
});



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






// User routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');


//Entreprise routes
Route::prefix('company')->group(function (){
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/{id}/update', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/{id}/destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');
    Route::get('/{id}/data', [CompanyController::class, 'data'])->name('companies.data');
    Route::post('/rate', [CompanyController::class, 'rate'])->name('companies.rate');
    Route::get('/stats', [CompanyController::class, 'stats'])->name('companies.stats');
});

//Promotions routes
Route::prefix('promotion')->group(function(){
    Route::get('/', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/store', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/{id}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/{id}/update', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/{id}/destroy', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::get('/{id}/users', [PromotionController::class, 'showUsers'])->name('promotions.users');
    Route::get('/{id}/addUser', [PromotionController::class, 'addUser'])->name('promotions.addUser');
    Route::post('/{id}/addUser', [PromotionController::class, 'storeUser'])->name('promotions.storeUser');
    Route::delete('/{id}/removeUser/{userId}', [PromotionController::class, 'removeUser'])->name('promotions.removeUser');
});

});




