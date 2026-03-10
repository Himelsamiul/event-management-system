<?php

namespace App\Http\Controllers;

use App\Models\Decoration;
use App\Models\Event;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DecorationController extends Controller 
{
    public function decorationList()
    {
        $decorations = Decoration::with(['event', 'vendor'])->get();
        $decorations = Decoration::paginate(15);
        // dd($events);
        return view('backend.pages.decoration.decorationList',compact('decorations'));
    }

    public function decorationSearch(Request $request)
    {
        $query = Decoration::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('price', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('event', function ($q) use ($search) {
                      $q->where('name', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('vendor', function ($q) use ($search) {
                      $q->where('name', 'LIKE', '%' . $search . '%');
                  });
        }

        $decorations = $query->paginate(4);
        return view('backend.pages.decoration.decorationSearch', compact('decorations'));
    }

    public function createDecoration()
    {
        $events = Event::all();
        $vendors = Vendor::all();
        return view('backend.pages.decoration.createDecoration',compact('events', 'vendors'));
    }

    public function decorationStore(Request $request)
    {

        $checkValidation = Validator::make
        (
            $request->all(),
            [
                'name' => 'required',
                'event_id' => 'required',
                'vendor_id' => 'required',
                'price' => 'required|integer|min:1',
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        Decoration::create([
                'name' => $request->name,
                'event_id' => $request->event_id,
                'vendor_id' => $request->vendor_id,
                'price' => $request->price,
                
            ]);

        notify()->success('Decoration Created Successfully.');

        return redirect()->route('admin.decoration.list');
    }

    public function decorationEdit(Request $request, $decoration_id)
    {
        $events= Event::all();
        $vendors= Vendor::all();
        $decorations = Decoration::find($decoration_id);
        return view('backend.pages.decoration.decorationEditForm', compact('decorations','events', 'vendors'));
    }

    public function  decorationUpdate(Request $request, $decoration_id)
    {
        $decorations = Decoration::find($decoration_id);

        $checkValidation = Validator::make
        (
            $request->all(),
            [
                'name' => 'required',
                'event_id' => 'required',
                'vendor_id' => 'required',
                'price' => 'required|integer|min:1'
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $decorations->update([
                'name' => $request->name,
                'event_id' => $request->event_id,
                'vendor_id' => $request->vendor_id,
                'price' => $request->price
            ]);
        notify()->success('Decoration Updated Successfully.');

        return redirect()->route('admin.decoration.list');
    }

    public function decorationDelete($decoration_id)
    {
        $decorations = Decoration::find($decoration_id);
        $decorations->delete();
        notify()->success('Decoration Deleted Successfully.');
        return redirect()->back();
    }
}
