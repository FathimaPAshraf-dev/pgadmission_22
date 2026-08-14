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

                       <div class="card-header ">
                        <h5 class="card-title m-0 "><b>PG ADMISSION 2025 - ONLINE FEE PAYMENT</b></h5>
                        </div>
                
               
                  <!-- <form action="{{ route('pgadmissionpayment2022') }}" name="pgadmissionpayment" id="pgadmissionpayment" method="post"> -->
                  <form method="POST" action="https://payment.ssus.ac.in/api/payment/initiate" id="paymentForm">
  
                  @csrf

                      <!-- Hidden fields for required payment parameters -->
            <input type="hidden" name="tid" id="tid" value="{{ random_int(10000, 99999) }}" readonly>
            <input type="hidden" name="merchant_id" value="3147015">
            <input type="hidden" name="order_id" value="{{ random_int(10000, 99999) }}">
            <input type="hidden" name="currency" value="INR">
            <input type="hidden" name="redirect_url" value="https://pg.ssus.ac.in/payResponse"/>
            <input type="hidden" name="cancel_url" value="https://pg.ssus.ac.in/payResponse"/>
            <input type="hidden" name="merchant_param2" id="merchant_param2" value="PG-ADMISSION-FEE-2026">
            <input type="hidden" name="merchant_param3" id="merchant_param3" value="{{ Auth::user()->pgapp_id }}">
            <input type="hidden" name="sub_account_id" id="sub_account_id" value="{{ $account_code }}">

            <input type="hidden" name="merchant_param1" id="merchant_param1" value="{{ Auth::user()->pgapp_id}}">
          <input type="hidden" name="merchant_param4" id="merchant_param4" value="{{$merchant_param4}}">
            @foreach($allotusr as $key)
            <input type="hidden" name="amount" id="amount" value="{{$key->adm_fees}}">
            @endforeach
            <input type="hidden" name="language" value="EN">
            <!-- //split up -->
            
            <input type="hidden" name="fee_splitup" id="fee_splitup" value="{{ json_encode($feeDetails) }}">
           
            
            <!-- Billing information -->

            <input type="hidden" id="billing_name" name="billing_name" value=" {{ Auth::user()->pgapp_name }}" >
            <input type="hidden" id="billing_address" name="billing_address" value="{{  Auth::user()->comm_addressline1 }}">
            <input type="hidden" name="billing_city" value="city">
            <input type="hidden" id="billing_state" name="billing_state" value="Kerala" >
            <input type="hidden" name="billing_zip" value="{{ Auth::user()->pgapp_pincode }}">
            <input type="hidden" name="billing_country" value="India">
            <input type="hidden" id="billing_tel" name="billing_tel" value="{{ Auth::user()->pgapp_mobile }}" />
            <input type="hidden" id="billing_email" name="billing_email" value="{{ Auth::user()->pgapp_email }}" >



                    <div class="card-body col-md-8 offset-md-2">
                        @foreach($allotusr as $key)
                         <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Application Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm col-sm-8" name="appid"  value="{{Auth::user()->pgapp_id}}"readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm col-sm-8" name="appname"  value="{{Auth::user()->pgapp_name}}" readonly="">
                    </div>
                  </div>
                 <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Programme</label>
                    <div class="col-sm-8">
                       <textarea class="form-control col-sm-8" form-control-sm readonly="" rows="1">{{$key->pgm}}</textarea>
                    </div>
                  </div>
                
                        <input type="hidden" class="form-control form-control-sm col-sm-8" name="adm_centid" id="adm_centid" value="{{$key->adm_centid}}" readonly="">
                        <input type="hidden" class="form-control form-control-sm col-sm-8" name="pgmid" id="pgmid" value="{{$pgmid}}" readonly="">
    
                   <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Total Fee</label>
                    <div class="col-sm-8">
<!--                        @if(Auth::user()->pgapp_id=='ADMPG2503144' || Auth::user()->pgapp_id=='ADMPG2501231' || Auth::user()->pgapp_id=='ADMPG2500512' 
                        || Auth::user()->pgapp_id=='ADMPG2503249' || Auth::user()->pgapp_id=='ADMPG2503186' || Auth::user()->pgapp_id=='ADMPG2503775' 
                        || Auth::user()->pgapp_id=='ADMPG2503326' || Auth::user()->pgapp_id=='ADMPG2502562' || Auth::user()->pgapp_id=='ADMPG2503500' 
                        || Auth::user()->pgapp_id=='ADMPG2503675')
                        <input type="text" class="form-control form-control-sm col-sm-8" name="totfee" id="totfee" value="{{ $key->adm_fees - 8000 }}" readonly>

                        @else
                        <input type="text" class="form-control form-control-sm col-sm-8" name="totfee" id="totfee" value="{{$key->adm_fees}}" readonly="">
                        @endif-->


@php
    $discountedIds = [
        'ADMPG2503144', 'ADMPG2501231', 'ADMPG2500512',
        'ADMPG2503249', 'ADMPG2503186', 'ADMPG2503775',
        'ADMPG2503326', 'ADMPG2502562', 'ADMPG2503500',
        'ADMPG2503675','ADMPG2503103','ADMPG2503952','ADMPG2503980'
    ];
    $userId = Auth::user()->pgapp_id;
@endphp

<input type="text" class="form-control form-control-sm col-sm-8" name="totfee" id="totfee"
    value="{{ in_array($userId, $discountedIds) ? $key->adm_fees - 8000 : $key->adm_fees }}" readonly>

                    </div>
                  </div>   
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-4 col-form-label">Mode of Payment</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm col-sm-8" name="paymode" id="paymode"  value="Online" readonly="">
                    </div>
                  </div>  
                  
                
                  <div class="form-group row">
                  
                    <div class="offset-md-4">
                           <button type="submit" name="btn_payment" id="btn_payment" class="btn btn-xs btn-danger" value="Submit">Pay Now</button> 

                    </div>
                  </div>  
                       
                  @endforeach
                        </div>
                        
                  </form>
            </div>
       
           
               
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
