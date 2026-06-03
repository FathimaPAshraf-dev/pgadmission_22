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
            <h1 class="m-0 text-dark">PGADMISSION  -2021</h1>
            
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
                <h3 class="card-title"><b>PG Admission-2021</b></h3>
            </div>  
        <br>@foreach($view as $key)
<!--<marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>Congratulations {{$key->pgapp_name}}  !!!</b></p></marquee>-->
@endforeach
    </div> 
</section>
 <br>
   <form action="/updatecentre" method="post" >

      <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  @foreach($view as $key1) 
  <div class="card-body">
  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Application Id</label>

                  <div class="col-sm-5">
                      
                      <input type="text" disabled class="form-control col-md-8" id="stud_id" placeholder="" value="{{$key->pgapp_id}}">
                  </div>
                </div>
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-5">
                      
                      <input type="text" disabled class="form-control col-md-8" id="stud_name" placeholder="" value="{{$key->pgapp_name}}">
                  </div>
                </div>
       <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Exam Centre</label>

                  <div class="col-sm-5">
                     @if($key->pgapp_exam_centre == 23) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="MAIN CAMPUS, KALADY"readonly=""/> 
       
        @endif  
    @if($key->pgapp_exam_centre == 22) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL CAMPUS,THURAVOOR"readonly=""/> 
       
        @endif     
     @if($key->pgapp_exam_centre == 21) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL CAMPUS, TIRUR"readonly=""/> 
       
        @endif     
         @if($key->pgapp_exam_centre == 20) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL CAMPUS, KOYILANDY"readonly=""/> 
       
        @endif
         @if($key->pgapp_exam_centre == 19) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL CAMPUS,THIRUVANANTHAPURAM"readonly=""/> 
       
        @endif
         @if($key->pgapp_exam_centre == 18) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL CAMPUS,PANMANA"readonly=""/> 
       
        @endif
        @if($key->pgapp_exam_centre == 16) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL  CAMPUS, ETTUMANOOR"readonly=""/> 
       
        @endif
        @if($key->pgapp_exam_centre == 15) 
        <input type="text" name="pgapp_exam_centre" id="pgapp_exam_centre"  class="form-control col-md-8" value="REGIONAL CAMPUS, PAYYANNUR"readonly=""/> 
       
        @endif 
<!--                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key->pgapp_exam_centre}}">-->
                  </div>
                </div>
       <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Exam Centre</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
<option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach

                  </select>  
                      
                      
                  </div>
                </div>
         
         <div class="col-md-8">
   </div>
<!--          <button type="submit"class="btn btn-primary"  >DOWNLOAD INTERVIEW MEMO</button>-->
<!-- <form method="get" action="/updatecentre">
           <button type="submit"class="btn btn-primary"  >Save Changes</button>
 </form>-->
  </div>
 
  
 @endforeach 
  <div  class="col-md-2 control-label " style="border-style: none;">
                           <button type="submit" class="btn btn-success " >Updte xam Centre </button>

                        </div>
   </form>
    <!-- Main content -->
  
 
    <!-- /.content -->
    @endsection
