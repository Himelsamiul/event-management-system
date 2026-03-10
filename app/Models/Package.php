<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded=[];
    
   //  public function event()
   //  {
   //     return $this->belongsTo(Event::class);
   //  }

   //  public function service()
   //  {
   //     return $this->hasMany(Service::class);
   //  }
 

    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_service');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function packageServices()
    {
        return $this->hasMany(PackageService::class, 'package_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
