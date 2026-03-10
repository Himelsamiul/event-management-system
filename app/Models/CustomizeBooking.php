<?php

namespace App\Models;

use App\Models\CustomizeDecoration;
use App\Models\CustomizeFood;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeBooking extends Model
{
    use HasFactory;
    protected $table = 'customize_bookings';
    protected $guarded=[];

    public function foods()
    { 
        return $this->belongsToMany(CustomizeFood::class, 'customize_booking_food', 'customize_booking_id', 'food_id');
    }

    public function decorations()
    {
        return $this->belongsToMany(CustomizeDecoration::class, 'customize_booking_decoration', 'customize_booking_id', 'decoration_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }

    public function customer()
    {
       return $this->belongsTo(Customer::class);
    }
}
