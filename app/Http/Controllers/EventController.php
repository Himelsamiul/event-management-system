<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function eventList()
    { 
        $events = Event::paginate(10);
        // dd($events);
        return view('backend.pages.events.eventList', compact('events'));
    }

    public function eventSearch(Request $request)
{
    $query = Event::query();

    if ($request->has('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    $events = $query->paginate(4);

    return view('backend.pages.events.search', compact('events'));
}


    public function createEvent()
    {
        return view('backend.pages.events.createEvent');
    }

    public function eventStore(Request $request)
    {
        // $checkValidation=$request->except('_token');
        // dd($request->all());

        $checkValidation = Validator::make
        (
            $request->all(),
            [
                'event_name' => 'required',
                'event_image' => 'image'       // |size:10000'
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $event_image = '';

        if ($request->hasFile('image')) {
            $event_image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/events', $event_image);
        }

        Event::create([
            // database                  //blade/view/form 
                'name' => $request->event_name,
                //'address' => $request->event_address,
                'image' => $event_image
            ]);

        notify()->success('Event Created Successfully.');

        return redirect()->route('admin.event.list');
    }

    public function eventEdit(Request $request, $event_id)
    {
        $events = Event::find($event_id);
        return view('backend.pages.events.eventEditForm', compact('events'));
    }


    public function  eventUpdate(Request $request, $event_id)
    {
        $events = Event::find($event_id);

        $event_image = '';

        if ($request->hasFile('image')) {

            $event_image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('/events', $event_image);
            File::delete('images/events/' . $events->image);
        }



        $events->update([
                'name' => $request->event_name,

                'image' => $event_image,

            ]);
        notify()->success('Event Updated Successfully.');

        return redirect()->route('admin.event.list');
    }

    public function eventDelete($event_id)
    {
        $events = Event::find($event_id);
        $events->delete();
        notify()->success('Event Deleted Successfully.');
        return redirect()->back();
    }
}
