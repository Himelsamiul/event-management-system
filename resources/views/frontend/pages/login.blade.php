@extends('frontend.master')
@section('content')
<div>
<section class="registration">
			<div class="">
				<div class="registration-block bg-registration-one" >
					<div class="block">
					<div class="row" style="margin-top: 0px; margin-bottom:10px;">
    <div class="col-md-3"> </div>
	     <div style="margin-top:80px;" class="col-md-6" style=" border-radius:15px;"> 
                           
		 
		 <form action="{{route('do.login')}}" method="post" class="row">
                                @csrf
                                <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6">
                                    <div class="title text-left">
                                    <h3 style="color: black;"><strong>Login to </strong> <span class="alternate"><strong>Eventre</strong> </span></h3>
                                    </div>
								<input name="email" type="email" class="form-control main" placeholder="Email" required>
								<input name="password" type="password" class="form-control main" placeholder="Password" required>
                                <button type="submit" class="btn btn-white-md">Login</button>
                            </div>
							
							<div class="col-md-3">
							</div>
						</form>
					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>
		</div>
	</div>
    </div>
</section>
@endsection
