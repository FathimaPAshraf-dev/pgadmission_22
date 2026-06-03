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

     <center><img src="{{public_path("storage/redemb.jpg")}}" alt="Logo" width="110" height="90" class="center"></center>
   
    <center> <b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></center>
    <center><p style="font-size: 13px;">Kalady Post,Ernakulam(Dist)&nbsp;&nbsp;Kerala-683574&nbsp;&nbsp;Fax:0484-2463380<br>
            Tel:0484-2463380&nbsp;&nbsp;email:reg@ssus.ac.in</p></center>
    
     @if(Auth::user()->pgapp_adsc_sl==997 && Auth::user()->pgapp_sl>59865)
            <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
                 <u><b>PG ADMISSION ONLINE APPLICATION PRINTOUT (PROJECT MODE) RE-NOTIFICATION</b></u> 
             </p>
    @elseif(Auth::user()->pgapp_adsc_sl==993)
            <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
                 <u><b>PG ADMISSION ONLINE APPLICATION PRINTOUT </b></u> 
             </p>          
    @elseif(Auth::user()->pgapp_adsc_sl<997 && Auth::user()->pgapp_sl>59894)
            <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
                 <u><b>PG ADMISSION SC/ST RE-NOTIFICATION ONLINE APPLICATION PRINTOUT </b></u> 
             </p>           
    @elseif(Auth::user()->pgapp_adsc_sl==996 || Auth::user()->pgapp_adsc_sl==997 ||Auth::user()->pgapp_adsc_sl==998)
            <p style="text-align: center;  font-family: arial, sans-serif;font-size: 13px;">
                 <u><b>PG ADMISSION ONLINE APPLICATION PRINTOUT (PROJECT MODE)</b></u> 
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
            <td rowspan="8"> <img  src="{{public_path("images/pgphoto/".Auth::user()->pgapp_photo)}}" width="130" height="150" alt="user"> </td>
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
            <td>SSLC/10th register number</td>
            <td >{{Auth::user()->sslc_regno}}</td>
            </tr> 
            <tr>    
            <td>Aadhaar number</td>
            <td >{{Auth::user()->pgapp_adhar}}</td>
            </tr> 
            <tr>    
            <td>ABC ID</td>
            <td >{{Auth::user()->pgapp_abcid}}</td>
            </tr> 
            <tr>
            <td>Nationality </td>
            
                <td colspan="2">{{Auth::user()->pgapp_nationality}} </td>
              
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
            <td>Communication address: House Name  </td>
            
                <td colspan="2">{{Auth::user()->comm_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Communication address: Place / Street Name  </td>
            
                <td  colspan="2">{{Auth::user()->comm_addressline2}} </td>
            
            </tr>
            <tr>
            <td>Communication address: Post Office   </td>
            
                <td colspan="2">{{Auth::user()->comm_addressline3}} </td>
            
            </tr>
            <tr>
            <td>Permanent address: House Name   </td>
            
                <td colspan="2">{{Auth::user()->per_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Permanent address: Place/Street Name  </td>
            
                <td colspan="2">{{Auth::user()->per_addressline2}} </td>
            
            </tr>
            <tr>
                <td>Permanent address: Post Office  </td>
            
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

            </table><br/>
        
     
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
            <th>Programme</th>
            <th>Main Subject</th>
              <th>Programme Type</th>

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

           
       @if(Auth::user()->pgapp_adsc_sl==998)
   
          
          <p style="text-align: left;  font-family: arial, sans-serif;font-size: 12px;"><b>Applied Stream</b></p>

          <table class="table table-bordered table-hover" border="1" id="tb_quali">
            <tr>
             
            <th>Option</th>
            <th>Programme</th>
           
            </tr>
            @if($pmodeoption->isEmpty())        
            <tr>
               
                 <td>Nil</td>
                 <td>Nil</td>
                                                      
            </tr>
            @else  
            @foreach($pmodeoption as $key)
            <tr>
                <td>{{$key->p_option}}</td>

                <td>{{$key->p_stream}}</td>
                
            </tr>
            @endforeach
            @endif
            </table>
          
        @endif  
          

     
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
         
    


<p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Documents Uploaded</b></p>
           <table class="table table-bordered table-hover" border="1" id="tb_quali">


           <tr>
            <td width="50%">Aadhar Card</td>
            <td width="50%">
                @if(!empty($fileUrlaadhar)) 
                    Uploaded
                @else 
                    Not Uploaded
                @endif
            </td>
        </tr>
               
           <tr>
            <td width="50%">10th certificate</td>
            <td width="50%">
                @if(!empty($filePathSSLC)) 
                    Uploaded
                @else 
                    Not Uploaded
                @endif
            </td>
        </tr>

        <tr>
            <td width="50%">Degree certificate</td>
            <td width="50%">
                @if(!empty($filePathHSE)) 
                Uploaded
                @else 
                Not Uploaded
                @endif
            </td>
        </tr>


        <tr>
            <td width="50%">Special Reservation certificate</td>
            <td width="50%">
                @if(!empty($filePathSpecial)) 
                Uploaded
                @else 
                Not Uploaded
                @endif
            </td>
        </tr>

        

        <tr>
            <td width="50%">Caste Reservation certificate</td>
            <td width="50%">
            @if(Auth::user()->directory_docs!="")
            Uploaded
                @else 
                Not Uploaded
                @endif
            </td>
        </tr>
            
           </table>

           
<p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Campus Options Selected</b></p>
           <table class="table table-bordered table-hover" border="1" id="tb_quali">
               
           <tr>
            <td width="50%">Priority</td>
            <td width="50%">
               Campus            </td>
        </tr>
      
         @foreach($campus_options as $key5)       
            <tr>
            <td width="50%">{{$key5->pg_option}}</td>
           
            <td width="50%">{{$key5->cent}}</td>
            
             </tr>
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
     
         <td>{{$payment_success->merchantid}}</td>
    </tr>
    <tr>
       <td>University Service name</td>
     
         <td>{{$payment_success->ucity_service}}</td>
    </tr>
<!--    <tr>
        <td>Bank Name</td>
        <td>{{$payment_success->res_bankname}}</td>
    </tr>-->
      <tr>
             <td>Date of payment</td>
             <td>{{$payment_success->tdate}}</td>
      </tr>
    <tr>
       <td>Bank Reference No</td>
      <td>{{$payment_success->order_id}}</td>
    </tr>
       
       
    <tr>
        
        <td>Pay Amount</td>
        
         <td>{{$payment_success->trans_amt}}</td>
    </tr>
    <tr>
        
        <td>Payment Status</td>
        
         <td>{{$payment_success->order_status}}</td>
    </tr>
        
     
        
     
</table>         
    
    @if(!empty($payment_balnc))
    <p style=" font-family: arial, sans-serif;font-weight:bold;font-size: 12px;">Balance Payment Details</p> 
        <table class="" border="1" id="tb_quali">
 
            <tr>
               <td>Mode of Payment</td>
                <td>Online</td>
           </tr>

           <tr>
              <td>Application Number</td>

                <td>{{$payment_balnc->client_code}}</td>
           </tr>
            <tr>
              <td>University Transaction id</td>

                <td>{{$payment_balnc->merchanttxnid}}</td>
           </tr>
           <tr>
              <td>University Service name</td>

                <td>{{$payment_balnc->ucity_service}}</td>
           </tr>
           <tr>
               <td>Bank Name</td>
               <td>{{$payment_balnc->res_bankname}}</td>
           </tr>
             <tr>
              <td>Date of payment</td>
               <td>{{$payment_balnc->res_txn_date}}</td>
             </tr>
           <tr>
              <td>Bank Reference No</td>
             <td>{{$payment_balnc->res_bid}}</td>
           </tr>

           <tr>
                 <td>Pay Amount</td>

                <td>{{$payment_balnc->trans_amt}}</td>
           </tr>
           <tr>

               <td>Payment Status</td>

                <td>{{$payment_balnc->res_verified}}</td>
           </tr>
         
     
        </table>         
    @endif
 
          <p style=" font-family: arial, sans-serif;font-weight:bold;font-size: 13px;">Declaration</p>          

              <p  style=" font-family: arial, sans-serif;font-size: 12px; text-align:justify">
                  I hereby declare that all the statements made in this application are complete, true and correct to the best of my knowledge and belief. I understand and agree that in the event of any information being found to be false or incorrect or concealed or misstated, at any stage or if I am found not eligible to be admitted to the program, according to the requirements as given in the original notification or University/UGC regulations, my candidature for the program applied is liable to be rejected and if already admitted, the said admission will be cancelled/revoked.
              </p>
              @if(Auth::user()->pgapp_adsc_sl==997)
              <p style=" font-family: arial, sans-serif;font-size: 12px; text-align:justify">
                I have filled in the relevant portions of the application after carefully reading the notification, prospectus and agree to the conditions stipulated 
                thereon for the admission to the Post Graduate Diploma in Sanskrit Computational Linguistics Programme under Project Mode Scheme, 2023-24 issued by the university.
  
              </p>
              @endif
        <table>
            <tr>
            <td>Place :</td>
            <td style="text-align: right"><img  src="{{public_path("images/pgsign/".Auth::user()->pgapp_sign)}}" width="140" height="90" alt="signature"></td>
            </tr>
            <tr>
                <td style="padding-top:-25px;">Date :</td>

            <td style="text-align: right">Signature of the Candidate</td>
            </tr>
        </table>
           
    <p style="font-size: 11px;"><i>Document generated on:{{$curnt_date}} {{$time}}</i></p>    
</body>
</html>