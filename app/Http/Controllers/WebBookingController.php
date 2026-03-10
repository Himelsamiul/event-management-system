<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Package;
use App\Models\PackageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WebBookingController extends Controller
{
    public function bookingForm($id)
    {
        $package = Package::with(['packageServices.food', 'packageServices.decoration'])->findOrFail($id);
        return view('frontend.pages.booking.bookingForm', compact('package'));
    }

    public function bookingStore(Request $request)
    {
        $package = Package::with(['packageServices.food', 'packageServices.decoration'])->findOrFail($request->package_id);

        $checkValidation = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|regex:/^[0-9\-\+\s\(\)]+$/|min:10',
        'email' => 'required|email|max:255',
        'date' => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'venue' => 'required|string|max:255',
        'guest' => 'required|integer|min:1',
        'total_amount' => 'required|numeric|min:0',
        ]);

        if ($checkValidation->fails()) {
            return redirect()->back()->withErrors($checkValidation)->withInput();
        }

        $booking = Booking::create([
            'name' => $request->name,
            'customer_id' => auth('customerGuard')->user()->id,
            'package_id' => $request->package_id,
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
            'payment_status' => 'pending',
        ]);

        // Mail::to($request->email)->send(new OrderPlacedMail($booking));
        notify()->success('Booked Package Successfully.Please Pay Within 2 Days.');
        return redirect()->route('booking.details');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => 'Cancelled'
        ]);

        notify()->success('Booking cancel successfully.');
        return redirect()->back();
    }

    public function downloadReceipt($id)
    {
        $booking = Booking::with('package.event', 'customer')->findOrFail($id);

        if ($booking->payment_status == 'pending') {
            return redirect()->back()->with('error', 'Payment not completed yet.');
        }

        $currentDate = Carbon::now()->format('d M, Y');
        $pdf = PDF::loadView('frontend.pages.booking.receipt', compact('booking', 'currentDate'));

        return $pdf->download('receipt_' . $booking->transaction_id . '.pdf');
    }
}
