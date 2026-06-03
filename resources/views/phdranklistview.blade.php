
@extends('layouts.rankapp')

@section('content')
<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 12px;
        text-align: center;
    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:white;
    }
    table.tb_quali td{
        text-align: center;
    }

</style>
 


</head>

<section class="container-fluid">
    <div class="card">
        <div class="card-body">
            
    @if(empty($studlist))
       @foreach($nolist as $ckey)
       <?php $adname=$ckey->adsc_name;
             $pgm_name=$ckey->pgm_name;
             $adsc_admnyear=$ckey->adsc_admnyear;
       ?>
       @endforeach
       
          
                 
<!--        <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 17px;">
                   <b>No Qualified Candidates </b>
                 </p>-->
                 
                 
                 @if(!empty($studlistjrf))
                 @if($adsc_admnyear==2021)
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>JRF QUALIFIED CANDIDATES (Provisional) FOR PH.D 2021  : {{$pgm_name}}</b></u> 
                 </p>
                 
                 
                   <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
           <table id="example1" class="center table table-bordered table-hover " border="1">
             <tr>
                <th><font >SL NO</font></th> 
               
                <th><font >APPLICATION NUMBER</font></th>
                <th><font >NAME OF APPLICANT</font></th>
                <th><font >COMMUNITY</font></th>
                
            </tr>              
               
                <tbody>
               <?php 
               $tot=0;
                    $i=0;
               ?> 
           
            @foreach($studlistjrf as $ckey1)
             
                <tr>
            
                  <td>{{ ++$i }}</td>
                 
                
                    
                    <td>{{$ckey1->postpgapp_appid}}</td>
                    <td>{{$ckey1->postpgapp_studname}}</td>
                    <td>{{$ckey1->postpgapp_community}}</td>
                    
                 
                </tr>
             
               
               
              @endforeach 
                
            
                </tbody>
               
              </table>
              
             
    </div> 
</div>
             @endif 
           
           @endif       
                   
                 
    @else
        @foreach($studlist as $ckey)

         <?php $pgm_name=$ckey->pgm_name; ?>
          @if($ckey->adsc_admnyear==2021)
                      <?php $pgm_name=$ckey->pgm_name; ?>
          @endif  

        @endforeach
        
         @if(!empty($studlistjrf))
                 @if($ckey->adsc_admnyear==2021 || $ckey->adsc_admnyear==2020)
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>JRF QUALIFIED CANDIDATES (Provisional) FOR PH.D 2021  : {{$pgm_name}}</b></u> 
                 </p>
                 
                 
                   <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
           <table id="example1" class="center table table-bordered table-hover " border="1">
             <tr>
                <th><font >SL NO</font></th> 
               
                <th><font >APPLICATION NUMBER</font></th>
                <th><font >NAME OF APPLICANT</font></th>
                <th><font >COMMUNITY</font></th>
                
            </tr>              
               
                <tbody>
               <?php 
               $tot=0;
                    $i=0;
               ?> 
           
            @foreach($studlistjrf as $ckey1)
             
                <tr>
            
                  <td>{{ ++$i }}</td>
                 
                
                    
                    <td>{{$ckey1->postpgapp_appid}}</td>
                    <td>{{$ckey1->postpgapp_studname}}</td>
                    <td>{{$ckey1->postpgapp_community}}</td>
                    
                 
                </tr>
             
               
               
              @endforeach 
                
            
                </tbody>
               
              </table>
              
             
    </div> 
</div>
             @endif 
             
             @endif
             
               
                 <br>
                  @if(!empty($list_teacher))   
              <div class="col-sm-12">
    <div class="card-body table-responsive" >
     <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>SHORT LISTED TEACHERS LIST (Provisional) FOR PH.D 2021 : {{$pgm_name}}</b></u> 
                 </p>
           <table id="example1" class="center table table-bordered table-hover " border="1">
             <tr>
                <th><font >SL NO</font></th> 
                <th><font >ROLL NO </font></th>
                <th><font >APPLICATION NUMBER</font></th>
                <th><font >NAME OF APPLICANT</font></th>
                <th><font >COMMUNITY</font></th>
                
            </tr>              
               
                <tbody>
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
            @foreach($list_teacher as $ckey)
              
                <tr>
            
                  <td>{{ ++$i }}</td>
                 
                
                    <td>{{$ckey->postpgapp_rollno}}</td> 
                    <td>{{$ckey->postpgapp_appid}}</td>
                    <td>{{$ckey->postpgapp_studname}}</td>
                    <td>{{$ckey->postpgapp_community}}</td>
                    
                 
                </tr>
              @endforeach 
                
                    
                </tbody>
               
              </table>
             
             
    </div> 
</div>
              
                 @endif   
                 <br>
         
          <div class="col-sm-12">
    <div class="card-body table-responsive" >
     <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>SHORT LISTED CANDIDATES (Provisional) FOR PH.D 2021 : {{$pgm_name}}</b></u> 
                 </p>
           <table id="example1" class="center table table-bordered table-hover " border="1">
             <tr>
                <th><font >RANK</font></th> 
                <th><font >ROLL NO </font></th>
                <th><font >APPLICATION NUMBER</font></th>
                <th><font >NAME OF APPLICANT</font></th>
                <th><font >COMMUNITY</font></th>
                
            </tr>              
               
                <tbody>
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
            @foreach($studlist as $ckey)
              
                <tr>
            
                  <td>{{ ++$i }}</td>
                 
                
                    <td>{{$ckey->postpgapp_rollno}}</td> 
                    <td>{{$ckey->postpgapp_appid}}</td>
                    <td>{{$ckey->postpgapp_studname}}</td>
                    <td>{{$ckey->postpgapp_community}}</td>
                    
                 
                </tr>
              @endforeach 
                
                    
                </tbody>
               
              </table>
             
             
    </div> 
</div>
                 
             
                
    @endif  
   
    
   <br>  <p style="font-size: 12px; text-align: left"><b>Note 1: Claim for admission shall be subject to the satisfactory verification of qualification and eligibility</b></p> 
  <p style="font-size: 12px; text-align: left"><b>Note 2: Candidates shall submit a copy of the research proposal as mentioned in the notification to the Head of the department on or before 02/12/2020 </b></p> 
  <br> 
   <p style="font-size: 12px; text-align: right"><b>Sd/-</b></p>  
    <p style="font-size: 13px; text-align: right;"><b>REGISTRAR</b></p>  
     <p style="font-size: 11px;"><i>Published on: 24/11/2020</i></p>   
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>    
    </div>
       
    </div>
</section>
</html>
@stop