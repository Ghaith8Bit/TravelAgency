<?php

namespace App\Http\Controllers;

use App\Models\Package;
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
        return view('website.pages.about');
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
