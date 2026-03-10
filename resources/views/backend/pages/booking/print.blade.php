@extends('backend.master')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
</head>

<style>
    @media print {
        #print {
            display: none;
        }
    }
</style>

<body>


    <div class="container">

        <div class="row mt-3">
            <h2 class="mb-1 text-center">Report</h2>
            <!-- <div class="col-1"></div> -->
            <div class="col">
                <button id="print" class="btn btn-success mb-3" onclick="printlist()">Booking Details</button>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">User</th>
                            <th scope="col">Event</th>
                            <th scope="col">Package</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment Status</th>


                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $data)

                        <tr>
                            <th scope="row">{{$data->id}}</th>
                            <td>{{$data->name}}</td>
                            <td>{{$data->package->event->name}}</td>
                            <td>{{$data->package->name}}</td>
                            <td>{{$data->phone_number}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->amount}} .BDT</td>
                            <td>{{$data->start_time}}</td>
                            <td>{{$data->end_time}}</td>
                            <td>{{$data->status}}</td>
                            <td>{{$data->payment_status}}</td>
                        </tr>
                        @endforeach

                        <script>
                        function printlist() {
                            window.print();

                        }
                    </script>
                    </tbody>

                 
</body>

</html>
@endsection