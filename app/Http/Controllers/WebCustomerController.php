<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebCustomerController extends Controller
{
     public function registration()
    {
        return view('frontend.pages.registration');
    }

    public function doRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:customers,email',

            'phone' => [
                'required',
                'regex:/^(013|014|015|016|017|018|019)[0-9]{8}$/',
                'unique:customers,phone'
            ],

            'address' => 'required|string|max:255',

            'password' => 'required|min:6',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'password' => bcrypt($request->password),
        ]);

        notify()->success('Registration Successful');
        return redirect()->route('login');
    }

    public function login()
    {
        return view('frontend.pages.login');
    }

    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (auth()->guard('customerGuard')->attempt($credentials)) {
            notify()->success('Login Successful');
            return redirect()->route('home.page');
        }

        notify()->error('Invalid Credentials');
        return redirect()->back();
    }

   public function logout()

   {
      auth('customerGuard')->logout();
      // Auth::logout();
      notify()->success('Logout Successful');
      return redirect()->route('home.page');
   }

   public function customerList()

   {
      $customerDetails = Customer::paginate(20);
      return view('backend.pages.customer.customerList', compact('customerDetails'));
   }

   public function search(Request $request)
{
    $query = Customer::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('email', 'LIKE', '%' . $search . '%')
              ->orWhere('phone', 'LIKE', '%' . $search . '%')
              ->orWhere('address', 'LIKE', '%' . $search . '%');
    }

    $customerDetails = $query->paginate(4);

    return view('backend.pages.customer.customerSearch', compact('customerDetails'));
}


   public function deleteCustomer()

   {
      $customer = Customer::find(auth('customerGuard')->user()->id);
      $customer->delete();
      notify()->success('Customer Deleted Successfully.');
      return redirect()->back();
   }
}
