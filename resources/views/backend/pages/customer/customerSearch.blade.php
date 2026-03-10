@extends('backend.master')

@section('content')

<h1>Customers</h1>

<!-- Search form -->
<form action="{{ route('admin.search.customer') }}" method="GET" class="mb-3">
<div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="" value="{{ request()->search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<h3>Search result :
    found {{ $customerDetails->count() }}
</h3>

@if($customerDetails ->count() > 0)
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Image</th>
      <th>Action</th>
    </tr>
  </thead> 
  <tbody>

@foreach($customerDetails as $key => $data)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$data->name}}</td>
      <td>{{$data->email}}</td>
      <td>{{$data->phone}}</td>
      <td>{{$data->address}}</td>
      <td><img style="width: 100px;height:100px" src="{{ url('images/customers', $data->image) }}" alt="" srcset=""></td>
      <td> 
        <a class="btn btn-danger" href="{{route('admin.delete.customer', $data->id)}}">Delete</a>
      </td> 
    </tr>
@endforeach    
  </tbody>
</table>
@else
<p>No result found.</p>
@endif
{{$customerDetails->appends(request()->query())->links()}}

@endsection    
