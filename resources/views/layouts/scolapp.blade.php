<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SSUS | PG ADMISSION</title>
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
  <nav class="navbar navbar-expand-md navbar-dark top bg-dark"><div class="container" style="text-align: left;">
         
         For any issues related to online registration please write to us helpdesk@ssus.ac.in , Contact Us : 0484-2699731(Enquiry)
    </nav>
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container" style="text-align: center;">
    
          <center><img src="{{asset('images/ssuslogo.png')}}" alt="ssus Logo" class="img-fluid" width="350" height="100"></center>
          <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-secondary">SCOL Admission Portal</span></h2>
      
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
        <li class="nav-item d-none d-sm-inline-block">
            
<!--        <a href="{{route('register')}}" class="btn btn-dark float-right ">Register</a>-->
          
      </li>
      
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
<!--   <nav class="navbar navbar-expand-md navbar-dark top bg-cyan"><div class="container" style="text-align: left;">
        <li class="nav-item d-none d-sm-inline-block">
            
        <a href="https://ssus.ac.in/files/240/NotificationsfromSep7-2021/2454/PG-NOTIFICATION-2023---24.pdf" class="btn btn-dark  ">Notification</a>
        <a href="https://ssus.ac.in/files/240/NotificationsfromSep7-2021/2456/PG-Prospectus-2024-1.pdf" class="btn btn-dark  ">Prospectus</a>
        <a href="register" class="btn btn-dark  ">Apply Now</a>

          
      </li>
         
    </nav>-->
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
