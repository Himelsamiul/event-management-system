<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Package;
use App\Models\Package_service;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function packageList()
    {

        $packages = Package::all();
        $packages = Package::paginate(10);
        return view('backend.pages.package.packageList', compact('packages'));
    }

    public function packageSearch(Request $request)
    {
        $query = Package::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('event', function ($q) use ($search) {
                      $q->where('name', 'LIKE', '%' . $search . '%');
                  });
        }

        $packages = $query->paginate(4);

        return view('backend.pages.package.packageEventSearch', compact('packages'));
    }


    public function createPackage()
    {
        $events = Event::all();
        return view('backend.pages.package.createPackage', compact('events'));
    }

    public function packageStore(Request $request)
    {
        $checkValidation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'event_id' => 'required',

            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }
        Package::create([
            'name' => $request->name,
            'event_id' => $request->event_id,
        ]);

        notify()->success('Package Created Successfully.');
        return redirect()->route('admin.package.list');
    }

    public function packageEdit($package_id)
    {
        $events = Event::all();
        $package = Package::find($package_id);
        return view('backend.pages.package.editpackage', compact('package', 'events'));
    }

    public function packageUpdate(Request $request, $id)
    {
        // $events=Event::find($id);
        $package = Package::find($id);

        $checkValidation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'event_id' => 'required',
            ]
        );
        // dd($request->all()); 

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $package->update([
            'name' => $request->name,
            'event_id' => $request->event_id,

        ]);

        notify()->success('Package Updated Successfully.');

        return redirect()->route('admin.package.list');
    }

    public function packageDelete($id)
    {
        $package = Package::find($id);
        $package->delete();
        notify()->success('Package Deleted Successfully.');
        return redirect()->back();
    }
}
