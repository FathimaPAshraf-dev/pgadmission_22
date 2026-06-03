<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>



  <!-- Font Awesome -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @include('layouts.style')
</head>
<body class="sidebar-mini control-sidebar-slide-open layout-fixed layout-footer-fixed layout-navbar-fixed text-sm accent-info">
<div class="wrapper">


@include('layouts.partial.navbar')

@include('layouts.partial.leftsidebar')

  <div class="content-wrapper">
   @yield('tittle')   
   @yield('content')
  </div>

  <footer class="main-footer">
      <strong><font style="font-size: 12px; ">Designed and developed by SSUS-IT wing</font></strong>
    <div class="float-right d-none d-sm-inline-block">
   
    </div>
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  
@include('layouts.script')
</body>
</html>
