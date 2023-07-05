<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_count',
        'price',
        'trip_id'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservationable');
    }

    // Get the last three packages
    public static function getLastThreePackages()
    {
        return self::getUpcomingPackages()->take(3);
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
    // Accessor to get the people count
    public function getPeopleCountAttribute($value)
    {
        if (LaravelLocalization::getCurrentLocale() == 'en') {
            $unit = $value == 1 ? ' person' : ' people';
        } else {
            $unit = $value == 1 ? ' شخص' : ' أشخاص';
        }
        return $value . $unit;
    }

    // Count of all packages
    public static function countAllPackages()
    {
        return self::count();
    }

    // Get the upcoming packages
    public static function getUpcomingPackages()
    {
        return self::with('trip')->whereHas('trip', function ($query) {
            $query->where('start_date', '>=', now());
        })->get();
    }
}
