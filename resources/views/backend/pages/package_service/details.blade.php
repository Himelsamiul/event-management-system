@extends('backend.master')

@section('content')

<h1>Package Service Details</h1>

<div class="card">
    <div class="card-body">
        <h4>Event: {{ $packageService->event->name }}</h4>
        <h4>Package: {{ $packageService->package->name }}</h4>
        <h4>Food: {{ $packageService->food->name }}</h4>
        <h4>Decoration: {{ $packageService->decoration->name }}</h4>
    </div>
</div>

<a href="{{ route('admin.package.service.list') }}" class="btn btn-secondary mt-3">Back</a>

@endsection
