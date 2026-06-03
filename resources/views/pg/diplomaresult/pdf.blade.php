<html>
<head>
<style>
    @page { margin: 1px; }
   
    table {
        
        border-collapse: collapse;
        width: 100%;
        background-color:white;
    }
    body{
        margin: 30px;
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        
        font-size: 11px;
        /*padding: 3px;*/
    }
    table.student td{
        padding: 4px;
    }
 
</style>
 

</head>
<?php 
$str="Name: ".Auth::user()->stud_name;
$str.="\n Reg: ".Auth::user()->stud_registerno;
$stud_regno=Auth::user()->stud_registerno;
$pgm_name=Auth::user()->admnscheme_table->program_table->pgm_name;
?>

<body>
<!--    <pageheader name="MyHeader1" content-right=""
        header-style="font-weight: bold; color: #000000;" line="on" />
    <pagefooter name="MyFooter1" content-left="" content-right="document generated on: {DATE j-m-Y} {DATE H:i:s}"
        content-center="{PAGENO}/{nbpg}" footer-style="font-size: 8pt;" line="on"/>
   -->
     <center><img src="{{asset('storage/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>
    
    <p style="text-align: center; font-size: 14px;">
       <u><b>SEMESTER GRADE REPORT&nbsp;(Provisional)</b></u> 
    </p>
    
    @foreach($exam_pg as $res)
        <?php   $exam_name1= $res->exam_name; 
                $sem = explode(" ", $exam_name1);
        ?>
 
        @if($res->exam_month==10)
        <?php
        $exam_month='OCTOBER';?>
        @endif

        @if($res->exam_month==4)
        <?php $exam_month='APRIL'; ?>
        @endif

        <table style="border:white;" class="student">
            <tr>
                <td><b>PROGRAMME OF STUDY&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{$pgm_name}}</td>
                <td><b>NAME OF THE CANDIDATE&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{$res->tb_name_of_stud}}</td>
            </tr>
            <tr>
                <td><b>SEMESTER&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{$sem[0]}}</td>
                <td><b>REGISTER NUMBER&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{$stud_regno}}</td>
            </tr>
            <tr>
                <td><b>YEAR & MONTH OF EXAMINATION&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{$res->exam_year.' '.$exam_month}}</td>
                <td><b>FACULTY&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{strtoupper(Auth::user()->admnscheme_table->program_table->faculty_table->name)}}</td>
            </tr>
        </table>
       
    @endforeach    

    <br>

            
        <table border="1" style="border:1px; border-collapse:collapse;" align="center">
          
      <tr>
            <th class="abcd" style="text-align: center" rowspan="2">SL.NO.</th>
            <th class="abcde" style="text-align: center" rowspan="2">COURSE CODE</th>
            <th style="text-align: center" rowspan="2">COURSE TITLE</th>
            <th class="abcd" style="text-align: center" rowspan="2">CREDITS</th>
            <th class="abcde" style="text-align: center" rowspan="2">CORE/ELECTIVE</th>
            <th style="text-align: center" colspan="2">GRADE</th>
            <th class="abcde" style="text-align: center" rowspan="2">POINTS</th>
            
   
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
     
     <br>
  
     <table border="1" style="border:1px; border-collapse:collapse;" align="center">

   <tr>
   
         
            <th class="abcde" style="text-align: center" colspan="3">CURRENT SEMESTER RECORD</th>
            <th class="abcde" style="text-align: center" colspan="3">CUMULATIVE RECORD</th>
            <th class="abcde" style="text-align: center" rowspan="2">TOTAL VALID CREDITS EARNED</th>
         
     </tr>
     <tr>
     <th  style="text-align: center" >TOTAL CREDITS</th>
     <th  style="text-align: center" >TOTAL POINTS</th>
     <th  style="text-align: center">SGPA</th>
     <th  style="text-align: center" >TOTAL CREDITS</th>
     <th  style="text-align: center" >TOTAL POINTS</th>
     <th  style="text-align: center">CGPA</th>
    </tr>

    <tr> 
        <td style="text-align: center">{{$cum_tpoint}}</td>
        <td style="text-align: center">{{$cum_tcredit}}</td>
        <td style="text-align: center">{{$sgpa}}</td>
        <td style="text-align: center">{{$cum_tcredits}}</td>
        <td style="text-align: center">{{$cum_tpoints}}</td>
        @if($cgpa=='0.00')
        <td style="text-align: center">-</td>
        @else
        <td style="text-align: center">{{$cgpa}}</td>
        @endif
        <td style="text-align: center">{{$cum_tcredits}}</td>
    </tr>
    
   
</table> 
     <br>
    <p style="font-size: 11px;"><i>The results published on the website are for immediate information to examinees.This cannot be treated as original grade sheet.The original grade 
                    report will be issued by the university separately.</i></p>
                    <br>
         
      <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>  
</body>
</html>