<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Trip;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(8);
        $trips = Trip::getUpcomingTrips();

        return view('dashboard.packages.index', ['packages' => $packages, 'trips' => $trips]);
    }

    public function show(Package $package)
    {
        return view('dashboard.packages.show', ['package' => $package]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'people_count' => 'required|integer',
            'price' => 'required|numeric',
            'trip_id' => 'required|exists:trips,id',
        ]);

        $trip = Trip::find($request->trip_id);

        if (!$trip) {
            return redirect()->route('dashboard.packages.index')->with('error', 'Selected trip does not exist.');
        }

        $package = new Package();
        $package->people_count = $request->people_count;
        $package->price = $request->price;
        $package->trip_id = $request->trip_id;
        $package->save();

        return redirect()->route('dashboard.packages.index')->with('success', 'Package created successfully.');
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'people_count' => 'required|integer',
            'price' => 'required|numeric',
            'trip_id' => 'required|exists:trips,id',
        ]);

        if (!$package) {
            return redirect()->back()->with('error', 'Package does not exist.');
        }

        $package->people_count = $request->people_count;
        $package->price = $request->price;
        $package->trip_id = $request->trip_id;
        $package->save();

        return redirect()->back()->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        if (!$package) {
            return redirect()->back()->with('error', 'Package does not exist.');
        }

        $package->delete();

        return redirect()->back()->with('success', 'Package deleted successfully.');
    }
}
