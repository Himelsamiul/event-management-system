@extends('backend.master')

@section('content')

<h1>Vendors</h1>

<a href="{{route('admin.create.vendor')}}" class="btn btn-success">Create Vendor</a>
<br>
<br>

<form action="{{ route('admin.vendor.search') }}" method="GET" class="mb-3">
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
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  @php
  $currentPage = $vendors->currentPage();
  $perPage = $vendors->perPage();
  $startId = ($currentPage - 1) * $perPage + 1;
  @endphp

    @foreach($vendors as $key => $data)

    <tr>
      <th scope="row">{{ $startId + $key }}</th>
      <td>{{$data->name}}</td>
      <td>{{$data->address}}</td>
      <td>{{$data->phone}}</td>
      <td>
        <a class="btn btn-info" href="{{route('admin.vendor.edit' , $data->id)}}">Edit</a>
        <a class="btn btn-danger" href="{{route('admin.vendor.delete' , $data->id)}}">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$vendors->links()}}

@endsection