@extends('backend.master')
@section('content')

<h1>Edit Customize Decoration Item</h1>
  
<form action="{{route('admin.customize.decoration.update', $decorations->id)}}" method="post" enctype="multipart/form-data">                             
@method('put')
@csrf
  <div class="form-group">
    <label for="">Customize Decoration Name</label>
    <input name="name" type="text" class="form-control" id="" value="{{$decorations->name}}" placeholder="">
  </div> 

  <br>
  <div class="form-group">
    <label for="">Event</label>
    <select class="form-control" name="event_id" id="">
    <option value ="{{$decorations->event->id}}">{{$decorations->event->name}}</option>
      @foreach ($events as $data)
     <option value ="{{$data->id}}">{{$data->name}}</option>
     @endforeach 
     </select>
  </div>

  <br>
  <div class="form-group">
    <label for="">Vendor</label>
    <select class="form-control" name="vendor_id" id="">
    <option value ="{{$decorations->vendor->id}}">{{$decorations->vendor->name}}</option>
      @foreach ($vendors as $data)
     <option value ="{{$data->id}}">{{$data->name}}</option>
     @endforeach 
     </select>
  </div>

 <br>
  <div class="form-group">
    <label for="">Price</label>
    <textarea name="price" id="" class="form-control" placeholder="" >{{$decorations->price}}</textarea>
  </div>
 <br>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection