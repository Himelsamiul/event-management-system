@extends('backend.master')

@section('content')

<h1>Events</h1>

<a href="{{route('admin.create.event')}}" class="btn btn-success">Create Event</a>
<br>
<br>

<form action="{{ route('admin.event.search') }}" method="GET" class="mb-3">
  <div class="input-group">
    <input type="text" name="search" class="form-control" placeholder="Search by event name" value="{{ request()->search }}">
    <div class="input-group-append">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  @php
  $currentPage = $events->currentPage();
  $perPage = $events->perPage();
  $startId = ($currentPage - 1) * $perPage + 1;
  @endphp

    @foreach($events as $key => $data)

    <tr>
      <th scope="row">{{ $startId + $key }}</th>
      <td>{{$data->name}}</td>
      <td><img style="width: 100px;height:100px" src="{{ url('images/events', $data->image) }}" alt="" srcset=""></td>
      <td>
        <a class="btn btn-info" href="{{route('admin.event.edit' , $data->id)}}">Edit</a>
        <a class="btn btn-danger" href="{{route('admin.event.delete' , $data->id)}}">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$events->links()}}

@endsection