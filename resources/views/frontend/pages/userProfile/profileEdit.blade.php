@extends('frontend.master')
@section('content')
<section class="section about">
	<div class="container">
		<div class="row">
		 <div class="col-lg-1"></div>
			<div class="col-lg-4 align-self-center">
				<div class="image-block bg-about">
					<img class="img-fluid" style="width: 350px;height:350px"  src="{{ url('images/customers', $profileData->image) }}" alt="">
				</div>
			</div>
			
			<div class="col-lg-6 align-self-center">
				<div class="content-block">
					<h2>Update <span class="alternate">Profile</span></h2>
					<div class="description-one">
						<p>
						</p>
					</div>
					<div class="description-two"> 

                    <form action="{{route('update.profile',$profileData->id)}}" method="post" class="" enctype="multipart/form-data">
                        @method('put')
                            @csrf
							<div class="col-md-6">
                                <label style="color: black;" for="">Name</label>
								<input name="name" value="{{$profileData->name}}" type="text" class="form-control main" placeholder="Your Name" required>
							</div>
							<div class="col-md-6">
                            <label style="color: black;"  for="">Email</label>
								<input name="email" value="{{$profileData->email}}" type="email" class="form-control main" placeholder="Email" required>
							</div>
							<div class="col-md-6">
                            <label style="color: black;"  for="">Phone Number</label>
								<input name="phone" value="{{$profileData->phone}}" type="tel" class="form-control main" placeholder="Phone" required>
							</div>

                            <div class="col-md-6">
                            <label style="color: black;"  for="">Address</label>
								<input  name="address" value="{{$profileData->address}}" type="text" class="form-control main" placeholder="Enter Address" required>
                            </div>

							<div class="col-md-6">
                            <label style="color: black;" for="">Upload Image</label>
								<input  name="image"  type="file" class="form-control main" placeholder="Upload Image" >
                            </div>

	                          </div>
					<ul class="list-inline">
						<li class="list-inline-item">
                        <button class="btn btn-white-md2">Update</button>
						</li>
						
					</ul>
				</div>
			</div>
			<div class="col-lg-1"></div>
		</div>
	</div>
</section>

@endsection
