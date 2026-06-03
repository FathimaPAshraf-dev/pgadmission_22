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
<section class="content">
         <div class="card card-secondary">
        <div class="card-header">
           
     
            <div class="card-title">
               <b><center>SEMESTER GRADE REPORT&nbsp;(Provisional)..</center></b>
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
      <td>{{auth()->user()->centre_table->centre_name}}</td>
      </tr>
   
     
     
       <tr>
      <th>Register Number</th>
      <th>:</th>
      <td></td>
      <td>{{$stud_regno}}</td>
      </tr>
   
      </table>
    </div>
  </div>
           
           
      <div class="col-sm-12">
      <div class="card-body table-responsive" >
     
       
      <table border="2"  align="center" class="table table-bordered table-striped dataTable">
 
      <tr>
            <th class="abcd" style="text-align: center" rowspan="2">SL.NO.</th>
            <th class="abcde" style="text-align: center" rowspan="2">COURSE CODE</th>
            <th style="text-align: center" rowspan="2">COURSE TITLE</th>
            <th class="abcd" style="text-align: center" rowspan="2">CREDITS</th>
            <th class="abcde" style="text-align: center" rowspan="2">CORE/ELECTIVE</th>
            <th style="text-align: center" colspan="2">GRADE</th>
            <th class="abcde" style="text-align: center" rowspan="2">POINTS</th>
            
            @foreach($pdetsl as $key)
            
                <?php $ptype_sl=$key->ptype_sl; ?>
            
            @endforeach
           
            
            
     </tr>
     <tr>
            <th>IA</th>
            <th>ESA</th>
         
     </tr>
      
       <?php     $i=1;  ?>
        
        @foreach($pdetsl as $key)
          <tr>
            <td style="text-align: center">{{$i++}}</td>
            <td style="text-align: center">{{$key->pdet_code}}</td>
            <td style="text-align: center">{{$key->pdet_name}}</td>
            <td style="text-align: center">{{$key->pdet_credit}}</td>
            <td style="text-align: center">{{$key->ptype_name}}</td>
         
        
      <!--start of int mark-->
      
       <?php  
        
            $points=($key->pdet_cswt*$key->expdet_ce)+($key->pdet_eswt*$key->expdet_ese);
            $avg_grade=$points/$key->pdet_credit;
           
        ?>
    @foreach($exam_pg as $val)
        <?php $exmsl=$val->exstd_exam_sl;  ?>
    @endforeach
  
    @if($exmsl=='2700')       
        
         @if($key->expdet_ce==9)
         
            <td style="text-align: center">A+</td>
            
            @elseif($key->expdet_ce==8)
         
            <td style="text-align: center">A</td>
            
            @elseif($key->expdet_ce==7)
         
            <td style="text-align: center">A-</td>
            
            @elseif($key->expdet_ce==6)
         
            <td style="text-align: center">B+</td>
            
            @elseif($key->expdet_ce==5)
         
            <td style="text-align: center">B</td>
            
            @elseif($key->expdet_ce==4)
         
            <td style="text-align: center">B-</td>
            
            @elseif($key->expdet_ce==3)
         
            <td style="text-align: center">C+</td>
            
            @elseif($key->expdet_ce==2)
         
            <td style="text-align: center">C</td>
            
            @elseif($key->expdet_ce==1)
         
            <td style="text-align: center">C-</td>
            
            @elseif($key->expdet_ce==0)
         
            <td style="text-align: center">F</td>
            
            @elseif($key->expdet_ce=='ab')
          
            <td style="text-align: center">Absent</td>
            
         @endif   
   <!--end of internal mark-->
   
   <!--start of ext mark-->
         @if($key->expdet_ese==9)
        
            <td style="text-align: center">A+</td>
            
            @elseif($key->expdet_ese==8)
            
            <td style="text-align: center">A</td>
            
            @elseif($key->expdet_ese==7)
            
            <td style="text-align: center">A-</td>
            
            @elseif($key->expdet_ese==6)
            
            <td style="text-align: center">B+</td>
            
            @elseif($key->expdet_ese==5)
            
            <td style="text-align: center">B</td>
            
            @elseif($key->expdet_ese==4)
            
            <td style="text-align: center">B-</td>
            
            @elseif($key->expdet_ese==3)
            
            <td style="text-align: center">C+</td>
            
            @elseif($key->expdet_ese==2)
            
            <td style="text-align: center">C</td>
            
            @elseif($key->expdet_ese==1)
            
            <td style="text-align: center">C-</td>
            
            @elseif($key->expdet_ese==0)
            
            <td style="text-align: center">F</td>
            
            @elseif($key->expdet_ese=='ab')
            
            <td style="text-align: center">Absent</td>
            
         @endif   <!--end of extmark-->
            
            @if($key->expdet_ese==0 || $key->expdet_ce==0 || $key->expdet_ese=='ab' || $key->expdet_ce=='ab')
                <td style="text-align: center">-</td>
                <td style="text-align: center">-</td>
          
            @else
           
                <td style="text-align: center">{{($key->pdet_cswt*$key->expdet_ce)+($key->pdet_eswt*$key->expdet_ese)}} </td>
                 
                                 
            @endif    
             <!-- end of examsl=2700-->
        
         @else
            @if($key->pdet_iaesa==1)
            
            @if($key->expdet_ce==7)
         
            <td style="text-align: center">A+</td>
            
            @elseif($key->expdet_ce==6)
         
            <td style="text-align: center">A</td>
                      
            @elseif($key->expdet_ce==5)
         
            <td style="text-align: center">B+</td>
            
            @elseif($key->expdet_ce==4)
         
            <td style="text-align: center">B</td>
                       
            @elseif($key->expdet_ce==3)
         
            <td style="text-align: center">C+</td>
            
            @elseif($key->expdet_ce==2)
         
            <td style="text-align: center">C</td>
                       
            @elseif($key->expdet_ce==0)
         
            <td style="text-align: center">F</td>
            
            @elseif($key->expdet_ce=='ab')
          
            <td style="text-align: center">Absent</td>
            
            @endif
            <td style="text-align: center">-</td>
            
             @if($key->expdet_ce==0 || $key->expdet_ce=='ab')
                <td style="text-align: center">-</td>
                <td style="text-align: center">-</td>
             
             @else
                <td style="text-align: center">{{$key->pdet_cswt*$key->expdet_ce}}</td>
               
              @endif  
              
           @else 
            @if($key->expdet_ce==7)
         
            <td style="text-align: center">A+</td>
            
            @elseif($key->expdet_ce==6)
         
            <td style="text-align: center">A</td>
            
            @elseif($key->expdet_ce==5)
         
            <td style="text-align: center">B+</td>
            
            @elseif($key->expdet_ce==4)
         
            <td style="text-align: center">B</td>
                      
            @elseif($key->expdet_ce==3)
         
            <td style="text-align: center">C+</td>
            
            @elseif($key->expdet_ce==2)
         
            <td style="text-align: center">C</td>
                       
            @elseif($key->expdet_ce==0)
         
            <td style="text-align: center">F</td>
            
            @elseif($key->expdet_ce=='ab')
          
            <td style="text-align: center">Absent</td>
            
         @endif 
          <!--start of ext mark-->
         @if($key->expdet_ese==7)
        
            <td style="text-align: center">A+</td>
            
            @elseif($key->expdet_ese==6)
            
            <td style="text-align: center">A</td>
            
                       
            @elseif($key->expdet_ese==5)
            
            <td style="text-align: center">B+</td>
            
            @elseif($key->expdet_ese==4)
            
            <td style="text-align: center">B</td>
            
           
            @elseif($key->expdet_ese==3)
            
            <td style="text-align: center">C+</td>
            
            @elseif($key->expdet_ese==2)
            
            <td style="text-align: center">C</td>
            
            
            @elseif($key->expdet_ese==0)
            
            <td style="text-align: center">F</td>
            
            @elseif($key->expdet_ese=='ab')
            
            <td style="text-align: center">Absent</td>
            
         @endif   <!--end of extmark-->
                      
          <td style="text-align: center">{{($key->pdet_cswt*$key->expdet_ce)+($key->pdet_eswt*$key->expdet_ese)}} </td> <!--points-->

        @endif 
       
          
       @endif 
       
    </tr>  
    @endforeach    
        
      </table>
          
      <div class="card-body" >
           
                 <div class="row">
                 <div class="col-md-4"><b>TOTAL CREDITS&nbsp;&nbsp;:&nbsp;&nbsp;{{$cum_tpoint}}</b></div>
             <div class="col-md-4"><b>TOTAL POINTS&nbsp;&nbsp;:&nbsp;&nbsp; {{$cum_tcredit}}</b></div>
              <div class="col-md-4"><b>SGPA&nbsp;&nbsp;:&nbsp;&nbsp;{{$sgpa}}</b></div>
           </div>
        </div>    
       
   
    @foreach($exam_pg as $key)
      <form action="{{route('diplomapdf')}}" method="post" id="nameform{{++$i}}" >

  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

            <div class="card-body">
         
                <input name="sem" type="hidden" value="{{$key->exstd_sem}}" />
               <input name="exmsl" type="hidden" value="{{$key->exstd_exam_sl}}" />

                <button type="submit" form="nameform{{$i}}" id="name{{$i}}" value="{{$key->exstd_sem}}"
                        class="btn bg-secondary color-palette  margin " style="white-space: pre-line;" >Download Provisional Semester Grade Report
               </button>
             
   
   
            </div>
  </form>
        @endforeach
       
        <?php
   $i=0;
   ?>
    @foreach($exam_pg as $key)
      <form action="{{route('finalgradepdf')}}" method="post" id="nameform{{++$i}}" >

  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

            <div class="card-body">
         
                <input name="sem" type="hidden" value="{{$key->exstd_sem}}" />
               <input name="exmsl" type="hidden" value="{{$key->exstd_exam_sl}}" />
               @if(empty($final))
               
               @else
                <button type="submit" form="nameform{{$i}}" id="name{{$i}}" value="{{$key->exstd_sem}}"
                        class="btn bg-secondary color-palette  margin " style="white-space: pre-line;" >Download Final Grade Report
               </button>
               @endif
             
   
   
            </div>
  </form>
        @endforeach 

      <div class="box box-body" >
          <p align="center"><i>Disclaimer: IT Division is not responsible for any inadvertent error that may have crept up  the results being published on net.</i></p>
      </div>
      </div>

      </div>   
          </section>
 @endsection