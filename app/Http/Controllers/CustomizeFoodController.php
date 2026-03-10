<?php

namespace App\Http\Controllers;

use App\Models\CustomizeFood;
use App\Models\Event;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomizeFoodController extends Controller
{
    public function customizeFoodList()
    { 
        $customizeFoods = CustomizeFood::with(['event', 'vendor'])->get();
        $customizeFoods = CustomizeFood::paginate(15);
        return view('backend.pages.customizeFood.customizeFoodList', compact('customizeFoods'));
    }

    public function customizeFoodSearch(Request $request)
    {
        $query = CustomizeFood::query();

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

        $foods = $query->paginate(4);

        return view('backend.pages.customizeFood.customizeFoodSearch', compact('foods'));
    }

    public function createCustomizeFood()
    {
        $events = Event::all();
        $vendors = Vendor::all();
        return view('backend.pages.customizeFood.createCustomizeFood',compact('events', 'vendors'));
    }

    public function customizeFoodStore(Request $request)
    {
        // $checkValidation=$request->except('_token');
        // dd($request->all());

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

        CustomizeFood::create([
                'name' => $request->name,
                'event_id' => $request->event_id,
                'vendor_id' => $request->vendor_id,
                'price' => $request->price,
                
            ]);

        notify()->success('Customize Food Created Successfully.');

        return redirect()->route('admin.customize.food.list');
    }

    public function customizeFoodEdit(Request $request, $food_id)
    {
        $events= Event::all();
        $vendors= Vendor::all();
        $foods = CustomizeFood::find($food_id);
        return view('backend.pages.customizeFood.customizeFoodEditForm', compact('foods','events', 'vendors'));

    }

    public function  customizeFoodUpdate(Request $request, $food_id)
    {
        $foods = CustomizeFood::find($food_id);

        $checkValidation = Validator::make
        (
            $request->all(),
            [
                'name' => 'required',
                'event_id' => 'required',
                'vendor_id' => 'required',
                'price'=>'required'
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $foods->update([
                'name' => $request->name,
                'event_id' => $request->event_id,
                'vendor_id' => $request->vendor_id,
                'price' => $request->price
            ]);
        notify()->success('Customize Food Updated Successfully.');

        return redirect()->route('admin.customize.food.list');
    }

    public function customizeFoodDelete($food_id)
    {
        $foods = CustomizeFood::find($food_id);
        $foods->delete();
        notify()->success('Customize Food Deleted Successfully.');
        return redirect()->back();
        
    }
      
}
