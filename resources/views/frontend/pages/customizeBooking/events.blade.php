@extends('frontend.master')

@section('content')

<style>
    .event-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }

    .event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.25);
    }

    .event-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .event-content {
        padding: 18px;
        text-align: center;
    }

    .event-content h5 {
        font-weight: 700;
        margin-bottom: 12px;
        color: #222;
    }

    .event-btn {
        border-radius: 25px;
        padding: 8px 22px;
        font-size: 14px;
    }
</style>

<section class="section speakers bg-speaker1 overlay-lighter">
    <div class="container">

        {{-- Section Title --}}
        <div class="row mb-4">
            <div class="col-12 text-center">
                <div class="section-title white">
                    <h3>
                        <span class="alternate" style="color:white;">
                            <strong>Events</strong>
                        </span>
                    </h3>
                    <p style="color:#ddd;">Choose your favorite event & book instantly 🎉</p>
                </div>
            </div>
        </div>

        {{-- Event Cards --}}
        <div class="row">
            @foreach($eventShow as $data)
                <div class="col-md-3 col-sm-6">
                    <div class="event-card">
                        <img src="{{ url('images/events/', $data->image) }}" alt="event">

                        <div class="event-content">
                            <h5>{{ $data->name }}</h5>
                            <a href="{{ route('customize.booking.form', $data->id) }}"
                               class="btn btn-success event-btn">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection
