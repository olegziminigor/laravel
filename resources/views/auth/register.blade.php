@extends('layouts.app')

@section('content')

<div class="b-t">
    <div class="center-block w-xxl w-auto-xs p-y-md text-center">
        <div class="p-a-md">
			<div>
			  <a href="#" class="btn btn-block indigo text-white m-b-sm" id = "facebook-btn">
				<i class="fa fa-facebook pull-left"></i>
				Sign up with Facebook
			  </a>
			  <a href="#" id = "google-plus-btn" class="btn btn-block red text-white">
				<i class="fa fa-google-plus pull-left"></i>
				Sign up with Google+
			  </a>
			</div>
			
			<form class="form-horizontal form" role="form" method="POST" action="{{ url('/register') }}">
				{{ csrf_field() }}
				
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<input id="name" type="hidden" class="form-control" name="name"  placeholder="Username" value="{{ old('name') }}" required autofocus>
					@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
					@endif			
				</div>
				
				<div class="form-group">
					<input  id="email" type="hidden" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"  required>
						@if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
						@endif				
				</div>
				
				
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<input id="password" type="hidden" class="form-control" placeholder="Password" name="password" value = "aaaa1111" required>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
				</div>				
				<div class="form-group">
					<input id="password-confirm" type="hidden" class="form-control" placeholder="Confirm Password" value = "aaaa1111" name="password_confirmation" required>
				</div>
					
				<input id="bio" type="hidden" class="form-control"  value = "" name="bio">
					
					
					
					<br/>
					<br/>
					<br/>
					<br/>
			
			
				<div class="form-group row usertype-div" style = "display:none;">
					<div class="col-sm-3 form-control-label text-muted">Type</div>
					<div class="col-sm-9">
					  <select class="form-control c-select" id = "usertype"   name = "usertype">
						<option value = "-1" selected = "selected">-select the user type-</option>
						<option value = "0">Fan</option>
						<option value = "1">Artise</option>
					  </select>
					  
					    <span class="help-block user-type-hint" style = "display:none;">
								<strong>Please select the user type </strong>
						</span>
							
							
					</div>
				</div>
				
				
				<div class="m-b-md text-sm">
					<span class="text-muted">By clicking Sign Up, I agree to the</span> 
					<a href="#">Terms of service</a> 
					<span class="text-muted">and</span> 
					<a href="#">Policy Privacy.</a>
				</div>
				
				<input id="image" type="hidden" class="form-control"  name="image">
				
				<button type="submit" style = "display:none;" class="btn btn-lg black p-x-lg btn-primary signupbtn signupinbtn">Sign Up</button>
			</form>
	   
		<div class="p-y-lg text-center">
          <div>Already have an account? <a href="{{ url('/login') }}" class="text-primary _600">Sign in</a></div>
        </div>
	   
        </div>
    </div>
</div>




@endsection
