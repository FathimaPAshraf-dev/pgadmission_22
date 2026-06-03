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
                        <a href="https://ssus.ac.in/files/264/PG-Admission-2023/2030/PROGRAMME--CAMPUS-WISE-LIST.pdf"
                           class="btn btn-sm btn-secondary" target="_blank">PG ADMISSION 2023 PROGRAMME – CAMPUS WISE LIST </a>
                    </div>
                    
                    
                    @endif
                    
                      @if($allotstat==3)
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
                            
                             @if($allotstat==0 && Auth::user()->pgapp_adsc_sl<996)
                             
                              @if(Auth::user()->pgapp_sl<=59865)
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div>
                             <div class="card-header " align="center">
                                 <h5 class="card-title m-0 danger"><font style="color: red">You are not in allotment list. Better luck next allotment.</font></h5>
                             </div>
                             @endif
                             @endif
                              @if($allotstat==5 && Auth::user()->pgapp_adsc_sl<996)
                             <div class="card-header ">
                               <h5 class="card-title m-0 "><b>ALLOTMENT DETAILS</b></h5>
                           </div>
                             <div class="card-header " align="center">
                                   <h5 class="card-title m-0 danger"><font style="color: red">No change in previous allotment</font></h5>
                             </div>
                             
                             @endif
                    
                    <div class="card-body">
                    <h6 class="row"> 
                    <div class="col-sm-4">
                      <form action="{{route('getpdf')}}" method="get" name="pdffrom">
                        <button type="submit" name="pdffrom" class="btn btn-info">Application printout <i class="fa fa-download" aria-hidden="true"></i></button>
                    </form>
                    </div>
                   @if(Auth::user()->pgapp_adsc_sl==996||Auth::user()->pgapp_adsc_sl==997||Auth::user()->pgapp_adsc_sl==998)                   
<!--                    <div class="col-sm-6">
                        <form action="{{route('editpg')}}" method="get" name="editfrom">
                       
                        <button type="submit" name="editfrom" class="btn btn-warning float-right">Edit Application <i class="fa fa-edit" aria-hidden="true"></i></button>
                    </form>
                    </div>-->
                   @endif
                   
                @if(Auth::user()->ent_hallticket_stat==1)
<!--               <div class="col-sm-4">
                   <a href="{{route('hallticket2022')}}" target="_blank" class="btn btn-flat btn-sm btn-danger">
                          Download Hall Ticket  <i class="fa fa-download"></i></a>
                        
                    </div>-->
                 @endif    
                 @if(Auth::user()->option_stat==1 || Auth::user()->option_stat==2)
                   <div class="col-sm-4">
                   <a href="{{route('printoption')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
                        Download Option <i class="fa fa-download"></i></a>
                        
                   </div> 
                 @endif
                @if(Auth::user()->ranklist_stat==1 && Auth::user()->option_stat==0)
<!--                   <div class="col-sm-4">
                   <a href="{{route('optionentry23')}}"  class="btn btn-flat btn-sm btn-danger" >
                   Option entry</a>
                   </div>-->
                @endif
                @if(Auth::user()->ranklist_stat==1)
                 @if(Auth::user()->directory_docs!="")
<!--                 <div class="col-sm-2">
                  <a href="{{route('documentsupload')}}"  class="btn btn-flat btn-sm btn-danger" >
                   Upload Certificates</a>
                 </div>-->
                 <div class="col-sm-2">    
                 <a href="{{url(Auth::user()->directory_docs)}}" target="_blank" class="btn btn-xs btn-secondary">
                  View uploaded file
                 </a>
                 </div>     
                 @else
                 
<!--                  <div class="col-sm-4">
                   <a href="{{route('documentsupload')}}"  class="btn btn-flat btn-sm btn-danger" >
                   Upload Certificates</a>
                        <p><b>Document upload will be available after 5 pm</b></p>
                        
                   </div>-->
                 @endif
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
                          
                       
                            
                          @if($allotstat==1 && $admstat==0 )
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
<!--                          </div>-->
                      @endif
                    
            </div>
       

        
        
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
