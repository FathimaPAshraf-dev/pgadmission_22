<aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-secondary">
      <img src="{{Storage::url('redemb.jpg')}}" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8;background-color: white" >
      <span class="brand-text font-weight-bold" style="color: white">SSUS Kalady</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-2 mb-2 d-flex">
        <div class="image">
 @if(isset(auth()->user()->last_sign_in_at))
                 <p class="text-sm">Sign in at {{ Auth::user()->current_sign_in_at->diffForHumans() }}</p>
                @else
                @endif
        </div>
        <div class="info">
          
        </div>
      </div>
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                  
                <a href="#" class="nav-link coursehome">
                  <i class="far fa-circle nav-icon"></i>
                  <p></p>
                </a>
             <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-fw fa-power-off"></i>
                  <p>Logout</p>
                </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
            </form>
              </li>
              
              
            </ul>
          </li>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

