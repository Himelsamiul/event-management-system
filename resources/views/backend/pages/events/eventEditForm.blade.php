@extends('backend.master')
@section('content')

<h1>Edit Event</h1>
  
<form action="{{route('admin.event.update', $events->id)}}" method="post" enctype="multipart/form-data">                             
@method('put')
@csrf
  <div class="form-group">
    <label for="">Event Name</label>
    <input name="event_name" type="text" class="form-control" id="" value="{{$events->name}}" placeholder="Enter Event name">
  </div> 

  <br>

  <div class="form-group">
    <label for="">Upload Image</label>
    <img style="width: 100px;height:100px" src="{{url('images/events',$events->image)}}" alt="">
    <input name="image" type="file" class="form-control" id="" placeholder="Upload Image">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection