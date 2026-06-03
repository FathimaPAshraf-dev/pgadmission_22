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
            <h1 class="m-0 text-dark">Student Services</h1>
            
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
  
     <section class="content">


    <div class="row">

        <div class="col-md-8 col-md-offset-2">

          <div class="box box-default">
  <div class="box-header with-border">
              <!-- <i class="fa fa-bullhorn"></i>

              <h3 class="box-title"><b>No Active Notifications</b></h3> -->
            </div>
</div>
        </div>

  

            <div class="col-md-9 col-md-offset-2 new">
               
              <br>
            <div class="card card-secondary">
              <div class="card-header">
              <!-- <i class="fa fa-bullhorn"></i> -->

              <h3 class="card-title"><i class="fas fa-bell" style="text-align: center"></i>&nbsp;&nbsp;<b>Notifications</b></h3>
            </div>
                   <div id="successMessage" name="successMessage">
												</div>


            <!-- /.box-header -->
            <div class="card-body">
                
              <div class="callout callout- bg-secondary color-palette">
                
<!--                  <form action="http://app.ssus.ac.in:8082/home/course/ugpdf" method="get" id="nameform">-->
<!--                        <input name="_token" type="hidden" value="AOEmtTPt4fLNicLzY4lJG4zafTl6Jg2G0dRpGwYD" />
                           <input type="hidden" name="adsc_sl" id="adsc_sl" value="688"/>
                          <input  type="hidden" name="regno" id="regno" value="19KA01SA01"/>
                        
                            <input name="crsreg_id"  id="crsreg_id" type="hidden" value="10035" />
                            <input name="sturegsem"  id="sturegsem" type="hidden" value="3" />-->

                       
                       
  <div class="row mb-2">
                             <div class="col-sm-9"><h5><font color="white">Allotment Details</font> </h5></div>
                          <div class="col-sm-3"> 
                        <a href="/loadallotment" class="small-box-footer text-white">View Allottment status <i class="fas fa-arrow-circle-right"></i></a>
<!--                        <button type="submit" form="nameform" id="pdf" name="pdf"   class="btn bg-white  margin" style="white-space: pre-line;"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download &nbsp;-->
                        </button> 
                         </div>
                        </div>
<!--                 </form>-->
                                
                                
             </div>
              


 </div>
</div>

   
   


</section>
    <!-- /.content -->
    @endsection
