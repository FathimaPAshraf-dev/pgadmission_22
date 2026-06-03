<html>
<head>
<style>
    th{
        text-align: right;
    }
    td{
        text-align: left;
    }
    td,th{
        font-size: 12px;
         padding: 3px;
         /*text-align: center;*/

    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:white;
    
    }
   
    .watermark {
        background-image: url('/storage/ssus-logo1.jpg'); 
        background-size: 10%;
        background-repeat:   no-repeat;
        opacity: 0.2; 
        background-position: center center;              
    }
footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px; 
        font-size: 14px;

    }
</style>
 
</head>
<body>


    <center><img src="{{public_path("storage/redemb.jpg")}}" alt="Logo" width="110" height="90" class="center"></center>

    <center> <b style="font-family:arial, sans-serif;">SREE SANKARACHARYA UNIVERSITY OF SANSKRIT, KALADY</b></center>
    <center><b style="font-size: 13px;font-family:arial, sans-serif;">Re-accredited by NAAC with A+ Grade</b></center>
    <center><p style="font-family:arial, sans-serif;font-size: 12px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>
   
    <hr>
   
                
     <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
         <u><b> PG ADMISSION : STUDY CAMPUS CHOICE DETAILS</b></u> 
     </p>
      
        <div class="watermark">     
            
           <table class="table table-bordered table-hover " border="0" >
            <tr>
            <th>PROGRAM</th>
            <th>:</th>
            <td style="text-align: left">{{$pgmname}} </td>
           </tr>     
            <tr>
            <th>APPLICATION NUMBER </th>
            <th>:</th>
            <td style="text-align: left">{{Auth::user()->pgapp_id}} </td>
           </tr>
           <tr>
            <th>NAME </th>
            <th>:</th>
            <td style="text-align: left">{{Auth::user()->pgapp_name}}</td>
           </tr>
           <tr>
            <th>DOB </th>
            <th>:</th>
            <td style="text-align: left">{{date('d-m-Y', strtotime(Auth::user()->pgapp_dob))}}</td>
           </tr>
           <tr>
            <th>RANK </th>
            <th>:</th>
             @foreach($rank as $key)
            <td style="text-align: left">{{$key->rank}}</td>
             @endforeach
           </tr>
             @foreach($option as $key) 
            <tr>
              <?php $time=$key->pgpgm_timestamp; 
              
              ?>  
              <th>STUDY CAMPUS CHOICE {{$key->pg_option}} </th>
              <th>:</th>
             <td>{{$key->centre_name}}</td>
           </tr>
              @endforeach
            <tr>
            <th>OPTION SUBMITTED ON </th>
            <th>:</th>
            <td>{{$key->pgpgm_timestamp}}</td>
            </tr>
            </table>
           
         </div>   
           <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 12px;"><b><u>Declaration</u> </b></p>   
       <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 12px;"><b>The Transfer of Campus will be based on the position of the candidate in the ranklist, availability of seats (should be within the sanctioned strength 
                  approved by the University) and the option exercised by the candidate.
           The university reserves the right to direct any student to transfer from one Campus to another Campus in case there is a shortfall in the number of 
           students at any of the Campus.</b></p>  
   
           <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 12px;"> I accept the above declarations <input type="checkbox" name="option_declaration" id="option_declaration"  <?php if (Auth::user()->option_declaration == 1 || Auth::user()->option_declaration == 3)  echo 'checked'; ?>></p>
      
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$timenow}}</i></p>    
      <hr> 
      
         <footer>
            Document generated on : {{$curnt_date}} {{$timenow}}
        </footer>
      
</body>
</html>