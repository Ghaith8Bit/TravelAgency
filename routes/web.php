<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
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
        Route::get('/', [WebsiteController::class, 'blogs'])->name('index');
    });
    Route::prefix('trips')->name('trips.')->group(function () {
        Route::get('/', [WebsiteController::class, 'trips'])->name('index');
        Route::get('/{trip}', [WebsiteController::class, 'trip'])->name('show');
    });
    Route::prefix('packages')->name('packages.')->group(function () {
        Route::get('/', [WebsiteController::class, 'packages'])->name('index');
        Route::get('/{package}', [WebsiteController::class, 'package'])->name('show');
    });
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::post('send', [WebsiteController::class, 'send'])->name('send');
    });
    Route::prefix('reservations/store')->name('reservations.store.')->middleware('auth')->group(function () {
        Route::post('trip/{trip}', [WebsiteController::class, 'storeTrip'])->name('trip');
        Route::post('package/{package}', [WebsiteController::class, 'storePackage'])->name('package');
    });
});

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/home', [DashboardController::class, '__invoke'])->name('home');
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update-name', [ProfileController::class, 'updateName'])->name('updateName');
        Route::patch('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    });
    Route::prefix('users')->name('users.')->middleware('admin')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/role', [UserController::class, 'role'])->name('role');

    });
    Route::prefix('trips')->name('trips.')->middleware('admin')->group(function () {
        Route::get('/', [TripController::class, 'index'])->name('index');
        Route::get('/{trip}', [TripController::class, 'show'])->name('show');
        Route::post('/', [TripController::class, 'store'])->name('store');
        Route::put('/{trip}', [TripController::class, 'update'])->name('update');
        Route::delete('/{trip}', [TripController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('packages')->name('packages.')->middleware('admin')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('index');
        Route::get('/{package}', [PackageController::class, 'show'])->name('show');
        Route::post('/', [PackageController::class, 'store'])->name('store');
        Route::put('/{package}', [PackageController::class, 'update'])->name('update');
        Route::delete('/{package}', [PackageController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('ratings')->name('ratings.')->middleware('admin')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::patch('/{rating}/show-on-blog', [BlogController::class, 'showOnBlog'])->name('showOnBlog');
    });
    Route::prefix('contacts')->name('contacts.')->middleware('admin')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
    });
    Route::prefix('reservations')->name('reservations.')->middleware('admin')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        Route::patch('/{reservation}/is_paid', [ReservationController::class, 'isPaid'])->name('isPaid');
    });
});
