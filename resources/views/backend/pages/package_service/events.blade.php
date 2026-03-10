@extends('backend.master')

@section('content')

<h1 class="mb-4" style="color:rgb(4, 38, 89);">Events</h1>

<div class="row">
    @foreach($packages as $data)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0" style="background-color: #e6f0ff; border-radius: 10px;">
                <div class="card-body text-center">
                    <a href="{{ route('admin.package.service.create', $data->id) }}" style="text-decoration: none; color: #333;">
                        <h5 class="card-title mb-0">{{ $data->name }}</h5>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
