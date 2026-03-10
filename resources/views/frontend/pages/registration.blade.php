@extends('frontend.master')

@section('content')
<div>
    <section class="registration">
        <div style="padding:0px;margin-top: 20px; margin-bottom:0px;" class="">
            <div class="registration-block bg-registration ">
                <div class="block">
                    <div class="row">
                        <div class="col-md-3"></div>

                        <div class="col-md-6" style=" padding:0px;border-radius:15px; ">
                            <div style="margin-top:80px;" class="title text-left">
                                <h3 style="color: black;">
                                    <strong>Register to </strong>
                                    <span class="alternate"><strong>Eventre</strong></span>
                                </h3>
                            </div>

                            {{-- 🔴 ERROR MESSAGE (NO DESIGN CHANGE) --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="margin-bottom:0;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('do-registration') }}" method="post" class="row" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <input name="name" type="text" class="form-control main"
                                           placeholder="Your Name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input name="email" type="email" class="form-control main"
                                           placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input name="phone" type="tel" class="form-control main"
                                           placeholder="Phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <small class="text-danger" style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input name="password" type="password" class="form-control main"
                                           placeholder="Password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- image optional --}}
                                {{--
                                <div class="col-md-6">
                                    <input name="image" type="file" class="form-control main">
                                </div>
                                --}}

                                <div class="col-md-6">
                                    <input name="address" type="text" class="form-control main"
                                           placeholder="Enter Address" value="{{ old('address') }}">
                                    @error('address')
                                        <small class="text-danger" style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-white-md">
                                        Register Now
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
