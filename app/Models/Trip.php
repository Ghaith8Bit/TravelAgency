<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservationable');
    }

    // Filter trips by price range
    public static function filterByPriceRange($minPrice, $maxPrice)
    {
        return self::whereBetween('price', [$minPrice, $maxPrice])->get();
    }

    // Filter trips by start date
    public static function filterByStartDate($startDate)
    {
        return self::where('start_date', '>=', $startDate)->get();
    }

    // Filter trips by end date
    public static function filterByEndDate($endDate)
    {
        return self::where('end_date', '<=', $endDate)->get();
    }

    // Filter trips by date range
    public static function filterByDateRange($startDate, $endDate)
    {
        return self::whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->get();
    }

    // Filter trips by name
    public static function filterByName($name)
    {
        return self::where('name', 'like', "%$name%")->get();
    }

    // Get the last three trips
    public static function getLastThreeTrips()
    {
        return self::getUpcomingTrips()->take(3);
    }

    // Get the upcoming trips
    public static function getUpcomingTrips()
    {
        return self::where('start_date', '>', now())->get();
    }


    // Create trip
    public static function addNewTrip($data)
    {
        // Check if the user is an admin
        if (!auth()->user()->isAdmin()) {
            return false;
        }

        // Cast start_date and end_date to Carbon instances
        $data['start_date'] = Carbon::parse($data['start_date']);
        $data['end_date'] = Carbon::parse($data['end_date']);

        // Check if the start date is not in the past
        if ($data['start_date']->isPast()) {
            return false;
        }

        // Check if the end date is not before the start date
        if ($data['end_date']->isBefore($data['start_date'])) {
            return false;
        }

        // Create the new trip
        Trip::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return true;
    }

    // Get duration of the trip
    public function getTripDurationInDays(): int
    {
        $startDate = $this->start_date;
        $endDate = $this->end_date;

        // Calculate the duration in days
        $duration = $startDate->diff($endDate)->days;

        return $duration;
    }

    // Get rating of trip
    public function averageRating()
    {
        return ceil($this->ratings()->avg('rating'));
    }

    // Accessor to get the price
    public function getPriceAttribute($value)
    {
        if (LaravelLocalization::getCurrentLocale() == 'en') {
            $unit = ' S.P';
        } else {
            $unit = ' ل.س';
        }
        return $value . $unit;
    }

    // Count of all trips
    public static function countAllTrips()
    {
        return self::count();
    }
}
