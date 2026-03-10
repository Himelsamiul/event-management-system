<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class WebCustomizeController extends Controller
{
    public function allCustomizeEvents()
    {
        $eventShow=Event::all();
        return view('frontend.pages.customizeBooking.events',compact('eventShow'));
    }
}
