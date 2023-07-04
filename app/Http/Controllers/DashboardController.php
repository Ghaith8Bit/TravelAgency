<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\Package;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        if (auth()->user()->isAdmin()) {
            $adminCount = User::countAdmins();
            $userCount = User::countUsers();
            $tripCount = Trip::countAllTrips();
            $packageCount = Package::countAllPackages();
            return view('dashboard.home', ['adminCount' => $adminCount, 'userCount' => $userCount, 'tripCount' => $tripCount, 'packageCount' => $packageCount]);
        } elseif (auth()->user()->isUser()) {
            $reservationCount = Reservation::where('user_id', auth()->user()->id)->count();
            $ratingCount = Rating::where('user_id', auth()->user()->id)->count();
            return view('dashboard.home', ['reservationCount' => $reservationCount, 'ratingCount' => $ratingCount]);
        } else {
            return abort(403);
        }
    }
}
