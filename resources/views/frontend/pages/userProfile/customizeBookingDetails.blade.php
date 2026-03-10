@extends('frontend.master')
@section('content')
<div style="padding-top: 150px; padding-right:30px; padding-left:10px; padding-bottom:30px;">
    <h5>Your Customize Booking Details</h5>
    <div style="padding-bottom: 30px;"></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Transaction Id</th>
                <th scope="col">Event</th>
                <th scope="col">Foods</th>
                <th scope="col">Decorations</th>
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
            $currentPage = $customizeBookingDetails->currentPage();
            $perPage = $customizeBookingDetails->perPage();
            $startId = ($currentPage - 1) * $perPage + 1;
            @endphp
            @foreach($customizeBookingDetails as $key => $booking)
                <tr>
                    <th scope="row">{{ $customizeBookingDetails->firstItem() + $key }}</th>
                    <td>{{ $booking->transaction_id }}</td>
                    <td>{{ $booking->event->name ?? 'N/A' }}</td>
                    <td>
                        @foreach($booking->foods as $food)
                        {{ $food->name }},<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($booking->decorations as $decoration)
                        {{ $decoration->name }},<br>
                        @endforeach
                    </td>
                    <td>{{ $booking->venue }}</td>
                    <td>{{ $booking->total_amount }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->start_time }}</td>
                    <td>{{ $booking->end_time }}</td>
                    <td> 
                        @if($booking->status == 'Cancelled')
                        Booking Cancelled
                        @elseif($booking->status == 'Reject')
                        Booking Rejected
                        @elseif($booking->payment_status != 'Paid' && $booking->created_at->diffInDays(now()) > 2)
                        Not Paid & Booking Rejected
                        @else
                        {{ $booking->payment_status }}
                        @endif
                    </td>
                    <td>{{ $booking->dues }} TK</td>
                    <td>{{ $booking->total_amount - $booking->dues }} TK</td>
                    <td>
                        @if($booking->payment_status == 'pending' && $booking->created_at->diffInDays(now()) > 2)

                        @elseif($booking->status == 'Pending')
                            <a class="btn-sm btn-danger" href="{{ route('cancel.customize.booking', $booking->id) }}">Cancel Booking</a>
                        @elseif($booking->status == 'Accept' && $booking->payment_status == 'Pending' && $booking->created_at->diffInDays(now()) <= 2) 
                            <div>
                                <a class="btn-sm btn-primary" href="{{ route('customize.make.payment', $booking->id) }}">Make Payment</a>
                            </div>
                            <div>
                                <a class="btn-sm btn-danger" href="{{ route('cancel.customize.booking', $booking->id) }}">Cancel Booking</a>
                            </div>
                        @elseif($booking->payment_status !== 'pending')
                            <a class="btn-sm btn-success" href="{{ route('customize.download.receipt', $booking->id) }}">Receipt</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$customizeBookingDetails->links()}}
</div>
@endsection