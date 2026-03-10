@extends('frontend.master')
@section('content')

<section class="section speakers bg-speaker overlay-lighter">
	<div class="container">

			
		<style>
        .button-container {
            text-align: center;
            margin-top: 50px;
        }
    </style>

    <form action="{{route('booking.store',$singleEvent->id)}}" method="post">
        @csrf
        <div class="container mt-5 pt-6">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
                    <img class="img-fluid" style="object-fit: cover; width: 100%; height: 300px;"
                        src="{{url('images/events',$singleEvent->event->image)}}" alt="">
                    <div class="mt-4">
                        <h3  style="color:white ;">{{ $singleEvent->event->name }}</h3>
                        <p  style="color:white ;">{{ $singleEvent->description}}</p>
                        <p  style="color:white ;"><strong>Price Range:</strong> min_price- max_price .BDT</p>
                    </div>

                    <h5  style="color:white ;">Select Services:</h5>
                    @foreach($services as $data)
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="services[]" value="{{ $data->id }}">
                            <label class="form-check-label" for="service">
                                {{ $data->name }} </label>                            </label>
                        </div>
                    @endforeach
                <input step="visibility:none';" type="hidden" class="card-title" name="event_name"
                    value="" />
                <hr>
                <h5  style="color:white ;">Calculated Price: <span id="calculated_price"></span></h5>
                <hr>
                <div class="form-outline md-6" style="width: 22rem;">
                    <label class="form-label" for="form2"  style="color:white ;">Enter number of guest</label>
                    <input  name="guest" id="guest" type="number" class="form-control" onkeyup=""/>

                </div>
                <div class="form-group 2">
                    <label for="inputContactNumber"  style="color:white ;">Appointment Date</label>
                    <input name="apponitment_date" type="date" class="form-control" id="event_price" placeholder=""
                        required>
                        @error('appointment_date')
                        <div class ="alert alert-danger">{{$message}}</div>
                        @enderror

                </div>
                <div class="form-group 2">
                    <label for="inputContactNumber"  style="color:white ;">Event Starting Date</label>
                    <input name="start_date" type="date" class="form-control" id="event_price" placeholder="" required>
                    @error('start_date')
                        <div class ="alert alert-danger">{{$message}}</div>
                        @enderror

                </div>
                <div class="form-group 2">
                    <label for="inputContactNumber"  style="color:white ;">Event Ending Date</label>
                    <input name="end_date" type="date" class="form-control" id="event_price" placeholder="" required>
                    @error('end_date')
                        <div class ="alert alert-danger">{{$message}}</div>
                        @enderror
                </div>

                <div class="form-outline md-6" style="width: 22rem;">
                    <label class="form-label" for="form2"  style="color:white ;">Location</label>
                    <input required name="location" value="" type="text" id="form2" class="form-control" />
                    @error('location')
                        <div class ="alert alert-danger">{{$message}}</div>
                        @enderror
                <div class="mt-4 text-align-center">
                    <button type="submit" class="col-12 mb-4 btn btn-primary">Get Quote</button>
                </div>

            </div>
        </div>
    </form>
          
    
    

			
		
	</div>
</section>
</div>
@endsection







		
		
		
			
				





