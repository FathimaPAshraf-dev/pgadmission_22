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
<!-- <h5 style="color: red;">Registration is closed</h5>-->
<div class="form-group row">
<p style="font-size: 16px;"><u style="color: red">About Online Payment:</u> Once money has been debited from your account, do not attempt to make the payment again. Sometimes it takes a while to process the payment. Check your profile regularly. 
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

<input type="hidden" name="redirect_url" value="https://pg.ssus.ac.in/pay_details">
<input type="hidden" name="cancel_url" value="https://pg.ssus.ac.in/pay_details">

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
<!-- <marquee><font style="color: red ;font-size: 17px;">The last date to apply for the PG entrance examination is 07.04.2024</marquee>-->

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

<table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table" >
<thead>
</thead>
<tbody>
<tr hidden>
<th scope="row" >
<i class="fa fa-trophy text-warning"></i>
PG Entrance Rank Details
</th>
<td>
@if(!empty($rankl))
<div class="card border-0 shadow-sm">
<div class="card-body p-3">
<p class="mb-2">
<strong>Entrance Rank :</strong>
<span class="badge badge-success">{{ $rankl }}</span>
</p>

<p class="mb-0">
<strong>Entrance Mark:</strong>
<span class="badge badge-info">{{ $finalIndexMark }}</span>
</p>
</div>
</div>
@else
<div class="alert alert-warning mb-0">
You are not included in the rank list.
</div>
@endif
</td>
</tr>

@if($feestat==1)
<tr>
<th scope="row">Admission Fee Receipt</th>
<td> 
<div class="col-sm-4" >
<a href="{{route('admfeereceipt2022')}}" target="_blank" class="btn btn-flat btn-sm btn-success">
Download <i class="fa fa-download"></i></a>
</div> 
</td>
</tr> 
@endif

<!-- @if($allotstat == 1 && $secondallot_status!='1' )

@if(Auth::user()->pgapp_adsc_sl != '1182')
<tr>
<th scope="row">First Allotment Status</th>
<td>
<div class="col-sm-12">
<div style="padding:10px; background-color:#f8f9fa; border:1px solid #dee2e6; border-radius:5px;">

@if(isset($allotstatusres[0]) && !empty($allotstatusres[0]->program_name))
<div style="
    padding:8px 12px;
    margin-bottom:12px;
    border-left:4px solid #28a745;
    background:rgba(40,167,69,0.08);
    color:#155724;
    border-radius:4px;
    font-size:14px;
">
    🎉 <strong>Congratulations!</strong> You are included in the First Allotment.
</div>
@foreach($allotstatusres as $allot)
<p><strong>Program:</strong> {{ $allot->program_name }}</p>
<p><strong>Centre:</strong> {{ $allot->centre }}</p>
<p><strong>Community:</strong> {{ $allot->app_cat }}</p>
<p><strong>Allotted Category:</strong> {{ $allot->seat }}</p>
<p><strong>Allotment Type:</strong> {{ $allot->app_allotment }}</p>

@if(!$loop->last)
<hr>
@endif
@endforeach

@else

<div class="alert alert-warning mb-0">
<strong>You are not included in the Rank List.</strong>
</div>

@endif

</div>
</div>
</td>
</tr>
@endif -->



<!-- @endif -->

@if($secondallot_status == '1')


@if(!in_array(Auth::user()->pgapp_adsc_sl, [1202]))
<tr>
<th scope="row">Third Allotment Status</th>
<td>
<div class="col-sm-12">
<div style="padding:10px; background-color:#f8f9fa; border:1px solid #dee2e6; border-radius:5px;">

@if(isset($allotstatusres2[0]) && !empty($allotstatusres2[0]->program_name))
<div style="
    padding:8px 12px;
    margin-bottom:12px;
    border-left:4px solid #28a745;
    background:rgba(40,167,69,0.08);
    color:#155724;
    border-radius:4px;
    font-size:14px;
">
    🎉 <strong>Congratulations!</strong> You are included in the Third Allotment.
</div>
@foreach($allotstatusres2 as $allot)
<p><strong>Program:</strong> {{ $allot->program_name }}</p>
<p><strong>Centre:</strong> {{ $allot->centre }}</p>
<p><strong>Community:</strong> {{ $allot->app_cat }}</p>
<p><strong>Allotted Category:</strong> {{ $allot->seat }}</p>
<p><strong>Allotment Type:</strong> {{ $allot->app_allotment }}</p>

@if(!$loop->last)
<hr>
@endif
@endforeach

@else

<div class="alert alert-warning mb-0">
<strong>You are not included in the Rank List.</strong>
</div>

@endif

</div>
</div>
</td>
</tr>
@endif

@elseif($secondallot_status!= 0 && $secondallot_status!= 1)

<tr>
<th scope="row">Second Allotment Status</th>
<td>
<div style="
padding: 15px 20px;
background-color: #fff8e1;
border-left: 4px solid #f02906;
border-radius: 5px;
color: #856404;
">
You have not been allotted a seat in this round. Please wait for the upcoming allotments.
</div>
</td>
</tr>

@endif



<!-- 
<tr>
<th scope="row">Hall Ticket</th>
<td>
@if(Auth::user()->ent_hallticket_stat == 1 && $publish_status == 1)
<div class="row">
<div class="col-sm-6">
<a href="{{ route('hallticket2022') }}" target="_blank" class="btn btn-info btn-sm btn-flat">
Download <i class="fa fa-download"></i>
</a>
</div>
<div class="col-sm-6" hidden="">
<strong>Index Mark:</strong> {{ $mark }} <br/>
<strong>Rank:</strong> {{ $rankl }}
</div>
</div>
@endif
</td>
</tr> -->

<!-- <tr>
<th>Entrance Rank</th>
<td>
Rank: {{ $rankl }}<br>
Final Index Mark: {{ $finalIndexMark }}
</td>
</tr> -->
<tr hidden="">
<th scope="row">Application Printout</th>
<td><div class="col-sm-4">
<form action="{{route('getpdf')}}" method="get" name="pdffrom">
<!--{{Auth::user()->pgapp_name}}<br><br>-->
<button type="submit" name="pdffrom" class="btn btn-info btn-sm">Download <i class="fa fa-download" aria-hidden="true"></i></button>
</form>
</div></td>
</tr>
<tr>
<th scope="row">
<i class="fa fa-file-pdf-o text-info"></i> Option Printout
</th>

<td>
@if(in_array(Auth::user()->option_stat, [1,2,3]))

<span style="color:#6c757d; margin-right:10px;">
Download your submitted options
</span>

<a href="{{ route('printoption') }}"
target="_blank"
style="
background:#17a2b8;
color:#fff;
padding:6px 12px;
border-radius:4px;
text-decoration:none;
font-size:13px;
font-weight:500;
">
<i class="fa fa-download"></i> Download
</a>

@endif
</td>
</tr>
</table>


@if(Auth::user()->pgapp_adsc_sl != '1182')
<div class="container mt-4" >

<!-- Button to toggle table visibility -->
<button class="btn btn-info mb-3" id="toggleTableBtn"> Third Allotment - Last Rank Details (For Reference)</button>

<div id="tableContainer" style="display: none;">
<!--<h4 class="mb-4">Provisional Allotment Summary (for reference): Last rank of students allotted seats, listed by program, centre, and reservation category.</h4>-->
<h4 class="mb-4">Third Allotment: Last rank details</h4>
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
@endif
<style>
#toggleTableBtn {
font-size: 16px;
}
.table th, .table td {
text-align: center;
}
</style>
<style>
.option-edit-card{
background: linear-gradient(135deg, #f8fbff, #eef4ff);
border: 1px solid #dbe7ff;
border-radius: 18px;
padding: 22px;
margin-top: 25px;
box-shadow: 0 4px 15px rgba(0,0,0,0.06);
}

.option-content{
display:flex;
align-items:center;
justify-content:space-between;
gap:20px;
flex-wrap:wrap;
}

.option-icon{
width:60px;
height:60px;
border-radius:50%;
background:#17a2b8;
color:#fff;
display:flex;
align-items:center;
justify-content:center;
font-size:24px;
}

.option-text{
flex:1;
min-width:250px;
}

.option-text h5{
margin-bottom:6px;
font-weight:700;
color:#1d3557;
}

.option-text p{
margin:0;
color:#5c677d;
font-size:15px;
line-height:1.6;
}

.modern-edit-btn{
display:inline-flex;
align-items:center;
gap:8px;
background:#17a2b8;
color:#fff !important;
padding:12px 24px;
border-radius:12px;
text-decoration:none;
font-weight:600;
transition:0.3s ease;
box-shadow:0 4px 10px rgba(45,108,223,0.25);
}

.modern-edit-btn:hover{
background:#17a2b8;
transform:translateY(-2px);
color:#fff !important;
text-decoration:none;
}

@media(max-width:768px){

.option-content{
flex-direction:column;
text-align:center;
}

.option-action{
width:100%;
}

.modern-edit-btn{
width:100%;
justify-content:center;
}
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




</div>
</div> 
</div> 
</div>
</div>
@if(!in_array(Auth::user()->pgapp_adsc_sl, [1202,]))
@if(Auth::user()->ranklist_stat==1 || Auth::user()->ranklist_stat==0)

<div class="container mt-4 mb-4">

    <div style="
        background:#f8fff8;
        border:1px solid #d4edda;
        border-left:5px solid #28a745;
        padding:25px;
        border-radius:4px;">

        <div class="row align-items-center">

@if($secondallot_status == 1 )

            <div class="col-md-9 text-left">

                <h5 style="
                    color:#155724;
                    font-weight:600;
                    margin-bottom:10px;">
                    <i class="fa fa-check-circle"></i>
                   Download Allotement Memo And Fee Structure
                </h5>

                <p style="
                    margin:0;
                    color:#495057;
                    font-size:15px;
                    line-height:1.7;">
                     Please download the Interview Memo for further
                    instructions regarding the admission process.
                </p>

            </div>

            <div class="col-md-3 text-center mt-3 mt-md-0">

                <a href="{{ route('pginterviewmemo2022') }}"
                   target="_blank"
                   class="btn btn-success">
                    <i class="fa fa-download"></i>
                    Download Memo
                </a>

            </div>

        </div>

    </div>
@endif



<!--<div class="card-body">-->
<tr>

@if( $admstat==0 )
<div class="card-header ">
<!-- <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5> -->
</div>
<div class="card-header ">
<!-- <h6 ><font style="color: red"> Admission request is not initiated. </font></h6> -->
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1 ) 
<div class="card-header ">
<!-- <h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5> -->
</div>
<!--fee date extension-->
<!--@if($id!='ADMPG2402875')-->

<div class="card-body text-center">

    <div style="
        background:#f8f9fa;
        border:1px solid #dee2e6;
        border-radius:15px;
        padding:25px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">

       

            <h5 style="color:#2c3e50;margin-bottom:15px;">
                Admission Fee Payment
            </h5>

            <p style="color:#6c757d;margin-bottom:20px;">
                Click the button below to proceed with your admission fee payment.
            </p>

            <a href="{{ route('allotmentdetails2022') }}"
               class="btn btn-success btn-lg px-5 py-2"
               style="
                    border-radius:30px;
                    font-weight:bold;
                    box-shadow:0 4px 12px rgba(40,167,69,.3);
               ">
                <i class="fa fa-credit-card"></i>
                Pay Admission Fee
            </a>

      

    </div>

</div>

<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
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
<!-- Please contact the corresponding department / centre for admission-->
</div>
@elseif($admstat==1) 
<div class="card-header ">
<h5 class="card-title m-0 "><b>ADMISSION PROCEDURE</b></h5>
</div>
<div class="card-body">
<a href="{{route('allotmentdetails2022')}}" class="btn btn-flat btn-sm btn-danger">
Pay Admission Fee <i class="fa fa-rupee-sign "></i></a>

</div>
<div class="card-header ">
<h6 ><u style="color: red">About Online Payment:</u> If cash is debited from your account,don't try to do payment again.Sometimes payment will take 1 to 2 days to success.
For any issues related to online payment please write to us, helpdesk@ssus.ac.in</h6>
</div> 
@endif
@elseif($allotstat==0)
<!-- <div class="card-header " align="center">
<h5 class="card-title m-0 danger"><font style="color: red">You are not in allotment list. Better luck next allotment.</font></h5>
</div>-->
@endif
@if(Auth::user()->pgapp_adsc_sl != '1182') 
@if($result == 1)

<div style="background:#fff8e6;border:1px solid #ffd591;border-left:6px solid #fa8c16;border-radius:12px;padding:20px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

```
<div style="display:flex;align-items:center;margin-bottom:15px;">
    <div style="font-size:30px;margin-right:12px;">⚠️</div>
    <div>
        <h4 style="margin:0;color:#d46b08;font-weight:700;">
            Third Allotment Notice
        </h4>
        <small style="color:#666;">
            Please read the following information carefully.
        </small>
    </div>
</div>

<div style="background:#ffffff;border-radius:8px;padding:15px;border:1px solid #f0f0f0;">

    <p style="line-height:1.8;color:#333;margin-bottom:15px;">
        <strong style="color:#cf1322;"><strong>മൂന്നാം അലോട്ട്മെന്റുമായി ബന്ധപ്പെട്ട പ്രധാന നിർദ്ദേശം:</strong><br>
മൂന്നാം അലോട്ട്മെന്റിൽ ഒരു ക്യാമ്പസിൽ പ്രവേശനം ലഭിച്ച അപേക്ഷകർ തുടർ അലോട്ട്മെന്റുകളിൽ ഉയർന്ന ഓപ്ഷനുകൾ (Higher Options) പരിഗണിക്കപ്പെടാൻ ആഗ്രഹിക്കുന്നുവെങ്കിൽ, അനുവദിക്കപ്പെട്ട ക്യാമ്പസിൽ നിശ്ചിത സമയപരിധിക്കുള്ളിൽ പ്രവേശനം നേടേണ്ടതാണ്.

പ്രവേശനം നേടാത്ത അപേക്ഷകരെ ഉയർന്ന ഓപ്ഷൻ പരിഗണനയ്ക്കോ തുടർ അലോട്ട്മെന്റുകളിലേക്കോ അർഹരായി പരിഗണിക്കുകയില്ല.

        
    </p>

    <hr style="border:0;border-top:1px solid #e8e8e8;margin:15px 0;">

    <p style="line-height:1.8;color:#333;margin-bottom:0;">
        <strong style="color:#cf1322;">Important Instruction Regarding Third Allotment:</strong><br>
        Candidates who have been allotted admission in a campus through the Third Allotment and wish to be considered for Higher Options in subsequent allotments must secure admission in the allotted campus within the prescribed time limit.

        Candidates who fail to take admission in the campus allotted through the Third Allotment will not be eligible for consideration under Higher Options or for participation in subsequent allotments.

        Therefore, candidates are advised to confirm their admission in the allotted campus within the stipulated time to retain eligibility for further allotment processes.
    </p>

</div>
```

</div>




<!-- <div style="
background:#f8fcfd;
border:1px solid #d1ecf1;
border-left:4px solid #17a2b8;
border-radius:8px;
padding:15px 20px;
margin:15px 0;
"> -->

<!-- <div style="
display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;
gap:15px;
">

<div> -->
<!-- <h5 style="
margin:0 0 5px 0;
color:#17a2b8;
font-weight:600;
">
<i class="fa fa-sliders"></i>
Update Your Options
</h5> -->

<!-- <p style="
margin:0;
color:#6c757d;
font-size:14px;
line-height:1.5;
">
You can rearrange, add, or remove your preferred centre options before the allotment process closes.
</p> -->
<!-- </div> -->

<!-- <a href="{{ route('reoptionindex') }}"
style="
background:#17a2b8;
color:#fff;
text-decoration:none;
padding:8px 18px;
border-radius:5px;
font-size:14px;
font-weight:600;
white-space:nowrap;
">
<i class="fa fa-pen"></i> Edit Options
</a> -->

<!-- </div> -->

<!-- </div> -->

@endif
@endif
<div class="col-sm-2" hidden="true">
<a href="{{route('documentsupload')}}" class="btn btn-flat btn-sm btn-danger" >
Upload Certificates</a>
</div>
<!-- <div class="col-sm-4" >
<a href="{{route('optionentry23')}}" class="btn btn-flat btn-sm btn-danger" >
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
