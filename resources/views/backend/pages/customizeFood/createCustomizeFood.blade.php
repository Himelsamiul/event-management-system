@extends('backend.master')
@section('content')

<h1>Create Customize Food Item</h1>


<form action="{{route('admin.customize.food.store')}}" method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="">Name</label>
    <input required name="name" type="text" class="form-control" id="" placeholder="Enter Food name">
  </div>

  <br>

<div class="form-group">
  <label for="">Event</label>
  <select class="form-control" name="event_id" id="">
  <option>select event</option>
    @foreach ($events as $data)
   <option value ="{{$data->id}}">{{$data->name}}</option>
   @endforeach 
   </select>
</div>
  <br>

<div class="form-group">
  <label for="">Vendor</label>
  <select class="form-control" name="vendor_id" id="">
  <option>select vendor</option>
    @foreach ($vendors as $data)
   <option value ="{{$data->id}}">{{$data->name}}</option>
   @endforeach 
   </select>
</div>

  <br>
  <div class="form-group">
    <label for="">Price</label>
    <input required name="price" type="number" class="form-control" id="" placeholder="Enter Food Price">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection