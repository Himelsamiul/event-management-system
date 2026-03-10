<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CustomizeBooking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
       public function paymentDetails()
       {
              $payments = Payment::paginate(4);
              return view('backend.pages.payment.paymentDetails', compact('payments'));
       }

       public function createPayment()
       {
              return view('backend.pages.payment.createPayment');
       }

       public function paymentDetailsStore(Request $request)
       {
              $checkValidation = Validator::make(
                     $request->all(),
                     [
                            'transaction_id' => 'required',
                            'amount' => 'required',
                            'payment_method' => 'required',
                            'due' => 'required'
                     ]
              );

              if ($checkValidation->fails()) {
                     notify()->error("something went wrong");
                     return redirect()->back();
              }

              Payment::create([
                     'transaction_id' => $request->transaction_id,
                     'amount' => $request->amount,
                     'payment_method' => $request->payment_method,
                     'due' => $request->due

              ]);

              notify()->success("Payment Created Successfully");
              return redirect()->back();
       }

       public function start($id)
       {
              $booking = Booking::findOrFail($id);

              // 10% payment
              $amount = ceil($booking->total_amount * 0.10); // in BDT

              Stripe::setApiKey(env('STRIPE_SECRET'));

              $session = StripeSession::create([
                     'payment_method_types' => ['card'],
                     'line_items' => [[
                            'price_data' => [
                                   'currency' => 'bdt',
                                   'product_data' => [
                                          'name' => "Tour Payment #{$booking->id}",
                                   ],
                                   'unit_amount' => $amount * 100, // Stripe amount in cents
                            ],
                            'quantity' => 1,
                     ]],
                     'mode' => 'payment',
                     'success_url' => route('booking.details'),
                     // 'cancel_url' => route('web.profile'),
                     'metadata' => [
                            'booking_id' => $booking->id
                     ]
              ]);

              return redirect($session->url);
       }

       // Step 2: Callback after payment
       public function callback(Request $request)
       {
              $session_id = $request->query('session_id');

              if (!$session_id) {
                     return redirect()->route('booking.details')->with('error', 'Payment session not found.');
              }

              Stripe::setApiKey(env('STRIPE_SECRET'));

              $session = \Stripe\Checkout\Session::retrieve($session_id);

              if ($session->payment_status !== 'paid') {
                     return redirect()->route('booking.details')->with('error', 'Payment not completed.');
              }

              return redirect()->route('booking.details')->with('success', 'Payment completed successfully!');
       }

       public function customizeStart($id)
       {
              $booking = CustomizeBooking::findOrFail($id);

              // 10% payment
              $amount = ceil($booking->total_amount * 0.10); // in BDT

              Stripe::setApiKey(env('STRIPE_SECRET'));

              $session = StripeSession::create([
                     'payment_method_types' => ['card'],
                     'line_items' => [[
                            'price_data' => [
                                   'currency' => 'bdt',
                                   'product_data' => [
                                          'name' => "Tour Payment #{$booking->id}",
                                   ],
                                   'unit_amount' => $amount * 100, // Stripe amount in cents
                            ],
                            'quantity' => 1,
                     ]],
                     'mode' => 'payment',
                     'success_url' => route('customize.booking.details'),
                     // 'cancel_url' => route('web.profile'),
                     'metadata' => [
                            'booking_id' => $booking->id
                     ]
              ]);

              return redirect($session->url);
       }

       // Step 2: Callback after payment
       public function customizeCallback(Request $request)
       {
              $session_id = $request->query('session_id');

              if (!$session_id) {
                     return redirect()->route('booking.details')->with('error', 'Payment session not found.');
              }

              Stripe::setApiKey(env('STRIPE_SECRET'));

              $session = \Stripe\Checkout\Session::retrieve($session_id);

              if ($session->payment_status !== 'paid') {
                     return redirect()->route('booking.details')->with('error', 'Payment not completed.');
              }

              return redirect()->route('booking.details')->with('success', 'Payment completed successfully!');
       }
}
