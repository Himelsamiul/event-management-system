@extends('frontend.master')
@section('content')
<section class="section about">
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-4 align-self-center">
                <div class="image-block bg-about">
                    <img class="img-fluid" style="width: 350px;height:350px" src="{{ url('images/customers', $profileData->image) }}" alt="">
                </div>
            </div>

            <div class="col-lg-6 align-self-center">
                <div class="content-block">
                    <h2>About <span class="alternate">You</span></h2>
                    <div class="description-one">
                        <p></p>
                    </div>
                    <div class="description-two">
                        <div class="col-md-6">
                            <label style="color: black;" for="Name">Name: {{ $profileData->name }}</label>
                        </div>
                        <div class="col-md-6">
                            <label style="color: black;" for="Name">Email: {{ $profileData->email }}</label>
                        </div>
                        <div class="col-md-6">
                            <label style="color: black;" for="Name">Phone: {{ $profileData->phone }}</label>
                        </div>
                        <div class="col-md-6">
                            <label style="color: black;" for="Name">Address: {{ $profileData->address }}</label>
                        </div>
                    </div>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('edit.profile') }}" class="btn btn-main-md">Update Profile</a>
                        </li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('booking.details') }}" class="btn btn-main-md">Booking Details</a>
                        </li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('appointment.details') }}" class="btn btn-main-md">Appointment Details</a>
                        </li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('customize.booking.details') }}" class="btn btn-main-md">Customize Booking Details</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
</div>
</section>
@endsection
