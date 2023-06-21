<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::getUpcomingTrips();
        return view('website.pages.trips.index', ['trips' => $trips]);
    }

    public function show(Trip $trip)
    {
        return view('website.pages.trips.show', ['trip' => $trip]);
    }
}
