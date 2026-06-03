@extends('layouts.master')

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
            <h1 class="m-0 text-dark">M.PHIL ADMISSION ALLOTMENT -2020</h1>
            
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
            <div class="card-header">
                <h3 class="card-title"><b>PG Admission-2020</b></h3>
            </div>
            <br>@foreach($results as $key)
 <marquee   behavior="alternate" direction="left">Congratulations {{$key->pgapp_name}}  !!!</marquee>
 @endforeach
            <!-- /.box-header -->
            <!-- form start -->
            <br>
   

             @foreach($view as $key1) 
                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
              
              <div class="card-body">
                  
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Application Id</label>

                  <div class="col-sm-5">
                      
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->appid}}">
                  </div>
                </div>
                     <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->appname}}">
                  </div>
                </div>
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allot Centre</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_cent}}">
                  </div>
                </div>
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allot Category</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_category}}">
                  </div>
                </div>
                   <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Rank</label>

                  <div class="col-sm-5">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->rank}}">
                  </div>
                </div>
                   
                  
                       <form method="get" action="/downloadmemo">
    <button type="submit"class="btn btn-primary"  >DOWNLOAD INTERVIEW MEMO</button>
    
    
    
    
<!--                      <input type="button" class="btn btn-primary"  value="  DOWNLOAD UNION BANK CHALLAN " onclick="window.location.href='https://ssusonline.org/challan.pdf'" /> </form><br> -->

   <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">PG Allotment -2020</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <!-- content type here -->
                @foreach($view as $key1)   
<div class="form-group row">
                  <label for="inputEmail3" class="col-sm-6 control-label">Allotted Centre</label>

                  <div class="col-sm-6">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_cent}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-6 control-label">Allotted Category</label>

                  <div class="col-sm-6">
                      <input type="text" disabled class="form-control col-md-8" id="stud_registerno" placeholder="" value="{{$key1->allot_category}}">
                  </div>
                </div>
                 @endforeach 
<!--<div class="form-group row">
                  <label for="inputEmail3" class="col-sm-6 control-label"></label>

                  <div class="col-sm-6">
                     <fieldset data-role="controlgroup">
  <legend>Do you need higher option:</legend>

  <input type="radio" name="myCheck" value="male" checked> YES
  <br>
  <input type="radio" name="myCheck" value="female"> NO

</fieldset> 


  <fieldset data-role="controlgroup">
      <legend>Do you need higher option:</legend>
        <label for="male">YES</label>
        <input type="radio" name="higher_option" id="higher_option"  value="1"onclick="myFunction()"  required>
        <label for="female">NO</label>
        <input type="radio" name="higher_option" id="higher_option1"  value="0" onclick="myFunction1()" >
      </fieldset>

           
<p id="text1" style="display:none">You are continue with this !  Best wishes</p> 
<p id="text" style="display:none">You are waiting for Hiher option!    Better Luck Next Time</p>
               </div>
  </div>
<input type="checkbox"name="myCheck2" id="myCheck2" onclick="myFunction2()" required>
<label for="myCheck2"> Continue</label><br>
<p id="text2" style="display:none">Read carefully and continue no edit option after submission .       After submission you can download allottment memo</p>
  <button type="button" class="btn btn-outline-light">Save changes</button> 

<button type="submit" class="btn btn-outline-light" name="btnsubmit" id="btnsubmit"   >Submit</button>
                 contents end  
               <p>One fine body&hellip;</p> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-outline-light">Save changes</button> 
            </div>
          </div>
           /.modal-content 
        </div>
         /.modal-dialog 
      </div>-->
      <!-- /.modal -->




                  </div>
                   @endforeach 
        
          </div>
       </section>
    <!-- /.content -->
    @endsection
