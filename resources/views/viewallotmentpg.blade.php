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
<section class="content-header">
    <div class="card card-info">
      <div class="card-header">
                <h3 class="card-title"><b>PG Admission-2021 First Allotment</b></h3>
            </div>  
        <br>@foreach($results as $key)
<marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>Congratulations {{$key->pgapp_name}}  !!!</b></p></marquee>
@endforeach
<!--<marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>If sufficient candidates are not available for a particular program in a campus, such students will be transfered to the nearest regional campus of the university offering that program</b></p></marquee>-->

    </div> 
</section>
 <br>
  @foreach($view as $key1) 
  <div class="card-body">
  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Application Id</label>

                  <div class="col-sm-5">
                      
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key->pgapp_id}}">
                  </div>
                </div>
       <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key->pgapp_name}}">
                  </div>
                </div>
       <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allot Centre</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_cent}}">
                  </div>
                </div>
        <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allotment</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allotment}}">
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
     <p style="color:red" style="font-size: 17px;" ><b> NB:If sufficient candidates are not available for a particular program in a campus, such students will be transfered to the nearest regional campus of the university offering that program</b></p>
  
 <div class="form-group row">
     <div class="col-3">
          
                       <form method="get" action="/downloadmemo">
    <button type="submit"class="btn btn-primary"  >DOWNLOAD INTERVIEW MEMO</button>
    
    
                       </form>
 </div>
     
                           <input type="text" hidden="true" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_category}}">
@if($key1->allot_category=='OPEN') 
    
   @else
    <div  class="col-5" >
      <form action="{{route('loadview')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="">
                        <input type="hidden" name="tdate" id="tdate" value="">
                        <button type="submit" name="pdffrom1" class="btn btn-primary">Upload Non creamy layer certificate for OBC/caste certificate SC/ST/OEC</button>
      </form></div>
     
     </div>
   @endif
     
  </div>
 
  
 @endforeach 

    <!-- Main content -->
  
 
    <!-- /.content -->
    @endsection
