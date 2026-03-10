<?php

namespace App\Models;

use App\Models\Event;
use App\Models\CustomizeBooking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeFood extends Model
{
    use HasFactory;
    protected $table = 'customize_foods';
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function customizeBookings()
    {
        return $this->belongsToMany(CustomizeBooking::class, 'customize_booking_food');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
