@extends('backend.master')

@section('content')

<h1>Foods</h1>

<a href="{{ route('admin.create.food') }}" class="btn btn-success">Create Food</a>
<br><br>

<form action="{{ route('admin.food.search') }}" method="GET" class="mb-3">
  <div class="input-group">
    <input type="text" name="search" class="form-control" placeholder="Search by food name" value="{{ request()->search }}">
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
      <th scope="col">Event</th>
      <th scope="col">Vendor</th>
      <th scope="col">Price</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @php
        $currentPage = $foods->currentPage(); 
        $perPage = $foods->perPage();         
        $startId = ($currentPage - 1) * $perPage + 1; 
    @endphp
    
    @foreach($foods as $key => $data)
      <tr>
        <th scope="row">{{ $startId + $key }}</th>
        <td>{{ $data->name }}</td>
        <td>{{ $data->event->name }}</td>
        <td>{{ $data->vendor->name }}</td>
        <td>BDT.{{ $data->price }} /-per person</td>
        <td>
          <a class="btn btn-info" href="{{ route('admin.food.edit', $data->id) }}">Edit</a>
          <a class="btn btn-danger" href="{{ route('admin.food.delete', $data->id) }}">Delete</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $foods->links() }}

@endsection
