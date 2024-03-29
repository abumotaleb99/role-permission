@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <h5 class="login-box-msg" style="font-weight: bold;">Enter Your Email to Reset Your Password</h5>
        @include('backend.message')
        <form action="{{ route('admin.forget.password') }}" method="post">
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
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
            </div>
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="{{ route('admin.login.form') }}">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
