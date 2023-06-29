<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Package;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $trips = Trip::all();
        return view('website.pages.gallery', ['trips' => $trips]);
    }

    public function trips(Request $request)
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

    public function trip(Trip $trip)
    {
        return view('website.pages.trips.show', ['trip' => $trip]);
    }

    public function packages(Request $request)
    {
        $packages = Package::getUpcomingPackages();

        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
        $priceMin = (float) $request->input('price-min');
        $priceMax = (float) $request->input('price-max');

        if (!$startDate) {
            $startDate = '0001-01-01'; // Assuming the smallest possible date
        }

        if (!$endDate) {
            $endDate = '9999-12-31'; // Assuming the largest possible date
        }

        if (!$priceMin) {
            $priceMin = 0; // Assuming the smallest possible price
        }

        if (!$priceMax) {
            $priceMax = PHP_INT_MAX; // Assuming the largest possible price
        }

        $packages = $packages->reject(function ($package) use ($startDate, $endDate, $priceMin, $priceMax) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $tripStartDate = Carbon::parse($package->trip->start_date)->startOfDay();
            $packagePrice = (float) $package->price;

            return ($tripStartDate->isBefore($start) || $tripStartDate->isAfter($end)) || ((float) $packagePrice < (float) $priceMin || (float) $packagePrice > (float) $priceMax);
        });

        return view('website.pages.packages.index', ['packages' => $packages]);
    }
    public function package(Package $package)
    {
        return view('website.pages.packages.show', ['package' => $package]);
    }

    public function send(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('toastify', [
                'text' => 'Message has errors. Please check if all fields are not empty and correct.',
                'className' => 'error',
            ])->withInput();
        }

        // Create a new contact record
        Contact::create([
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('toastify', [
            'text' => 'Message sent successfully.',
            'className' => 'success',
        ])->withInput();
    }

    public function blogs()
    {
        $ratings = Rating::getRatingWithTripAndUser();
        return view('website.pages.blogs.index', ['ratings' => $ratings]);
    }

    public function storeTrip(Request $request, Trip $trip)
    {

        if (auth()->user()->isAdmin()) {
            return redirect()->route('website.home')->with('toastify', [
                'text' => 'Trip reservation can not be created from admin.',
                'className' => 'error',
            ]);
        }

        // Create a new reservation for the trip
        Reservation::create([
            'user_id' => auth()->user()->id,
            'reservationable_id' => $trip->id,
            'reservationable_type' => Trip::class,
        ]);

        return redirect()->route('website.home')->with('toastify', [
            'text' => 'Trip reservation created successfully.',
            'className' => 'success',
        ]);
    }

    public function storePackage(Request $request, Package $package)
    {

        if (auth()->user()->isAdmin()) {
            return redirect()->route('website.home')->with('toastify', [
                'text' => 'Package reservation can not be created from admin.',
                'className' => 'error',
            ]);
        }

        // Create a new reservation for the package
        Reservation::create([
            'user_id' => auth()->user()->id,
            'reservationable_id' => $package->id,
            'reservationable_type' => Package::class,
        ]);

        return redirect()->route('website.home')->with('toastify', [
            'text' => 'Package reservation created successfully.',
            'className' => 'success',
        ]);
    }
}
