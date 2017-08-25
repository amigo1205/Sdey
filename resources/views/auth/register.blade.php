@extends('auth.authMaster')
@section('title')
Register
@endsection
@section('content')
  <h1>Share App Admin Register</h1>
  <form action="{{ route('register') }}" class="register-form" method="post">
      {{ csrf_field() }}
      <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button>
          <span>Enter any username and password. </span>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required/>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Phone Number" value="{{ old('phonenumber') }}" name="phonenumber" required/> </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Company name" value="{{ old('company_name') }}" name="company_name" required/> </div>
          <div class="col-sm-3">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="First name" value="{{ old('fname') }}" name="fname" required/> </div>
          <div class="col-sm-3">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Last name" value="{{ old('lname') }}" name="lname" required/> </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" id="register_password" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Confirm Password" name="password_confirmation" required/> </div>
      </div>
      <div class="row">
          <div class="col-sm-12">
              <div class="rem-password" style="margin-bottom:20px;">
                  <label style="cursor:pointer;"><input type="checkbox" name="confirm_terms" class="rem-checkbox" /> I agree to the <a>Terms of Service</a> and <a> Privacy Policy </a></label>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-8 text-left">
              <a class="btn grey" href="{{url('login-page')}}">Back to Login Page</a>
          </div>
          <div class="col-sm-4 text-right">
              <button class="btn blue" type="submit">Proceed</button>
          </div>
      </div>
  </form>
@endsection
