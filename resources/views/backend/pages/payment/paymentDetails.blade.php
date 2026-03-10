@extends('backend.master')

@section('content')

<h1>Payment Details</h1>
<a href="{{route('create.payment')}}" class="btn btn-success">Create Payment</a>

<table class="table">
  <thead>
    <tr> 
      <th scope="col">Id</th>
      
      <th scope="col">Transaction Id</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment Method</th>
      <th scope="col">Due</th>
      <!-- <th scope="col">Status</th> 
      <th>Action</th> -->
    </tr>
  </thead>
  
  <tbody>
  @foreach($payments as $data)
 
    <tr>
      <th scope="row">{{$data->id}}</th>
      <td>{{$data->transaction_id}}</td>
      <td>{{$data->amount}} .BDT</td>
      <td>{{$data->payment_method}}</td>
      <td>{{$data->due}}</td>
    </tr>
@endforeach    
  </tbody>
</table>
{{$payments->links()}}

@endsection