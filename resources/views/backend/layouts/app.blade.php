<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Role & Permission</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @if(!request()->routeIs('admin.login.form') && !request()->routeIs('admin.forget.password.form') && !request()->routeIs('admin.reset.password.form'))
    @include('backend.layouts.header')
  @endif

  <!-- Sidebar -->
  @if(!request()->routeIs('admin.login.form') && !request()->routeIs('admin.forget.password.form') && !request()->routeIs('admin.reset.password.form'))
    @include('backend.layouts.sidebar')
  @endif

  @yield('content')

  <!-- Main Footer -->
  @if(!request()->routeIs('admin.login.form') && !request()->routeIs('admin.forget.password.form') && !request()->routeIs('admin.reset.password.form'))
    @include('backend.layouts.footer')
  @endif
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/backend') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('assets/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/backend') }}/dist/js/adminlte.min.js"></script>
</body>
</html>