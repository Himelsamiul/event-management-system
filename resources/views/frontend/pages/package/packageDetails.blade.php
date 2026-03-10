@extends('frontend.master')
@section('content')
<section class="section speakers bg-speaker overlay-lighter">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section Title -->
				<div class="section-title white">
					<h3><span class="alternate">Services</span></h3> 

				</div>
			</div>
		</div>
		<div class="col">
			<div class="row">
				<div class="col-md-12" style="padding-left: 200px; padding-right: 200px;">
					<div class="speaker-item">
						<div class="content text-left">
						<h4 style="text-align: center;">Food Items</h4>
							@foreach($packageDetails as $key => $data)
							<p style="color: black;">{{$key+1}}: {{$data->food->name}}({{$data->food->price}} /-per person)</p>
							@endforeach
						</div>
					</div>
					<div class="speaker-item">
						<div class="content text-left">
						<h4 style="text-align: center;">Decoration Items</h4>
							@foreach($packageDetails as $data)
							<p style="color: black;"> {{$data->decoration->name}} (BDT.{{$data->decoration->price}})</p>
							@break
							@endforeach
						</div>
					</div>
					<div style="text-align: center;">
						@foreach($packageDetails as $data)
						<a href="{{ route('booking.form', $data->package_id) }}" class="btn btn-success">Book Now</a>
						@break
						@endforeach
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
@endsection