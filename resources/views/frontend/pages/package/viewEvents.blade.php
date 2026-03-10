@extends('frontend.master')
@section('content')
<section class="section speakers bg-speaker1 overlay-lighter">
	<div class="container">
		<div class="row">
			<div class="col-12"> 
				<!-- Section Title -->
				<div class="section-title white">
					<h3><span class="alternate" style="color: white;"><strong>Events</strong></span></h3>
					
				</div>
			</div> 
		</div>
		<div class="row">
			@foreach($eventShow as $data)
			<div class="col-md-3">
				<div class="speaker-item">
					<div class="image">
						<img style="width: 300px;height:200px;" src="{{url('images/events/',$data->image)}}" alt="speaker" class="img-fluid">
						<div class=""></div></div>
					    <div class="content text-center">
						<h5><a href="{{route('all.packages',$data->id)}}" class="btn btn-success">{{$data->name}}</a></h5>
					</div>
				</div>
			</div>
            @endforeach			
		</div>
	</div>
</section>
@endsection