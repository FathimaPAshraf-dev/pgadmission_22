@extends('layouts.app')

@section('styles')

@stop


@section('scripts')
 <script type="text/javascript">
     $(document).ready(function (){
              
   $("#successMessage").delay(5000).slideUp(400);
    $('.examhome').removeClass('active');
    $('.examhome').addClass('active');
 
   

});
</script>
 
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
                 <div id="successMessage" name="successMessage">
		@if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>

		@endif
		</div>

        
                    @if(( $payment_success_count > 0))
                
                       <div class="card-header" >
                        <h4 class="card-title m-0 "><b>PG ADMISSION 2024</b></h4>
                        </div>
                       @if(Auth::user()->ranklist_stat==1)
                     <div class="card-header">
                         <table class="table" style="border: none">
  <thead>
    
  </thead>
  <tbody>
      <tr>
      <th scope="row">Name</th>
      <!--<td>Mark</td>-->
      <td> </td>
      <td> <b>{{Auth::user()->pgapp_name}} </b></td>
    </tr>
    <tr>
      <th scope="row">Hall ticket</th>
      <!--<td>Mark</td>-->
      <td> </td>
      <td> @if((Auth::user()->ent_hallticket_stat==1) && ($publish_status == 1))
                <!--ent_hallticket_pub_stat-->	
                    <div class="col-sm-4">
                   <a href="{{route('hallticket2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                          Download Hall Ticket  <i class="fa fa-download"></i></a>
                        
                    </div>
                 @endif </td>
    </tr>
   
    <tr>
      <th scope="row">Application Printout</th>
      <!--<td>Larry</td>-->
      <td></td>
      <td><div class="col-sm-4">
                      <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                          <!--{{Auth::user()->pgapp_name}}<br><br>-->
                        <button type="submit" name="pdffrom" class="btn btn-info btn-sm">Application printout <i class="fa fa-download" aria-hidden="true"></i></button>
                    </form>
                    </div></td>
    </tr>
     <tr>
      <th scope="row">Option Printout</th>
     
      <td></td>
      <td> @if(Auth::user()->option_stat==1 || Auth::user()->option_stat==2 || Auth::user()->option_stat==3)
                   <div class="col-sm-4" >
                   <a href="{{route('printoption')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                        Download Option <i class="fa fa-download"></i></a>
                        
                   </div> 
                 @endif</td>
    </tr>
    <tr>
      <th scope="row">Documents Uploaded</th>
      
      <td></td>
      <td>   <div class="col-sm-2">    
                    <a href="{{url(Auth::user()->directory_docs)}}" target="_blank" class="btn btn-flat btn-sm btn-secondary">
                     View
                    </a>
                    </div>  </td>
    </tr>
  </tbody>
</table>    
                    
                    </div>
                    @endif
                    
                    
                    
                    @if(Auth::user()->ranklist_stat==1)
                    <div class="card-header" hidden="true">
                       <p>The qualified candidates of PG Entrance Examinations, 2024 are directed to select
                        the campus of study according to their preference and in tune with the list attached,
                        within <b>02.06.2024, 5 pm.</b>You are requested to select maximum centres of preference.
                        As stipulated in the admission memo, the candidate should take admission to the
                        programme in the offered campus within the time limit, lest the claim to join in other
                        campus of preference will be automatically cancelled. However the candidates who
                        joined in lower options will be permitted to join in higher option of preference as
                        and when the vancancy arises in future.</p>
<!--                        <p>The qualified candidates of PG Entrance Examinations, 2024 are directed to upload
                            the following documents on or before<b> 02.06.2024, 5 pm.</b></p>-->
                        <ol>
                            <li >Copy of SSLC ( Front Page, Marklist)</li>
                            <li>Copy of plus two marklist</li>
                            <li>Copy of degree marklists & certificates</li>
                        </ol>
                        <ul>
                            <li>Those candidates who are awaiting for the release of final semester Degree
                                result should mandatorily upload the marklists of I to IV semester marklists.</li>
                            <li>The candidates of OBC category are directed to upload the copy of non-
                                creamy layer certificate without fail, so as to claim the reservation benefits,
                                else the same will be cancelled.</li>
                            <li>Transfer certificate & Migration certificate shall be produced at the time of
                                admission.</li>
                        </ul>
<!--                        <a href="https://ssus.ac.in/files/264/PG-Admission-2023/2030/PROGRAMME--CAMPUS-WISE-LIST.pdf"
                           class="btn btn-sm btn-secondary" target="_blank">PG ADMISSION 2024 PROGRAMME – CAMPUS WISE LIST </a>-->
                    
<br>

<p style="color: red">The candidate who claims reservation under various category doesn't posses the relevant certificate while uploading shall submit a self declaration to the effect that the same shall be submitted at the time of admission.

    The candidature under reservation category will be forfeited unless the original documents are not submitted at the time of admission.</p>
                    </div>
                    
                    
                    @endif
                    
                    
                    <div class="row" hidden="">
                  
                   
                   @if(Auth::user()->ranklist_stat==1)
                
                    @if(1)
                    <div class="card-header " hidden="">
                          <p class="card-title m-0 ">
<!--സർവകലാശാലയുടെ പ്രാദേശിക കേന്ദ്രത്തിൽ അക്കാദമിക് പുന: സംഘടനത്തിന്റെ ഭാഗമായി നിർത്തലാക്കിയ ചില പി ജി പ്രോഗ്രാമുകൾ (കൊയിലാണ്ടി - സംസ്‌കൃതം വേദാന്ത (10 സീറ്റ് ),തിരൂർ - ഇംഗ്ലീഷ് (20 സീറ്റ് ), പൻമന- ഹിന്ദി(20സീറ്റ് ),തിരുവനന്തപുരം - മലയാളം (20 സീറ്റ് ))2023-24 അക്കാദമിക വർഷം തന്നെ പുന : സ്ഥാപിക്കാൻ സിൻഡിക്കേറ്റ് തീരുമാനിച്ച സാഹചര്യത്തിൽ സെൻറർ ഓപ്ഷൻ നൽകി അഞ്ച് അലോട്മെൻ്റി ലൂടെ അഡ്മിഷൻ നേടിയ വിദ്യാർത്ഥികൾക്കും നാളിതുവരെ ഓപ്ഷൻ നൽകാൻ സാധിക്കാത്ത വിദ്യാർത്ഥികൾക്കും മേൽ സൂചിപ്പിച്ച ക്യാമ്പസ് കൂടി ഉൾപെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ തീരുമാനിച്ചിരിക്കുന്നു. റീ ഓപ്ഷൻ നൽകാൻ താല്പര്യമുള്ള വിദ്യാർത്ഥികൾ മാത്രം 11.08. 2023 മുതൽ 16.08.2023 വരെയുള്ള തീയതികുള്ളിൽ ഈ അവസരം ഉപയോഗപ്പെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ അറിയിക്കുന്നു. 2023 ഓഗസ്റ്റ്‌ 20 ന് അലോട്മെന്റ് പ്രക്രിയ നടത്തി ഓഗസ്റ്റ്‌ 23,24 തീയതികളിലായി പ്രവേശന നടപടി പൂർത്തിയാക്കുന്നതാണ്.-->
</p>
                     </div> 
                    <br>
<!--                    <div class="col-sm-4" >
                       <a href="{{route('optionentry23')}}"  class="btn btn-flat btn-sm btn-danger"  >
                       Option <i class="fa fa-edit"></i></a>
                       </div>-->
                    @endif
                    @endif
                
                   @if(Auth::user()->option_stat==1 || Auth::user()->option_stat==2 || Auth::user()->option_stat==3)
                   <div class="col-sm-4" >
                   <a href="{{route('printoption')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                        Download Option <i class="fa fa-download"></i></a>
                        
                   </div> 
                 @endif
                
               </div>
                    
                      @if($allotstat==4555)
                            <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h5 class="card-title m-0 "><font style="color: red">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h5>
                               </div>
                                <div class="card-body">
                                <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>

                                </div>
                            @endif
                            
                           @if($allotstat==0 && Auth::user()->pgapp_adsc_sl<996 )
                            @if(Auth::user()->pgapp_sl<=59865)
                            <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                            </div>
                             <div class="card-header " align="center">
                                 <h5 class="card-title m-0 danger"><font style="color: red">You are not in allotment list. Better luck next allotment.</font></h5>
                             </div>
                             @endif
                            @endif
                              @if($allotstat==5 && Auth::user()->pgapp_adsc_sl<996 )
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                             </div>
                             <div class="card-header " align="center">
                                   <h5 class="card-title m-0 danger"><font style="color: red">No change in previous allotment</font></h5>
                             </div>
                             
                             @endif
                    
                    <div class="card-body">
                    <h6 class="row"> 
                     @if(Auth::user()->ranklist_stat==1 && Auth::user()->pgapp_adsc_sl==975)

                     <div class="col-sm-12" hidden="">
                         <label>സർവകലാശാലയുടെ പയ്യന്നൂർ പ്രാദേശിക കേന്ദ്രത്തിൽ 2023-24 അക്കാദമിക വർഷം മുതൽ പിജി മലയാളം പ്രോഗ്രാം (20 സീറ്റ്) ആരംഭിക്കുവാൻ തീരുമാനിച്ചിരിക്കുന്ന സാഹചര്യത്തിൽ സെൻറർ ഓപ്ഷൻ നൽകി മൂന്ന് അലോട്മെൻ്റി ലൂടെ അഡ്മിഷൻ നേടിയ വിദ്യാർത്ഥികൾക്കും നാളിതുവരെ ഓപ്ഷൻ നൽകാൻ സാധിക്കാത്ത വിദ്യാർത്ഥികൾക്കും മേൽ സൂചിപ്പിച്ച ക്യാമ്പസ് കൂടി ഉൾപെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ തീരുമാനിച്ചിരിക്കുന്നു. റീ ഓപ്ഷൻ നൽകാൻ താല്പര്യമുള്ള വിദ്യാർത്ഥികൾ മാത്രം 10.07. 2023 മുതൽ 12.07.2023 വരെയുള്ള തീയതികുള്ളിൽ ഈ അവസരം ഉപയോഗപ്പെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ അറിയിക്കുന്നു.</label>
                     </div>                     
                     @endif
                    <div class="col-sm-4" hidden="">
                      <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                          {{Auth::user()->pgapp_name}}<br><br>
                        <button type="submit" name="pdffrom" class="btn btn-info">Application printout <i class="fa fa-download" aria-hidden="true"></i></button>
                    </form>
                    </div>
                   @if(Auth::user()->pgapp_adsc_sl==993)                   
                    <div class="col-sm-4">
                        <form action="{{route('editpg')}}" method="get" name="editfrom">
                       
                        <button type="submit" name="editfrom" class="btn btn-warning float-right">Edit Application <i class="fa fa-edit" aria-hidden="true"></i></button>
                    </form>
                    </div>
                   @endif
                   
                @if((Auth::user()->ent_hallticket_stat==1) && ($publish_status == 1))
                <!--ent_hallticket_pub_stat-->	
                    <div class="col-sm-4" hidden="">
                   <a href="{{route('hallticket2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                          Download Hall Ticket  <i class="fa fa-download"></i></a>
                        
                    </div>
                 @endif    
                 
                @if(Auth::user()->ranklist_stat==100)
                    @if(Auth::user()->directory_docs!="")
                    <div class="col-sm-2">
                     <a href="{{route('documentsupload')}}"  class="btn btn-flat btn-sm btn-danger" >
                      Upload Certificates</a>
                    </div>
                    <div class="col-sm-2" hidden="">    
                    <a href="{{url(Auth::user()->directory_docs)}}" target="_blank" class="btn btn-xs btn-secondary">
                     View uploaded file
                    </a>
                    </div>     
                    @else

                    <div class="col-sm-4">
                      <a href="{{route('documentsupload')}}"  class="btn btn-flat btn-sm btn-danger" >
                      Upload Certificates</a>
                           <!--<p><b>Document upload will be available after 5 pm</b></p>-->

                      </div>
                    @endif
                    @else
                    <div class="col-sm-2" hidden="">    
                    <a href="{{url(Auth::user()->directory_docs)}}" target="_blank" class="btn btn-xs btn-secondary">
                     View uploaded file
                    </a>
                    </div> 
                 @endif 
                                
                 
                 @if(Auth::user()->shortfallcentstat==1 && Auth::user()->option_stat==3)
<!--                  <div class="col-sm-4">
                   <a href="{{route('optionentry')}}"  class="btn btn-flat btn-sm btn-danger">
                       Edit option <i class="fa fa-edit"></i></a>
                        
                   </div>-->
                   @endif   
                
                  @if(Auth::user()->shortfallcentstat==1 && Auth::user()->option_stat==1)
<!--                  <div class="col-sm-6">
                   <a href="{{route('optionentry')}}"  class="btn btn-flat btn-sm btn-danger">
                        Re-opt Your Study Centre <i class="fa fa-edit"></i></a>
                        
                   </div>-->
                    <div class="card-header">
                       <h5 class="card-title m-0 "><b>Option entry is closed</b></h5>
                   </div>
                  @endif
                 
                </h6>
             
         </div>
                    @if(Auth::user()->pgapp_id=='ADMPG2307124'||Auth::user()->pgapp_id=='ADMPG2307126'||Auth::user()->pgapp_id=='ADMPG2307128'||
                    Auth::user()->pgapp_id=='ADMPG2307129'||Auth::user()->pgapp_id=='ADMPG2307130'||Auth::user()->pgapp_id=='ADMPG2307131'||
                    Auth::user()->pgapp_id=='ADMPG2307132'||Auth::user()->pgapp_id=='ADMPG2307133'||Auth::user()->pgapp_id=='ADMPG2307137')    
                    
                    @if($payment_balnc<1)
                     <div class="card-header ">
                          <h5 class="card-title m-0 "><b>Entrance Fee Balance Payment</b></h5>
                     </div> 
                     <div class="card-header ">
                       <form action="{{route('pgbalancepayment')}}" method="post">   
                           @csrf
                           <p>Pay the balance of the exam entry fee. Take another printout of the application after a successful payment. If you have any issues with online payments, send an email to helpdesk@ssus.ac.in.  </p>
                       <p> <button type="submit" class="btn btn-sm btn-danger">Pay Now <i class="fa fa-rupee-sign	"></i></button></p>
                       </form>
                    </div>
                    @endif
                    
                    @endif
                          @if($allotstat==4 && $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 >Admission request is not initiated.Please contact the corresponding department/centre for admission</h6>
                            </div>
                           @elseif($admstat==1) 
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                           </div>
                                                        
                             <div class="card-body">
                            <a href="{{route('allotmentdetails2022')}}"  class="btn btn-flat btn-sm btn-danger">
                                Pay Admission Fee <i class="fa fa-rupee-sign	"></i></a>

                            </div>
                             <div class="card-header ">
                               <h6 ><u style="color: red">About Online Payment:</u>  If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
                                                   For any issues related to online payment please write to us, helpdesk@ssus.ac.in</h6>
                           </div>
                          
                        
                             
                             @endif

                             @if($feestat==1)
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                           </div>
                             <div class="card-body">
                            <a href="{{route('admfeereceipt2022')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                                Admission Fee Receipt <i class="fa fa-download"></i></a>

                            </div>
                             @endif
                             
                    @if(Auth::user()->pgapp_adsc_sl==993)
<!--                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>IMPORTANT DATES</b></h5>
                           </div>-->
                           <!--<marquee><font style="color: red ;font-size: 17px;">The last date to apply for the PG entrance examination  is extended upto 20.04.2023</marquee>-->
<!--                             <div class="card-body">
                              <u><b> Admission to the P.G. Diploma in Translation and Office Proceedings in Hindi</b></u>
                                <p>Last date of submission of application through online : 07.07.2023</p>
                                <p>Download of Hall Ticket : 11.07.2023</p>
                                <p>Tentative Schedule of Entrance Examinations : 14.07.2023 </p>
                                <p>Tentative Date of Publication of Rank list : 20.07.2023</p>
                                <p>Tentative dates for exercising option of Campus by the candidates: 20.07.2023- 22.07.2023</p>
                               <p>
                                <a href="https://ssus.ac.in/files/264/PG-Admission-2023/2068/PG-Diploma-in-Translation-and-Office-Proceedings-in-Hindi---Notification.pdf
                                " target="_blank" class="btn btn-flat btn-xs btn-danger">
                                                        P.G.Diploma in Translation and office proceedings in Hindi 2023 Admission <i class="fa fa-info-circle"></i></a> 
                                </p>

                            </div>-->
                    @endif
                             
                    @else

                      @if( Auth::user()->pgapp_sl>59865)
                       
                            <div class="card-header">
                                <h5 class="card-title m-0"><b>PAYMENT STATUS</b></h5>
                            </div>

                            <div class="card-body">
<!--                                <h5 style="color: red;">Registration is closed</h5>-->
                                
                              <div class="form-group row">
                                  <p style="font-size: 16px;"><u style="color: red">About Online Payment:</u>  Once money has been debited from your account, do not attempt to make the payment again. Sometimes it takes a while to process the payment. Check your profile regularly. 
                                      For any such issue please write to us at helpdesk@ssus.ac.in</p>
                                
                                  <p style="font-size: 16px;">ഓൺലൈൻ പേയ്‌മെന്റിനെക്കുറിച്ച്: നിങ്ങളുടെ അക്കൗണ്ടിൽ നിന്ന് പണം ഡെബിറ്റ് ചെയ്തുകഴിഞ്ഞാൽ, വീണ്ടും പണമടയ്ക്കാൻ ശ്രമിക്കരുത്. പേയ്‌മെന്റ് പ്രോസസ്സ് ചെയ്യാൻ ചിലപ്പോൾ കുറച്ച് സമയമെടുക്കും. നിങ്ങളുടെ പ്രൊഫൈൽ പതിവായി പരിശോധിക്കുക. അത്തരം പ്രശ്‌നങ്ങൾക്ക് helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ ഞങ്ങൾക്ക് എഴുതുക</p>
                              </div>
<div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped table-responsive">
             <thead>
            <th width="2%"><font >MID</font></th>
          <th width="2%"><font >Amount</font></th>
          <th width="2%"><font >Date</font></th>
             <th width="2%"><font >Status</font></th>
         
              </thead>
         

            <tr>
      
       @foreach($pay_details as $ckey)

                  <td> {{$ckey->merchanttxnid}}</td> 
                  <td>{{$ckey->trans_amt}}</td>
                   <td>{{$ckey->res_txn_date}}</td>
                    <td>{{$ckey->res_verified}}</td>
                  
              
         </tr>
        @endforeach    
              
         </table>        
     </div> 




                                 <div class="form-group row">
                                     <form action="{{route('checkpay')}}" method="post">
                                    @csrf
                                    <input type="hidden" id="pgapp_id" name="pgapp_id" value="{{Auth::user()->pgapp_id}}">
                                     <p> <button type="submit" class="btn btn-sm btn-danger">Check Payment if all ready paid </button></p>
                                       </form> 
                                </div>   
                    
                              <form action="{{route('pgpayment')}}" method="post">
                            @csrf
                            <div class="form-group row">
                             
                               
                                   <!--<p> <button type="submit" class="btn btn-sm btn-info">Retry Payment</button></p>-->
                                   
                                </div>
                       </form> 
                            </div>
<!--                            <marquee><font style="color: red ;font-size: 17px;">The last date to apply for the PG entrance examination  is  07.04.2024</marquee>-->

                     
                     
                          
                      @else
                      <h5 style="color: red;">Registration is closed</h5>   
                      @endif
                    @endif
                   @if(Auth::user()->pgapp_sl>59865)
                     @foreach($pay_details as $key)
              
                     <div class="card px-3 pt-4 pb-0 mt-3 mb-3" hidden="">

                              <div class="card-header ">
                                  <h5 class="card-title m-0 "><b>PAYMENT DETAILS</b></h5>
                              </div>
                              <div class="card-body">  
                                  <div class="form-group row">
                                    <label for="" class="col-sm-6 col-form-label">University Transaction Id:</label>
                                    <div class="col-sm-6">
                                     {{$key->merchanttxnid}}
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="" class="col-sm-6 col-form-label">Bank Reference Number</label>
                                    <div class="col-sm-6">
                                     {{$key->res_bid}}
                                    </div>
                                  </div>
                                     <div class="form-group row">
                                    <label for="" class="col-sm-6 col-form-label">Payment Status</label>
                                    <div class="col-sm-6">
                                     {{$key->res_verified}}
                                    </div>
                                  </div>
                                     <div class="form-group row">
                                    <label for="" class="col-sm-6 col-form-label">Date Of Payment</label>
                                    <div class="col-sm-6">
                                     {{$key->res_txn_date}}
                                    </div>
                                  </div>
                                   <div class="form-group row">
                                    <label for="" class="col-sm-6 col-form-label">Bank Name</label>
                                    <div class="col-sm-6">
                                     {{$key->res_bankname}}
                                    </div>
                                  </div>

                              </div>


                            </div>

                      @endforeach 
                        
                   @endif     
                    
            </div>
       

        
        
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
