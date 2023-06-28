<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(Request $request)
    {
        $trips = Trip::getLastThreeTrips();
        $packages = Package::getLastThreePackages();
        return view('website.pages.home', ['trips' => $trips, 'packages' => $packages]);
    }
    public function about()
    {
        $tripCount = Trip::countAllTrips();
        $packageCount = Package::countAllPackages();
        $reservationCount = Reservation::countAllReservations();
        return view('website.pages.about', ['tripCount' => $tripCount, 'packageCount' => $packageCount, 'reservationCount' => $reservationCount]);
    }
    public function contact()
    {
        return view('website.pages.contact');
    }

    public function gallery()
    {
        return view('website.pages.gallery');
    }
}
