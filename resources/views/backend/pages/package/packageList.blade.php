@extends('backend.master')

@section('content')

<h1>Packages</h1>

<a href="{{route('admin.create.package')}}" class="btn btn-success">Create Package</a>
<br>
<br>
<form action="{{ route('admin.package.search') }}" method="GET" class="mb-3">
  <div class="input-group">
    <input type="text" name="search" class="form-control" placeholder="" value="{{ request()->search }}">
    <div class="input-group-append">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Event</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @php
    $currentPage = $packages->currentPage();
    $perPage = $packages->perPage();
    $startId = ($currentPage - 1) * $perPage + 1;
    @endphp
    @foreach($packages as $key => $data)

    <tr>
      <th scope="row">{{ $startId + $key }}</th>
      <td>{{$data->name}}</td>
      <td>{{$data->event->name}}</td>
      <!-- <td><img style="width: 100px;height:100px" src="{{ url('images/events', $data->image) }}"
      alt="" srcset=""></td> -->
      <td>
        <a class="btn btn-info" href="{{route('admin.package.edit',$data->id)}}">Edit</a>
        <a class="btn btn-danger" href="{{route('admin.package.delete',$data->id)}}">Delete</a>
      </td>
    </tr>

    @endforeach
  </tbody>
</table>
{{$packages->links()}}
@endsection