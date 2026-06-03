<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 15px;
    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
     margin-top:5;
    width: 100%;
    background-color:white;
    }
    table.tb_quali td{
        text-align: center;
    }
/*    p.sign_student {
        margin-top:165;
       
        font-family: arial, sans-serif;
        font-size: 14px;
    }*/
  
    
</style>
 


</head>


<body>

     <center><img src="{{asset('storage/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>PG  ENTRANCE HALL TICKET 2021-2022 (PROVISIONAL)</u>
                    
                     
                 </p>
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 12px;">( To be returned to the Invigilator after exam)</p>
               <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
        <table border="1" class="table table-striped">
                @foreach($pgapp as $key) 
         
             <tr>
            <td>Name of the Candidate</td>
            <td colspan="2"><b> {{Auth::user()->pgapp_name}}</b></td>
            </tr>
            <tr>
            <td>Application Number</td>
            
            <td colspan="2"><b>{{Auth::user()->pgapp_id}}  </b></td>
            
            </tr>
            <tr>
            <td>Roll Number</td>
            <td colspan="2"><b>{{Auth::user()->pgapp_rollno}}</b> </td>
            
            </tr>
           
             <tr>
            <td>Name Of Examination</td>
            
            <td colspan="2"><b>{{$key->ent_exam_name}}</b></td>
            
            </tr>
           
             <tr>
            <td>Centre of Examination </td>
            
            
          
            <td colspan="2"><b>{{$key->centre_name}}</b></td>
           
            </tr>
            <tr>
            <td>Date & Time </td>
            
            <td colspan="2"><b>{{$key->ent_exam_date}} {{$key->ent_exam_time}} </b> </td>
            
            </tr>
             @endforeach
            <tr>
            <td><img  src="{{asset('images/pgphoto/'.Auth::user()->pgapp_photo)}}" width="120" height="150" alt="user"> </td>
            
                <td colspan="2"> <img  src="{{asset('images/postpghallticktpic.jpg')}}" width="120" height="150" alt="user"> </td>
           
            </tr>
           
          

           </table>
             
             
    </div> 
</div>
                 <br>    <br>
                 
  <div class="col-md-12">
           <table>
                        <tr>
                        <td>Signature of the Invigilator :</td>
                          <td style="text-align: right">Signature of the candidate :</td>
                        </tr>
                      
                        <tr>
                             <td style="text-align: left">(Invigilator shall also sign across the candidates photograph)</td>
                            <td style="text-align: right">(To be signed in the presence of the Invigilator)</td>
                        </tr>
            </table>
             
  </div>   
         
                 <hr>
                        
     <div class="col-md-12">
           <table>
                 <tr>
                 <br><br>
                <td colspan="2" style="text-align: right"> <img  src="{{asset('images/digital_signature.jpg')}}" width="105" height="120" alt="user"> </td>
                 </tr>
               
                        <tr>
                            <td></td>
                            <td style="text-align: right;font-size: 14px;" class="pull-right"><b>Pro-Vice-Chancellor</b></td>
                        </tr>
            </table>
             
     </div>            <br>
                  <br>
                  <br><br><br><br><br>
                <br><br><p style="font-size: 18px; text-align: center;"><b><u>Instructions to the Candidates</u></b></p>   
                
    <p  style="font-size: 15px;">1. Candidates are advised to be present in the Examination Hall of the concerned Department / Centre 30
        minutes before the commencement of the examination.<br><br>
        
2.  The Admit Card must be brought by all candidates for entering the Examination Hall and shall be
produced for verification during the examination. No candidate will be allowed to write the examination
without his/her Admit Card.<br><br>

3.  The candidate shall affix an identical passport size photograph that was uploaded during online registration.<br><br>

<b>4.   Candidates will not be allowed to take the examination, if they arrive after the
    commencement of the examination.</b><br><br>

5.  Duration of the written test will be two hours.<br><br>

6.  Candidates found resorting to unfair means will be disqualified.<br><br>

7.  Either blue or black ink shall be used in writing the examination.<br><br>

8.  Roll numbers shall be legibly written both in words and figures in the space provided.<br><br>

9.  Candidates shall not write their names or identification marks inside the answer book, doing so will be a disqualification.<br><br>

10. The candidates shall abide by the instructions given to them by the invigilator and any disobedience will be a disqualification.<br><br>

11. Admit Cards are issued provisionally to all candidates, who have applied, subject to subsequent verification of eligibility.<br><br>



12. If any defect is found at the time of verification, the application will summarily be rejected.<br><br>

13. All the applicants are allowed to appear for the entrance exam provisionally.<br><br>

14. If anyone is found not eligible in terms of the qualification,remittance of fee etc. his/her candidature will
summarily be rejected at any stage of selection/admission procedure.<br><br>
15.  The Candidate should produce a photo affixed identity card in original (Issued by Government or Government Agencies)and it's self attested copy to prove their identity.(Voters ID,Driving Licence,Aadhar Card,ID Card issued by Social welfare Dept,Valid Photo affixed student ID card issued by Aided/Govt Colleges or Universities within last 3 year, etc).<br>
16. Photos or scanned copies of the Identity cards stored in the mobile phones will not be accepted as a valid Identity proof.<br>
17. Hall Ticket and Self Attested copy of Identity Card should be returned to the Invigilator after the Examination.<br> 
18. The Candidates shall wear a mask throughout and shall strictly adhere to COVID 19 protocol issued by the Government of Kerala.
 </p>
 <p style="text-align: center;">***</p>
          <p style="font-size: 13px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>         

</body>
</html>