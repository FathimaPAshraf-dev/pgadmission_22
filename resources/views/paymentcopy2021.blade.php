<div class="form-group row">
    <label class="control-label col-md-12" ><marquee>
   Please check the data carefully before submitting the application.If any correction, go through previous button and correct the data.
   After submitting the form you cannot edit it again</marquee>
 </label>
 <label class="control-label col-md-12" >അപേക്ഷ സമർപ്പിക്കുന്നതിന് മുമ്പ് ദയവായി ഡാറ്റ ശ്രദ്ധാപൂർവ്വം പരിശോധിക്കുക. എന്തെങ്കിലും തിരുത്തലുകൾ ഉണ്ടെങ്കിൽ, മുമ്പത്തെ ബട്ടണിലൂടെ പോയി ഡാറ്റ ശരിയാക്കുക. ഫോം സമർപ്പിച്ച ശേഷം നിങ്ങൾക്ക് അത് വീണ്ടും എഡിറ്റ് ചെയ്യാൻ കഴിയില്ല</label>
</div>
     
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
                  <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Personal Information</b></p>
                 
            <table class="table table-bordered table-striped">
                @foreach($pgapp as $pg) 
                <tr>
            <td>Stream in which you are applied for</td>
            @if($pg->pgapp_stream_id==1)
            <td ><b>MA </b></td>
            @elseif($pg->pgapp_stream_id==2)
            <td><b>MSW </b></td>
            @elseif($pg->pgapp_stream_id==6)
            <td><b>MFA </b></td>
             @elseif($pg->pgapp_stream_id==3)
            <td><b>MPES</b></td>
            @elseif($pg->pgapp_stream_id==8)
            <td><b>MSC </b></td>
            @elseif($pg->pgapp_stream_id==9)
            <td><b>PG DIPLOMA </b></td>
            @else
            @endif
            </tr>
            <tr> 
            <td width="30%">Programm which you are applied for</td>
            <td width="60%">{{$pg->adsc_name}}</td>
            <td rowspan="6"> <img  src="{{asset('images/pgphoto/'.Auth::user()->pgapp_photo)}}" width="150" height="200" alt="user"> </td>
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
            <td>House Name  </td>
            
                <td colspan="2">{{Auth::user()->comm_addressline1}} </td>
            
            </tr>
            <tr>
            <td>Place / Street Name  </td>
            
                <td  colspan="2">{{Auth::user()->comm_addressline2}} </td>
            
            </tr>
            <tr>
            <td>Post Office   </td>
            
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
        <table class="table table-bordered table-striped">
                                @foreach($pgapp as $key)
                                <tr>
                                    <th>UG Result awaiting</th>
                                    
                                    <tr>
                                    @if($key->ugcourse_status==1)
                                          <td>Yes</td>
                                    @else
                                        <td>No</td>

                                    @endif
                                    
                                                              
                                </tr>
                              @endforeach
        </table>
    <br>
        @if($pgquali->isEmpty())
                        <table class="table table-bordered table-striped">
                               
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
                            <table class="table table-bordered table-striped">
                               
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
            <table class="table table-bordered table-striped">
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
            
           </table>
<table class="table table-bordered table-striped">
            <tr>
            <td width="30%">Whether eligible for Special Reservation (NCC/NSS/SPORTS/ARTS)</td>
            @if( $key->pgapp_wh_special_reserv== '1')
            <td width="60%">Yes</td>
              
            @else
            <td width="60%">No</td>
            @endif
             </tr>
              
            
            
           </table>
 <table class="table table-bordered table-striped">
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
             
            
           </table>
 @endforeach            
    </div> 
</div> 

<!-- <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Study Centres</b></p>
@foreach($pgoptions as $key)
  
            <table class="table table-bordered table-striped">
                
                <tr>
           
            <td width="30%">{{$key->centre_name}} </td>
             <td width="30%">{{$key->pg_option}} </td>
            
                </tr>

            
         
           </table>       
 @endforeach 
    </div> 
</div>  -->
<div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Centre Of Entrance Examination</b></p>
@foreach($pgapp as $key1)
  
            <table class="table table-bordered table-striped">
                
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
         
           </table>       
 @endforeach 
    </div> 
</div> 
 
    <label class="control-label col-md-4" >Mode of Payment : </label>
    <div class="col-md-8">
        <input type="text"  class="form-control col-sm-8" value="Online Payment" id="" name="" disabled="">
    
   </div>
   <div class="col-sm-12">
    <div class="card-body table-responsive" >
     
    <p style="text-align: left;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;"><b>Declaration /പ്രഖ്യാപനം</b></p>

  
            <table class="table table-bordered table-striped">
                <label class="control-label col-md-12" >1. I hereby declare that all the statements made in this application are complete, true and correct to the best of my knowledge and
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
 3.I declare that all information provided by me in connection with this
application is accurate, complete and true.  OR ഇതുമായി ബന്ധപ്പെട്ട് ഞാൻ നൽകിയ എല്ലാ വിവരങ്ങളും ഞാൻ പ്രഖ്യാപിക്കുന്നു
ആപ്ലിക്കേഷൻ കൃത്യവും പൂർണ്ണവും സത്യവുമാണ്      

      
 
        <input type="checkbox" name="declaration_status" id="declaration_status"  >
</label></table>
   
<td rowspan="5"> <img  src="{{asset('images/pgsign/'.Auth::user()->pgapp_sign)}}" width="200" height="100" alt="user"> </td>

</div>



  



