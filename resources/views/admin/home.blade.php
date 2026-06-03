@extends('layouts.admin.adminmaster')

@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


<section class="content">
      <div class="container-fluid" id="app">
 
        <!-- Info boxes -->
        <div class="row">
           
          <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.course') }}">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <h5 class="info-box-text">Course Settings</h5>
                
              </div>
              <!-- /.info-box-content -->
            </div>
             </a>
          </div>
               
          <!-- /.col -->
  
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
          <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('admin.exam') }}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
             
              <div class="info-box-content">
                   
                <h5 class="info-box-text">Exam Settings</h5>
                 
              </div>
           
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
              
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
              <a href="{{route('admin.hallticket')}}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cog"></i></span>
             
              <div class="info-box-content">
                   
                <h5 class="info-box-text">Hallticket Settings</h5> 
                 
              </div>
           
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
            <div class="col-12 col-sm-6 col-md-3">
              <a href="">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>
             
              <div class="info-box-content">
                   
                <h5 class="info-box-text">Result Settings</h5>
                 
              </div>
           
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
          
             <div class="col-12 col-sm-6 col-md-3">
              <a href="">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-cog"></i></span>
             
              <div class="info-box-content">
                   
                <h5 class="info-box-text">Paper Settings</h5>
                 
              </div>
           
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
          
             <div class="col-12 col-sm-6 col-md-3">
              <a href="">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
             
              <div class="info-box-content">
                   
                <h5 class="info-box-text">Re-admission</h5>
                 
              </div>
           
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>
          <!-- /.col -->
        </div>
   

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
       
          </div>

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
@endsection

