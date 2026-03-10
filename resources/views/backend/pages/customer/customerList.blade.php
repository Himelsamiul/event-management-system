@extends('backend.master')

@section('content')

<h1>Customers</h1>

<form action="{{ route('admin.search.customer') }}" method="GET" class="mb-3">
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
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      
     
      <th>Action</th>
    </tr>
  </thead> 
  <tbody>
  @php
  $currentPage = $customerDetails->currentPage();
  $perPage = $customerDetails->perPage();
  $startId = ($currentPage - 1) * $perPage + 1;
  @endphp
@foreach($customerDetails as $key => $data)
    <tr>
      <th scope="row">{{ $startId + $key }}</th>
      <td>{{ $data->name }}</td>
      <td>{{ $data->email }}</td>
      <td>{{ $data->phone }}</td>
      <td>{{ $data->address }}</td>
      <td>
        <a class="btn btn-danger" href="{{ route('admin.delete.customer', $data->id) }}">Delete</a>
      </td> 
    </tr>
@endforeach

  </tbody>
</table>
{{$customerDetails->links()}}

@endsection    