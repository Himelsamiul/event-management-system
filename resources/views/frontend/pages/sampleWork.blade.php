@extends('frontend.master')
@section('content')
<section class="section speakers bg-speaker overlay-lighter">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section Title -->
				<div class="section-title white">
					<h3><span class="alternate">Sample Work</span></h3>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6">
               <img style="width: 300px;height:200px;" src="{{url('images/birthday.jpg')}}" alt="" class="img-fluid">
  
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <img style="width: 300px;height:200px;" src="{{url('images/marriage.jpg')}}" alt="" class="img-fluid">
  
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <img style="width: 300px;height:200px;" src="{{url('images/eng.jpg')}}" alt="" class="img-fluid">
  
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <img style="width: 300px;height:200px;" src="{{url('images/seminer.jpg')}}" alt="" class="img-fluid">
  
            </div>
		
        </div>
</section>
@endsection