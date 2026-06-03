<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 13px;
        padding: 3px;
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

     <center><img src="{{public_path('storage/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT, KALADY</b></center>
    <center><b>Re-accredited by NAAC with A+ Grade</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>PG ENTRANCE EXAMINATION HALL TICKET 2023-24 (PROVISIONAL)</u>
                    
                     
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
            
            
          
            <td colspan="2"><b>{{$key->centre_name}} @if(Auth::user()->pgapp_adsc_sl==986 && Auth::user()->pgapp_exam_centre==23)***@endif</b></td>
           
            </tr>
          
            <tr>
            <td>Date & Time </td>
            <td colspan="2"><b>{{$key->ent_exam_date}} {{$key->ent_exam_time}} </b> </td>
            
            </tr>
             @endforeach
            <tr>
            <td><img  src="{{public_path('images/pgphoto/'.Auth::user()->pgapp_photo)}}" width="120" height="150" alt="user"> </td>
            
                <td colspan="2"> <img  src="{{public_path('images/photopgentrnce.jpg')}}" width="120" height="150" alt="user"> </td>
           
            </tr>
             @if(Auth::user()->pgapp_adsc_sl==983 || Auth::user()->pgapp_adsc_sl==980 || Auth::user()->pgapp_adsc_sl==981 || Auth::user()->pgapp_adsc_sl==982)
             
             <tr>
                 <td style="font-size: 13px;font-weight:bold;" colspan="3">* Aptitude / Practical /Portfolio presentation / interview for MFA/ Theatre / Music / Dance (Bharathanatyam & Mohiniyattom) will be conducted on the same day itself at Main Centre, Kalady. The time slot of each candidate attending the Aptitude / Practical /Portfolio presentation will be informed by the Head of the Departments concerned.</td>
             </tr><br>
              @elseif(Auth::user()->pgapp_adsc_sl==995)
             <tr>
                 <td  style="font-size: 13px;font-weight:bold;" colspan="3">* Aptitude / Practical /Portfolio presentation / interview for MFA/ Theatre / Music / Dance (Bharathanatyam & Mohiniyattom) will be conducted on the same day itself at Main Centre, Kalady. The time slot of each candidate attending the Aptitude / Practical /Portfolio presentation will be informed by the Head of the Departments concerned.</td>    
             </tr>
              <br>   
             <tr>
                <td style="font-size: 13px;font-weight:bold;" colspan="3">** Candidates seeking admission to MFA Program should submit their protfolio presentation before the Head of the Department of Painting immediately after the entrance examination.</td>
             </tr>
              @elseif(Auth::user()->pgapp_adsc_sl==992)
             <tr>
                <td style="font-size: 13px;font-weight:bold;" colspan="3">
                 *** Candidates seeking admission to MPES Program should attend the physical fitness test scheduled at 8 AM onwards on the date of entrance examination at Main Centre, Kalady conducted by the Department of Physical Education. </td>    
             </tr><br>
                @else
                <br><br><br><br>
            @endif
           </table>
             
             
    </div> 
</div>
                  @if(Auth::user()->pgapp_adsc_sl!=995)
                 <br>    <br> 
                 @endif
                
                 
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
            @if(Auth::user()->pgapp_adsc_sl==986 && Auth::user()->pgapp_exam_centre==23)
            <p style="font-size: 13px; text-align: center;"><b> *** Directed to report before the HOD English on the date of entrance examinations.</b></p>

   @endif            
         <table>
                 <tr>
                 
                <!--<td colspan="2" style="text-align: right"> <img  src="{{public_path('images/pro_sign.jpg')}}" width="250" height="120" alt="user"> </td>-->
                     <td colspan="2" style="text-align: right">sd/- </td>
                 </tr>
               
                        <tr>
                            <td></td>
                            <td style="text-align: right;font-size: 13px;" class="pull-right"><b>Pro Vice Chancellor</b></td>
                        </tr>
                           
            </table>
              
                 <br>  <br>  <br>  <br>  <br> <br>  <br> <br><br><br>
                <p style="font-size: 15px; text-align: center;"><b><u>Instructions to the Candidates</u></b></p>   
                 
                 
              
    <p  style="font-size: 13px;">1. Candidates are advised to be present in the Examination Hall of the concerned Department / Centre 30
        minutes before the commencement of the examination.<br><br>
        
2.  The Admit Card must be brought by all candidates for entering the Examination Hall and shall be
produced for verification during the examination. No candidate will be allowed to write the examination
without his/her Admit Card.<br><br>

3.  The candidate shall affix an identical passport size photograph that was uploaded during online registration and hall ticket should be duly attested by a Gazetted officer.<br><br>

<b>4.   Candidates will not be allowed to take the examination, if they arrive after the
    commencement of the examination.</b><br><br>

5.  Duration of the written test will be two hours.<br><br>

6.  Candidates found resorting to unfair means will be disqualified.<br><br>

7.  Either blue or black ink shall be used in writing the examination.<br><br>

8.  Roll numbers shall be legibly written both in words and figures in the space provided.<br><br>

9.  Candidates shall not write their names or identification marks inside the answer book, doing so will be a disqualification.<br><br>

10. The candidates shall abide by the instructions given to them by the invigilator and breach of any examination related rules will be a reason for disqualification.<br><br>

11. Admit Cards are issued to all candidates, whoever applied provisionally, subject to subsequent verification of eligibility.<br><br>



12. If any defect is found at the time of verification, the application will summarily be rejected.<br><br>

13. All the applicants are allowed to appear for the entrance exam provisionally.<br><br>

14. If anyone is found not eligible in terms of the qualification,remittance of fee etc. his/her candidature will
summarily be rejected at any stage of selection/admission procedure.<br><br>
15. Photos or scanned copies of the Identity cards stored in the mobile phones will not be accepted as a valid Identity proof.<br>
16. The Candidates shall wear a mask throughout and shall strictly adhere to COVID 19 protocol issued by the Government of Kerala.
 </p>
 <p style="text-align: center;">***</p>
 
  @if(Auth::user()->pgapp_adsc_sl==991)

  <p style="font-size: 17px; text-align: center;"><b><u>MSW Entrance Examinations 2023- Special Instructions to Candidates </u></b></p>   
                   
              
    <p  style="font-size: 13px;">1. The candidates shall reach the Centre at least 30 minutes before the commencement of the 
examination.<br><br>
        
2.  No candidate is permitted to enter the examination hall 10 minutes after the commencement of the examination. 
<br><br>

3.  The candidate shall bring a black or blue ball point pen for attending the examination <br><br>

4.  The examination consists of objective type questions with multiple choices and the 
candidate should darken the bubble against the one correct answer only with black or blue 
ball point pen.<br><br>

5. Marking more than one bubble for a single question will be deemed as a wrong answer<br><br>

6. There will be no negative mark for wrong answer.<br><br>

7.   All question carry equal marks.<br><br>

8.  The candidate shall attempt 100 objective type questions within 120 minutes.<br><br>

9.   No candidate will be allowed to leave the examination hall before 15 minutes prior to the 
completion of examination.<br><br>

10. The Hall ticket, Question paper booklet and Answer sheet are the property of the University 
and the candidate will be allowed to leave the examination hall only after returning the same 
to the invigilator. <br><br>

11. Admissions shall be strictly on merit taking into consideration the relevant admission rules 
followed by the University for PG admission<br><br>



12. The answer sheets will not be subjected to revaluation or scrutiny at any cost.<br><br>

13. Grievances, if any, shall be addressed only to the Registrar, Sree Sankaracharya University 
of Sanskrit, Kalady. 
<br><br>
    </p>
 
 @endif
   

          <p style="font-size: 13px;"><i>Document generated on : {{$curnt_date}} {{$time}}</i></p>         

</body>
</html>