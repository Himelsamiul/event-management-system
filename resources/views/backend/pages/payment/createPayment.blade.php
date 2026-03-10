@extends('backend.master')
@section('content')

<h1>Create Payment</h1>


<form action="{{route('admin.payment.details.store')}}" method="post">
@csrf
  <div class="form-group"> 
    <label for="">Transaction Id</label>
    <input required name="transaction_id" type="text" class="form-control" id="" placeholder="Enter Transaction Id">
  </div>

  <br>

 <div class="form-group">
    <label for="">Amount</label>
    <input required name="amount" type="number" id="" class="form-control" placeholder="Enter Amount" >
  </div>
  
 <br>

 <div class="form-group">
    <label for="">Payment Method</label>
    <input required name="payment_method" type="text" id="" class="form-control" placeholder="Enter Payment Method" >
  </div>
  
 <br>

 <div class="form-group">
    <label for="">Due</label>
    <input required name="due" type="number" id="" class="form-control" placeholder="Enter due">
  </div>
  
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection