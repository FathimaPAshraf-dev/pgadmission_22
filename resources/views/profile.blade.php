@extends('layouts.master')

@section('styles')

@stop


@section('scripts')
<script type="text/javascript">
$(document).ready(function (){  
     $('.profile').removeClass('active');
         $('.profile').addClass('active');
 
});
</script>

@stop
@section('tittle')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Profile</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
             @if($agent->isDesktop())   
              <li class="breadcrumb-item">Desktop</li>
              @elseif($agent->isPhone())
              <li class="breadcrumb-item">Mobile</li>
              @endif
            
              <li class="breadcrumb-item"><a href="#">Home</a></li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
                   <div class="card-header">
               
                <div class="card-tools">
               
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                 
                 
                </div>
              </div>
              <div class="card-body box-profile">
                <div class="text-center">
                      @php
      $pgm_type=auth()->user()->admnscheme_table->program_table->pgm_type;
      @endphp
      @if(($pgm_type==5))
            <img src="{{Storage::url('ug/'.Auth::user()->admnscheme_table->adsc_admnyear.'/'.Auth::user()->stud_app_id.'.jpg')}}" alt="User Avatar"
                 class="profile-user-img img-fluid img-circle">
       @endif
         @if(($pgm_type==4))
            <img src="{{Storage::url('pg/'.Auth::user()->admnscheme_table->adsc_admnyear.'/'.Auth::user()->stud_app_id.'.jpg')}}" alt="User Avatar"
                 class="profile-user-img img-fluid img-circle">
       @endif
                

                <h3 class="profile-username text-center"> {{ Auth::user()->stud_name }}</h3>

                
</div>
                  <p class="text-muted text-center">Student</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Admission Number</b> {{ auth()->user()->stud_app_id }}
                  </li>
                  <li class="list-group-item">
                    <b>Register Number</b> {{ auth()->user()->stud_registerno }}
                  </li>
                 
                  @if($sem>0)
                    <li class="list-group-item">
                        
                    <b>Semester</b> {{ $sem }}
                  </li>
                  @endif
                  
                   <li class="list-group-item">
                    <b>Program of study</b>  {{ auth()->user()->admnscheme_table->scheme_table->program_table->pgm_name }}
                  </li>
               
                    <li class="list-group-item">
                    <b>Year of Admission</b>  {{ auth()->user()->admnscheme_table->adsc_admnyear }}
                  </li>
                   <li class="list-group-item">
                    <b>Type</b> @if( auth()->user()->is_readmission==1 )
                    Re-Admission
                    @else
                    Regular
                    @endif
                  </li>
                </ul>

                <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
          
             
                <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">Personal information</h3>
                <div class="card-tools">
               
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Edit" data-widget="chat-pane-toggle">
                    <i class="fa fa-edit"></i>
                  </button>
                 
                </div>
              </div>
                    
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Date of birth</strong>

                <span class="text-muted">
                    @php
                    $date=auth()->user()->stud_dob;
                    $time = strtotime($date);
                    @endphp
                 {{  date('d-m-Y',$time) }}
                </span>

                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Communication Address</strong>
                 <p class="text-muted">{{ auth()->user()->stud_permaddress }}</p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Mobile</strong>

                <span class="text-muted">{{ auth()->user()->stud_phone }}</span>
                
                 <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Email</strong>

                <span class="text-muted">{{ auth()->user()->stud_email }}</span>
              </div>
              <!-- /.card-body -->
            </div>
              
               <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">Login Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                              <strong><i class="fas fa-book mr-1"></i> Last login at</strong>

                <span class="text-muted">
                   {{ Auth::user()->last_sign_in_at->diffForHumans() }}
                </span>

                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Browser</strong>
                 <span class="text-muted">{{ $browser = $agent->browser()
                     }}  {{$version = $agent->version($browser)}} </span>
                <hr>
                      </div>
                      <div class="col-md-6">
                          
                           <strong><i class="far fa-file-alt mr-1"></i> Last login ip</strong> 

                <span class="text-muted">{{ auth()->user()->last_login_ip }}</span>
                
                 <hr>
                         <strong><i class="far fa-file-alt mr-1"></i> Device</strong>

                <span class="text-muted">{{ $platform = $agent->platform() }} {{$version = $agent->version($platform)}}</span>
                
                 <hr>
                      </div>
                  </div>
            
               
               
              </div>
              <!-- /.card-body -->
            </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
