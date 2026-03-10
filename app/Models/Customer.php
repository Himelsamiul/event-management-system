<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    // public function customer()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function package()
    // {
    //     return $this->belongsTo(Package::class);
    // }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
