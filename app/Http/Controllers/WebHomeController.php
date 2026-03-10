<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebHomeController extends Controller
{
    public function home()
    {
        return view('frontend.pages.homePage');
    }
}
