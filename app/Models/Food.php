<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'foods';

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
