@extends('backend.master')
@section('content')

<h1>Create Package Services</h1>
<form action="{{route('admin.package.service.store')}}" method="post" enctype="multipart/form-data">
  @csrf


  <input type="hidden" name="event_id" value="{{ $events->id }}">

  <div class="form-group">
    <label for="">Package </label>
    <select class="form-control" name="package_id" id="">
      <option>select package</option>
      @foreach ($packages as $data)
      <option value="{{$data->id}}">{{$data->name}}</option>
      @endforeach
    </select>
  </div>

  <br>

  @if($foods->isNotEmpty())
  <label for="">Food</label>
  @foreach($foods as $data)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="food_id[]" value="{{ $data->id }}">
    <label class="form-check-label" for="food">
      {{ $data->name }} (BDT.{{$data->price}}-/per person)
    </label>
  </div>
  @endforeach
  @endif
  <br>
  @if($decorations->isNotEmpty())
  <label for="">Decoration</label>
  @foreach($decorations as $data)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="decoration_id[]" value="{{ $data->id }}">
    <label class="form-check-label" for="decoration">
      {{ $data->name }} (BDT.{{$data->price}})
    </label>
  </div>
  @endforeach

  @endif
  <br>
  <br>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection