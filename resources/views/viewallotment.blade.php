@extends('layouts.app')

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
            <h1 class="m-0 text-dark">PG ALLOTMENT -2021</h1>
            
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
                <h3 class="card-title"><b>PG Admission-2021</b></h3>
            </div>
            <br>@foreach($results as $key)
            <marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>Congratulations {{$key->pgapp_name}}  !!!</b></p></marquee>
 @endforeach
            <!-- /.box-header -->
            <!-- form start -->
            <br>
   

             @foreach($view as $key1) 
                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
              
              <div class="card-body">
                  
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Application Id</label>

                  <div class="col-sm-5">
                      
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key->postpgapp_appid}}">
                  </div>
                </div>
                     <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key->postpgapp_studname}}">
                  </div>
                </div>
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allot Centre</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_cent}}">
                  </div>
                </div>
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allot Category</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_category}}">
                  </div>
                </div>
                  
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Rank</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->rank}}">
                  </div>
                </div>
             
                   
                  
<!--                       <form method="get" action="/downloadmemo">
    <button type="submit"class="btn btn-primary"  >DOWNLOAD INTERVIEW MEMO</button>-->
    
    
    
    
<!--                      <input type="button" class="btn btn-primary"  value="  DOWNLOAD UNION BANK CHALLAN " onclick="window.location.href='https://ssusonline.org/challan.pdf'" /> </form><br> -->

   <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">PG Allotment -2021</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <!-- content type here -->
                @foreach($view as $key1)   
<div class="form-group row">
                  <label for="inputEmail3" class="col-sm-6 control-label">Allotted Centre</label>

                  <div class="col-sm-6">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_cent}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-6 control-label">Allotted Category</label>

                  <div class="col-sm-6">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_category}}">
                  </div>
                </div>
                 @endforeach 



                  </div>
                   @endforeach 
        
          </div>
       </section>
    <!-- /.content -->
    @endsection
