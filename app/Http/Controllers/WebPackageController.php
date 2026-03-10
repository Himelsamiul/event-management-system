<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Service;
use App\Models\Package; 
use App\Models\PackageService;
use Illuminate\Http\Request;

class WebPackageController extends Controller
{
    public function allEvents()
    {
        $eventShow=Event::all();
        return view('frontend.pages.package.viewEvents',compact('eventShow'));
    }

    
    public function allPackages($id)
    {
        $packageShow=Package::where('event_id', $id)->get();
        return view('frontend.pages.package.viewPackages',compact('packageShow'));
    }

    
    public function allPackagesDetails($id)
    {
        $packages=Package::all();
        $packageDetails=PackageService::where('package_id', $id)->get();
        // dd($packageDetails);
        return view('frontend.pages.package.packageDetails',compact('packageDetails','packages'));
    }
    
}
