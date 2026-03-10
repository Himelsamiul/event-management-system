<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Package_service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   use HasFactory;
   protected $guarded = [];
   protected $table = 'booking';

   //  public function event()
   //  {
   //     return $this->belongsTo(Event::class); 
   //  }

   //  public function service()
   //  {

   //     return $this->belongsTo(Service::class);
   //  }

   //  public function package()
   //  {
   //     return $this->belongsTo(Package::class);
   //  }

   //  public function package_service()
   //  {
   //     return $this->belongsTo(Package_service::class);
   //  }
   public function customer()
   {
      return $this->belongsTo(Customer::class);
   }

   public function package()
   {
      return $this->belongsTo(Package::class);
   }

   // public function event()
   // {
   //    return $this->belongsTo(Event::class);
   // }
}
