  <nav class="main-header navbar navbar-expand navbar-dark navbar-secondary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      
    </ul>
    


    <!-- SEARCH FORM -->
<!--    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->
      
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      
      
        <li class="nav-item dropdown user-menu">
       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
       
       
    </a>
        
            
            
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
                 
            </div>
            <!-- Message End -->
          </div>
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          
            <a class=" btn btn-secondary btn-flat float-right  btn-block "
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <font style="color: white"> <i class="fa fa-fw fa-power-off"></i>
                {{ __('Logout') }}</font>
            </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
            </form>
          <!--<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>-->
        </div>
      </li>
      
   
    </ul>
  </nav>
