<?php

use App\Http\Controllers\BlogController;
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
});
