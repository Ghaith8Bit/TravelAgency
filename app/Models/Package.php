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

    // Get the last three packages
    public static function getLastThreePackages()
    {
        return self::orderBy('created_at', 'desc')->limit(3)->get();
    }

    // accessor to get the price
    public function getPriceAttribute($value)
    {
        return $value . ' SP';
    }
    // accessor to get the people count
    public function getPeopleCountAttribute($value)
    {
        return $value == 1 ? $value . ' person' : $value . ' people';
    }
}
