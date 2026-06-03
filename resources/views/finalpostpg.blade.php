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
<!--                <h4 id="heading">Complete Your Profile</h4>
                <p>Fill all form field to go to next step</p>-->
                @foreach($pay_details as $key)
                    @if(($key->res_verified=='SUCCESS'))
                   
                <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0">Application Printout</h5> 
              </div>
                     
              <div class="card-body">
                <h6 class="row"> 
                    <div class="col-sm-6">
                         <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                        <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$key->merchanttxnid}}">
                        <input type="hidden" name="tdate" id="tdate" value="{{$key->tdate}}">
                        <button type="submit" name="pdffrom" class="btn btn-primary">Download PDF</button>
                    </form>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{route('editpostpg')}}" method="get" name="editfrom">
                       
                        <button type="submit" name="editfrom" class="btn btn-warning float-right">Edit Application</button>
                    </form>
                    </div>
                   
                    
</h6>

                <p class="card-text">A printed copy of the filled in applications with the following documents shall be sent to the Heads of Departments concerned, on or before 10.11.2020. The cover containing the printed copy should be superscribed 
            specifying the name of the programme and the Department. The application should be accompanied with the following</p>
                      <ol>
                           <li>Self attested copies of mark lists of the qualifying examination.</li>  
                           <li> Self attested true copies of the Provisional/ Original Degree Certificate. </li>
                           <li>No Objection Certificate from the employer, in the case of employed candidates.</li>
                           <li>True copy of Community/Caste Certificate in the case of candidates eligible for reservation). </li>
                           <li>Non Creamy Layer Certificate issued by competent authority in the case of OBC 
candidates. If no Certificate is produced the OBC candidates will be considered 
under General Category. </li>
                           <li>True copy of the Master's/P.G. Degree/M.Phil. Degree & Provisional Degree 
Certificate as the case may be.</li> 
                           <li>Candidates with UGC/JRF shall produce the proof thereof. </li> 
               
      
                      </ol>
                     
                <!--<a href="{{route('home')}}" class="btn btn-warning">Edit</a>-->
              </div>
            </div>
                    
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
                <!--<a href="{{route('home')}}" class="btn btn-warning">Edit</a>-->
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
