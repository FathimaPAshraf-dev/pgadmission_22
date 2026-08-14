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
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT, KALADY</b></center>
     <center><b style="font-size: 13px;font-family:arial, sans-serif;">Re-accredited by NAAC with A+ Grade</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-size: 14px;">
                     <u><b>ALLOTMENT MEMO FOR PG ADMISSION 2026</b></u> 
                 </p>
                 <br>
                 <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                        <table border="1" class="table table-striped">
                       

                         <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Application ID</th>
                            <th>Community</th>
                        </tr>
                        <tr>
                                  <td>
        @if(!empty(Auth::user()->pgapp_photo))
      <img  src="{{asset('images/pgphoto/'.Auth::user()->pgapp_photo)}}" width="120" height="150" alt="user">
        @endif
    </td>
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
                        <p style="font-size: 13px; text-align: center;"><b>Allotted Campus : </b>{{$key->allot_cent}}</p>
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
        <th width="40%">Name of the Programme</th>
        <th width="10%">Rank</th>
        <th width="50%">Admission Schedule</th>
    </tr>
                     
                        <tr>
                            <td style="text-align: center;">{{$key->pgm}}</td>
                            <td style="text-align: center;">{{$rankValue}} </td>
                            @if($key->app_allotment == 'First')
                             <td style="text-align: center;">22-06-2026 to 23-06-2026, between 10.30 AM to 3.30 PM</td>
                             <!--<td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>-->
                             @elseif($key->app_allotment == 'Second')
                                                      <td style="text-align:center; white-space: normal; word-wrap: break-word;">
                                               01-07-2026 to 03-07-2026,<br>
                                  between 10:30 AM to 03:30 PM
                                      </td>
                                       @elseif($key->app_allotment == 'Third')
                                                   @if($adscl == 1182)
        <td style="text-align:center; white-space: normal; word-wrap: break-word;">
            13-07-2026 to 15-07-2026,<br>
            between 10:30 AM to 03:30 PM
        </td>
    @else
        <td style="text-align:center; white-space: normal; word-wrap: break-word;">
            08-07-2026 to 09-07-2026,<br>
            between 10:30 AM to 03:30 PM
        </td>
    @endif
        
                             @elseif($key->app_allotment == 'THIRD')
                             @if($key->app_id == 'ADMPG2501616' || $key->app_id == 'ADMPG2503304' || $key->app_id == 'ADMPG2500016' || $key->app_id == 'ADMPG2501283'
                             || $key->app_id == 'ADMPG2502987' || $key->app_id == 'ADMPG2503567' || $key->app_id == 'ADMPG2500932' || $key->app_id == 'ADMPG2502304')
                             <td style="text-align:center; white-space: normal; word-wrap: break-word;">
    01-07-2026 to 03-07-2026,<br>
    between 10:30 AM to 03:30 PM
</td>
                             @else
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @endif
                              @elseif($key->app_allotment == 'FOURTH')
                             
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @elseif($key->app_allotment == 'FIFTH')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @elseif($key->app_allotment == 'SIXTH')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @elseif($key->app_allotment == 'SEVENTH')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @elseif($key->app_allotment == 'EIGHTH')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @elseif($key->app_allotment == 'NINTH')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             @elseif($key->app_allotment == 'SPOT')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                              @elseif($key->app_allotment == 'SPOT-II')
                             <td style="text-align: center;">{{$key->sh_date5}}, between {{$key->sh_time5}}  </td>
                             @elseif($key->app_allotment == 'SPECIAL')
                             <td style="text-align: center;">{{$key->memodate}}, between {{$key->memotime}}  </td>
                             
                             @endif
                           
                        </tr>
                      
                        </table>
          
                     </div>
                     </div>
            @endforeach
                 
               <div class="col-sm-12">
    <div class="card-body table-responsive" >
     @if($adscl!=1041 || $adscl!=1054 || $adscl!=1063 || $adscl!=1064)
       @foreach($allotment as $key) 
       @if($key->app_allotment=='FIRST')
       <p style="font-size: 13px; text-align: left;">  The provisional rank list for the selection of candidates to various P.G Programme in Sree Sankaracharya
University of Sanskrit during this year has already been published. Now the University has decided to conduct
admission for P.G programmes offered at {{$key->allot_cent}} </p>  
       
       @else
       <p style="font-size: 13px; text-align: left;">  The provisional rank list for the selection of candidates to various P.G Programme in Sree Sankaracharya
University of Sanskrit during this year has already been published. Now the University has decided to conduct
admission for P.G programmes offered at Main Campus and Regional Campuses. </p>  
       @endif
       @endforeach
       
       @endif  
   <p style="font-size: 13px; text-align: left;"> You are hereby directed to report at the above campus at the prescribed date and time, for completing the admission
process. </p>          
    </div> 
</div>
       <p style="font-size: 13px; text-align: left;"> 
           The following original documents are to be produced at the time of Interview</p>
       <ul>
           <li> Allotment Memo</li>
           <li> SSLC Certificate</li>
           <li> Provisional/Original degree certificate.(Those who have appeared for the Final Year/Semester Degree Examination in April-May 2026 and not received the
        original/Provisional certificate must submit original Mark/Grade Sheets of I to IV semesters(I to VI semesters for 4 year degree programme))</li>
           <li>Mark List of qualifying degree examination.</li>
           <li>Transfer Certificate</li>
           <li> Conduct Certificate</li>
           <li> Disability Certificate in the case of Physically Handicapped Candidates</li>
           <li>Non creamy layer Certificate (In the case of OBC/OEC Candidates)</li>
           
           <li>Caste/Community Certificate/SSLC Certificate (In the case of SC/ST/OEC/OBC(H) candidates)</li>
           <li>Migration Certificates for those who studied in other Universities.</li>
           <li> Eligibility certificate (applicable to those who have not undergone 10+2+3 pattern)/and those who have passed &nbsp;
                the Degree course from Universities outside Kerala).</li>
           <li> Candidates eligible for reservation of EWS among forward caste should produce EWS certificate
                 issued by Competent Authority</li>
        <li> Matriculation Fee is applicable to students who have studied in other universities within Kerala,
             while Recognition Fee is applicable to students who have studied in universities outside Kerala</li>
       </ul>
     @foreach($allotment as $key) 
       @if($key->app_allotment=='CENTRE TRANSFER (SHORTFALL)')  
       <p style="font-size: 13px; text-align: left;"> * Those who have appeared for the Final Year/Semester Degree Examination in April-May 2026 and not received the
        original/Provisional certificate must submit a declaration that they will produce the same before 31.10.2026</p>  
      @else
<!--        <p style="font-size: 13px; text-align: left;"> * Those who have appeared for the Final Year/Semester Degree Examination in April-May 2026 and not received the
        original/Provisional certificate must submit a declaration that they will produce the same before 30.08.2026</p>  -->
        
         <p style="font-size: 13px; text-align: left;"> * Those who have appeared for the Final Year/Semester Degree Examination in April-May 2026 and not received the
        original/Provisional certificate must submit a declaration that they will produce the same before 31.08.2026</p> 
       @endif
       @endforeach
     <p style="font-size: 13px; text-align: left;">    The fees to be remitted at the time of admission are mentioned below.</p>
     <br><br>

<div class="col-sm-12">
    <div class="card-body table-responsive">

        <h4 style="text-align:center; font-weight:bold; margin-bottom:15px;">
            {{ $courseName }}
        </h4>

        <table border="1" class="table table-striped">
            <tr>
                <th>Fee Description</th>
                <th>Fee</th>
              <th>Fee For SC / ST / OEC Category </th>
            </tr>

            @foreach($fee as $key)
            <tr>
                <td>{{ $key->fee_title }}</td>
                <td style="text-align:center;">{{ $key->fee_gen }}</td>
                       <td style="text-align:center;">{{ $key->fee_scstoec }}</td>
            </tr>
            @endforeach

        </table>

    </div>
</div>
 
  
  <p style="font-size: 13px; text-align: left;">
      <!--<b>Note:Those who are eligible for e- grants [SC/ST/OEC/OBC(H)] need to pay only the Caution Deposit, PTA, and Silver Jubilee Welfare Fund  at the time of admission.</b> <br>-->   
 1 .This Memo does not ensure a seat for you in the PG Programme, but provides a chance based on merit at the time of interview.
       @foreach($allotment as $key) 
       @if($key->app_allotment=='SIXTH')
         If, after the candidates have exercised their option facility, five students are not available for Sanskrit Programmes and ten students are not available for non Sanskrit Programmes at a particular campus, then those particular Programmes will not be offered at those Campuses.Students who have opted for those campuses will be offered admission in nearby/other campus.


       @endif
       @endforeach
 <br>

2. Candidates obtaining admission should also remit such amount prescribed, to the P.T.A.Fund<br>
3. Candidates who fail to bring fee or any of the original certificates mentioned above will have no claim for
admission<br>
4. Candidates who abstain from the admission in the prescribed time will have no claim for admission in future.<br>
5. Admission will be given for those who satisfy the eligibility criteria regarding the qualifying exam passed,
remittance of fee and eligibility for weightage of marks, on verification of certificates/marklists.<br>
<!--@if($adscl==998)

6. For details of programmes offered at the Headquarters, Kalady see the prospectus.<br>

@else
6. For details of programmes offered at the Headquarters, Kalady and Regional Campuses see the prospectus.<br>

@endif-->
6. For more information about the University visit www.ssus.ac.in<br>
 </p>
  <hr>
  
 
  
  <div class="col-md-12">
      
      
           <table>
               
                <tr>
                

                <td style="text-align: left;">Kalady</td>
                <!--<td style="text-align: right;"><img  src="{{public_path('images/pvc.png')}}" width="110" height="70" alt="user"></td>-->
                <td style="text-align: right;">sd/-</td>
                </tr>

                <tr>
                <td  style="text-align: left;" ></td>
                <td style="text-align: right;font-size: 13px;" class="pull-right"><b>Professor I/C of Examination</b></td>
                </tr>
            </table>
             
  </div>   
       
          <p style="font-size: 11px;"><i>Document generated on : {{$curnt_date}} {{$timenow}}</i></p>         

</body>
</html>