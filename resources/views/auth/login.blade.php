@extends('auth.authMaster')
@section('title')
login
@endsection
@section('content')
  <h1>Share App Admin Login</h1>
  <form action="{{ url('login-page') }}" class="login-form" method="post">
      {{ csrf_field() }}
      <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button>
          <span>Enter any Email and password. </span>
      </div>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      <div class="row">
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" name="email" required/>
          </div>
          <div class="col-sm-6">
              <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-4">
              <div class="rem-password">
                  <label style="cursor:pointer;"><input type="checkbox" name="remember" class="rem-checkbox" />Remember Me</label>
              </div>
          </div>
          <div class="col-sm-8 text-right">
              <div class="forgot-password">
                  <a href="{{url('password-reset')}}" id="forget-password" class="forget-password">Forgot Password?</a>
              </div>
              <button class="btn blue" type="submit">Sign In</button>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-8">
              <p class="form-group" style="font-size:13px;">Don't have an account yet ? </p>
          </div>
          <div class="col-sm-4 text-right">
              <p class="form-group"><a href="{{url('register-account')}}" style="font-size:13px;">Create New Account</a> </p>
          </div>
      </div>
  </form>
@endsection
