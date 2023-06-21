<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating',
        'trip_id',
        'user_id',
        'show_on_blog'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getRatingWithTripAndUser()
    {
        return self::with('trip', 'user')->where('show_on_blog', true)->get();
    }


}
