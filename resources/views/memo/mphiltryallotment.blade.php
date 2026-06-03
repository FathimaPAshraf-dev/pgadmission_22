@extends('layouts.master')

@section('styles')

@stop


@section('scripts')


@stop
@section('tittle')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">M.PHIL ADMISSION ALLOTMENT -2020</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              
<!--              <li class="breadcrumb-item">Desktop</li>-->
              
<!--              <li class="breadcrumb-item">Mobile</li>-->
          
            
<!--              <li class="breadcrumb-item"><a href="#">Home</a></li>-->
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop
@section('content')

    


    <!-- Main content -->
  
   <section class="content-header">

          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b> Allotment</b></h3>
            </div>
              
            <br>@foreach($results as $key)
 <marquee   behavior="alternate" direction="left">Better Luck Next Time {{$key->postpgapp_studname}}  !!!</marquee>
 @endforeach
            <!-- /.box-header -->
            <!-- form start -->
            <br>
                  <div class="card card-secondary">
              <div class="card-header">
              <!-- <i class="fa fa-bullhorn"></i> -->

              <h3 class="card-title"><i class="fas fa-bell" style="text-align: center"></i>&nbsp;&nbsp;<b>You are not included in ALLOTMENT LIST</b></h3>
            </div>
                   <div id="successMessage" name="successMessage">
												</div>


            <!-- /.box-header -->
     
</div>
           <!--  <form class="form-horizontal" class="form-horizontal" id="profile" name="profile"> -->
               <form class="form-horizontal" action="" method="post" id="formcourse">

             
                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
              
             
                 
            </form>
          </div>
       </section>
    <!-- /.content -->
    @endsection
