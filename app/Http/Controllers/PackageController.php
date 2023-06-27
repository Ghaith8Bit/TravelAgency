<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function index(Request $request)
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




    public function show(Package $package)
    {
        return view('website.pages.packages.show', ['package' => $package]);
    }

}
