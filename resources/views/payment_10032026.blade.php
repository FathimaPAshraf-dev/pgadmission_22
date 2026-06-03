<div class="form-group row">
    <label class="control-label col-md-12" ><marquee>
   Please check the data carefully before submitting the application.If any correction, go through previous button and correct the data.
   After submitting the form you cannot edit it again</marquee>
 </label>
 <label class="control-label col-md-12" >അപേക്ഷ സമർപ്പിക്കുന്നതിന് മുമ്പ് ദയവായി ഡാറ്റ ശ്രദ്ധാപൂർവ്വം പരിശോധിക്കുക. എന്തെങ്കിലും തിരുത്തലുകൾ ഉണ്ടെങ്കിൽ, മുമ്പത്തെ ബട്ടണിലൂടെ പോയി ഡാറ്റ ശരിയാക്കുക. ഫോം സമർപ്പിച്ച ശേഷം നിങ്ങൾക്ക് അത് വീണ്ടും എഡിറ്റ് ചെയ്യാൻ കഴിയില്ല</label>
</div>
      
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
         <p style="text-align: left;  font-family: arial, sans-serif;font-size: 15px;"><b>Personal Informations</b></p>
                 
            <table class="table table-bordered table-hover">
            @foreach($pgapp as $pg) 
          
            <tr> 
            <td width="30%">Program which you are applied for</td>
            <td width="60%">{{$pg->adsc_name}}</td>
            <td rowspan="5"> <img  src="{{asset('images/pgphoto/'.Auth::user()->pgapp_photo)}}?{{filemtime( public_path('images/pgphoto/'.Auth::user()->pgapp_photo) ) }}" width="150" height="200" alt="user"> </td>
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
            
                <td colspan="2">{{$pg->gender_name}} </td>
            
            </tr>
             <tr>    
            <td>SSLC register number</td>
            <td colspan="2">{{Auth::user()->sslc_regno}}</td>
            </tr> 
            <tr>    
            <td>Aadhaar number</td>
            <td colspan="2">{{Auth::user()->pgapp_adhar}}</td>
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
            <td>Commuication address: House Name  </td>
            
                <td colspan="2">{{Auth::user()->comm_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Commuication address: Place / Street Name  </td>
            
                <td  colspan="2">{{Auth::user()->comm_addressline2}} </td>
            
            </tr>
            <tr>
            <td>Commuication address: Post Office   </td>
            
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

           </table>
                  
    </div> 
</div>
   
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-size: 15px;"><b>Educational Qualifications</b></p>
      
    </div>
</div>
<div class="col-sm-12">
    <div class="card-body table-responsive" >
      <p style="text-align: left;  font-family: arial, sans-serif;font-size: 13px;"><b>SSLC DETAILS</b></p>

           <table class="table table-bordered table-hover">
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
    </div>
</div>
<div class="col-sm-12">
    <div class="card-body table-responsive" >
          <p style="text-align: left;  font-family: arial, sans-serif;font-size: 13px;"><b>DEGREE DETAILS</b></p>

            <table class="table table-bordered table-hover">
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
                  <!--<td>Nil</td>-->
                  <td>Nil</td>
                   <td>Nil</td>
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

<!--                <td>{{$key->pgquali_year}} - {{$endyr}}</td>-->
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

            </div>

    </div>     
<div class="col-sm-12">
    <div class="card-body table-responsive" >
          <p style="text-align: left;  font-family: arial, sans-serif;font-size: 13px;"><b>DEGREE MARK DETAILS</b></p>

            <table class="table table-bordered table-hover">
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

            </div>

    </div>   
@if(Auth::user()->pgapp_adsc_sl==998)

@if(isset($pmodeoption))
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-size: 15px;"><b>Categories</b></p>
      
    </div>
</div>

<div class="col-sm-12">
    <div class="card-body table-responsive" >
      <p style="text-align: left;  font-family: arial, sans-serif;font-size: 13px;"><b></b></p>

           <table class="table table-bordered table-hover">
            <tr>
            <th>Stream</th>
            <th>Option</th>
            </tr>
            @foreach($pstream as $key)
            <tr>
            <td>{{$key->p_stream}}</td>
            <td>{{$key->p_option}}</td>
            </tr>
            @endforeach
            </table>
    </div>
</div>

@else

@endif
@endif
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Other Information</b></p>

            <table class="table table-bordered table-hover">
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
            <td width="60%">Other differently abled</td>
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

         
          
    </div> 

   
</div> 

<div class="col-sm-12">
    <div class="card-body table-responsive" >

<p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Documents Uploaded</b></p>
           <table class="table table-bordered table-hover">
           

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

           </div> 

   
</div> 


<div class="col-sm-12">
    <div class="card-body table-responsive" >

<p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Campus Options Selected</b></p>
           <table class="table table-bordered table-hover">
               
           <tr>
            <td width="50%">Priority</td>
            <td width="50%">
               Campus            </td>
        </tr>
        <table class="table table-bordered table-hover">
         @foreach($campus_options as $key5)       
            <tr>
            <td width="50%">{{$key5->pg_option}}</td>
           
            <td width="50%">{{$key5->cent}}</td>
            
             </tr>
        @endforeach
        
            
           </table>

           </div> 

   
</div> 

<form action="{{ route('pgpayment') }}" name="pgpayment" id="pgpayment" method="post">
@csrf
 <div class="col-sm-12">
   <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 15px;"><b>Declaration /പ്രഖ്യാപനം</b></p>

    <label class="control-label col-md-12"  style="font-size: 15px;">1. I hereby declare that all the statements made in this application are complete, true and correct to the best of my knowledge and
belief. I understand and agree that in the event of any information being found to be false or incorrect or concealed or misstated, at
any stage or if I am found not eligible to be admitted to the program, according to the requirements as given in the original
notification or University/UGC regulations, my candidature for the program applied is liable to be rejected and if already admitted,
the said admission will be cancelled/revoked.   OR  <br>
           ഈ ആപ്ലിക്കേഷനിൽ പറഞ്ഞിരിക്കുന്ന എല്ലാ പ്രസ്താവനകളും എന്റെ അറിവിൽ പൂർണ്ണവും സത്യവും ശരിയും ആണെന്ന് ഞാൻ ഇതിനാൽ പ്രഖ്യാപിക്കുന്നു.
 ഏതെങ്കിലും വിവരം തെറ്റായതോ  മറച്ചുവെച്ചതോ തെറ്റായി പ്രസ്താവിച്ചതോ ആണെന്ന് കണ്ടെത്തിയാൽ, 
ഏതെങ്കിലും ഘട്ടം അല്ലെങ്കിൽ ഒറിജിനലിൽ നൽകിയിരിക്കുന്ന ആവശ്യകതകൾക്ക് അനുസൃതമായി പ്രോഗ്രാമിലേക്ക് പ്രവേശനം നേടാൻ ഞാൻ യോഗ്യനല്ലെന്ന് കണ്ടെത്തിയാൽ
വിജ്ഞാപനം അല്ലെങ്കിൽ യൂണിവേഴ്സിറ്റി/യുജിസി നിയന്ത്രണങ്ങൾ, അപേക്ഷിച്ച പ്രോഗ്രാമിനുള്ള എന്റെ സ്ഥാനാർത്ഥിത്വം നിരസിക്കപ്പെടാൻ ബാധ്യസ്ഥമാണ്, ഇതിനകം പ്രവേശനം ലഭിച്ചിട്ടുണ്ടെങ്കിൽ,
പ്രസ്തുത പ്രവേശനം റദ്ദാക്കപ്പെടും/അസാധുവാക്കപ്പെടും.<br><br>
 2.  My graduation marks submitted with the application
I certify that it is accurate and that I have successfully completed all the semesters up to that point.  OR  <br>
അപേക്ഷയോടൊപ്പം സമർപ്പിച്ച എന്റെ ബിരുദ മാർക്കുകൾ
അത് കൃത്യമാണെന്നും അതുവരെയുള്ള എല്ലാ സെമസ്റ്ററുകളും ഞാൻ വിജയകരമായി പൂർത്തിയാക്കിയിട്ടുണ്ടെന്നും ഞാൻ സാക്ഷ്യപ്പെടുത്തുന്നു.<br>
 3.I declare that all information provided with this
application is accurate, complete and true.  OR ഇതുമായി ബന്ധപ്പെട്ട് ഞാൻ നൽകിയ എല്ലാ വിവരങ്ങളും
കൃത്യവും പൂർണ്ണവും സത്യവുമാണ്      

@if(Auth::user()->pgapp_adsc_sl==997)
<br>
 4. I have filled in the relevant portions of the application after carefully reading the notification, prospectus and agree to the conditions stipulated 
 thereon for the admission to the Post Graduate Diploma in Sanskrit Computational Linguistics Programme under Project Mode Scheme, 2023-24 issued by the university.
@endif

</label>
    
   
     @foreach($pgapp as $key)
    <label class="control-label col-md-12" style="color: red"> I accept the above declarations <input type="checkbox" name="declaration_status" id="declaration_status"
                                 <?php if ($key->declaration_status == 1) echo 'checked'; ?> >
   </label>
   
<img  src="{{asset('images/pgsign/'.$key->pgapp_sign)}}?{{filemtime( public_path('images/pgsign/'.$key->pgapp_sign) ) }}" width="200" height="120" alt="signature">
 
</div>
   </div>

 <div class="col-sm-12">
     
     <label class="control-label  col-md-6" >Mode of Payment : </label>
    
        <input type="text"  class="form-control form-control-sm col-md-4" value="Online Payment" id="" name="" disabled="">
    
   
 </div>
 <div class="card-body">
     @if($key->pg_edit_appl==0)
    <p style="text-align: left;  font-family: arial, sans-serif; color: black;font-size: 15px;"><b>
    After clicking the submit button you will be go to the payment page. /സബ്മിറ്റ് ബട്ടണിൽ ക്ലിക്ക് ചെയ്ത ശേഷം നിങ്ങൾ പേയ്മെന്റ് പേജിലേക്ക് പോകും
    </b></p>
    @else
    <p style="text-align: left;  font-family: arial, sans-serif; color: black;font-size: 15px;"><b>
    After clicking the submit button you will be go to the printout page. /സബ്മിറ്റ് ബട്ടണിൽ ക്ലിക്ക് ചെയ്ത ശേഷം നിങ്ങൾ പ്രിന്റൗട്ട് പേജിലേക്ക് പോകും.
    </b></p>
    @endif
 </div>
   @endforeach  
     <button type="button" name="btn_payment" style="display: none" id="btn_payment" class="action-button" value="Submit">Submit</button> 

 </form>


  



