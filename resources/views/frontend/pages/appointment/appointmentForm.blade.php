@extends('frontend.master')
@section('content')

<section class="registration">
    <div class="">
        <div class="registration-block bg-registration-one">
            <div class="block">
                <div class="row" style="margin-top:0px; margin-bottom:0px;">
                    <div class="col-md-4"></div>
                    <div style="margin-top:80px; border-radius:15px;">
                        <div class="col-md-4"></div>
                        <form action="{{ route('appointment.details.store') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <h3 style="color: black;"><strong>Appointment For</strong> <span class="alternate"><strong>Eventre</strong> </span></h3>

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <input required name="user_name" type="text" class="form-control" id="" value="{{ auth('customerGuard')->user()->name }}" placeholder="Enter Name" readonly>
                                </div>
                                <div class="form-group">
                                    <input required name="phone_number" type="tel" id="" value="{{ auth('customerGuard')->user()->phone }}" class="form-control" placeholder="Enter Phone Number" readonly>
                                </div>
                                <div class="form-group">
                                    <input required name="email" type="email" id="" class="form-control" value="{{ auth('customerGuard')->user()->email }}" placeholder="Enter Email" readonly>
                                </div>
                                <div class="form-group">
                                    <input required name="date" type="date" id="datePicker" class="form-control" value="{{ old('date') }}" placeholder="Enter date">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="time">
                                        <option value="" disabled selected>Select Time</option>
                                        <option value="11:00" {{ old('time') == '11:00' ? 'selected' : '' }}>11:00</option>
                                        <option value="12:00" {{ old('time') == '12:00' ? 'selected' : '' }}>12:00</option>
                                        <option value="13:00" {{ old('time') == '13:00' ? 'selected' : '' }}>13:00</option>
                                        <option value="14:00" {{ old('time') == '14:00' ? 'selected' : '' }}>14:00</option>
                                        <option value="15:00" {{ old('time') == '15:00' ? 'selected' : '' }}>15:00</option>
                                        <option value="16:00" {{ old('time') == '16:00' ? 'selected' : '' }}>16:00</option>
                                        <option value="17:00" {{ old('time') == '17:00' ? 'selected' : '' }}>17:00</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-white-md">Get Appointment</button>
                            </div>
                        </form>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const today = new Date();
    const minDate = today.toISOString().split('T')[0];
    document.getElementById('datePicker').setAttribute('min', minDate);
</script>
@endsection
