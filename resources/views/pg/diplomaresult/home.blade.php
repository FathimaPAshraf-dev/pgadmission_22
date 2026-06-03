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
@section('tittle')
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-1 text-dark">RESULT</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
             @if($agent->isDesktop())   
              <!--<li class="breadcrumb-item">Desktop</li>-->
              @elseif($agent->isPhone())
              <!--<li class="breadcrumb-item">Mobile</li>-->
              @endif
            
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
             <li class="breadcrumb-item"><a href="#">Result</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function (){  
     $('.pgmarklistindex').removeClass('active');
     $('.pgmarklistindex').addClass('active');
 
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



@if(empty($pgexam))

  <div class="col-md-9 col-md-offset-2 new">
           
       <div class="card card-secondary">
            <div class="card-header">

                 <h3 class="card-title"><i class="fas fa-bell" style="text-align: center"></i>&nbsp;&nbsp;<b>Notifications</b></h3>
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
           
    @foreach($pgexam as $key)
        <form action="{{route('diplomamarklistpreview')}}" method="get" id="nameform{{++$i}}" >

        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

        <div class="card-body"> 
          
        <div class="callout callout- bg-secondary color-palette">
            <h4><font color="white">Exam Result   ( Provisional )</font></h4>
            <input name="sem" type="hidden" value="{{$key->exam_sem_sl}}" />
            <input name="exmsl" type="hidden" value="{{$key->exam_sl}}" />
            <div class="row mb-2">
                <div class="col-sm-9"><font color="white">{{$key->exam_name}}</font> </div>
                <div class="col-sm-3">  
                     <button type="submit" form="nameform{{$i}}" id="name{{$i}}" value="{{$key->exam_sem_sl}}" 
                                    class="btn bg-white  margin" style="white-space: pre-line;"  >View <i class="fa fa-chevron-right" aria-hidden="true"></i> 
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
