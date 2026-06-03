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
        <div class="col-sm-6">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
                 <div id="successMessage" name="successMessage">
		@if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>

		@endif
		</div>

        
                    @if(( $payment_success_count > 0))
                
                       <div class="card-header ">
                        <h5 class="card-title m-0 "><b>PG ADMISSION ONLINE APPLICATION</b></h5>
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
                @if(Auth::user()->ent_hallticket_stat==1)
               <div class="col-sm-6">
                   <a href="{{route('hallticket2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                          Download Hall Ticket  <i class="fa fa-download"></i></a>
                        
                    </div>
                 @endif    
                 @if(Auth::user()->option_stat==2)
                   <div class="col-sm-6">
                   <a href="" target="_blank" class="btn btn-flat btn-sm btn-danger">
                        test <i class="fa fa-download"></i></a>
                        
                    </div>
                 @endif   
                 
                </h6>
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
                                      For any issues related to online registration please write to us, helpdesk@ssus.ac.in.</p>
                                  <p style="font-size: 16px;">ഓൺലൈൻ പേയ്‌മെന്റിനെക്കുറിച്ച്: നിങ്ങളുടെ അക്കൗണ്ടിൽ നിന്ന് പണം ഡെബിറ്റ് ചെയ്‌താൽ, വീണ്ടും പേയ്‌മെന്റ് ചെയ്യാൻ ശ്രമിക്കരുത്. ചിലപ്പോൾ പേയ്‌മെന്റ് വിജയിക്കാൻ 1 മുതൽ 2 ദിവസം വരെ എടുക്കും. നിങ്ങളുടെ പ്രൊഫൈൽ പതിവായി പരിശോധിക്കുക. ഓൺലൈൻ രജിസ്ട്രേഷനുമായി ബന്ധപ്പെട്ട എന്തെങ്കിലും പ്രശ്നങ്ങൾക്ക്, helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ ഞങ്ങൾക്ക് എഴുതുക.</p>
                                  <button type="submit" class="btn btn-sm btn-info">Retry Payment</button>
                                </div>   
                    
                             
                            </div>
                       </form>     -->
                  
                    @endif
                    
            </div>
        </div>
  <div class="col-sm-6">
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
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
