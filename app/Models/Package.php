<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return self::orderBy('created_at', 'desc')->limit(3)->get();
    }

    // Accessor to get the price
    public function getPriceAttribute($value)
    {
        return $value . ' SP';
    }
    // Accessor to get the people count
    public function getPeopleCountAttribute($value)
    {
        return $value == 1 ? $value . ' person' : $value . ' people';
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
