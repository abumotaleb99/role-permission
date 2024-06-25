@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <h5 class="login-box-msg pb-0" style="font-weight: bold;">Welcome Back! Let's Get Started</h5>
        <p class="text-center text-muted pb-2">
          Please enter your user credentials to access the dashboard.
        </p>
        @include('backend.message')
        <form action="{{ route('user.login') }}" method="post">
          @csrf
          <div class="mb-3">
            <div class="input-group">
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : "" }}</span>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
        <p class="mb-1 mt-2">
          <a href="#">I forgot my password</a>
        </p>
        <p class="mt-2 mb-0">
          Don't have an account? <a href="{{ route('user.register.form') }}">Register</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection