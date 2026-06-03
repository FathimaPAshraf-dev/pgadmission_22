
@extends('layouts.master')

@section('styles')
<link href="toastr.css" rel="stylesheet"/>
<style>

    .card-title{
        text-align: center;
    }
    .row{
        height: 100%;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    .button {
        background-color: #db5d3d; /* Green */
        color: white;
    }
</style>
@stop
@section('scripts')
<script type="text/javascript">
$(document).ready(function (){  
     $('.pgmarklistindex').removeClass('active');
     $('.pgmarklistindex').addClass('active');
     $("#successMessage").delay(2000).slideUp(400);
});


</script>

@stop
@section('content')
<section class="content">
    <?php 
    $i=0;
    ?>
     <br>
     <br>
      <div class="row">



@if(empty($exam_pg))

  <div class="col-md-9 col-md-offset-2 new">
           
       <div class="card card-secondary">
            <div class="card-header">

                <h3 class="card-title">   <i class="fa fa-bell-o" style="text-align: center"></i>&nbsp;&nbsp;<b>Notifications</b></h3>
              </div>
            <div class="card-body"> 
          
                     <div class="callout callout- bg-white color-palette">
                         <marquee>   <h5><b><font color="red">No Result found!</font></b></h5></marquee>
                   </div>
   
            </div>
       </div>
  </div>


@else
        <div class="col-md-9 col-md-offset-2 new">
           
       <div class="card card-secondary">
            <div class="card-header">

                <h3 class="card-title">   <i class="fa fa-bell-o" style="text-align: center"></i>&nbsp;&nbsp;<b>Notifications</b></h3>
              </div>
           <div id="successMessage" name="successMessage">
@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>

@endif
</div>
           
        @foreach($exam_pg as $key)
      <form action="{{route('finalgrade_preview')}}" method="get" id="nameform{{++$i}}" >

  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

            <div class="card-body"> 
          
                     <div class="callout callout- bg-secondary color-palette">
                         <h4><font color="white">Final Grade Sheet</font></h4>
                <input name="sem" type="hidden" value="{{$key->exam_sem_sl}}" />
                 <input name="exmsl" type="hidden" value="{{$key->exam_sl}}" />
                    <div class="row mb-2">
                                  <div class="col-sm-9"><font color="white">{{$key->exam_name}}</font> </div>
                   <div class="col-sm-3">  

                          <button type="submit" form="nameform{{$i}}" id="name{{$i}}" value="{{$key->exam_sem_sl}}" 
                        class="btn bg-white" style="white-space: pre-line;"  >View <i class="fa fa-chevron-right" aria-hidden="true"></i> 
                         </button> 
                   </div>
                  </div>
                
              </div>
   
            </div>
  </form>
        @endforeach
            </div> </div>
       @endif
      
      </div>
     </section>

@endsection