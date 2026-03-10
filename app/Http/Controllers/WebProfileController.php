<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\CustomizeBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WebProfileController extends Controller
{
    public function viewProfile()
    {
        $profileData = Customer::find(auth('customerGuard')->user()->id);
        return view('frontend.pages.userProfile.profileView', compact('profileData'));
    }

    public function bookingDetails()
    {
        $bookingDetails = Booking::with('package.event')->where('customer_id', auth('customerGuard')->user()->id)->get();
        // dd($bookingDetails);
        $bookingDetails = Booking::paginate(20);
        return view('frontend.pages.userProfile.bookingDetails', compact('bookingDetails'));
    }

    public function customizeBookingDetails()
    {
        $customizeBookingDetails = CustomizeBooking::with(['event', 'foods', 'decorations'])->where('customer_id', auth('customerGuard')->user()->id)->get();
        $customizeBookingDetails = CustomizeBooking::paginate(20);
        return view('frontend.pages.userProfile.customizeBookingDetails', compact('customizeBookingDetails'));
    }

    public function appointmentDetails()
    {
        $appointmentDetails = Appointment::where('customer_id', auth('customerGuard')->user()->id)
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('frontend.pages.userProfile.appointmentDetails', compact('appointmentDetails'));
    }

    public function editProfile()
    {
        $profileData = Customer::find(auth('customerGuard')->user()->id);
        return view('frontend.pages.userProfile.profileEdit', compact('profileData'));
    }

    public function updateProfile(Request $request)
    {
        $profileData = Customer::find(auth('customerGuard')->user()->id);

        $checkValidation = Validator::make(
            $request->all(),
            [

                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',


            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $customer_image = '';

        if ($request->hasFile('image')) {

            $customer_image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('/customers', $customer_image);
            File::delete('images/customers/' . $profileData->image);
        }

        $profileData->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $customer_image,

        ]);
        notify()->success('Profile Updated Successfully');
        return redirect()->route('view.profile');
    }

    public function makePayment($id)
    {
        $booking = Booking::find($id);
        $tenPercent = $booking->total_amount * 0.10;
        $booking->dues = $booking->total_amount - $tenPercent;
        $booking->payment_status = 'Partial Paid';
        $booking->save();
        return redirect()->route('payment.start', $booking->id);
    }

    public function payment($payment, $payAmount)
    {
        //dd($payment);
        $post_data = array();
        $post_data['total_amount'] = (int) $payAmount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $payment->transaction_id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $payment->customer_id;
        $post_data['cus_email'] = $payment->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        // dd($post_data);
        #Before  going to initiate the payment order status need to insert or update as Pending.


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function customizeMakePayment($id)
    {

        $booking = CustomizeBooking::find($id);
        $tenPercent = $booking->total_amount * 0.10;
        $booking->dues = $booking->total_amount - $tenPercent;
        $booking->payment_status = 'Partial Paid';
        $booking->save();
        return redirect()->route('customize.payment.start', $booking->id);

    }

    public function customizePayment($payment, $payAmount)
    {

        // dd($payment);
        $post_data = array();
        $post_data['total_amount'] = (int) $payAmount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $payment->transaction_id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $payment->customer_id;
        $post_data['cus_email'] = $payment->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        // dd($post_data);
        #Before  going to initiate the payment order status need to insert or update as Pending.


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }


    public function deleteProfile()
    {
        $profileData = Customer::find(auth('customerGuard')->user()->id);
        $profileData->delete();
        notify()->success('Profile Deleted Successfully');
        return redirect()->back();
    }
}
