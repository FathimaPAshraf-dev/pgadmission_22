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


<body>

     <center><img src="{{asset('images/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

      @foreach($studlist as $ckey)
       <?php $pgm_name=$ckey->pgm_name; ?>
       @if($ckey->adsc_admnyear==2021)
                    <?php $pgm_name=$ckey->pgm_name; ?>
        @endif  
                 @endforeach
                 @if($ckey->adsc_admnyear==2021)
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>JRF Qualified Candidates : {{$pgm_name}}</b></u> 
                 </p>
                 
                   <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
           <table id="example1" class="table table-bordered table-striped table-responsive" border="1">
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
               
         
          <div class="col-sm-12">
    <div class="card-body table-responsive" >
     <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>Provisional Rank List : {{$pgm_name}}</b></u> 
                 </p>
           <table id="example1" class="table table-bordered table-striped table-responsive" border="1">
             <tr>
                <th><font >RANK</font></th> 
                <th><font >ROLL NO </font></th>
                <th><font >APPLICATION NUMBER.</font></th>
                <th><font >NAME OF APPLICANT</font></th>
                <th><font >COMMUNITY</font></th>
                    <th><font >MARK</font></th>
            </tr>              
               
                <tbody>
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
            @foreach($studlist as $ckey)
              @if($ckey->mphilrenotification==0)
                <tr>
            
                  <td>{{ ++$i }}</td>
                 
                
                    <td>{{$ckey->postpgapp_rollno}}</td> 
                    <td>{{$ckey->postpgapp_appid}}</td>
                    <td>{{$ckey->postpgapp_studname}}</td>
                    <td>{{$ckey->postpgapp_community}}</td>
                    <td>{{$ckey->postpg_indexmark}}</td>
                 
                </tr>
                @endif
              @endforeach 
                
                    
                </tbody>
               
              </table>
             
             
    </div> 
</div>
   <br>  <br>
   <p style="font-size: 12px; text-align: left"><b>Note: Claim for admission shall be subject to the satisfactory verification of qualification and eligibility</b></p> 
  <br> 
   <p style="font-size: 12px; text-align: right"><b>Sd/-</b></p>  
    <p style="font-size: 13px; text-align: right;"><b>REGISTRAR</b></p>  
     <p style="font-size: 11px;"><i>Published on: 23/11/2020</i></p>   
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>    
</body>
</html>