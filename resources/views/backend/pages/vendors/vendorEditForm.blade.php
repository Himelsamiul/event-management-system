@extends('backend.master')
@section('content')

<h1>Edit Vendor</h1>
  
<form action="{{route('admin.vendor.update', $vendors->id)}}" method="post" enctype="multipart/form-data">                             
@method('put')
@csrf
  <div class="form-group">
    <label for="">Vendor Name</label>
    <input name="vendor_name" type="text" class="form-control" id="" value="{{$vendors->name}}" placeholder="Enter Vendor name">
  </div> 

  <br>

  <div class="form-group">
    <label for="">Vendor Address</label>
    <input name="vendor_address" type="text" class="form-control" id="" value="{{$vendors->address}}" placeholder="Enter Vendor Address">
  </div> 

  <br>

  <div class="form-group">
    <label for="">Vendor Phone</label>
    <input name="vendor_phone" type="tel" class="form-control" id="" value="{{$vendors->phone}}" placeholder="Enter Vendor Phone">
  </div> 

  <br>

  <br>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection