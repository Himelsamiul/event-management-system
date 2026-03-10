<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function bookinglist()
    {
        $bookings = Booking::with('package.event')->get();
        $bookings = Booking::paginate(20);

        return view('backend.pages.booking.bookingDetails', compact('bookings'));
    }

    public function accept($id)
    {
        $bookings = Booking::find($id);
        $bookings->update(['status' => 'Accept']);

        notify()->success("Booking Accepted.");
        return redirect()->back();
    }

    public function reject($id)
    {
        $bookings = Booking::find($id);
        $bookings->update(['status' => 'Reject']);

        notify()->error("Booking rejected.");
        return redirect()->back();
    }

    public function markPaymentDone($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'Paid';
        $booking->dues = 0;
        $booking->save();

        return redirect()->back()->with('success', 'Booking marked as Payment Done');
    }

    public function markEventDone($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Event Done';
        $booking->save();

        return redirect()->back()->with('success', 'Booking marked as Event Done');
    }

    public function search(Request $request)
    {
        $searchResult = collect(); // Initialize an empty collection

        $query = Booking::query();

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $searchResult = $query->get();

        return view('backend.pages.booking.search', compact('searchResult'));
    }

    public function autoUpdateStatus(Request $request, $id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->status = $request->status;
            $booking->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
