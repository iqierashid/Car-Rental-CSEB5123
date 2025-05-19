<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // app/Models/Booking.php
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];
    public function cars()
    {
        return $this->belongsToMany(Car::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
