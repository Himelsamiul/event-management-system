<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function vendorList()
    {
        $vendors = Vendor::paginate(10);
        return view('backend.pages.vendors.vendorList', compact('vendors'));
    }

    public function vendorSearch(Request $request)
    {
        $query = Vendor::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $vendors = $query->paginate(4);

        return view('backend.pages.vendors.search', compact('vendors'));
    }


    public function createVendor()
    {
        return view('backend.pages.vendors.createVendor');
    }

    public function VendorStore(Request $request)
    {
        $checkValidation = Validator::make(
            $request->all(),
            [
                'vendor_name' => 'required',    
                'vendor_address' => 'required' ,     
                'vendor_phone' => 'required'      
            ]
        );

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        Vendor::create([
            'name' => $request->vendor_name,
            'address' => $request->vendor_address,
            'phone' => $request->vendor_phone,
        ]);

        notify()->success('Vendor Created Successfully.');

        return redirect()->route('admin.vendor.list');
    }

    public function vendorEdit(Request $request, $vendor_id)
    {
        $vendors = Vendor::find($vendor_id);
        return view('backend.pages.vendors.vendorEditForm', compact('vendors'));
    }

    public function  vendorUpdate(Request $request, $vendor_id)
    {
        $vendors = Vendor::find($vendor_id);

        $vendors->update([
            'name' => $request->vendor_name,
            'address' => $request->vendor_address,
            'phone' => $request->vendor_phone,
        ]);

        notify()->success('Vendor Updated Successfully.');

        return redirect()->route('admin.vendor.list');
    }

    public function vendorDelete($vendor_id)
    {
        $vendors = Vendor::find($vendor_id);
        $vendors->delete();
        notify()->success('Vendor Deleted Successfully.');
        return redirect()->back();
    }
}
