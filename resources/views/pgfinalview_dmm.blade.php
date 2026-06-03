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
                        <h4 class="card-title m-0 "><b>PG ADMISSION 2023</b></h4>
                        </div>
                    @if(Auth::user()->ranklist_stat==1)
                    <div class="card-header" hidden="true">
                       <p>The qualified candidates of PG Entrance Examinations, 2023 are directed to select
                        the campus of study according to their preference and in tune with the list attached,
                        within <b>31.05.2023, 5 pm.</b>You are requested to select maximum centres of preference.
                        As stipulated in the admission memo, the candidate should take admission to the
                        programme in the offered campus within the time limit, lest the claim to join in other
                        campus of preference will be automatically cancelled. However the candidates who
                        joined in lower options will be permitted to join in higher option of preference as
                        and when the vancancy arises in future.</p>
                        <p>The qualified candidates of PG Entrance Examinations, 2023 are directed to upload
                            the following documents on or before<b> 02.06.2023, 5 pm.</b></p>
                        <ol>
                            <li >Copy of SSLC ( Front Page, Marklist)</li>
                            <li>Copy of plus two marklist</li>
                            <li>Copy of degree marlists & certificates</li>
                        </ol>
                        <ul>
                            <li>Those candidates who are awaiting for the release of final semester Degree
                                result should mandatorily upload the marklists of I to IV semester marlists.</li>
                            <li>The candidates of OBC category are directed to upload the copy of non-
                                creamy layer certificate without fail, so as to claim the reservation benefits,
                                else the same will be cancelled.</li>
                            <li>Transfer certificate & Migration certificate shall be produced at the time of
                                admission.</li>
                        </ul>
                        <a href="https://ssus.ac.in/files/264/PG-Admission-2023/2030/PROGRAMME--CAMPUS-WISE-LIST.pdf"
                           class="btn btn-sm btn-secondary" target="_blank">PG ADMISSION 2023 PROGRAMME – CAMPUS WISE LIST </a>
                    </div>
                    
                    
                    @endif
                    
                    
                    
                    <div class="card-body">
                    <h6 class="row"> 
                    <div class="col-sm-4">
                      <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                        <button type="submit" name="pdffrom" class="btn btn-info">Application printout <i class="fa fa-download" aria-hidden="true"></i></button>
                    </form>
                    </div>
                   @if(Auth::user()->pgapp_adsc_sl==997)                   
                    <div class="col-sm-6">
                        <form action="{{route('editpg')}}" method="get" name="editfrom">
                       
                            <button type="submit" name="editfrom" class="btn btn-warning float-right" hidden="">Edit Application <i class="fa fa-edit" aria-hidden="true"></i></button>
                    </form>
                    </div>
                   @endif
                   
                @if(Auth::user()->ent_hallticket_stat==1)
<!--               <div class="col-sm-4">
                   <a href="{{route('hallticket2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                          Download Hall Ticket  <i class="fa fa-download"></i></a>
                        
                    </div>-->
                 @endif    
             
                
                           
                 
                </h6>
                        @if($allotstat==4)
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
                            
                            @if($allotstat==0 && Auth::user()->pgapp_adsc_sl==998)
                            <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                            </div>
                             <div class="card-header " align="center">
                                 <h5 class="card-title m-0 danger"><font style="color: red">You are not in allotment list. Better luck next allotment.</font></h5>
                             </div>
                             @endif
                             
                             @if($allotstat==4 && $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 >Admission request is not initiated.Please contact the corresponding department for admission</h6>
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
                    </div>
                          
                        <!--<div class="card px-3 pt-4 pb-0 mt-3 mb-3">-->

                            
<!--                          </div>-->
                        @if(Auth::user()->pgapp_adsc_sl==997)
                        <div class="card-header " hidden="">
                               <h5 class="card-title m-0 "><b>IMPORTANT DATES</b></h5>
                           </div>
                           <!--<marquee><font style="color: red ;font-size: 17px;">The last date to apply for the PG entrance examination  is extended upto 20.04.2023</marquee>-->
                           <div class="card-body" hidden="">
                              <u><b> Admission to PG/PG Diploma Programmes under Project Mode Scheme 2023-24</b></u>
                                <p>Last date of submission of application through online : 10.07.2023</p>
                                <p>Download of Hall Ticket : 13.07.2023</p>
                                <p>Tentative Schedule of Entrance Examinations : 15.07.2023 </p>
                                <p>Date of Interview : 18.07.2023</p>
                                <p>Date of publication of Result : 19.07.2023</p>
                                <p>Date of Admission : 21.07.2023</p>
                                <p>Date of commencement of classes : 24.07.2023</p>
                               <p><a href="https://ssus.ac.in/files/265/Project-Mode-Scheme-2023/2067/PG-Diploma-in-Sanskrit-computational-Linguistics-Re-Notification.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
                        P.G.Diploma in Sanskrit Computational Linguistics 2023 Admission Re-notification (Project Mode) <i class="fa fa-info-circle"></i></a> 
</p>       

                            </div>
                        @endif
                    @else
                    
                    @if(Auth::user()->pgapp_adsc_sl==997)
                       <form action="{{route('pgpayment')}}" method="post">
                          @csrf
                            <div class="card-header">
                                <h5 class="card-title m-0"><b>PAYMENT STATUS</b></h5>
                            </div>

                            <div class="card-body">
                                <!--<h5 style="color: red;">Registration is closed</h5>-->
                                
                              <div class="form-group row">
                                  <p style="font-size: 16px;"><u style="color: red">About Online Payment:</u>  Once money has been debited from your account, do not attempt to make the payment again. Sometimes it takes a while to process the payment. Check your profile regularly. 
                                      For any such issue please write to us at helpdesk@ssus.ac.in</p>
                                
                                  <p style="font-size: 16px;">ഓൺലൈൻ പേയ്‌മെന്റിനെക്കുറിച്ച്: നിങ്ങളുടെ അക്കൗണ്ടിൽ നിന്ന് പണം ഡെബിറ്റ് ചെയ്തുകഴിഞ്ഞാൽ, വീണ്ടും പണമടയ്ക്കാൻ ശ്രമിക്കരുത്. പേയ്‌മെന്റ് പ്രോസസ്സ് ചെയ്യാൻ ചിലപ്പോൾ കുറച്ച് സമയമെടുക്കും. നിങ്ങളുടെ പ്രൊഫൈൽ പതിവായി പരിശോധിക്കുക. അത്തരം പ്രശ്‌നങ്ങൾക്ക് helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ ഞങ്ങൾക്ക് എഴുതുക</p>
                              </div>
                                 <div class="form-group row">
                                  <p> <button type="submit" class="btn btn-sm btn-info">Retry Payment</button></p>
                                </div>   
                    
                             
                            </div>
                            <!--<marquee><font style="color: red ;font-size: 17px;">The last date to apply for the PG entrance examination  is extended upto 20.04.2023</marquee>-->

                       </form>  
                    @else
                      <h5 style="color: red;">Registration is closed</h5>

                    @endif


                    
                    
                     @foreach($pay_details as $key)
              
                            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">

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
