@extends('backend.master')
<style>
    @media print {
        #print, .search-form {
            display: none;
        }

        footer, .sidebar, .navbar, .action {
            display: none !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        .table {
            width: 100%;
            table-layout: fixed;
            font-size: smaller; /* Smaller font size for printing */
        }

        th, td {
            white-space: nowrap; /* Ensure no cell content breaks into new lines */
        }
    }

    /* Ensure table doesn't overflow */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        table-layout: auto;
    }
</style>

@section('content')

<h1>Booking Details</h1>
<button id="print" onclick="printlist()" class="btn btn-info">Print</button>
<br>
<br>

<form action="{{ route('admin.search.booking') }}" method="get">
    <div class="input-group mb-3">
        <input type="date" id="start_date" class="form-control" placeholder="Start Date" name="start_date">
        <input type="date" id="end_date" class="form-control" placeholder="End Date" name="end_date">
        <div class="input-group-append">
            <button style="color: black;" class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </div>
</form>

<h3>Search result for:
    @if(request()->start_date && request()->end_date)
    "{{ request()->start_date }} to {{ request()->end_date }}"
    @endif
    found {{ $searchResult->count() }}
</h3>

@if($searchResult->count() > 0)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Event</th>
                <th>Package</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Venue</th>
                <th>Guest</th>
                <th>Transaction Id</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th class="action">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($searchResult as $data)
            <tr>
                <th scope="row">{{ $data->id }}</th>
                <td>{{ $data->name }}</td>
                <td>{{ $data->package->event->name }}</td>
                <td>{{ $data->package->name }}</td>
                <td>{{ $data->phone_number }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->venue }}</td>
                <td>{{ $data->guest }}</td>
                <td>{{ $data->transaction_id }}</td>
                <td class="date">{{ $data->date }}</td>
                <td>{{ $data->start_time }}</td>
                <td>{{ $data->end_time }}</td>
                <td>{{ $data->total_amount }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->payment_status }}</td>
                <td class="action">
                    @if($data->status == 'Pending')
                    <a href="{{ route('admin.accept.booking', $data->id) }}" class="btn btn-success">Accept</a>
                    <a href="{{ route('admin.reject.booking', $data->id) }}" class="btn btn-danger">Reject</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<p>No result found.</p>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.date').forEach(cell => {
            const date = new Date(cell.innerText);
            const formattedDate = ('0' + (date.getMonth() + 1)).slice(-2) + '/' + ('0' + date.getDate()).slice(-2) + '/' + date.getFullYear();
            cell.innerText = formattedDate;
        });
    });

    function printlist() {
        window.print();
    }
</script>
@endsection
