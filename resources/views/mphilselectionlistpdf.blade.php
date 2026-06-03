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
                     
               
                 <br>
         
          <div class="col-sm-12">
    <div class="card-body table-responsive" >
     <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>SELECTION LIST : {{$pgm_name}}</b></u> 
                 </p>
           <table id="example1" class="table table-bordered table-striped table-responsive" border="1">
             <tr>
                <th><font >SLNO</font></th> 
                <th><font >RANK</font></th> 
                <th><font >APPLICATION ID</font></th>
                <th><font >NAME OF APPLICANT</font></th>
                <th><font >COMMUNITY</font></th>
                    <th><font >ALLOTMENT CATEGORY</font></th>
                    <th><font >ALLOTED CAMPUS</font></th>
            </tr>              
               
                <tbody>
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
            @foreach($studlist as $ckey)
              @if($ckey->allotment!='RE-FIRST')
                <tr>
            
                  
                 <td>{{ ++$i }}</td>
                
                    <td>{{$ckey->rank}}</td> 
                    <td>{{$ckey->rank_appid}}</td>
                    <td>{{$ckey->rank_stud_name}}</td>
                    <td>{{$ckey->rank_community}}</td>
                    <td>{{$ckey->reserve}}</td>
                    <td>{{$ckey->allot_cent}}</td>
                  
                 
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
     <p style="font-size: 11px;"><i>Published on: 01/12/2020</i></p>   
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>    
</body>
</html>