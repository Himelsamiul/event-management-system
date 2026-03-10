<?php

namespace App\Http\Controllers;




use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function appointmentDetails()
    {
        $appointments = Appointment::paginate(20);
        return view('backend.pages.appointment.appointmentDetails', compact('appointments'));
    }

    public function createAppointment()
    {
        return view('frontend.pages.appointment.appointmentForm');
    }

    public function appointmentDetailsStore(Request $request)
    {
        $checkValidation = Validator::make(
            $request->all(),
            [
                'user_name' => 'required|string|max:255',
    'phone_number' => 'required|string|max:20',
    'email' => 'required|email|max:255',
    'date' => 'required|date|after_or_equal:today',
                'time' => 'required'
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        // Check if the selected date and time combination already exists
        $existingAppointment = Appointment::where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', '!=' , 'Cancelled')
            ->first();

        if ($existingAppointment) {
            notify()->error("The selected date and time are already booked. Please choose a different time.");
            return redirect()->back();
        }

        // Create the appointment
        Appointment::create([
            'customer_id' => auth('customerGuard')->user()->id,
            'user_name' => $request->user_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'date' => $request->date,
            'time' => $request->time,
            'status'=>'Booked'
        ]);

        notify()->success("Appointment Created Successfully");
        return redirect()->route('appointment.details');
    }

    public function cancelAppointment($id)
    {
        $appointments =  Appointment::findOrFail($id);
        // dd($id);
        $appointments->update([
            'status' => 'Cancelled'
        ]);

        notify()->success('Appointment Cancel Successfully.');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $searchResult = collect(); // Initialize an empty collection

        if ($request->start_date && $request->end_date) {
            // Search in the Appointment table by date range
            $appointments = Appointment::whereBetween('date', [$request->start_date, $request->end_date])->get();
            $searchResult = $searchResult->merge($appointments);
        } elseif ($request->search) {
            // Search in the Appointment table by specific date
            $appointments = Appointment::where('date', 'LIKE', '%' . $request->search . '%')->get();
            $searchResult = $searchResult->merge($appointments);
        }

        return view('backend.pages.appointment.search', compact('searchResult'));
    }
}
