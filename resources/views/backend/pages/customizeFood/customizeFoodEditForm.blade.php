@extends('backend.master')
@section('content')

<h1>Edit Customize Food Item</h1>
  
<form action="{{route('admin.customize.food.update', $foods->id)}}" method="post" enctype="multipart/form-data">                             
@method('put')
@csrf
  <div class="form-group">
    <label for="">Customize Food Name</label>
    <input name="name" type="text" class="form-control" id="" value="{{$foods->name}}" placeholder="">
  </div> 

  <br>
  <div class="form-group">
    <label for="">Event</label>
    <select class="form-control" name="event_id" id="">
    <option value ="{{$foods->event->id}}">{{$foods->event->name}}</option>
      @foreach ($events as $data)
     <option value ="{{$data->id}}">{{$data->name}}</option>
     @endforeach 
     </select>
  </div>

  <br>
  <div class="form-group">
    <label for="">Vendor</label>
    <select class="form-control" name="vendor_id" id="">
    <option value ="{{$foods->vendor->id}}">{{$foods->vendor->name}}</option>
      @foreach ($vendors as $data)
     <option value ="{{$data->id}}">{{$data->name}}</option>
     @endforeach 
     </select>
  </div>

 <br>
  <div class="form-group">
    <label for="">Price</label>
    <textarea name="price" id="" class="form-control" placeholder="" >{{$foods->price}}</textarea>
  </div>
 <br>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection