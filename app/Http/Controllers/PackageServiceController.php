<?php

namespace App\Http\Controllers;

use App\Models\Decoration;
use App\Models\Event;
use App\Models\Food;
use App\Models\Package;
use App\Models\PackageService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageServiceController extends Controller
{
    public function packageServiceList()
    {
        $packages=PackageService::with('package')->get();
        $packages=PackageService::paginate(20);
        //    dd($packages);
        return view('backend.pages.package_service.list',compact('packages'));
    }

    public function packageServiceSearch(Request $request)
{
    $query = PackageService::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->whereHas('event', function($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        })->orWhereHas('package', function($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        })->orWhereHas('food', function($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        })->orWhereHas('decoration', function($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        });
    }

    $packages = $query->paginate(4);

    return view('backend.pages.package_service.search', compact('packages'));
}

    
    public function packageServiceEvent()
    {
        $packages =Event::all();
        return view('backend.pages.package_service.events', compact('packages'));
    }
    
    public function packageServiceCreate($id)
    {
        $events=Event::findOrFail($id);
        $packages=Package::where('event_id', $id)->get();
        $foods=Food::where('event_id', $id)->get();
        $decorations=Decoration::where('event_id', $id)->get();
        return view('backend.pages.package_service.create',compact('packages','foods','events','decorations'));
    }
    public function packageServiceStore(Request $request)
    {
        $checkValidation = Validator::make
        (
            $request->all(),
            [
                
                'package_id' => 'required',
                'food_id' => 'required',
                'decoration_id' => 'required',
                
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }
       
        // dd($request->all());
        foreach ($request->food_id as $foodId) {
            foreach ($request->decoration_id as $decorationId) {
                PackageService::create([
                    'package_id' => $request->package_id,
                    'event_id' => request()->event_id,
                    'food_id' => $foodId,
                    'decoration_id' => $decorationId,
                ]);
            }
        }
        
        notify()->success('Package Service Created Successfully.');
        return redirect()->route('admin.package.service.list');
    }

    public function packageServiceDelete($id)
    {
        $package = PackageService::find($id);
        $package->delete();
        notify()->success('Package Service Deleted Successfully.');
        return redirect()->back();
    }
}

