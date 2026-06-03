<html>
<head>
<style>
      
    body{
        font-family: arial, sans-serif;
        font-size: 17px;
        padding: 2px;
    }
    td,th{
        font-size: 12px;
         padding: 3px;
    }
    
    table,p {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:white;
    
    }
    table#tb_quali td,th{
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
@foreach($pgapp as $pg) 
 <?php  
   $sign=$pg->pgapp_sign;
 ?>
@endforeach
     <center><img src="{{public_path("storage/redemb.jpg")}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>

        @if($payment_success->tdate>'2022-07-11')
                
                 <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
                     <u><b>PG ADMISSION SC/ST RE-NOTIFICATION ONLINE APPLICATION PRINTOUT</b></u> 
                 </p>
        @else
                <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
                     <u><b>PG ADMISSION ONLINE APPLICATION PRINTOUT</b></u> 
                 </p>
        @endif
         <p style="text-align: left;  font-family: arial, sans-serif;font-size: 12px;"><b>Personal Information</b></p>
                 
            <table class="table table-bordered table-hover" border="1">
            @foreach($pgapp as $pg) 
            <tr> 
            <td width="40%">Program which you are applied for</td>
            <td width="50%">{{$pg->adsc_name}}</td>
            <td rowspan="7"> <img  src="{{public_path("images/pgphoto/".$pg->pgapp_photo)}}" width="130" height="150" alt="user"> </td>
            </tr>
            <tr>
            <td>Application Number</td>
            <td><b>{{$pg->pgapp_id}} </b></td>
            </tr>
            <tr>
            <td>Name of Applicant</td>
            <td><b>{{$pg->pgapp_name}} </b></td>
            </tr>
            <tr>    
            <td>Date Of Birth</td>
            <td>{{date('d-m-Y', strtotime($pg->pgapp_dob))}}</td>
            </tr> 
           
            <tr>
            <td>Gender </td>
            
                <td>{{$pg->gender_name}} </td>
            
            </tr>
             <tr>    
            <td>SSLC register number</td>
            <td >{{$pg->sslc_regno}}</td>
            </tr> 
            <tr>    
            <td>Aadhaar number</td>
            <td >{{$pg->pgapp_adhar}}</td>
            </tr> 
            <tr>
            <td>Nationality </td>
            
                <td colspan="2">{{$pg->pgapp_nationality}} </td>
              
            </tr>
            <tr>
            <td>Religion  </td>
            
                <td colspan="2">{{$pg->pgapp_religion}} </td>
            
            </tr>
            <tr>
            <td>Community  </td>
            
                <td colspan="2">{{$pg->pgapp_community}} </td>
            
            </tr>
            <tr>
            <td>Caste   </td>
            
                <td colspan="2">{{$pg->subcaste}}</td>
            
            </tr>
          
            <tr>
            <td>Name of Guardian  </td>
            
                <td colspan="2">{{$pg->pgapp_father}} </td>
            
            </tr>
            <tr>
            <td>Communication address: House Name  </td>
            
                <td colspan="2">{{$pg->comm_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Communication address: Place / Street Name  </td>
            
                <td  colspan="2">{{$pg->comm_addressline2}} </td>
            
            </tr>
            <tr>
            <td>Communication address: Post Office   </td>
            
                <td colspan="2">{{$pg->comm_addressline3}} </td>
            
            </tr>
            <tr>
            <td>Permanent address: House Name   </td>
            
                <td colspan="2">{{$pg->per_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Permanent address: Place/Street Name  </td>
            
                <td colspan="2">{{$pg->per_addressline2}} </td>
            
            </tr>
            <tr>
                <td>Permanent address: Post Office  </td>
            
                <td  colspan="2">{{$pg->per_addressline3}} </td>
            
            </tr>
             <tr>
            <td>State    </td>
            
                <td colspan="2">{{$pg->pgapp_state}} </td>
            
            </tr>
             <tr>
            <td>District  </td>
            
                <td colspan="2">{{$pg->pgapp_district}} </td>
            
            </tr>
            <tr>
            <td>Pin Code  </td>
            
                <td colspan="2">{{$pg->pgapp_pincode}} </td>
            
            </tr>
            <tr>
            <td>Mobile Number   </td>
            
                <td colspan="2">{{$pg->pgapp_mobile}} </td>
            
            </tr>
            <tr>
            <td>Alternate Mobile Number  </td>
            
                <td colspan="2">{{$pg->pgapp_landphone}} </td>
            
            </tr>
            <tr>
            <td>E-mail ID  </td>
            
                <td colspan="2">{{$pg->pgapp_email}} </td>
            
            </tr>
         @endforeach
           </table>
        
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-size: 12px;"><b>Educational Qualifications</b></p>

      <p style="text-align: left;  font-family: arial, sans-serif;font-size: 12px;"><b>SSLC Details</b></p>

      <table class="table table-bordered table-hover" border="1" id="tb_quali">
            <tr>
            <th>SSLC Register No</th>
            <th>Percentage</th>
            </tr>
           
            @foreach($pgquali as $key)
            <tr>
                <td>{{$key->sslc_regno}}</td>
                <td>{{$key->sslc_mark}}</td>
              
            </tr>
            @endforeach
            </table>
  
          <p style="text-align: left;  font-family: arial, sans-serif;font-size: 12px;"><b>Degree Details</b></p>

          <table class="table table-bordered table-hover" border="1" id="tb_quali">
            <tr>
             <th>Register Number</th>
            <th>College/Institute</th>
            <th>University</th>
            <th>Course</th>
            <th>Main Subject</th>
              <th>Course Type</th>

            <th>Period of study</th>
            <!--<th>Duration of course </th>-->
            <th> Aggregate percentage / CGPA </th>
             <th>UG Result awaiting</th>
            </tr>
            @if($pgquali->isEmpty())        
            <tr>
               <td>Nil</td>
                <td>Nil</td>
                 <td>Nil</td>
                 <td>Nil</td>
                  <td>Nil</td>
                    <td>Nil</td>
                   <!--<td>Nil</td>-->
                    <td>Nil</td>
                    <td>Nil</td>
                    <td>Nil</td>
                  
            </tr>
            @else  
            @foreach($pgquali as $key)
            <?php $endyr=$key->pgquali_year+$key->courseduration;?>
            <tr>
                <td>{{$key->regnodegree}}</td>
                <td>{{$key->pgquali_institute}}</td>
                <td>{{$key->pgquali_university}}</td>
                <td>{{$key->pgquali_exam}}</td>
                <td>{{$key->pgquali_subject}}</td>
                 <td>{{$key->coursetype}}</td>

                <td>{{$key->pgquali_year}} - {{$key->pgquali_endyear}}</td>
                 <!--<td>{{$key->courseduration}}</td>-->
                  <td>{{$key->degree_aggregate}}</td>
                  @if($key->ugcourse_status==1)
                  <td>Yes</td>
                @else
                <td>No</td>
                @endif
            </tr>
            @endforeach
            @endif
            </table>
 
          <p style="text-align: left;  font-family: arial, sans-serif;font-size: 12px;"><b>Degree Mark Details</b></p>

          <table class="table table-bordered table-hover" border="1" id="tb_quali">
            <tr>
             @foreach($semester_grades as $key=>$value)    
           
             <th>SGPA / Percentage of {{$name}} {{$key}} </th>
            @endforeach

            </tr>
         
            <tr>
             @foreach($semester_grades as $key=>$value)    

                <td>{{$value}}</td>
                
              @endforeach

            </tr>
            
          
            </table>

           

     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 12px;"><b>Other Information</b></p>

            <table class="table table-bordered table-hover" border="1" id="tb_quali">
         @foreach($pgotherinfo as $key)       
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
            <td width="60%">Other differently abled </td>
            @endif
             </tr>
              @endif
            
            <tr>
            <td width="30%">Whether eligible for Special Reservation (NCC/NSS/SPORTS/ARTS)</td>
            @if( $key->pgapp_wh_special_reserv== '1')
            <td width="60%">Yes</td>
              
            @else
            <td width="60%">No</td>
            @endif
             </tr>
              
            <tr>
            <td width="30%">Annual Income Of family </td>
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
            @endforeach   
            
            @foreach($pgapp as $key1)
            <tr>
            <td width="30%">Entrance Examination Centre </td>
            
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
            @endforeach
           </table>
                     
                 
    <p style=" font-family: arial, sans-serif;font-weight:bold;font-size: 12px;">Payment Details</p>          
  <table class="" border="1" id="tb_quali">
 
 
    <tr>
        <td>Mode of Payment</td>
         <td>Online</td>
    </tr>
   
    <tr>
       <td>Application Number</td>
     
         <td>{{$payment_success->client_code}}</td>
    </tr>
     <tr>
       <td>University Transaction id</td>
     
         <td>{{$payment_success->merchanttxnid}}</td>
    </tr>
    <tr>
       <td>University Service name</td>
     
         <td>{{$payment_success->ucity_service}}</td>
    </tr>
    <tr>
        <td>Bank Name</td>
        <td>{{$payment_success->res_bankname}}</td>
    </tr>
      <tr>
             <td>Date of payment</td>
<td>{{$payment_success->res_txn_date}}</td>
      </tr>
    <tr>
       <td>Bank Reference No</td>
      <td>{{$payment_success->res_bid}}</td>
    </tr>
       
       
    <tr>
        
        <td>Pay Amount</td>
        
         <td>{{$payment_success->trans_amt}}</td>
    </tr>
    <tr>
        
        <td>Payment Status</td>
        
         <td>{{$payment_success->res_verified}}</td>
    </tr>
        
     
        
     
</table>         
 
          <p style=" font-family: arial, sans-serif;font-weight:bold;font-size: 13px;">Declaration</p>          

              <p  style=" font-family: arial, sans-serif;font-size: 12px; text-align:justify">
                  I hereby declare that all the statements made in this application are complete, true and correct to the best of my knowledge and belief. I understand and agree that in the event of any information being found to be false or incorrect or concealed or misstated, at any stage or if I am found not eligible to be admitted to the program, according to the requirements as given in the original notification or University/UGC regulations, my candidature for the program applied is liable to be rejected and if already admitted, the said admission will be cancelled/revoked.
              </p>
    
        <table>
            <tr>
            <td>Place :</td>
            <td style="text-align: right"><img  src="{{public_path("images/pgsign/".$sign)}}" width="140" height="90" alt="signature"></td>
            </tr>
            <tr>
                <td style="padding-top:-25px;">Date :</td>

            <td style="text-align: right">Signature of the Candidate</td>
            </tr>
        </table>
           
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>    
</body>
</html>