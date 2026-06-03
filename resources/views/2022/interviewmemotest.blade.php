<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 13px;
        text-align: center;
    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:white;
    }
   
    li{
        font-size: 13px;
    }
/*    p.sign_student {
        margin-top:165;
       
        font-family: arial, sans-serif;
        font-size: 14px;
    }*/
  
    
</style>
 


</head>


<body>

      <center><img src="{{public_path("storage/redemb.jpg")}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
     <center><b style="font-size: 13px;font-family:arial, sans-serif;">NAAC Re-accredited with A+ Grade</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-size: 14px;">
                     <u><b>INTERVIEW MEMO FOR PG ADMISSION 2022. </b></u> 
                 </p>
                 <br>
                 <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                        <table border="1" class="table table-striped">
                       

                         <tr>
                            <th>To,</th>
                            <th>Application ID</th>
                            <th>Community</th>
                        </tr>
                        <tr>
                        <td style="text-align: center;">{{Auth::user()->pgapp_name}}
                        </td>
                        
                        <td style="text-align: center;">{{Auth::user()->pgapp_id}} </td>
                        <td style="text-align: center;">{{Auth::user()->pgapp_community}}</td>
                        </tr>
                        
                        </table>
          
                     </div>
                     </div>
            @foreach($allotment as $key) 
                <div class="col-sm-12">
                    <div class="card-body table-responsive" >

                        <p style="font-size: 13px; text-align: center;"><b>Interview Venue : </b>{{$key->allot_cent}}</p>
                        <p style="font-size: 13px; text-align: center;"><b>Allotted Centre : </b>{{$key->allot_cent}}</p>
                         @if($key->seat != $key->weightage)
                        <p style="font-size: 13px; text-align: center;"><b>Allotted Category : </b>{{$key->seat}} - {{$key->weightage}}</p>
                        @else
                        <p style="font-size: 13px; text-align: center;"><b>Allotted Category : </b>{{$key->seat}}</p>
                        @endif
                        <p style="font-size: 13px; text-align: center;"><b>Allotment : </b>{{$key->app_allotment}}</p>

                    </div>
                </div>
                 <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                       <table border="1" class="table table-striped">
                        <tr>
                            <th>Name of the Program </th>
                            <th>Rank</th>
                            <th>Admission Schedule</th>
                            
                        </tr>
                     
                        <tr>
                            <td style="text-align: center;">{{$key->pgm}}</td>

                            <td style="text-align: center;">{{$key->app_rank }} </td>
                            @if($key->app_allotment=='SECOND')
                            <td style="text-align: center;">{{$key->sh_date1}}, between {{$key->sh_time1}}  </td>
                            @else
                             <td style="text-align: center;">{{$key->sh_date}}, between {{$key->sh_time}}  </td>
                            @endif
                        </tr>
                    
                          
                            
                        </table>
          
                     </div>
                     </div>
            @endforeach
                 
               <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
       <p style="font-size: 13px; text-align: left;">  The provisional rank list for the selection of candidates to various P.G Programme in Sree Sankaracharya
University of Sanskrit during this year has already been published. Now the University has decided to conduct
admission for P.G programmes offered at Main Centre and Regional Centres. </p>    
   <p style="font-size: 13px; text-align: left;"> You are hereby directed to report at the above centre at the prescribed date and time, for completing the admission
process. </p>          
    </div> 
</div>
  
     
       <p style="font-size: 13px; text-align: left;"> 
           The following original documents are to be produced at the time of Interview</p>

       <ul>
           <li> Interview Memo</li>
           <li> SSLC Book</li>
           <li> Provisional/Original degree certificate.(Those who have appeared for the Final Year/Semester Degree Examination in April-May 2022 and not received the
        original/Provisional certificate must submit original Mark/Grade Sheets of I to IV semesters(I to VI semesters for 4 year degree program))</li>
           <li>Mark List of qualifying degree examination.</li>
           <li>Transfer Certificate</li>
           <li> Conduct Certificate</li>
           <li> Disability Certificate in the case of Physically Handicapped Candidates</li>
           <li>Non creamy layer Certificate (In the case of OBC/OEC Candidates)</li>
           
           <li>Caste/Community Certificate (In the case of SC/ST/OEC candidates)</li>
           <li>Migration Certificates for those who studied in other Universities.</li>
           <li> Eligibility certificate (applicable to those who have not undergone 10+2+3 pattern)/and those who have passed &nbsp;
                the Degree course from Universities outside Kerala).</li>
           <li> Candidates eligible for reservation of EWS among forward caste should produce EWS certificate
                 issued by Competent Authority</li>
       </ul>
     <p style="font-size: 13px; text-align: left;"> * Those who have appeared for the Final Year/Semester Degree Examination in April-May 2022 and not received the
        original/Provisional certificate must submit a declaration that they will produce the same before 30.08.2022</p>  
       
     <p style="font-size: 13px; text-align: left;">    The fees to be remitted at the time of admission are mentioned below.</p> <br> 
     <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                        <table border="1" class="table table-striped">
                            <tr>
                            <th>Fee Description</th>
                            <th>MA</th>
                            <th>MA - Dance / Theatre / Music</th>
                            <th>M.Sc</th>
                            <th>MPES</th>
                            <th>MSW</th>
                            <th>Museology</th>
                            <th>MFA</th>
                            <th>PG Diploma-Hindi</th>
                            <th>PG Diploma-Wellness & Spa Therapy</th>
                            <th>Re-marks</th>
                            </tr>
                            <tr>
                            <td>Admission fee</td>
                            <td>100</td>
                            <td>100</td>
                            <td>110</td>
                            <td>100</td>
                            <td>100</td>
                            <td>100</td>
                            <td>100</td>
                            <td>50</td>
                            <td>50</td>
                            <td>SC/ST/OEC exempted</td>

                            </tr>
                            <tr>
                            <td>Tuition fee(per annum)</td>
                            <td>1000</td>
                            <td>1000</td>
                            <td>1100</td>
                            <td>20000</td>
                            <td>6500</td>
                            <td>6500</td>
                            <td>15000</td>
                            <td>1000</td>
                            <td>30000</td>
                            <td>SC/ST/OEC exempted</td>
                            </tr>
                            <tr>
                            <td>Special fee(per annum)</td>
                            <td>800</td>
                            <td>1000</td>
                            <td>880</td>
                            <td>2000</td>
                            <td>1500</td>
                            <td>1500</td>
                            <td>2000</td>
                            <td>500</td>
                            <td>10000</td>
                            <td>SC/ST/OEC exempted</td>
                            </tr>
                            <tr>
                            <td>Caution deposit</td>
                            <td>500</td>
                            <td>500</td>
                            <td>550</td>
                            <td>500</td>
                            <td>500</td>
                            <td>500</td>
                            <td>500</td>
                            <td>300</td>
                            <td>500</td>
                            <td></td>
                            </tr>
                            <tr>
                            <td> Matriculation fee*</td>
                            <td>75</td>
                            <td>75</td>
                            <td>85</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>75</td>
                            <td>SC/ST/OEC exempted</td>
                            </tr>
                            <tr>
                            <td> Recognition fee**</td>
                            <td>100</td>
                            <td>100</td>
                            <td>110</td>
                            <td>100</td>
                            <td>100</td>
                            <td>100</td>
                            <td>100</td>
                            <td>100</td>
                            <td>100</td>
                            <td></td>
                            </tr>

                            <tr>
                            <td> Dept. Development Fee</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>250</td>
                            <td>SC/ST/OEC exempted</td>
                            </tr>
                            <tr>
                            <td>Exam Fee For First Semester</td>
                            <td>700</td>
                            <td>700</td>
                            <td>760</td>
                            <td>725</td>
                            <td>900</td>
                            <td>700</td>
                            <td>700</td>
                            <td>400</td>
                            <td>4000</td>
                            <td>SC/ST/OEC exempted</td>
                            </tr>
                            <tr>
                            <td>Uniform Fee</td>
                            <td>--</td>
                            <td>--</td>
                            <td>-- </td>
                            <td>2500</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>SC/ST/OEC exempted</td>
                            </tr>
                            <tr>
                            <td>PTA</td>
                            <td>750</td>
                            <td>750</td>
                            <td> 750</td>
                            <td>750</td>
                            <td>750</td>
                            <td>750</td>
                            <td>750</td>
                            <td>750</td>
                            <td>750</td>
                            <td></td>
                            </tr>
                            <tr>
                            <td> Silver Jubilee welfare fund for students</td>
                            <td>200</td>
                            <td>200</td>
                            <td> 200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td>200</td>
                            <td></td>
                            </tr>
                            <tr>
                            <td> Total Fee</td>
                            <td>4475</td>
                            <td>4675</td>
                            <td> 4795</td>
                            <td>27200</td>
                            <td>10875</td>
                            <td>10675</td>
                            <td>19675</td>
                            <td>3625</td>
                            <td>45925</td>
                            <td></td>
                            </tr>
                        </table>
          
                     </div>
                     </div>
     
 <p style="font-size: 13px; text-align: left;"> * Not applicable for candidates graduated from this University. </p> 
  <p style="font-size: 13px; text-align: left;"> ** For candidates of other Universities outside Kerala </p> 
  <p style="font-size: 13px; text-align: left;">
 1 .This Memo does not ensure a seat for you in the PG Programme, but provides a chance based on merit at the time of interview<br>

2. Candidates obtaining admission should also remit such amount prescribed, to the P.T.A.Fund<br>
3. Candidates who fail to bring fee or any of the original certificates mentioned above will have no claim for
admission<br>
4. Candidates who abstain from the admission in the prescribed time will have no claim for admission in future.<br>
5. Admission will be given for those who satisfy the eligibility criteria regarding the qualifying exam passed,
remittance of fee and eligibility for weightage of marks, on verification of certificates/marklists.<br>


6. For details of programmes offered at the Headquarters, Kalady and Regional Centres see the prospectus.<br>
7. For more information about the University visit www.ssus.ac.in<br>
8. The Candidates shall wear a mask throughout and shall strictly adhere to COVID 19 protocol issued by
the Government of Kerala. </p>
  <hr>
  
 
  
  <div class="col-md-12">
      
      
           <table>
               
                <tr>
                

                <td style="text-align: left;">Kalady</td>
                <td style="text-align: right;"><img  src="{{public_path('images/pvc.png')}}" width="110" height="70" alt="user"></td>
                </tr>

                <tr>
                <td  style="text-align: left;" >Date</td>
                <td style="text-align: right;font-size: 13px;" class="pull-right"><b>Pro Vice Chancellor</b></td>
                </tr>
            </table>
             
  </div>   
       
          <p style="font-size: 11px;"><i>Document generated on : {{$curnt_date}} {{$timenow}}</i></p>         

</body>
</html>