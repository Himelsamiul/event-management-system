@extends('frontend.master')
@section('content')
<div style="padding-top: 150px; padding-right:30px; padding-left:10px; padding-bottom:30px;">
    <h4 style="text-align: center;">Your Booking Details</h4>
    <div style="padding-bottom: 30px;"></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Transaction Id</th>
                <th scope="col">Event</th>
                <th scope="col">Package</th>
                <th scope="col">Venue</th>
                <th scope="col">Amount</th>
                <th scope="col">Date(mm/dd/yy)</th>
                <th scope="col">Start_time</th>
                <th scope="col">End_time</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Dues</th>
                <th scope="col">Total Paid amount</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $currentPage = $bookingDetails->currentPage();
            $perPage = $bookingDetails->perPage();
            $startId = ($currentPage - 1) * $perPage + 1;
            @endphp
            @foreach($bookingDetails as $key => $data)
                <tr>
                    <td>{{ $startId + $key }}</td>
                    <td>{{ $data->transaction_id }}</td>
                    <td>{{ $data->package->event->name }}</td>
                    <td>{{ $data->package->name }}</td>
                    <td>{{ $data->venue }}</td>
                    <td>{{ $data->total_amount }}</td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->start_time }}</td>
                    <td>{{ $data->end_time }}</td>
                    <td>
                        @if($data->status == 'Cancelled')
                        Booking Cancelled
                        @elseif($data->status == 'Reject')
                        Booking Rejected
                        @elseif($data->payment_status != 'Paid' && $data->created_at->diffInDays(now()) > 2)
                        Not Paid & Booking Rejected
                        @else
                        {{ $data->payment_status }}
                        @endif
                    </td>
                    <td>{{ $data->dues }} TK</td>
                    <td>{{ $data->total_amount - $data->dues }} TK</td>
                    <td>
                        @if($data->payment_status == 'pending' && $data->created_at->diffInDays(now()) > 2)

                        @elseif($data->status == 'Pending')
                            <a class="btn-sm btn-danger" href="{{ route('cancel.booking', $data->id) }}">Cancel Booking</a>
                        @elseif($data->status == 'Accept' && $data->payment_status == 'pending' && $data->created_at->diffInDays(now()) <= 2) 
                            <div>
                                <a class="btn-sm btn-primary" href="{{ route('make.payment', $data->id) }}">Make Payment</a>
                            </div>
                            <div>
                                <a class="btn-sm btn-danger" href="{{ route('cancel.booking', $data->id) }}">Cancel Booking</a>
                            </div>
                        @elseif($data->payment_status !== 'pending')
                            <a class="btn-sm btn-success" href="{{ route('download.receipt', $data->id) }}">Receipt</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$bookingDetails->links()}}
</div>
@endsection