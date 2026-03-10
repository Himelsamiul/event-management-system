<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Event;
use App\Models\Decoration;
use App\Models\Food;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    use HasFactory;
    
    protected $table = 'package_services';
    protected $guarded=[];


  
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function decoration()
    {
        return $this->belongsTo(Decoration::class, 'decoration_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}


