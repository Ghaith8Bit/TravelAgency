<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
            $message = app()->getLocale() === 'ar' ? 'الرحلة غير موجودة' : 'Trip not exists.';
            return redirect()->back()->with('error', $message);
        }

        $package = new Package();
        $package->people_count = $request->people_count;
        $package->price = $request->price;
        $package->trip_id = $request->trip_id;
        $package->save();

        $message = app()->getLocale() === 'ar' ? 'تم إنشاء الحزمة بنجاح.' : 'Package created successfully.';

        return redirect()->route('dashboard.packages.index')->with('success', $message);
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'people_count' => 'required|integer',
            'price' => 'required|numeric',
            'trip_id' => 'required|exists:trips,id',
        ]);

        if (!$package) {
            $message = app()->getLocale() === 'ar' ? 'الحزمة غير موجودة' : 'Package not exists.';
            return redirect()->back()->with('error', $message);
        }

        $package->people_count = $request->people_count;
        $package->price = $request->price;
        $package->trip_id = $request->trip_id;
        $package->save();

        $message = app()->getLocale() === 'ar' ? 'تم تحديث الحزمة بنجاح.' : 'Package updated successfully.';

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Package $package)
    {
        if (!$package) {
            $message = app()->getLocale() === 'ar' ? 'الحزمة غير موجودة' : 'Package not exists.';
            return redirect()->back()->with('error', $message);
        }

        $package->delete();

        $message = app()->getLocale() === 'ar' ? 'تم حذف الحزمة بنجاح.' : 'Package deleted successfully.';

        return redirect()->back()->with('success', $message);
    }
}
