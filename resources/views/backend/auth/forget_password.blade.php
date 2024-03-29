@extends('backend.layouts.app')
@section('content')
<div class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-primary">
      <div class="card-body">
        <p class="login-box-msg">Enter Your Email to Reset Your Password</p>
        <form action="recover-password.html" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
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