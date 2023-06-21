<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
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

    // Filter trips by name
    public static function filterByName($name)
    {
        return self::where('name', 'like', "%$name%")->get();
    }

    // Get the last three trips
    public static function getLastThreeTrips()
    {
        return self::orderBy('created_at', 'desc')->limit(3)->get();
    }
}
