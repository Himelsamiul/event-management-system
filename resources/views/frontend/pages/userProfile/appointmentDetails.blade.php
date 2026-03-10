@extends('frontend.master')
@section('content')
<div style="padding-top: 150px; padding-right:30px; padding-left:30px; padding-bottom:30px;">
    <h5>Your Appointment Details</h5>
    <div style="padding-bottom: 30px;"></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date(mm/dd/yy)</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $currentPage = $appointmentDetails->currentPage();
            $perPage = $appointmentDetails->perPage();
            $startId = ($currentPage - 1) * $perPage + 1;
            @endphp
            @foreach($appointmentDetails as $key => $data)
            <tr>
                <th scope="row">{{ $startId + $key }}</th>
                <td>{{ \Carbon\Carbon::parse($data->date)->format('m/d/y') }}</td>
                <td>{{ $data->time }}</td>
                <td>
                    @if($data->status == 'Cancelled')
                    Cancelled
                    @endif
                </td>
                <td>
                    @if($data->status != 'Cancelled')
                    <a class="btn-sm btn-danger" href="{{ route('cancel.appointment', $data->id) }}">Cancel Appointment</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$appointmentDetails->links()}}
</div>
@endsection