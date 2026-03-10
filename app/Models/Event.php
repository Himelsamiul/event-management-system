<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{ 
    use HasFactory;
    protected $guarded=[];

    
    // public function service()
    // {
    //    return $this->hasMany(Service::class);
    // }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }


}
