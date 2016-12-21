@extends('layouts.app')

@section('content')

<div class="b-t">
    <div class="center-block w-xxl w-auto-xs p-y-md text-center">
       <div class="p-a-md">
			
			<div>
			  <a href="#" class="btn btn-block indigo text-white m-b-sm" id = "facebook-btn">
				<i class="fa fa-facebook pull-left"></i>
				Sign in with Facebook
			  </a>
			  <a href="#" class="btn btn-block red text-white" id = "google-plus-btn">
				<i class="fa fa-google-plus pull-left"></i>
				Sign in with Google+
			  </a>
			</div>
			<div class="m-y text-sm">
			  OR
			</div>
			
            
			<form  role="form" method="POST" action="{{ url('/login') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<input id="email" type="hidden" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
						@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
						@endif
				</div>
			
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<input id="password" type="hidden" class="form-control" placeholder="password"  name="password" value = "aaaa1111" required>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif			
				</div>  
			
				<div class="m-b-md checkbox form-group">        
					<label class="md-check">
					  <input type="checkbox"><i class="primary"></i> Keep me signed in
					</label>
				</div>
			
				<button type="submit" style = "display:none" class="btn btn-lg black p-x-lg signinbtn signupinbtn">Sign in</button> 
				
				<!--div class="m-y form-group">
				    <a href="{{ url('/password/reset') }}" class="_600">Forgot password?</a>
				</div-->
			</form>
			
			<div>
			   Do not have an account?
			   <a class="text-primary _600" href="{{ url('/register') }}">
					  <span>Register</span>
				</a>
			</div>
		
        </div>
    </div>
</div>
@endsection
