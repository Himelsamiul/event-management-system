@extends('backend.master')
@section('content')

<h1>Create Vendor</h1>


<form action="{{route('admin.vendor.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="">Vendor Name</label>
    <input required name="vendor_name" type="text" class="form-control" id="" placeholder="Enter Vendor name">
  </div>

  <br>
  
  <div class="form-group">
    <label for="">Vendor Address</label>
    <input required name="vendor_address" type="text" class="form-control" id="" placeholder="Enter Vendor address">
  </div>

  <br>

  <div class="form-group">
    <label for="">Vendor Phone</label>
    <input required name="vendor_phone" type="tel" class="form-control" id="" placeholder="Enter Vendor Phone">
  </div>

  <br>

  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection