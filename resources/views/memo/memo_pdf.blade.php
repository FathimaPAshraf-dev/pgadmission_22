<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 13px;
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

     <center><img src="{{asset('storage/redemb.jpg')}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

   
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 14px;">
                     <u><b>INTERVIEW MEMO FOR ADMISSION TO M.PHIL PROGRAM 2020-21 </b></u> 
                 </p>
                 <br>
                 <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                        <table border="1" class="table table-striped">
                         @foreach($postpgapp as $key) 

                         <tr>
                            <th>To,</th>
                            <th>Application ID</th>
                            <th>Community</th>
                        </tr>
                        <tr>
                        <td>{{Auth::user()->postpgapp_studname}}<br>
                        {{Auth::user()->comm_addressline1}}<br>
                        {{Auth::user()->comm_addressline2}}<br>
                        {{Auth::user()->comm_addressline3}}</td>
                        
                        <td style="text-align: center;">{{Auth::user()->postpgapp_appid}} </td>
                        <td style="text-align: center;">{{Auth::user()->postpgapp_community}}</td>
                        </tr>
                        

                         @endforeach

                        </table>
          
                     </div>
                     </div>
                 <?php foreach ($category as $key) {
                            $allot_category = $key->allot_category;
                            //return $allot_category;
                            $allot_cent = $key->allot_cent;
                            $allotment= $key->allotment;
                        }  ?>
                 <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
        <p style="font-size: 13px; text-align: center;"><b>Interview Venue : {{$allot_cent}}</b></p>
        <p style="font-size: 13px; text-align: center;"><b>Alloted Centre :{{$allot_cent}}</b></p>
        <p style="font-size: 13px; text-align: center;"><b>Alloted Category :{{$allot_category}} </b></p>
        <p style="font-size: 13px; text-align: center;"><b>Allotment: {{$allotment}}</b></p>
  @if($allotment=='SECOND' ||  $allotment=='RE-FIRST')
      <p style="font-size: 13px;"><b>You are directed to appear before the Head of the Department concerned and take admission immediately.</b></p>  
    @endif
    </div>
                     </div>
                 <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                        <table border="1" class="table table-striped">
                         
                         <tr>
                            <th>Name of the Program </th>
                            
                               <th>Rank</th>
                           
                             @if($allotment=='FIRST')
                            <th>Date&Time</th>
                            @endif
                        </tr>
                        

                           @foreach ($postpgapp as $key)
                  
                            <tr>
                                <td style="text-align: center;">{{$key->pgm_name}}</td>
                               
                                <td style="text-align: center;">{{$key->rank}} </td>
                              
                                @if($allotment=='FIRST')
                                <td style="text-align: center;">04/12/2020 10:00 AM</td>
                                  @endif
                            </tr>
                            @endforeach
                          
                            
                        </table>
          
                     </div>
                     </div>
               <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
       <p style="font-size: 13px; text-align: left;">The provisional rank list for the selection of candidates to various M.Phil Program in
Sree Sankaracharya University of Sanskrit during this year has already been published. Now the University
has decided to conduct admission for M.Phil Program offered at Main Centre and Regional Centres.
You are hereby directed to report before the Head of the Department / Co-ordinator concerned at the above centre at the prescribed date and time, for completing the
admission process. </p>    
             
    </div> 
</div>
  <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
       <p style="font-size: 13px; text-align: left;"> 
           The following orginal documents are to be produced at the time of Interview</p>

       <ul>
           <li> Interview Memo</li>
           <li> SSLC Book</li>
           <li> Provisional/Original degree certificate.</li>
           <li>Mark List of qualifying degree examination.</li>
           <li>Transfer Certificate</li>
           <li> Conduct Certificate</li>
           <li> Disability Certificate in the case of Physically Handicapped Candidates</li>
           <li>Non creamy layer certificate (In the case of OBC Candidates)</li>
           <li>Income Certificate (In the case of OEC Candidates)</li>
           
           <li>Caste/Community Certificate (In the case of SC/ST/OBC/OEC candidates)</li>
           <li>Migration Certificates for those who studied in other Universities.</li>
           <li>Eligibility certificate (applicable to those who have not undergone 10+2+3 pattern)/and those who have
passed the Degree course from Universities outside Kerala).</li>
           <li>Candidates eligible for reservation of EWS among forward caste should produce EWS certificate issued 
by Competent Authority</li>
       </ul>
       @if($allotment=='FIRST')
       <p style="font-size: 13px; text-align: left;"> 

*Those who have appeared for the Final year/Semester Degree Examination and not received the
Marklist/Provisional certificate must submit a declaration that they will produce the same before 30.12.2020     </p> 
       @endif
        @if($allotment=='SECOND')
       <p style="font-size: 13px; text-align: left;"> 

*Those who have appeared for the Final year/Semester Degree Examination and not received the
Marklist/Provisional certificate must submit a declaration that they will produce the same before 15.01.2021    </p> 
       @endif
       <br><br>     
       
    <p style="font-size: 13px; text-align: left;">    The fees to be remitted at the time of admission are mentioned below.</p>  
     <div class="col-sm-12">
                     <div class="card-body table-responsive" >
                        <table border="1" class="table table-striped">
                         
                         <tr>
                            <th   style="text-align: left;">Application fee </th>
                            <td>Rs.50/-</td>
                        </tr>
                        <tr>
                            <th  style="text-align: left;">Admission fee </th>
                            <td>Rs.50/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Special fee </th>
                            <td>Rs.3000/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Tuition fee </th>
                            <td>Rs.1000/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Caution deposit </th>
                            <td>Rs.1000/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Department Development Fund </th>
                            <td>Rs.250/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Matriculation Fee </th>
                            <td>Rs.75/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Recognition (Candidates from outside Kerala) </th>
                            <td>Rs.100/-</td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Library Fee (Per Annum)</th>
                            <td>Rs.500/-</td>
                        </tr>
                         <tr>
                            <th style="text-align: left;">Dessertation Fee</th>
                            <td>Rs.500/-</td>
                        </tr>
                         <tr>
                            <th style="text-align: left;">M.Phil Ist Semester Examination Fee</th>
                            <td>Rs.400/-</td>
                        </tr>
                        </table>
          
                     </div>
                     </div>
  
    <br>
    <br>
  <div class="col-md-12">
           <table>
                        <tr>
                        <td>Kalady</td>
                        <td style="text-align: right;">Sd/-</td>
                        </tr>
                      
                        <tr>
                        <td>Date</td>
                        <td style="text-align: right;font-size: 13px;" class="pull-right"><b>Registrar</b></td>
                        </tr>
            </table>
             
  </div>   
       
          <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>         

</body>
</html>