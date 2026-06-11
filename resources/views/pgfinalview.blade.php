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
                
                
                            
                

        
                   
                
                       <div class="card-header" >
                        <h4 class="card-title m-0 "><b>PG ADMISSION 2026</b></h4>
                        </div>
                      
                     <div class="card-header">
                         
                         
                         <div class="row">
<div class="col-md-12 ">
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">{{Auth::user()->pgapp_name}}</h3>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
<i class="fas fa-minus"></i>
</button>
</div>
</div>
<div class="card-body p-0">
    <div style="padding: 5px" >
        <div class="form-group row">
                                     
        
         @if( Auth::user()->pgapp_sl>68559)
         
         
          @if(( $payment_success_count == 0))
         
         
                       
                            <div class="card-header">
                                <!--<h5 class="card-title m-0"><b>PAYMENT STATUS, {{$payment_success_count}}</b></h5>-->
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
            <th width="2%"><font >Order ID</font></th>
          <th width="2%"><font >Amount</font></th>
          <th width="2%"><font >Date</font></th>
             <th width="2%"><font >Status</font></th>
         
              </thead>
         

            <tr>
      
       @foreach($pay_details as $ckey)

                  <td> {{$ckey->order_id}}</td> 
                  <td>{{$ckey->trans_amt}}</td>
                   <td>{{$ckey->tdate}}</td>
                    <td>{{$ckey->order_status}}</td>
                  
              
         </tr>
        @endforeach    
              
         </table>        
     </div> 




                                 <div class="form-group row">

    <form action="https://payment.ssus.ac.in/api/payment/initiate" method="post" id="pgpayment">
        {{ csrf_field() }}

        <!-- Payment Gateway Fields -->
        <input type="hidden" name="tid" value="{{ time() }}">
        <input type="hidden" name="auth_token" value="{{ encrypt(Auth::user()->pgapp_id) }}">

        <input type="hidden" name="merchant_id" value="3147015">
        <input type="hidden" name="order_id" value="PG{{ Auth::user()->pgapp_id }}{{ time() }}">
        <input type="hidden" name="currency" value="INR">

        <input type="hidden" name="redirect_url" value="https://pgadmission.ssus.ac.in/pay_details">
        <input type="hidden" name="cancel_url" value="https://pgadmission.ssus.ac.in/pay_details">

        <input type="hidden" name="merchant_param1" value="{{ Auth::user()->pgapp_id }}">
        <input type="hidden" name="merchant_param2" value="PG-APPLICATION-FEE-2026">
        <input type="hidden" name="merchant_param3" value="{{ Auth::user()->pgapp_id }}">
        <input type="hidden" name="merchant_param4" value="pgapplicationfee2026_{{ $amnt ?? 0 }}">
        <input type="hidden" name="merchant_param5" value="z">

        <input type="hidden" name="client_code" value="{{ Auth::user()->pgapp_id }}">
        <input type="hidden" name="sub_account_id" value="UNIVERSITY">

        <input type="hidden" name="language" value="EN">

        <input type="hidden" name="billing_name" value="{{ Auth::user()->pgapp_name }}">
        <input type="hidden" name="billing_address" value="{{ Auth::user()->comm_addressline1 }}">
        <input type="hidden" name="billing_zip" value="{{ Auth::user()->pgapp_pincode }}">
        <input type="hidden" name="billing_city" value="Kerala">
        <input type="hidden" name="billing_state" value="Kerala">
        <input type="hidden" name="billing_country" value="India">
        <input type="hidden" name="billing_tel" value="{{ Auth::user()->pgapp_mobile }}">
        <input type="hidden" name="billing_email" value="{{ Auth::user()->pgapp_email }}">

        <input type="hidden" name="amount" value="{{ $amnt ?? 0 }}">
        <input type="hidden" name="fee_splitup" value='@json($feeDetails ?? [])'>

        <!-- Display Table -->
        <table class="table table-bordered">
            <tr>
                <th>Payment Mode</th>
                <td>Online Payment</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $amnt ?? 0 }}</td>
            </tr>
        </table>

        <!-- Retry Button -->
        <div class="text-center mt-3">
            <button type="submit" id="retryBtn" class="btn btn-primary">
                Retry Payment
            </button>
        </div>

    </form>

</div>


         @endif
         
         
         
         
<!--                            <marquee><font style="color: red ;font-size: 17px;">The last date to apply for the PG entrance examination  is  07.04.2024</marquee>-->

                     
                     
                          
                      @else
                      <!--<h5 style="color: red;">Registration is closed</h5>-->   
                      @endif
        
        
        
        
        
        
        
        
               
         @if(( $payment_success_count > 0))
         
        @if(Auth::user()->ranklist_stat==0) 
         <table class="table table-bordered" style="width:100%;">
    <tr>
        <th style="width:40%;">Application Printout</th>
        <td style="text-align:center;">
            <form action="{{route('getpdf')}}" method="get">
                <button type="submit" class="btn btn-info btn-sm">
                    Application Printout <i class="fa fa-download" aria-hidden="true"></i>
                </button>
            </form>
        </td>
    </tr>
</table>
<br>
         @endif
         
          
               
         
         
         
         
         
         
         
         
        
         @if(Auth::user()->ranklist_stat==1 || Auth::user()->ranklist_stat==0)
        
        @if($allotstat==10000000 )
                            <div class="card-header " >
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div>
                             <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                <!--<div class="card-body">-->
                                
                            @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
                            </div>
                           @elseif($admstat==1 ) 
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                           </div>
                           
                           <!--fee date extension-->
                          <!--@if($id!='ADMPG2402875')-->
                          @if(Auth::user()->pgapp_id =='ADMPG2503500' || Auth::user()->pgapp_id =='ADMPG2503092' || Auth::user()->pgapp_id =='ADMPG2501281' || Auth::user()->pgapp_id =='ADMPG2502973'
                          || Auth::user()->pgapp_id =='ADMPG2500513' || Auth::user()->pgapp_id =='ADMPG2501273' || Auth::user()->pgapp_id =='ADMPG2500526' || Auth::user()->pgapp_id =='ADMPG2500512' || Auth::user()->pgapp_id =='ADMPG2501026'
                          
                          || Auth::user()->pgapp_id =='ADMPG2502220' || Auth::user()->pgapp_id =='ADMPG2500411' || Auth::user()->pgapp_id =='ADMPG2502292' || Auth::user()->pgapp_id =='ADMPG2501924'
                          || Auth::user()->pgapp_id =='ADMPG2502579'
                          || Auth::user()->pgapp_id =='ADMPG2502027' || Auth::user()->pgapp_id =='ADMPG2502958'|| Auth::user()->pgapp_id =='ADMPG2500897' || Auth::user()->pgapp_id =='ADMPG2501181' 
                          || Auth::user()->pgapp_id =='ADMPG2500366' || Auth::user()->pgapp_id =='ADMPG2501247' || Auth::user()->pgapp_id =='ADMPG2503144' || Auth::user()->pgapp_id =='ADMPG2503008')
                             <div class="card-body" >
                            <a href="{{route('allotmentdetails2022')}}"  class="btn btn-flat btn-sm btn-danger">
                                Pay Admission Fee <i class="fa fa-rupee-sign	"></i></a>                             

                            </div>
                          @endif
                              <div class="card-header ">
                               <h6 ><u style="color: red">About Online Payment:</u>  If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
                                                   For any issues related to online payment please write to us, helpdesk@ssus.ac.in</h6>
                           </div>
                             @endif
                            
                           
                           
                                
                           
                        
                             
                             @endif
                                
                                
                                
                                

                                <!--</div>-->
                                
                                 @elseif($allotstat==2)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>SECOND ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <!--<h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>-->
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             
                             
                             @elseif($allotstat==3)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>THIRD ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             
                             
                              @elseif($allotstat==4)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>FOURTH ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             @elseif($allotstat==50)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>FIFTH ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             @elseif($allotstat==60)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>SIXTH ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             @elseif($allotstat==70)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>SEVENTH ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             @elseif($allotstat==80)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>EIGHTH ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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

                             @elseif($allotstat==90)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>NINTH ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             
                             
                              @elseif($allotstat==5)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>SPOT ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             
                             @elseif($allotstat==6)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>SPOT ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             @elseif($allotstat==4000)
                            
                           <div class="card-header ">
                               <h5 class="card-title m-0 "><b>SPECIAL ALLOTMENT DETAILS</b></h5>
                           </div>
                                <div class="card-header ">
                                   <h4 class="card-title m-0 "><font style="color: green">Happy to inform that you are selected for PG Admission. Please download the Interview Memo</font></h4>
                               <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                                    Interview Memo <i class="fa fa-download"></i></a>
                                </div>
                                 
                                 @if( $admstat==0 )
                              <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
                            </div>
                             <div class="card-header ">
                               <h6 ><font style="color: red"> Admission request is not initiated. </font></h6>
<!--                               Please contact the corresponding department / centre for admission-->
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
                             
                            @elseif($allotstat==0)
                            
<!--                            <div class="card-header " align="center">
                                 <h5 class="card-title m-0 danger"><font style="color: red">You are not in allotment list. Better luck next allotment.</font></h5>
                             </div>-->
                            @endif
        
                             <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table" >
  <thead>
    
  </thead>
  <tbody>
      
      
       @if($feestat==1)
    <tr>
      <th scope="row">Admission Fee Receipt</th>
     
     
      <td> 
                   <div class="col-sm-4" >
                   <a href="{{route('admfeereceipt2022')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                        Download  <i class="fa fa-download"></i></a>
                        
                   </div> 
       </td>
     </tr>    
     @endif
      
      
       @if($allotstat==10)
<!--    <tr>
      <th scope="row">Interview Memo</th>
     
     
      <td> 
                   <div class="col-sm-4" >
                   <a href="{{route('pginterviewmemo2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                        Download  <i class="fa fa-download"></i></a>
                        
                   </div> 
       </td>
     </tr>    -->

    

     <tr>
  <th scope="row">Trial Allotment Status</th>
  <td>
    <div class="col-sm-12">
      <div style="padding: 10px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
      @foreach($allotstatusres as $allotstatusres)
        <p><strong>Program:</strong> {{ $allotstatusres->program_name }}</p>
        <p><strong>Centre:</strong> {{ $allotstatusres->centre }}</p>
        <p><strong>Community:</strong> {{ $allotstatusres->app_cat }}</p>
        <p><strong>Allotted Category:</strong> {{ $allotstatusres->seat }}</p>
        <p><strong>Allotment Type:</strong> {{ $allotstatusres->app_allotment }}</p>
        @endforeach
      </div>
    </div>
  </td>
</tr>

@elseif($allotstat==0)
                            
  <div class="card-header " align="center" hidden="">
           <h5 class="card-title m-0 danger"><font style="color: red">You have not been allotted a seat in this round. Please wait for the upcoming allotments. Wishing you the best of luck!</font></h5>
     </div>
 

     @endif




     <tr hidden="">
    <th scope="row">Hall Ticket</th>
    <td>
       
        @if($publish_status == 1)
            <div class="row">
                
                <div class="col-sm-6">
                    <a href="{{ route('hallticket2022') }}" target="_blank" class="btn btn-info btn-sm btn-flat">
                        Download <i class="fa fa-download"></i>
                    </a>
                </div>
                <div class="col-sm-6">
                    <strong>Index Mark:</strong> {{ $mark }} <br/>
                    <strong>Rank:</strong> {{ $rankl }}
                </div>
            </div>
        @endif
    </td>
</tr>

   
<tr hidden="">
      <th scope="row">Application Printout</th>
    
      <td><div class="col-sm-4">
                      <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                          <!--{{Auth::user()->pgapp_name}}<br><br>-->
                        <button type="submit" name="pdffrom" class="btn btn-info btn-sm">Download <i class="fa fa-download" aria-hidden="true"></i></button>
                    </form>
                    </div></td>
    </tr>
    <tr hidden="">
      <th scope="row">Option Printout</th>
     
     
      <td> @if(Auth::user()->option_stat==1 || Auth::user()->option_stat==2 || Auth::user()->option_stat==3)
                   <div class="col-sm-4" >
                   <a href="{{route('printoption')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                        Download  <i class="fa fa-download"></i></a>
                        
                   </div> 
                 @endif</td>
     </tr>
     
     
     
                             </table>




                           
                            <div class="container mt-4" hidden="">

        <!-- Button to toggle table visibility -->
        <button class="btn btn-info mb-3" id="toggleTableBtn">Show Allotment Details(For reference)</button>

        <div id="tableContainer" style="display: none;">
            <!--<h4 class="mb-4">Provisional Allotment Summary (for reference): Last rank of students allotted seats, listed by program, centre, and reservation category.</h4>-->
            <h4 class="mb-4">First Allotment: Last rank details</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Allotment Type</th>
                        <th>Program</th>
                        <th>Centre</th>
                        <th>Open</th>
                        <th>Ezhava</th>
                        <th>Muslim</th>
                        <th>OBH</th>
                        <th>OBX</th>
                        <th>LC/SIUC</th>
                        <th>SC</th>
                        <th>ST</th>
                        <th>EWS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seatAllocations as $allocation)
                    <tr>
                        <td>{{ $allocation->app_allotment }}</td>
                        <td>{{ $allocation->adscname }}</td>
                        <td>{{ $allocation->centcode }}</td>
                        <td>{{ $allocation->open ?? '-' }}</td>
                        <td>{{ $allocation->ezhava ?? '-' }}</td>
                        <td>{{ $allocation->muslim ?? '-' }}</td>
                        <td>{{ $allocation->obh ?? '-' }}</td>
                        <td>{{ $allocation->obx ?? '-' }}</td>
                        <td>{{ $allocation->lc_siuc ?? '-' }}</td>
                        <td>{{ $allocation->sc ?? '-' }}</td>
                        <td>{{ $allocation->st ?? '-' }}</td>
                        <td>{{ $allocation->ews ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        #toggleTableBtn {
            font-size: 16px;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>

    <script>
        document.getElementById('toggleTableBtn').addEventListener('click', function() {
            const tableContainer = document.getElementById('tableContainer');
            const buttonText = tableContainer.style.display === 'none' ? 'Hide Allotment Details' : 'Show Allotment Details(For reference)';
            tableContainer.style.display = tableContainer.style.display === 'none' ? 'block' : 'none';
            this.textContent = buttonText;
        });
    </script>



      @if($result == 1234)
          <a href="{{ route('reoptionindex') }}" class="btn btn-primary">
              Edit Option
          </a>
      @else
          <!--<p>edit option closed.</p>-->
      @endif



        
        
                           </div>
                   
              
              </div> 
         </div> 
         </div>
    </div>
                         
                         
                         
                         
    
   <div class="col-sm-2" hidden="true">
                     <a href="{{route('documentsupload')}}"  class="btn btn-flat btn-sm btn-danger" >
                      Upload Certificates</a>
                    </div>
  
<!--                      <div class="col-sm-4" >
                       <a href="{{route('optionentry23')}}"  class="btn btn-flat btn-sm btn-danger"  >
                       Option <i class="fa fa-edit"></i></a>
                       </div>-->
                     
                   @endif     
                      @endif     
            </div>
       

        
        
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
