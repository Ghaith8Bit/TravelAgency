<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $ratings = Rating::paginate(8);

        return view('dashboard.ratings.index', ['ratings' => $ratings]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Create a new Rating instance
        $rating = new Rating();
        $rating->trip_id = $validatedData['trip_id'];
        $rating->user_id = auth()->user()->id;
        $rating->rating = $validatedData['rating'];

        // Save the rating
        $rating->save();

        // Optionally, you can add a success message or any other additional logic here

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }

    public function showOnBlog(Rating $rating)
    {
        $rating->update([
            'show_on_blog' => $rating->show_on_blog ? 0 : 1,
        ]);

        return redirect()->back()->with('success', 'Rating visibility updated successfully.');
    }

    public function myRatings()
    {
        $user = auth()->user();
        $trips = self::getRateableTrips();
        $ratings = Rating::where('user_id', $user->id)->paginate(10);

        return view('dashboard.ratings.my', ['ratings' => $ratings, 'trips' => $trips]);
    }

    public function getRateableTrips()
    {
        // Get the authenticated user's ID or any identifier for the user
        $userId = auth()->user()->id;

        // Query reservations for the authenticated user with specific conditions
        $reservations = Reservation::where('user_id', $userId)
            ->where('is_paid', 1)
            ->get();

        // Extract the trip IDs of reservations with end dates in the past
        $tripIds = [];
        foreach ($reservations as $reservation) {
            if ($reservation->reservationable_type === 'App\\Models\\Trip') {
                $tripIds[] = $reservation->reservationable_id;
            } elseif ($reservation->reservationable_type === 'App\\Models\\Package') {
                $tripIds[] = $reservation->reservationable->trip->id;
            }
        }

        // Query trips with trip IDs in the past that do not have a rating from the authenticated user
        $trips = Trip::whereDoesntHave('ratings', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->whereIn('id', $tripIds)->where('end_date', '<=', now())->get();

        return $trips;
    }


}
