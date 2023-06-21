<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('website.home');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/authentication', [AuthController::class, 'authentication'])->name('authentication');
        Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
        Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    });
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
Route::prefix('website')->name('website.')->group(function () {
    Route::get('/home', [WebsiteController::class, 'home'])->name('home');
    Route::get('/about', [WebsiteController::class, 'about'])->name('about');
    Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
    Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/{blog}', [BlogController::class, 'show'])->name('show');
    });
    Route::prefix('trips')->name('trips.')->group(function () {
        Route::get('/', [TripController::class, 'index'])->name('index');
        Route::get('/{trip}', [TripController::class, 'show'])->name('show');
    });
    Route::prefix('packages')->name('packages.')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('index');
        Route::get('/{package}', [PackageController::class, 'show'])->name('show');
    });
});
