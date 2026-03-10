<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebCustomizeController;
use App\Http\Controllers\CustomizeFoodController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomizeBookingController;
use App\Http\Controllers\WebCustomizeBookingController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\CustomizeDecorationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\WebHomeController;
use App\Http\Controllers\WebBookingController;
use App\Http\Controllers\WebProfileController;
use App\Http\Controllers\WebCustomerController;
use App\Http\Controllers\WebPackageController;
use App\Http\Controllers\WebSampleWorkController;
use App\Models\Appointment;

//Backend

  Route::group(['prefix' => 'admin'], function ()           //prefix
  {
      //Login-Logout 
      Route::get('/login', [UserController::class, 'login'])->name('admin.login');
      Route::post('/do-login', [UserController::class, 'doLogin'])->name('admin.do.login');
      Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'auth'], function () {                       //auth

            Route::get('/', [HomeController::class, 'homePage'])->name('admin.home.page');

            //Vendor->
            Route::get('/vendor/list', [VendorController::class, 'vendorList'])->name('admin.vendor.list');
            Route::get('/create/vendor', [VendorController::class, 'createVendor'])->name('admin.create.vendor');
            Route::post('/vendor/store', [VendorController::class, 'vendorStore'])->name('admin.vendor.store');
            Route::get('/vendor/edit/{vendor_id}', [VendorController::class, 'vendorEdit'])->name('admin.vendor.edit');
            Route::put('/vendor/update/{vendor_id}', [VendorController::class, 'vendorUpdate'])->name('admin.vendor.update');
            Route::get('/vendor/delete/{vendor_id}', [VendorController::class, 'vendorDelete'])->name('admin.vendor.delete');
            Route::get('/vendor/search', [VendorController::class, 'vendorSearch'])->name('admin.vendor.search');
            
            //Events->
            Route::get('/event/list', [EventController::class, 'eventList'])->name('admin.event.list');
            Route::get('/create/event', [EventController::class, 'createEvent'])->name('admin.create.event');
            Route::post('/event/store', [EventController::class, 'eventStore'])->name('admin.event.store');
            Route::get('/event/edit/{event_id}', [EventController::class, 'eventEdit'])->name('admin.event.edit');
            Route::put('/event/update/{event_id}', [EventController::class, 'eventUpdate'])->name('admin.event.update');
            Route::get('/event/delete/{event_id}', [EventController::class, 'eventDelete'])->name('admin.event.delete');
            Route::get('/event/search', [EventController::class, 'eventSearch'])->name('admin.event.search');
            
            //Packages->
            Route::get('/package/list', [PackageController::class, 'packageList'])->name('admin.package.list');
            Route::get('/create/package', [PackageController::class, 'createPackage'])->name('admin.create.package');
            Route::post('/package/store', [PackageController::class, 'packageStore'])->name('admin.package.store');
            Route::get('/package/edit/{package_id}', [PackageController::class, 'packageEdit'])->name('admin.package.edit');
            Route::put('/package/update/{package_id}', [PackageController::class, 'packageUpdate'])->name('admin.package.update');
            Route::get('/package/delete/{package_id}', [PackageController::class, 'packageDelete'])->name('admin.package.delete');
            Route::get('/packages/search', [PackageController::class, 'packageSearch'])->name('admin.package.search');

            //Foods->
            Route::get('/food/list', [FoodController::class, 'foodList'])->name('admin.food.list');

            
            Route::get('/create/food', [FoodController::class, 'createFood'])->name('admin.create.food');    
            Route::post('/food/store', [FoodController::class, 'foodStore'])->name('admin.food.store');


            Route::get('/food/edit/{food_id}', [FoodController::class, 'foodEdit'])->name('admin.food.edit');
            Route::put('/food/update/{food_id}', [FoodController::class, 'foodUpdate'])->name('admin.food.update');
            Route::get('/food/delete/{food_id}', [FoodController::class, 'foodDelete'])->name('admin.food.delete');
            Route::get('/food/search', [FoodController::class, 'foodSearch'])->name('admin.food.search');
           
            //Decorations->
            Route::get('/decoration/list', [DecorationController::class, 'decorationList'])->name('admin.decoration.list');
            Route::get('/create/decoration', [DecorationController::class, 'createDecoration'])->name('admin.create.decoration');
            Route::post('/decoration/store', [DecorationController::class, 'decorationStore'])->name('admin.decoration.store');
            Route::get('/decoration/edit/{decoration_id}', [DecorationController::class, 'decorationEdit'])->name('admin.decoration.edit');
            Route::put('/decoration/update/{decoration_id}', [DecorationController::class, 'decorationUpdate'])->name('admin.decoration.update');
            Route::get('/decoration/delete/{decoration_id}', [DecorationController::class, 'decorationDelete'])->name('admin.decoration.delete');
            Route::get('/decorations/search', [DecorationController::class, 'decorationSearch'])->name('admin.decoration.search');
            
            //Packages service->       
            Route::get('/package/service/list', [PackageServiceController::class, 'packageServiceList'])->name('admin.package.service.list');
            Route::get('/package/service/event', [PackageServiceController::class, 'packageServiceEvent'])->name('admin.package.service.event');
            Route::get('/package/service/create/{id}', [PackageServiceController::class, 'packageServiceCreate'])->name('admin.package.service.create');
            Route::post('/package/service/store', [PackageServiceController::class, 'packageServiceStore'])->name('admin.package.service.store');
            Route::get('/package/service/delete/{p_s_id}', [PackageServiceController::class, 'packageServiceDelete'])->name('admin.package.service.delete');
            Route::get('/package/service/search', [PackageServiceController::class, 'packageServiceSearch'])->name('admin.package.service.search');
            
            //Bookings-> 
            Route::get('/booking/list', [BookingController::class, 'bookingList'])->name('admin.booking');
            Route::get('/booking/accept/{id}', [BookingController::class, 'accept'])->name('admin.accept.booking');
            Route::get('/booking/reject/{id}', [BookingController::class, 'reject'])->name('admin.reject.booking');
            Route::get('/search/booking', [BookingController::class, 'search'])->name('admin.search.booking');
            Route::get('/payment-done/{id}', [BookingController::class, 'markPaymentDone'])->name('admin.payment.done');
            Route::get('/event-done/{id}', [BookingController::class, 'markEventDone'])->name('admin.event.done');
            Route::post('/booking/auto-update-status/{id}', [BookingController::class, 'autoUpdateStatus']);
            
            //Customize Foods->
            Route::get('/customize/food/list', [CustomizeFoodController::class, 'customizeFoodList'])->name('admin.customize.food.list');
            Route::get('/customize/create/food', [CustomizeFoodController::class, 'createCustomizeFood'])->name('admin.create.customize.food');
            Route::post('/customize/food/store', [CustomizeFoodController::class, 'customizeFoodStore'])->name('admin.customize.food.store');
            Route::get('/customize/food/edit/{food_id}', [CustomizeFoodController::class, 'customizeFoodEdit'])->name('admin.customize.food.edit');
            Route::put('/customize/food/update/{food_id}', [CustomizeFoodController::class, 'customizeFoodUpdate'])->name('admin.customize.food.update');
            Route::get('/customize/food/delete/{food_id}', [CustomizeFoodController::class, 'customizeFoodDelete'])->name('admin.customize.food.delete');
            Route::get('/customize/food/search', [CustomizeFoodController::class, 'customizeFoodSearch'])->name('admin.customize.food.search');
            
            //Customize Decorations->
            Route::get('/customize/decoration/list', [CustomizeDecorationController::class, 'customizeDecorationList'])->name('admin.customize.decoration.list');
            Route::get('/customize/create/decoration', [CustomizeDecorationController::class, 'createCustomizeDecoration'])->name('admin.create.customize.decoration');
            Route::post('/customize/decoration/store', [CustomizeDecorationController::class, 'customizeDecorationStore'])->name('admin.customize.decoration.store');
            Route::get('/customize/decoration/edit/{decoration_id}', [CustomizeDecorationController::class, 'customizeDecorationEdit'])->name('admin.customize.decoration.edit');
            Route::put('/customize/decoration/update/{decoration_id}', [CustomizeDecorationController::class, 'customizeDecorationUpdate'])->name('admin.customize.decoration.update');
            Route::get('/customize/decoration/delete/{decoration_id}', [CustomizeDecorationController::class, 'customizeDecorationDelete'])->name('admin.customize.decoration.delete');
            Route::get('/customize/decoration/search', [CustomizeDecorationController::class, 'customizeDecorationSearch'])->name('admin.customize.decoration.search');
            
            //Customize Bookings-> 
            Route::get('/customize/booking/list', [CustomizeBookingController::class, 'customizeBookingList'])->name('admin.customize.booking');
            Route::get('/customize/booking/accept/{id}', [CustomizeBookingController::class, 'customizeAccept'])->name('admin.customize.accept.booking');
            Route::get('/customize/booking/reject/{id}', [CustomizeBookingController::class, 'customizeReject'])->name('admin.customize.reject.booking');
            Route::get('/customize/search/booking', [CustomizeBookingController::class, 'customizeSearch'])->name('admin.customize.search.booking');
            Route::get('/customize/event-done/{id}', [CustomizeBookingController::class, 'customizeMarkEventDone'])->name('admin.customize.event.done');
            Route::get('/customize/payment-done/{id}', [CustomizeBookingController::class, 'customizeMarkPaymentDone'])->name('admin.customize.payment.done');
            Route::post('/customize/booking/auto-update-status/{id}', [CustomizeBookingController::class, 'customizeAutoUpdateStatus']);

            //Appointments->
            Route::get('/appointment/details', [AppointmentController::class, 'appointmentDetails'])->name('admin.appointment.details');
            Route::get('/appointment/accept/{id}', [AppointmentController::class, 'accept'])->name('admin.accept.appointment');
            Route::get('/appointment/reject/{id}', [AppointmentController::class, 'reject'])->name('admin.reject.appointment');
            Route::get('/search/appointment', [AppointmentController::class, 'search'])->name('admin.search.appointment');

            //Customers->
            Route::get('/customer/list', [WebCustomerController::class, 'customerList'])->name('admin.customer.list');
            Route::get('/delete/customer', [WebCustomerController::class, 'deleteCustomer'])->name('admin.delete.customer');
            Route::get('/search/customer', [WebCustomerController::class, 'search'])->name('admin.search.customer');

    });
  });

//End Backend  

//Frontend 

      //Home Page->
      Route::get('/', [WebHomeController::class, 'home'])->name('home.page');
Route::get('/sample/work', [WebSampleWorkController::class, 'sampleWork'])->name('sample.work');
      //Registration->
      Route::get('/registration', [WebCustomerController::class, 'registration'])->name('registration');
      Route::post('/do-registration', [WebCustomerController::class, 'doRegistration'])->name('do-registration');

      //Sample Work->
      

      //packages->      
      Route::get('/all/events', [WebPackageController::class, 'allEvents'])->name('all.events');
      Route::get('/all/packages/{id}', [WebPackageController::class, 'allPackages'])->name('all.packages');
      Route::get('/all/packages/services/details/{id}', [WebPackageController::class, 'allPackagesDetails'])->name('all.packages.services.details');

      //Login-Logout-> 
      Route::get('/login', [WebCustomerController::class, 'login'])->name('login');
      Route::post('/do-login', [WebCustomerController::class, 'doLogin'])->name('do.login');

    Route::group(['middleware' => 'customerAuth'], function () {

            //logout->
            Route::get('/logout', [WebCustomerController::class, 'logout'])->name('logout');

            //Profile->
            Route::get('/view/profile', [WebProfileController::class, 'viewProfile'])->name('view.profile');
            Route::get('/edit/profile', [WebProfileController::class, 'editProfile'])->name('edit.profile');
            Route::put('/update/profile', [WebProfileController::class, 'updateProfile'])->name('update.profile');
            Route::get('/delete/profile', [WebProfileController::class, 'deletetProfile'])->name('delete.profile');
            Route::get('/make-payment/{id}', [WebProfileController::class, 'makePayment'])->name('make.payment');
            Route::get('/customize/make-payment/{id}', [WebProfileController::class, 'customizeMakePayment'])->name('customize.make.payment');
            Route::get('/booking/details', [WebProfileController::class, 'bookingDetails'])->name('booking.details');
            Route::get('/customize/booking/details', [WebProfileController::class, 'customizeBookingDetails'])->name('customize.booking.details');
            Route::get('/appointment/details', [WebProfileController::class, 'appointmentDetails'])->name('appointment.details');

            //Appointments-> 
            Route::get('/create/appointment', [AppointmentController::class, 'createAppointment'])->name('create.appointment');
            Route::post('/appointment/details/store', [AppointmentController::class, 'appointmentDetailsStore'])->name('appointment.details.store');
            Route::get('/cancel/appointment/{id}', [AppointmentController::class, 'cancelAppointment'])->name('cancel.appointment');

            //Customize->     
            Route::get('/all/customize/events', [WebCustomizeController::class, 'allCustomizeEvents'])->name('all.customize.events');
            
            //Booking-> 
            Route::get('/booking/form/{id}', [WebBookingController::class, 'bookingForm'])->name('booking.form');
            Route::post('/booking/store', [WebBookingController::class, 'bookingStore'])->name('booking.store');
            Route::get('/cancel/booking/{id}', [WebBookingController::class, 'cancelBooking'])->name('cancel.booking');
            Route::get('/download-receipt/{id}', [WebBookingController::class, 'downloadReceipt'])->name('download.receipt');

            //Customize Booking->
            Route::get('/customize/booking/form/{id}', [WebCustomizeBookingController::class, 'customizeBookingForm'])->name('customize.booking.form');
            Route::post('/customize/booking/store', [WebCustomizeBookingController::class, 'customizeBookingStore'])->name('customize.booking.store');
            Route::get('/cancel/customize/booking/{id}', [WebCustomizeBookingController::class, 'cancelCustomizeBooking'])->name('cancel.customize.booking');
            Route::get('/customize/download-receipt/{id}', [WebCustomizeBookingController::class, 'customizeDownloadReceipt'])->name('customize.download.receipt');
           



           //payment for normal booking.
            Route::get('/payment/{id}', [PaymentController::class, 'start'])->name('payment.start');
            //payment for customize booking
            Route::get('/customize/payment/{id}', [PaymentController::class, 'customizeStart'])->name('customize.payment.start');

            // SSLCOMMERZ Start->// problem in api so its did not used but kept for future reference
            Route::post('/success', [SslCommerzPaymentController::class, 'success']);
            Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
            Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
            Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
            //SSLCOMMERZ END
            
    });
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('customize/payment/callback', [PaymentController::class, 'customizeCallback'])->name('customize.payment.callback');
//End Frontend      
