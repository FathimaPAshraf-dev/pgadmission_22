@extends('layouts.app')
@section('styles')
<style>
/*    .test{
        background-color: #9CC3D5FF;
    }*/
  
    .card-title{
        text-align: center;
    }
    .row{
        height: 100%;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    .prnt{
         background-color: #737270;
    }
</style>
@stop
@section('tittle')

@stop
@section('content')
<br>
 <section class="content">
     
        <div class="row">
      <!-- Default box -->
      <div class="col-md-9 col-md-offset-2 new">
      <div class="card card-secondary " id="tab_1">
        <div class="card-header" >
       
         <h3 class="card-title"> <b>Payment Details</b></h3>
        
        </div>
        
          <div class="card-body justify-content-cente" style="">
              <!--<div class="callout callout- bg-white color-palette">-->
                @foreach($xmlvalues as $value=> $id)
                <p>{{$value}} : {{$id}}  
                @if((strtoupper($value)=='VERIFIED')&&(strtoupper($id)=='SUCCESS'))
                         <form action="{{route('getpdf')}}" method="post" id="examindex" class="form-horizontal">

             
                   <div class="col-sm-6">
                              <a href="{{route('pay_details')}}" class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>
                              <!-- <a href="#" class="btn btn-info"><i class="fas fa-times"></i>  Click Here to Download Pdf</a> -->

                   </div>
                
                        </form>
                @endif
                @if((strtoupper($value)=='VERIFIED')&&(strtoupper($id)=='FAILED'))
                             <form action="{{route('postpgpayment')}}" method="post" id="nodata" class="form-horizontal">
                            <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$merchanttxnid}}">
                            <input type="hidden" name="tdate" id="tdate" value="{{$tdate}}">
                            @csrf
                   <div class="col-sm-6">  
                                  <a href="{{route('pay_details')}}" class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>

                                  <button type="submit" form="nodata" id="examindex" 
                            class="btn bg-danger " style="white-space: pre-line;" ><i class="fa fa-sync" aria-hidden="true"></i> Try Again
                           </button> 
                   </div>
                
                        </form>
                @endif
                   @if((strtoupper($value)=='VERIFIED')&&(strtoupper($id)=='NODATA'))
                         <form action="{{route('postpgpayment')}}" method="post" id="nodata" class="form-horizontal">
                            <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$merchanttxnid}}">
                            <input type="hidden" name="tdate" id="tdate" value="{{$tdate}}">
                        @csrf
                   <div class="col-sm-6">  
                                  <a href="{{route('pay_details')}}" class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>

                                  <button type="submit" form="nodata" id="examindex" 
                            class="btn bg-danger " style="white-space: pre-line;" ><i class="fa fa-sync" aria-hidden="true"></i> Try Again
                           </button> 
                   </div>
                
                        </form>
                @endif
                    @if((strtoupper($value)=='VERIFIED')&&(strtoupper($id)=='INITIATED'))
                        <form action="{{route('postpgpayment')}}" method="post" id="nodata" class="form-horizontal">
                            <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$merchanttxnid}}">
                            <input type="hidden" name="tdate" id="tdate" value="{{$tdate}}">
                            @csrf
                   <div class="col-sm-6">  
                                  <a href="{{route('pay_details')}}" class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>

                                  <button type="submit" form="nodata" id="examindex" 
                            class="btn bg-danger " style="white-space: pre-line;" ><i class="fa fa-sync" aria-hidden="true"></i> Try Again
                           </button> 
                   </div>
                
                        </form>
                @endif
                
                 @if((strtoupper($value)=='VERIFIED')&&(strtoupper($id)=='PENDING FROM BANK'))
                    <form action="{{route('postpgpayment')}}" method="post" id="nodata" class="form-horizontal">
                            <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$merchanttxnid}}">
                            <input type="hidden" name="tdate" id="tdate" value="{{$tdate}}">
             @csrf
                   <div class="col-sm-6">  
                                  <a href="{{route('pay_details')}}" class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>

                                  <button type="submit" form="nodata" id="examindex" 
                            class="btn bg-danger " style="white-space: pre-line;" ><i class="fa fa-sync" aria-hidden="true"></i> Try Again
                           </button> 
                   </div>
                
                        </form>
                @endif
                
                     @if((strtoupper($value)=='VERIFIED')&&(strtoupper($id)=='INITIALIZED'))
                    <form action="{{route('postpgpayment')}}" method="post" id="nodata" class="form-horizontal">
                            <input type="hidden" name="merchanttxnid" id="merchanttxnid" value="{{$merchanttxnid}}">
                            <input type="hidden" name="tdate" id="tdate" value="{{$tdate}}">
             @csrf
                   <div class="col-sm-6">  
                                  <a href="{{route('pay_details')}}" class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>

                                  <button type="submit" form="nodata" id="examindex" 
                            class="btn bg-danger " style="white-space: pre-line;" ><i class="fa fa-sync" aria-hidden="true"></i> Try Again
                           </button> 
                   </div>
                
                        </form>
                @endif
                </p>
                 @endforeach
             </div>
              <!--</div>-->
      </div>
        </div>
        </div>
    </section>
@stop

