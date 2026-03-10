@extends('backend.master')

@section('content')

<h1>Packages</h1>

<!-- Search form -->
<form action="{{ route('admin.package.search') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="" value="{{ request()->search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
<h3>Search result :
    found {{ $packages->count() }}
</h3>

@if($packages->count() > 0)
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

    @foreach($packages as $data)

    <tr>
      <th scope="row">{{$data->id}}</th>
      <td>{{$data->name}}</td>
      <td>{{$data->event->name}}</td>
      <td>
        <a class="btn btn-info" href="{{route('admin.package.edit',$data->id)}}">Edit</a>
        <a class="btn btn-danger" href="{{route('admin.package.delete',$data->id)}}">Delete</a>
      </td>
    </tr>

    @endforeach
  </tbody>
</table>
@else
<p>No result found.</p>
@endif
{{$packages->appends(request()->query())->links()}}
@endsection
