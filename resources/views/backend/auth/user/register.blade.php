@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <h5 class="login-box-msg pb-0" style="font-weight: bold;">Join Us! Create Your Account</h5>
        <p class="text-center text-muted pb-2">
          Please fill in the information below to create your account.
        </p>
        @include('backend.message')
        <form action="{{ route('user.register') }}" method="post">
          @csrf
          <div class="mb-3">
            <div class="input-group">
              <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <span class="text-danger">{{ $errors->has('username') ? $errors->first('username') : "" }}</span>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
          </div>
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
          <div class="mb-3">
            <div class="input-group">
              <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>
        <p class="mt-2 mb-0">
          Already have an account? <a href="{{ route('user.login.form') }}">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection