@extends('layouts.master')

@section('styles')
<style type="text/css">
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        background-color:white;
    }

    td, th {
        text-align: left;
        padding: 8px;
        font-size: 13px;
    }

    th {
     valign:middle;
    }
    .text-nowrap {
        white-space: nowrap;
    }

</style>
@stop
<?php
   $stud_regno=Auth::user()->stud_registerno;
 ?>
@section('content')
<section class="content-header">
       
      <!-- Default box -->
   
         
        <div class="card card-secondary">
        <div class="card-header">
           
     
            <div class="card-title">
               <b><center>Final Grade Sheet</center></b>
             </div>
       
        </div>
 
   
  <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
          <table class="table table-responsive table-striped dataTable">
          @foreach($exam_pg as $res)
      <tr>
      <th>Examination</th>
      <th>:</th>
      <td></td>
      <td>{{$res->exam_name}}</td>
      </tr>
       <tr>
      <th>Name of Student</th>
      <th>:</th>
      <td></td>
      <td>{{$res->tb_name_of_stud}}</td>
      </tr>
       @endforeach
       
   
       <tr>
      <th>Centre of Exam</th>
      <th>:</th>
      <td></td>
      <td>{{$centre_name}}</td>
      </tr>
     
     
     
       <tr>
      <th>Register Number</th>
      <th>:</th>
      <td></td>
      <td>{{$regno}}</td>
      </tr>
   
      </table>
    </div>
  </div>
           
           
    
      <div class="card-body table-responsive" >
     
       
      <table border="2"  align="center" class="table table-bordered table-striped dataTable">
 
      <tr>
            <th class="abcd" style="text-align: center" >SEMESTER</th>
            <th class="abcde" style="text-align: center">CREDITS</th>
            <th style="text-align: center">POINTS EARNED</th>
          
              
     </tr>
     @foreach($exam_cum as $key)
        <tr>
       
           
              <td style="text-align: center">{{$key->cum_sem}}</td>
              <td style="text-align: center">{{$key->cum_tpoint}}</td>
              <td style="text-align: center">{{$key->cum_tcredit}}</td>
              
        </tr>
        
       @endforeach 
       
       <tr>
             <th style="text-align: center">TOTAL</th>
             <td style="text-align: center">{{$crc}}</td>
             <td style="text-align: center">{{$crp}}</td>
       </tr>
      </table>
    </div>  

   <div class="card-body table-responsive" >
         
      <table border="2"  align="center" class="table table-bordered table-striped dataTable">
 
      <tr>
          <th class="abcd" style="text-align: center" colspan="2">FINAL GRADE POINT AVERAGE</th>
             @foreach($cgpa as $key)
    
             <td style="text-align: center">{{$key->tb_zz_cgpa}}</td>
            
              @endforeach
        </tr>
       
           
     </tr>
     @foreach($cgpa as $key)
        <tr>
            <td style="text-align: center" rowspan="2">GRADE</td>
              <td style="text-align: center">In Letters</td>
               <td style="text-align: center">In Words</td>
        </tr>
        
       <tr>
           <th style="text-align: center"> {{$key->tb_zz_cgpag}}</th>
            <th style="text-align: center">{{$key->tb_zz_cgpagrd}}</th>
       </tr>
         @endforeach
      </table>
    </div>  
          
   <?php
   $i=0;
   ?>
    @foreach($exam_pg as $key)
      <form action="{{route('finalgradepdf')}}" method="post" id="nameform{{++$i}}" >

  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

            <div class="card-body">
         
                <input name="sem" type="hidden" value="{{$key->exstd_sem}}" />
               <input name="exmsl" type="hidden" value="{{$key->exstd_exam_sl}}" />

                <button type="submit" form="nameform{{$i}}" id="name{{$i}}" value="{{$key->exstd_sem}}"
                        class="btn bg-secondary color-palette  margin " style="white-space: pre-line;" >Download Final Grade Sheet
               </button>
             
   
   
            </div>
  </form>
        @endforeach
       
         

      <div class="box box-body" >
          <p align="center"><i>Disclaimer: IT Division is not responsible for any inadvertent error that may have crept up  the results being published on net.</i></p>
      </div>
    
</section>
  @endsection
