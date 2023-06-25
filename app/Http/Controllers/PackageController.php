<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::getUpcomingPackages();
        return view('website.pages.packages.index', ['packages' => $packages]);
    }

    public function show(Package $package)
    {
        return view('website.pages.packages.show', ['package' => $package]);
    }

}
