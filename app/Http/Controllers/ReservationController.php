<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
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
