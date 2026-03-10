<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Decoration;
use App\Models\Event;
use App\Models\Food;
use App\Models\Package;     
use App\Models\PackageService;
use App\Models\Payment;
use App\Models\CustomizeBooking;
use App\Models\User;
use App\Models\Vendor;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage()
{
    $totalBookings          = Booking::count();
    $totalCustomers         = Customer::count();
    $totalAppointments      = Appointment::count();
    $totalDecorations       = Decoration::count();
    $totalEvents            = Event::count();
    $totalFoods             = Food::count();
    $totalPackages          = Package::count();
    $totalPackageServices   = PackageService::count();
    $totalCustomizeBookings = CustomizeBooking::count();
    $totalVendors           = Vendor::count();
    $totalUsers             = User::count();

    // 🔹 Booking status
    $totalPendingBookings = Booking::where('status','pending')->count();
    $totalAcceptBookings  = Booking::where('status','accept')->count();
    $totalRejectBookings  = Booking::where('status','reject')->count();

    // 🔹 Normal booking payment
    $totalPaidAmount = Booking::sum('total_amount') - Booking::sum('dues');
    $totalDueAmount  = Booking::sum('dues');
    $totalCollectableAmount = Booking::sum('total_amount');

    // 🔹 Customize booking status
    $totalCustomizePending = CustomizeBooking::where('status','pending')->count();
    $totalCustomizeAccept  = CustomizeBooking::where('status','accept')->count();
    $totalCustomizeReject  = CustomizeBooking::where('status','reject')->count();

    // 🔹 Customize booking payment (SAME AS NORMAL)
    $totalCustomizePaidAmount = CustomizeBooking::sum('total_amount') - CustomizeBooking::sum('dues');
    $totalCustomizeDueAmount  = CustomizeBooking::sum('dues');
    $totalCustomizeCollectableAmount = CustomizeBooking::sum('total_amount');

    return view('backend.pages.homePage', compact(
        'totalBookings',
        'totalCustomers',
        'totalAppointments',
        'totalDecorations',
        'totalEvents',
        'totalFoods',
        'totalPackages',
        'totalPackageServices',
        'totalCustomizeBookings',
        'totalVendors',
        'totalUsers',

        'totalPendingBookings',
        'totalAcceptBookings',
        'totalRejectBookings',

        'totalPaidAmount',
        'totalDueAmount',
        'totalCollectableAmount',

        'totalCustomizePending',
        'totalCustomizeAccept',
        'totalCustomizeReject',

        'totalCustomizePaidAmount',
        'totalCustomizeDueAmount',
        'totalCustomizeCollectableAmount'
    ));
}

  

    
}
