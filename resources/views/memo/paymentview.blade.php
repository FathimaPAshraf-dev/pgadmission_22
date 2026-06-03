@extends('layouts.app')

@section('styles')

@stop


@section('scripts')


@stop
@section('tittle')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">M.PHIL/PH.D ALLOTMENT -2020</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              
<!--              <li class="breadcrumb-item">Desktop</li>-->
              
<!--              <li class="breadcrumb-item">Mobile</li>-->
          
            
<!--              <li class="breadcrumb-item"><a href="#">Home</a></li>-->
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop
@section('content')

    


    <!-- Main content -->
  
   <section class="content-header">

          <!-- Horizontal Form -->
          <div class="card card-info">
               <div id="successMessage" name="successMessage">
						@if(Session::has('message'))
						<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>

						@endif
		</div>
            <div class="card-header">
                <h3 class="card-title"><b>M.PHIL/PH.D Admission-2020</b></h3>
            </div>
               <div class="form-group row">
               <marquee><font style="color:red; font-size: 17px;">
              About Online Payment: If cash is debited from your account, do not try payment again.Sometimes payment will take 1 to 2 days to success.Please check your profile regularly
                   </font></marquee>
                 </div>
              
                             <form method="post" action="/mphiladmpayment">
                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                
              
              <div class="card-body">
                                  <p style="text-align: center;  font-family: arial, sans-serif;font-weight:bold;font-size: 13px;">If any query regarding online payment please send email to helpdesk@ssus.ac.in</p>

                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Application Id</label>

                  <div class="col-sm-5">
                      
                      <input type="text" readonly="" class="form-control col-md-8" id="adm_appid" name="adm_appid" placeholder="" value="{{Auth::user()->postpgapp_appid}}">
                  </div>
                </div>
                     <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-5">
                      <input type="text" readonly class="form-control col-md-8" id="stud_name" name="stud_name" placeholder="" value="{{Auth::user()->postpgapp_studname}} ">
                  </div>
                </div>
                  @foreach($postpgadm as $key) 
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Fee</label>

                  <div class="col-sm-5">
                      <input type="text" readonly class="form-control col-md-8" id="adm_fees" name="adm_fees" placeholder="" value="{{$key->adm_fees}}">
                  </div>
                </div>
                  @endforeach
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Payment mode</label>

                  <div class="col-sm-5">
                      <input type="text" readonly class="form-control col-md-8" id="paymentmode" name="paymentmode" placeholder="" value="Online Payment">
                  </div>
                </div>
               @if(empty($response))
                    <div class="col-md-12 text-center">
                     <button type="submit"class="btn btn-info " >PAY NOW</button>  
                    </div>

     @endif                      
               
        
          </div>
                             </form>
              
              
             
                 @foreach($response as $key1)  
                @if($key1->res_verified =='SUCCESS')
                 <form method="get" id="payment" name="payment" action="/pay_details/receiptdownload">
               <div class="col-md-12 text-center">
<button form="payment"type="submit"class="btn btn-info"  >DOWNLOAD</button>  
</div>
                </form>
           
                @else($key1->res_verified!='SUCCESS')
               
                       <form method="get" id="retry" name="retry" action="/pay_details/viewpayment">    
               
                          <div class="col-md-12 text-center">
<button form="retry"type="submit"class="btn btn-info"  >RE-TRY</button>  
</div>  
               
                       </form>
               @endif
            @endforeach  
                           
                         

          </div>       
   </section>
    <!-- /.content -->
    @endsection
