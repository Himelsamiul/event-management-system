@extends('backend.master')
@section('content')

<h1>Create Event</h1>


<form action="{{route('admin.event.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="">Event Name</label>
    <input required name="event_name" type="text" class="form-control" id="" placeholder="Enter Event name">
  </div>

  <!-- <div class="form-group">
    <label for="">Event Address</label>
    <input required name="event_address" type="text" class="form-control" id="" placeholder="Enter Event address">
  </div> -->

  <br>

  <div class="form-group">
    <label for="">Upload Image</label>
    <input name="image" type="file" class="form-control" id="" placeholder="Upload Image">
  </div>

  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection