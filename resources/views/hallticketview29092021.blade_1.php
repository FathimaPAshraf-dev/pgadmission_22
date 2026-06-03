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
<!--                <h4 id="heading">Complete Your Profile</h4>
                <p>Fill all form field to go to next step</p>-->
                @foreach($pay_details as $key)
        
                    @if(($key->res_verified=='SUCCESS'))
                   
                <div class="card">
              <div class="card-header">
                  <h5 class="card-title m-0"><b>PG ADMISSION 2021</b></h5> 
              </div>
                     
              <div class="card-body">
                <h6 class="row">
                     @if(count($postpgadm)>0)
                    <div class="col-sm-3">
                         <form action="{{route('viewpayment')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom1" class="btn btn-danger">PG Admission Online Payment</button>
                    </form>
                    </div>
                @endif
                
                
                 @if($key->pgapp_id!='ADMPPG21100038')
                    <div class="col-sm-3">
                         <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom" class="btn btn-primary">Download Application Print out</button>
                    </form>
                    </div>
                 
<!--                                                      <div class="col-sm-3">
                         <form action="{{route('changeexamcentre')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom1" class="btn btn-success">Click here to change Exam Centre</button>
                    </form> 
                    </div>-->
                 
                 
                                     <div class="col-sm-3">
                         <form action="{{route('hallticketdownload')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom1" class="btn btn-success">Download hallticket</button>
                    </form> 
                    </div>
  @endif
            @if($pubstatus=='1')

<!--                  <div class="col-sm-3">
                         <form action="{{route('loadallotment')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom1" class="btn btn-primary">View Allottment Status</button>
                    </form>
                    </div> -->
@endif


               
<!--                    @if($adsc_sl<799 && $key->pgapp_indexmark=='')-->
<!--                    <div class="col-sm-3">
                         <form action="{{route('hallticketdownload')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom1" class="btn btn-success">Download hallticket</button>
                    </form> 
                    </div>-->
<!--                    @endif-->

              
<!--                    <div class="col-sm-3">
                         <form action="{{route('loadallotment')}}" method="get" name="pdffrom1">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom1" class="btn btn-primary">View Allottment Status</button>
                    </form>
                    </div> -->

                    
</h6>
              </div>
            </div>
                  <p style="font-size: 17px; text-align: center;"><b><u>Instructions to the Candidates</u></b></p>   
                
    <p  style="font-size: 16px;">Candidates are advised to be present in the Examination Hall of the concerned Department / Centre 30
        minutes before the commencement of the examination.<br><br>
        
The Admit Card must be brought by all candidates for entering the Examination Hall and shall be
produced for verification during the examination. No candidate will be allowed to write the examination
without his/her Admit Card.<br><br>

The candidate shall affix an identical passport size photograph that was uploaded during online registration.<br><br>

<b>Candidates will not be allowed to take the examination, if they arrive after the
    commencement of the examination.</b><br><br>

Duration of the written test will be three hours.<br><br>

Candidates found resorting to unfair means will be disqualified.<br><br>

Either blue or black ink shall be used in writing the examination.<br><br>

Roll numbers shall be legibly written both in words and figures in the space provided.<br><br>

Candidates shall not write their names or identification marks inside the answer book, doing so will be a disqualification.<br><br>

The candidates shall abide by the instructions given to them by the invigilator and any disobedience will be a disqualification.<br><br>

Admit Cards are issued provisionally to all candidates, who have applied, subject to subsequent verification of eligibility.<br><br>



* If any defect is found at the time of verification, the application will summarily be rejected.<br><br>

* All the applicants are allowed to appear for the entrance exam provisionally.<br><br>

* If anyone is found not eligible in terms of the qualification,remittance of fee etc. his/her candidature will
summarily be rejected at any stage of selection/admission procedure.<br><br>
  
* The Candidates shall wear a mask throughout and shall strictly adhere to COVID 19 protocol issued by the Government of Kerala.
    </p>
    
    <p style="text-align: center;">***</p>
      
                    
                    @else
                    <div class="card">
                        <form action="{{route('paymentstatus')}}" method="get">
                            <div class="card-header">
                              <h5 class="card-title m-0">Payment status</h5>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                                <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                              <!--<h6 class="card-title">Special title treatment</h6>-->

                              <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                              <button type="submit" class="btn btn-primary">Check Payment Status</button>
                            </div>
                       </form>     
                    </div>
                    @endif
               @endforeach
            </div>
        </div>
  <div class="col-sm-6">
              @foreach($pay_details as $key)
              
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
             
<!--                <h4 id="heading">Complete Your Profile</h4>
                <p>Fill all form field to go to next step</p>-->
              
                    <form>
                <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0">Payment Details</h5>
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
                    @if(($key->res_verified=='SUCCESS')||(Auth::user()->onlinepay_status==1))      
              <div class="card-body">
                <!--<h6 class="card-title">Special title treatment</h6>-->

                <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                <!--<a href="{{route('getpdf')}}" class="btn btn-primary">Download PDF</a>-->
<!--                <a href="{{route('home')}}" class="btn btn-warning">Edit</a>-->
              </div>
                      @endif
            </div>
                    </form>
                 
            </div>
             
                  
               @endforeach         
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
