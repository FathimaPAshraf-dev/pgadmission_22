<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SSUS | RankList</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 @include('layouts.style')
 
</head>
<body class="hold-transition layout-top-nav text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container" style="text-align: center;">
    
        <center><img src="{{asset('images/ssuslogo.png')}}" alt="ssus Logo" class="img-fluid" width="550" height="150" style="text-align: center"></center>
    
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        @auth
        <li class="nav-item dropdown show">

            <a class=" btn btn-secondary btn-flat float-right  btn-block "
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <font style="color: white"> <i class="fa fa-fw fa-power-off"></i>
                {{ __('Logout') }}</font>
            </a>
           
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
            </form>
          
        </li>
         @endauth
      @guest
      
      
       @endguest
       
       
      </ul>

      <!-- Right navbar links -->
<!--      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        

       @auth
       
       <li class="nav-item d-none d-sm-inline-block">
         <a class=" btn btn-secondary btn-flat float-right  btn-block "
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <font style="color: white"> <i class="fa fa-fw fa-power-off"></i>
                {{ __('Logout') }}</font>
            </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
            </form>
      </li>
      @endauth
      @guest
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('register')}}" class="nav-link active">Register</a>
      </li>
      
       @endguest
       
      </ul>-->
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
@yield('content')
    <!-- /.content -->
  </div>
 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
       <!-- Default to the left -->
       <strong><font style="font-size:11px;">Designed and developed by SSUS-IT wing.</font> </strong> 
  </footer>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@include('layouts.script')

</body>
</html>
