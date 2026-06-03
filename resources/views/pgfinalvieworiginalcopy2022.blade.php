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
                
                       <div class="card-header ">
                        <h5 class="card-title m-0 "><b>PG ADMISSION ONLINE APPLICATION 2022</b></h5>
                        </div>
                    <div class="card-body">
                    <h6 class="row"> 
                    <div class="col-sm-4">
                         <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                        <button type="submit" name="pdffrom" class="btn btn-info">Download PDF <i class="fa fa-download" aria-hidden="true"></i></button>
                    </form>
                    </div>
                      
                
<!--                    <div class="col-sm-6">
                        <form action="{{route('editpg')}}" method="get" name="editfrom">
                       
                        <button type="submit" name="editfrom" class="btn btn-warning float-right">Edit Application <i class="fa fa-edit" aria-hidden="true"></i></button>
                    </form>
                    </div>-->
                @if(Auth::user()->ent_hallticket_stat==3)
<!--               <div class="col-sm-4">
                   <a href="{{route('hallticket2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                          Download Hall Ticket  <i class="fa fa-download"></i></a>
                        
                    </div>-->
                 @endif    
                 @if(Auth::user()->option_stat==3)
                   <div class="col-sm-4">
                   <a href="{{route('printoption')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                        Download Option <i class="fa fa-download"></i></a>
                        
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
                          
                        <div class="card px-3 pt-4 pb-0 mt-3 mb-3">

                          @if($allotstat==0 )
<!--                          <div class="card-header">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div>
                           <div class="card-header ">
                               <h6 >Better luck next time {{Auth::user()->pgapp_name}}, &nbsp; you are not included in allotment !!!</h6>
                               

                           </div>-->
                          @elseif($allotstat==1 || $allotstat==2 || $allotstat==3)
                          <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div>
                           <div class="card-header ">
                               <h6 >Allotment is over</h6>
                           </div>

                          @elseif($allotstat==5)
                          <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div> 

<!--                          <div class="card-header ">
                              <h6 >Hi {{Auth::user()->pgapp_name}} ,</h6>
                              <p>  <marquee style="color: #FFFFFF; font-size: 16px" bgcolor="gray"  direction="right"><b>Congratulations !!!</b></marquee></p>

                              <p style="font-size: 15px;">  Happy to inform that you are selected for admission to PG Program 2022.
                                  Kindly download the Interview Memo for admission to the Program and be present on the date and time in the
                                  respective Dept./Centre prescribed along with original certificates for completing admission procedure.</p>
                           </div>-->

                            <div class="card-body">
                            <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                Interview Memo <i class="fa fa-download"></i></a>

                            </div>
             <!--             <div class="card-body">
                             <p style="font-size: 15px;">Closed</p>
                          </div>-->

                          @endif

                         </div>
                          <div class="card px-3 pt-4 pb-0 mt-3 mb-3">

                           
                             @if($admstat==1 && $allotstat==2  && $allotstat==3) 
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                           </div>
                             <div class="card-body">
                             <p style="font-size: 15px;">Payment closed now</p>
                            </div>
                             @elseif($admstat==1 && $allotstat==4 && $feestat==0)
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                            
                               <div class="card-body">
                                <a href="#"  class="btn btn-flat btn-sm btn-danger">
                                Payment closed </a>
                               </div> 
                            
<!--                             <div class="card-body">
                            <a href="{{route('allotmentdetails2022')}}"  class="btn btn-flat btn-sm btn-danger">
                                Pay Admission Fee <i class="fa fa-rupee-sign	"></i></a>

                            </div>
                             <div class="card-header ">
                               <h6 ><u style="color: red">About Online Payment:</u>  If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
                                                   For any issues related to online payment please write to us, helpdesk@ssus.ac.in</h6>
                           </div>-->
                          
                           
                           @elseif($admstat==1 && $allotstat==5 && $feestat==0)
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                            
                               <div class="card-body">
                                <a href="#"  class="btn btn-flat btn-sm btn-danger">
                                Payment closed </a>
                               </div> 
                            
<!--                             <div class="card-body">
                            <a href="{{route('allotmentdetails2022')}}"  class="btn btn-flat btn-sm btn-danger">
                                Pay Admission Fee <i class="fa fa-rupee-sign	"></i></a>

                            </div>
                             <div class="card-header ">
                               <h6 ><u style="color: red">About Online Payment:</u>  If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
                                                   For any issues related to online payment please write to us, helpdesk@ssus.ac.in</h6>
                           </div>-->

                             @elseif($admstat==0 && $feestat==0)
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 >Admission request is not initiated</h6>
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

                    
                    
                    @else
                      <div class="card-body">
                        <div class="card-header with-border" style="text-align: center;">
                            <h5 style="color: red">Sorry, You did not complete the payment process. Registration is closed !!!</h5>
                      </div>

                    </div>
<!--                        <form action="{{route('pgpayment')}}" method="post">
                          @csrf
                            <div class="card-header">
                                <h5 class="card-title m-0"><b>PAYMENT STATUS</b></h5>
                            </div>
                          
                            <div class="card-body">
                              <div class="form-group row">
                                  <p style="font-size: 16px;"><u style="color: red">About Online Payment:</u>  If cash is debited from your account,don't try to do  payment again.Sometimes payment will take 1 to 2 days to success.Please check your profile regularly.
                                     
                                  <p style="font-size: 16px;"> For any issues related to online registration please write to us, helpdesk@ssus.ac.in.</p>
                                  
                                  <p style="font-size: 16px;">ഓൺലൈൻ പേയ്‌മെന്റിനെക്കുറിച്ച്: നിങ്ങളുടെ അക്കൗണ്ടിൽ നിന്ന് പണം ഡെബിറ്റ് ചെയ്‌താൽ, വീണ്ടും പേയ്‌മെന്റ് ചെയ്യാൻ ശ്രമിക്കരുത്. ചിലപ്പോൾ പേയ്‌മെന്റ് വിജയിക്കാൻ 1 മുതൽ 2 ദിവസം വരെ എടുക്കും. നിങ്ങളുടെ പ്രൊഫൈൽ പതിവായി പരിശോധിക്കുക. ഓൺലൈൻ രജിസ്ട്രേഷനുമായി ബന്ധപ്പെട്ട എന്തെങ്കിലും പ്രശ്നങ്ങൾക്ക്, helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ ഞങ്ങൾക്ക് എഴുതുക.</p>
                              </div>
                                 <div class="form-group row">
                                  <p> <button type="submit" class="btn btn-sm btn-info">Retry Payment</button></p>
                                </div>   
                    
                             
                            </div>
                       </form>     -->
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
