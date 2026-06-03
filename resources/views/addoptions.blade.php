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
   <form action="/saveoptions" method="post" >

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
                  <label for="inputEmail3" class="col-sm-3 control-label">Program</label>

                  <div class="col-sm-5">
                      
                      <input type="text" disabled class="form-control col-md-8" id="stud_name" placeholder="" value="{{$key->adscsl}}">
                  </div>
                </div>
      
      
<!--      @if ($key->pgapp_adsc_sl==831)
      
             <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                      
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
                        @if($pgpgm_count=='1')


               @foreach($centre_options_vya as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_vya as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>-->
<!--      @elseif($key->pgapp_adsc_sl==830)
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                      <lable>{{$pgpgm_count}}</lable>
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
                           
                        
                        @if($pgpgm_count=='1')
                        

               @foreach($centre_options_sah as $cent) 
               @if($cent->centre_sl==$pg_opt1)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_sah as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option2</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam2" name="center_slexam2" required="" >

                        @if($pgpgm_count=='1')
                        

               @foreach($centre_options_sah as $cent) 
               @if($cent->centre_sl==$pg_opt2)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_sah as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>-->
<!--      @elseif ($key->pgapp_adsc_sl==829)
           <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                      
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
                        @if($pgpgm_count=='1')


               @foreach($centre_options_gen as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_gen as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>-->
<!--      @elseif ($key->pgapp_adsc_sl==824)
           <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                      
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
                        @if($pgpgm_count=='1')


               @foreach($centre_options_ved as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_ved as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>-->
<!--        @elseif ($key->pgapp_adsc_sl==823)
           <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                      
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
                        @if($pgpgm_count=='1')


               @foreach($centre_options_philo as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_philo as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>-->
<!--          @elseif($key->pgapp_adsc_sl==821)
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >

                        @if($pgpgm_count=='1')
                        

               @foreach($centre_options_hind as $cent) 
               @if($cent->centre_sl==$pg_opt1)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_hind as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif

                  </select>  
                      
                      
                  </div>
                </div>
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option2</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam2" name="center_slexam2" required="" >
 @if($pgpgm_count=='1')
                        

               @foreach($centre_options_hind as $cent) 
               @if($cent->centre_sl==$pg_opt2)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_hind as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif


                  </select>  
                      
                      
                  </div>
                </div>-->
<!--          @elseif($key->pgapp_adsc_sl==820)
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >

     old strat                                                                                                                   
                                                                                                                       <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                                                                                                    

     
      
old end
         @if($pgpgm_count=='1')
                        

               @foreach($centre_options_mal as $cent) 
               @if($cent->centre_sl==$pg_opt1)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif           
                    
                    
                    
                    
                    </select>  
                      
                      
                  </div>
                </div>
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option2</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam2" name="center_slexam2" required="" >
<option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach

             
                 @if($pgpgm_count=='1')
                        

               @foreach($centre_options_mal as $cent) 
               @if($cent->centre_sl==$pg_opt2)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif   
                    
                    
                    
                    
                    
                    </select>  
                      
                      
                  </div>
                </div> 
       @else    
      @endif-->
<!--only for malayalam start-->
              @if($key->pgapp_adsc_sl==820)
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option1</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" ><!--

     old strat                                                                                                                   
                                                                                                                       <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                                                                                                    

-->     
      
<!--old end-->
         @if($pgpgm_count=='1')
                        

               @foreach($centre_options_mal as $cent) 
               @if($cent->centre_sl==$pg_opt1)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif           
                    
                    
                    
                    
                    </select>  
                      
                      
                  </div>
                </div>
      <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select New Option2</label>

                  <div class="col-sm-5">
                    <select class="form-control select2 col-md-8" id="center_slexam2" name="center_slexam2" required="" >
                        <!--
<option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach

-->             
                 @if($pgpgm_count=='1')
                        

               @foreach($centre_options_mal as $cent) 
               @if($cent->centre_sl==$pg_opt2)
               <option value="{{$cent->centre_sl }}"class="col-md-10" selected>
                                {{$cent->centre_name }}
                                 </option>
                                 
                                 @else
                                         <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                @endif
                                 
                                 @endforeach
                                 
                                 @else
                                 <option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options_mal as $cent) 
                   <option value="{{$cent->centre_sl }}"class="col-md-10" >
                                {{$cent->centre_name }}
                                 </option>
                                 @endforeach
                                 @endif   
                    
                    
                    
                    
                    
                    </select>  
                      
                      
                  </div>
                </div> 
       @else    
      @endif

         <div class="col-md-8">
   </div>

  </div>
 
  
 @endforeach 
  <div  class="col-md-2 control-label " style="border-style: none;">
                           <button type="submit" class="btn btn-success " >SUBMIT</button>

                        </div>
   </form>
    <!-- Main content -->
  
 
    <!-- /.content -->
    @endsection
