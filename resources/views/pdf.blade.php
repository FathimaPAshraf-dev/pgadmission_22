<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
    }
    td,th{
        font-size: 12px;
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
                     <u><b>PG Admission 2021 Online Application</b></u> 
                 </p>
          <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
                  <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Personal Information</b></p>
                 
            <table border="1" style="border:1px solid black; border-collapse:collapse;">
                @foreach($pgapp as $pg) 
            <tr> 
            <td width="30%">Stream in which you are applied for</td>
            <td width="60%">{{$pg->adsc_name}}</td>
            <td rowspan="8"> <img  src="{{asset('images/pgphoto/'.Auth::user()->pgapp_photo)}}" width="130" height="160" alt="user"> </td>
            </tr>
            <tr>
            <td>Application Number</td>
            <td><b>{{Auth::user()->pgapp_id}} </b></td>
            </tr>
            <tr>
            <td>Name of Applicant</td>
            <td><b>{{Auth::user()->pgapp_name}} </b></td>
            </tr>
            <tr>    
            <td>Date Of Birth</td>
            <td>{{date('d-m-Y', strtotime(Auth::user()->pgapp_dob))}}</td>
            </tr>   
            <tr>
            <td>Gender </td>
            
                <td>{{$pg->gender_name}} </td>
            
            </tr>
             <tr>    
            <td>SSLC register number</td>
            <td>{{Auth::user()->sslc_regno}}</td>
            </tr> 
            <tr>    
            <td>Aadhaar number</td>
            <td>{{Auth::user()->pgapp_adhar}}</td>
            </tr> 
            <tr>
            <td>Nationality </td>
            
                <td>{{Auth::user()->pgapp_nationality}} </td>
              
            </tr>
            <tr>
            <td>Religion  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_religion}} </td>
            
            </tr>
            <tr>
            <td>Community  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_community}} </td>
            
            </tr>
            <tr>
            <td>Caste   </td>
            
                <td colspan="2">{{Auth::user()->subcaste_table->subcaste}}</td>
            
            </tr>
            @endforeach
            <tr>
            <td>Name of Guardian  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_father}} </td>
            
            </tr>
            <tr>
            <td>House Name   </td>
            
                <td colspan="2">{{Auth::user()->comm_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Place / Street Name   </td>
            
                <td  colspan="2">{{Auth::user()->comm_addressline2}} </td>
            
            </tr>
            <tr>
            <td>Postoffice  </td>
            
                <td colspan="2">{{Auth::user()->comm_addressline3}} </td>
            
            </tr>
            <tr>
            <td>Permanent House Name   </td>
            
                <td colspan="2">{{Auth::user()->per_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Place/Street Name  </td>
            
                <td colspan="2">{{Auth::user()->per_addressline2}} </td>
            
            </tr>
            <tr>
                <td>Post Office  </td>
            
                <td  colspan="2">{{Auth::user()->per_addressline3}} </td>
            
            </tr>
             <tr>
            <td>State    </td>
            
                <td colspan="2">{{Auth::user()->pgapp_state}} </td>
            
            </tr>
             <tr>
            <td>District  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_district}} </td>
            
            </tr>
            <tr>
            <td>Pin Code  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_pincode}} </td>
            
            </tr>
            <tr>
            <td>Mobile Number   </td>
            
                <td colspan="2">{{Auth::user()->pgapp_mobile}} </td>
            
            </tr>
            <tr>
            <td>Alternate Mobile Number  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_landphone}} </td>
            
            </tr>
            <tr>
            <td>E-mail ID  </td>
            
                <td colspan="2">{{Auth::user()->pgapp_email}} </td>
            
            </tr>

           </table>
             
             
    </div> 
</div>
   <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Educational Qualifications</b></p>
    <table border="1" class="tb_quali">
                                @foreach($pgapp as $key)
                                <tr>
                                    <th>UG Result awaiting</th>
                                   
                                    
                                                              
                                </tr>
                                  <tr>
                                    @if($key->ugcourse_status==1)
                                    <td style="text-aline:center">Yes</td>
                                    @else
                                        <td style="text-aline:center">No</td>

                                    @endif

                                                              
                                </tr>
                                 @endforeach
                </table>
    <br>
    @if($pgquali->isEmpty())
                        <table border="1" class="table table-bordered table-striped">
                               
                                <tr>
                                <th>Exam</th>
                                <th>College/Institute</th>
                                <th>University</th>
                                <th>Main/Core Subjects</th>
                                <th>Year</th>
                                <th>Grade & Grade Point/Percentage of marks</th>
                                </tr>
                            <tr>
                                <td>Nil</td>
                                <td>Nil</td>
                                 <td>Nil</td>
                                  <td>Nil</td>
                                   <td>Nil</td>
                                    <td>Nil</td>
                                   
                            </tr>
                            
                        </table>
                        @else
                            <table border="1" style="border:1px solid black; border-collapse:collapse;" class="tb_quali">
                                <tr>
                                <th>Exam</th>
                                <th>College/Institute</th>
                                <th>University</th>
                                <th>Main/Core Subjects</th>
                                <th>Year</th>
                                <th>Grade & Grade Point/Percentage of marks</th>
                                </tr>
                            @foreach($pgquali as $key)
                            <tr>
                                <td>{{$key->pgquali_exam}}</td>
                                <td>{{$key->pgquali_institute}}</td>
                                <td>{{$key->pgquali_university}}</td>
                                <td>{{$key->pgquali_subject}}</td>
                                <td>{{$key->pgquali_year}}</td>
                                 <td>{{$key->pgquali_grade}}</td>
                                 
                            </tr>
                            @endforeach

                        </table>
    @endif                    
                        </div>
                       
                  
                </div>           
                 
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Other Information</b></p>
@foreach($pgotherinfo as $key)
            <table border="1" style="border:1px solid black; border-collapse:collapse;">
            <tr>
            <td width="30%">Whether eligible for PH Reservation </td>
            @if( $key->ph_status== '1')
            <td width="60%">Yes</td>
            @else
            <td width="60%">No</td>
            @endif
             </tr>
              @if( $key->ph_status== '1')
             <tr> 
            <td width="30%">Differently abled Type </td>
            @if( $key->ph_type== '1')
            <td width="60%">Visually Challenged</td>
            @else
            <td width="60%">Other PH</td>
            @endif
             </tr>
             
              @endif
           <tr>
               <td width="30%">Whether eligible for Special Reservation<br>(NCC/NSS/ARTS/SPORTS) </td>
            @if( $key->pgapp_wh_special_reserv== '1')
            <td width="60%">Yes</td>
            @else
            <td width="60%">No</td>
            @endif
             </tr>
            <tr>
               <td width="30%">Annual Income of Family </td>
           
            @if( $key->pgapp_inc_sl== '51')
            <td width="60%">Below 600000</td>
            @elseif($key->pgapp_inc_sl== '52')
            <td width="60%">Below 800000</td>
            @elseif($key->pgapp_inc_sl== '53')
            <td width="60%">Above 800000</td>
            @elseif($key->pgapp_inc_sl== '45')
            <td width="60%">Upto 22000</td>
            @elseif($key->pgapp_inc_sl== '46')
            <td width="60%">22001 - 36000</td>
            @elseif($key->pgapp_inc_sl== '48')
            <td width="60%">36001 - 42000</td>
            @elseif($key->pgapp_inc_sl== '49')
            <td width="60%">42001 - 450000</td>
            @elseif($key->pgapp_inc_sl== '50')
            <td width="60%">Above 450001</td>
            @else
            <td width="60%">NA</td>
            @endif
        
             </tr>

       
        
             
           
           
           </table>
 @endforeach            
    </div> 
</div>   
                 
    <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Study Centres</b></p>
@foreach($pgoptions as $key)
            <table border="1" style="border:1px solid black; border-collapse:collapse;">
                
                <tr>
            <td width="30%">{{$key->pg_option}} </td>
            <td width="30%">{{$key->centre_name}} </td>
            
                </tr>

            
         
           </table> 
 @endforeach            
    </div> 
</div>   
  <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Entrance Examination Centre</b></p>
@foreach($pgapp as $key1)
  
            <table border="1" style="border:1px solid black; border-collapse:collapse;">
                
                <tr>
            <td width="30%">Exam Centre </td>
            @if( $key1->pgapp_exam_centre== '23') 
            <td width="30%">MAIN CENTRE KALADY </td>
            @elseif($key1->pgapp_exam_centre== '20')
            <td width="30%">REGIONAL CAMPUS, KOYILANDY  </td>
            @elseif($key1->pgapp_exam_centre== '21')
            <td width="30%">REGIONAL CAMPUS, TIRUR  </td>
             @elseif($key1->pgapp_exam_centre== '22')
            <td width="30%">REGIONAL CAMPUS, THURAVOOR  </td>
             @elseif($key1->pgapp_exam_centre== '19')
            <td width="30%">REGIONAL CAMPUS, THIRUVANATHAPURAM  </td>
             @elseif($key1->pgapp_exam_centre== '16')
            <td width="30%">REGIONAL CAMPUS, ETTUMANOOR  </td>
               @elseif($key1->pgapp_exam_centre== '15')
            <td width="30%">REGIONAL CAMPUS, PAYYANNUR  </td>
             @elseif($key1->pgapp_exam_centre== '18')
            <td width="30%">REGIONAL CAMPUS, PANMANA  </td>
                </tr>

            @endif
         
           </table>       
 @endforeach 
    </div> 
</div>                
                 
                 
                 
                 
                 
    <p style=" font-family: arial, sans-serif;font-weight:bold;font-size: 13px;">Payment Details</p>          
  <table class="" border="1">
 
 
    <tr>
        <td>Mode of Payment</td>
         <td>Online</td>
    </tr>
    @foreach($pgapp as $pg) 
    <tr>
       <td>Application Number</td>
     
         <td>{{$pg->pgapp_id}}</td>
    </tr>
     <tr>
       <td>University Transaction id</td>
     
         <td>{{$pg->merchanttxnid}}</td>
    </tr>
    <tr>
       <td>University Service name</td>
     
         <td>{{$pg->ucity_service}}</td>
    </tr>
    <tr>
        <td>Bank Name</td>
        <td>{{$pg->res_bankname}}</td>
    </tr>
      <tr>
             <td>Date of payment</td>
<td>{{$pg->res_txn_date}}</td>
      </tr>
    <tr>
       <td>Bank Reference No</td>
      <td>{{$pg->res_bid}}</td>
    </tr>
       
       
    <tr>
        
        <td>Pay Amount</td>
        
         <td>{{$pg->trans_amt}}</td>
    </tr>
    <tr>
        
        <td>Payment Status</td>
        
         <td>{{$pg->res_verified}}</td>
    </tr>
        
     
        @endforeach
     
   
    
    
 
</table>         
  <div class="col-md-12">
          <p style=" font-family: arial, sans-serif;font-weight:bold;font-size: 13px;">Declaration</p>          

              <p  style=" font-family: arial, sans-serif;font-size: 12px; text-align:justify">
                  I hereby declare that all the statements made in this application are complete, true and correct to the best of my knowledge and belief. I understand and agree that in the event of any information being found to be false or incorrect or concealed or misstated, at any stage or if I am found not eligible to be admitted to the program, according to the requirements as given in the original notification or University/UGC regulations, my candidature for the program applied is liable to be rejected and if already admitted, the said admission will be cancelled/revoked.
              </p>
             
  </div>   <br>
    <table>
                        <tr>
                        <td>Place :</td>
                        
                        </tr>
                        <tr>
                        <td>Date :</td>
                        <td style="text-align: right">Signature of the Candidate</td>
                        </tr>
                    </table>
           
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>    
</body>
</html>