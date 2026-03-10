<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use Carbon\Carbon;
use App\Models\CustomizeDecoration;
use App\Models\CustomizeFood;
use App\Models\CustomizeBooking;
use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WebCustomizeBookingController extends Controller
{
    public function customizeBookingForm($id)
    {
        $events = Event::findOrFail($id);
        $foods = CustomizeFood::where('event_id', $id)->get();
        $decorations = CustomizeDecoration::where('event_id', $id)->get();
        return view('frontend.pages.customizeBooking.bookingForm', compact('events', 'foods', 'decorations'));
    }

    public function customizeBookingStore(Request $request)
    {
        $checkValidation = Validator::make($request->all(), [
            'name' => 'required',
            'food_id' => 'required|array',
            'decoration_id' => 'required|array',
            'phone' => 'required|string|max:20',
    'email' => 'required|email|max:255',
    'date' => 'required|date|after_or_equal:today',
    'start_time' => 'required|date_format:H:i',
    'end_time' => 'required|date_format:H:i|after:start_time',
    'venue' => 'required|string|max:255',
    'guest' => 'required|integer|min:1',
    'total_amount' => 'required|numeric|min:0',
        ]);

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $booking = CustomizeBooking::create([
            'name' => $request->name,
            'customer_id' => auth('customerGuard')->user()->id,
            'event_id' => $request->event_id,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'transaction_id' => date('YmdHis'),
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'venue' => $request->venue,
            'guest' => $request->guest,
            'total_amount' => $request->total_amount,
            'dues' => $request->total_amount,
            // 'address'=>$request->address,
            'status' => 'Pending',
            'payment_status' => 'Pending',
        ]);

        $booking->foods()->attach($request->food_id);
        $booking->decorations()->attach($request->decoration_id);

        // Mail::to($request->email)->send(new OrderPlacedMail($booking));

        notify()->success('Booked Successfully.Please Pay Within 2 Days.');
        return redirect()->route('customize.booking.details');
    }

    public function cancelCustomizeBooking($id)
    {
        $booking = CustomizeBooking::findOrFail($id);
        $booking->update([
            'status' => 'Cancelled'
        ]);

        notify()->success('Customize Booking cancel successfully.');
        return redirect()->back();
    }

    public function customizeDownloadReceipt($id)
    {
        $booking = CustomizeBooking::with('event', 'foods', 'decorations', 'customer')->findOrFail($id);

        if ($booking->payment_status == 'pending') {
            return redirect()->back()->with('error', 'Payment not completed yet.');
        }

        $currentDate = Carbon::now()->format('d M, Y');
        // return view('frontend.pages.customizeBooking.receipt', compact('booking', 'currentDate'));

        $pdf = PDF::loadView('frontend.pages.customizeBooking.receipt', compact('booking', 'currentDate'));

        return $pdf->download('receipt_' . $booking->transaction_id . '.pdf');
    }
}
