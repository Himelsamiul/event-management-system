@extends('backend.master')

<style>
  @media print {
    body * {
      visibility: hidden;
    }

    .print-area, .print-area * {
      visibility: visible;
    }

    .print-area {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }

    #print,
    .input-group,
    footer,
    .sidebar,
    .navbar,
    .pagination {
      display: none !important;
    }
  }
</style>

@section('content')

<div class="print-area">

  <h1>Appointment Details</h1>
  <button id="print" onclick="printlist()" class="btn btn-info">Print</button>
  <br><br>

  <form action="{{ route('admin.search.appointment') }}" method="get" class="search-form">
    <div class="input-group mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Search by date..." name="search">
      <input type="date" id="startDateInput" class="form-control" placeholder="Start Date" name="start_date">
      <input type="date" id="endDateInput" class="form-control" placeholder="End Date" name="end_date">
      <div class="input-group-append">
        <button style="color: black;" class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </div>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Email</th>
        <th scope="col">Date(mm/dd/yy)</th>
        <th scope="col">Time</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @php
      $currentPage = $appointments->currentPage();
      $perPage = $appointments->perPage();
      $startId = ($currentPage - 1) * $perPage + 1;
      @endphp
      @foreach($appointments as $key => $data)
      <tr>
        <th scope="row">{{ $startId + $key }}</th>
        <td>{{ $data->user_name }}</td>
        <td>{{ $data->phone_number }}</td>
        <td>{{ $data->email }}</td>
        <td>{{ \Carbon\Carbon::parse($data->date)->format('m/d/y') }}</td>
        <td>{{ \Carbon\Carbon::parse($data->time)->format('h:i A') }}</td>
        <td>{{ $data->status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="pagination">
    {{ $appointments->links() }}
  </div>

</div>

<script>
  function printlist() {
    window.print();
  }
</script>

@endsection
