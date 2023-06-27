<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $trips = Trip::getUpcomingTrips();

        if ($request->filled('start-date') || $request->filled('end-date') || $request->filled('price-min') || $request->filled('price-max')) {
            $startDate = $request->input('start-date');
            $endDate = $request->input('end-date');
            $priceMin = $request->input('price-min');
            $priceMax = $request->input('price-max');

            // Apply the filters to the trips query
            if ($startDate) {
                $trips = $trips->where('start_date', '>=', Carbon::parse($startDate)->toDateString());
            }
            if ($endDate) {
                $trips = $trips->where('end_date', '<=', Carbon::parse($endDate)->toDateString());
            }
            if ($priceMin) {
                $trips = $trips->where('price', '>=', $priceMin);
            }
            if ($priceMax) {
                $trips = $trips->where('price', '<=', $priceMax);
            }
        }

        return view('website.pages.trips.index', ['trips' => $trips]);
    }


    public function show(Trip $trip)
    {
        return view('website.pages.trips.show', ['trip' => $trip]);
    }
}
