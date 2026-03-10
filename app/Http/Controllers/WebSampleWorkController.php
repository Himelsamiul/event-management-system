<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSampleWorkController extends Controller
{
    
    public function sampleWork()
    {
        return view('frontend.pages.sampleWork');
    }
}
