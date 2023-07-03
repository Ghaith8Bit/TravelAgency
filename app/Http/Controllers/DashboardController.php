<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\Package;
use App\Models\Trip;
use App\Models\User;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $adminCount = User::countAdmins();
        $userCount = User::countUsers();
        $tripCount = Trip::countAllTrips();
        $packageCount = Package::countAllPackages();
        return view('dashboard.home', ['adminCount' => $adminCount, 'userCount' => $userCount, 'tripCount' => $tripCount, 'packageCount' => $packageCount,]);
    }
}
