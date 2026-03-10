<?php

namespace App\Http\Controllers;

use App\Models\CustomizeBooking;
use Illuminate\Http\Request;

class CustomizeBookingController extends Controller
{
    public function customizeBookinglist()
    {
        $customizeBookingDetails = CustomizeBooking::with(['event', 'foods', 'decorations'])->get();
        // dd($customizeBookingDetails);
        $customizeBookingDetails=CustomizeBooking::paginate(20);

        return view('backend.pages.customizeBooking.bookingDetails', compact('customizeBookingDetails'));
    }

    public function customizeAccept($id)
    {
        $bookings = CustomizeBooking::find($id);
        $bookings->update(['status'=>'Accept']);

        notify()->success("Customize Booking Accepted.");
        return redirect()->back();
    }

    public function customizeReject($id)
    {
        $bookings = CustomizeBooking::find($id);
        $bookings->update(['status'=>'Reject']);

        notify()->error("Customize Booking rejected.");
        return redirect()->back();
    }

    public function customizeMarkEventDone($id) {
        $booking = CustomizeBooking::findOrFail($id);
        $booking->status = 'Event Done';
        $booking->save();
    
        return redirect()->back()->with('success', 'Booking marked as Event Done');
    }

    public function customizeMarkPaymentDone($id) {
        $booking = CustomizeBooking::findOrFail($id);
        $booking->payment_status = 'Paid';
        $booking->dues = 0;
        $booking->save();
    
        return redirect()->back()->with('success', 'Booking marked as Payment Done');
    }

    public function customizeSearch(Request $request)
    {
        $searchResult = collect(); // Initialize an empty collection
    
        $query = CustomizeBooking::query();
    
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
    
        $searchResult = $query->get();
    
        return view('backend.pages.customizeBooking.search', compact('searchResult'));
    }

    public function customizeAutoUpdateStatus(Request $request, $id)
{
    $booking = CustomizeBooking::find($id);
    if ($booking) {
        $booking->status = $request->status;
        $booking->save();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
}


} 
