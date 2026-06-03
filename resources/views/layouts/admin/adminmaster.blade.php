<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<script src="{{ asset('js/app.js') }}"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
 
  @include('layouts.admin.style')
</head>
<body class="sidebar-mini control-sidebar-slide-open  layout-fixed layout-footer-fixed layout-navbar-fixed text-sm accent-info">
<div class="wrapper">

@include('layouts.admin.partial.navbar')

@include('layouts.admin.partial.leftsidebar')

  
  <div class="content-wrapper">
   @yield('content')
  </div>
 
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="https://ssus.ac.in">ssus.ac.in</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>
</div>



@include('layouts.admin.script')
</body>
</html>

