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
function centropt1()
{

    var f = document.getElementById("center_sl1");
    var cent1 = f.options[f.selectedIndex].value;
 
        $.ajax({
        type: 'POST',
        url: '/centopt1',
        data:{"_token": "{{ csrf_token() }}","cent1":cent1},
        success: function (response) {
            
            $("#cdiv2").html(response);

            $("#div2").show();
        }
                             
      });

}


</script>
<script>
 
//$(function() {
//
//  $("form[name='formoption']").validate({
//    // Specify validation rules
//    rules: {
//      
//       center_sl1: {
//         required: true
//        
//       },
//       center_sl2: {
//         required: true
//        
//       },
//     
//    },
//    // Specify validation error messages
//    messages: {
//                center_sl1: "Please select option 1",
//                center_sl2: "Please select option 2"
//    
//    },
//    submitHandler: function(form) {
//        form.submit();
//     },
//     errorElement: 'span',
//    errorPlacement: function (error, element) {
//        error.addClass('invalid-feedback');
//        element.closest('.col-md-8').append(error);
//    },
//    highlight: function (element, errorClass, validClass) {
//        $(element).addClass('is-invalid');
//    },
//    unhighlight: function (element, errorClass, validClass) {
//        $(element).removeClass('is-invalid');
//    },
//    // Make sure the form is submitted to the destination defined
//    // in the "action" attribute of the form when valid
//    submitHandler: function(form) {
//        $('#btnsubmit').prop('disabled', true);
//
//       form.submit();
//    }
//  });
//});

$(document).ready(function(){
 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


 $("#submitButton").click(function(ev) {
    ev.preventDefault(); 

  var formval= validateOption('formoption');
  if(formval){
             var flag = document.getElementById('flags').value;
             if(flag==1){
               var center_sl1 = document.getElementById('center_sl1').value;  
             }
             else{
                var center_sl1 = document.getElementById('center_sl1').value;
                var center_sl2 = document.getElementById('center_sl2').value;
             }

//      alert("yyyyy");
      $.ajax({
        type: 'POST',
        url: '/store_options',
        data:{ "center_sl1":center_sl1,"center_sl2":center_sl2},
        
        beforeSend: function(e){
                     $("#submitButton").prop('disabled', true);
                     $("#loader").show();
                     
                    if(confirm("Are you sure? You are not allowed to edit the option, once you submit the option."))
                    {
//                        alert('navigate!');
                    }
                    else
                    {
                         $("#submitButton").prop('disabled', false);
                        return false;
                    }
                },
        success: function (response) {
            
            if(response.message=='success'){
//              $(".btn-danger").attr("value", "Button Text");
//              $("#printoption").html(response.htmlbtn);
              $('#submitButton').prop('disabled', false);
              alert("Options Saved successfully");
               window.location.href = "pay_details";

            }
            
      }
                             
      }); 
  }
 });
 
 });
function validateOption(formval){
   var flag = document.getElementById('flags').value;
   var option_declaration = $('input[name="option_declaration"]').prop('checked'); 
  
if(flag==1){
if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice ';
    alert("Select your I st Centre Choice");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  } 
  
  if(option_declaration==false){
        alert('Please accept the declartions.')
        return false;
    }
}
else{
    if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice ';
    alert("Select your I st Centre Choice!");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  }
  if ($.trim($('#center_sl2').val()) == "") {
    error_center_sl1 = 'Select your II nd Centre Choice ';
    alert("select your II nd Centre Choice");
    $('#error_center_sl2').text(error_center_sl2);
    $('#center_sl2').addClass('has-error');
    $('#center_sl2').focus();
    return false;
  }
  if(option_declaration==false){
        alert('Please accept the declartions.')
        return false;
    }
}

  
  return true;
  
}
</script>
 
@stop

@section('content')
 <section class="content">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
    
 <div class="card card-info card-outline">
       <div class="form-horizontal">
            
            <div class="card-header with-border" style="text-align: center;">
                <h4>PG ADMISSION 2022 : STUDY CAMPUS OPTION ENTRY FORM<BR></h4>
            </div>
           <marquee><font style="color: red ;font-size: 20px;">You are not allowed to edit the option, once you submit the option.</marquee>

        <form class="form-horizontal" name="formoption" id="formoption"  method="post" >
             {{csrf_field()}}
             
             <input type="hidden" value="{{$flags}}" name="flags" id="flags">     
            <div class="card-body">
                @foreach($rank as $key)
                  <p style="color: red; text-align: center">* fields are required</p>
                  <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                   <label for="exampleInputEmail1">Stream in which you are applied for :</label>
                   <textarea name="pgapp_adsc_sl" id="pgapp_adsc_sl" class="form-control form-control-sm col-md-8" readonly="" >{{$key->adsc_name}}</textarea>
                   </div> 
                    </div> 
                   <div class="col-lg-6">
                      <div class="form-group">
                   <label for="exampleInputEmail1">Application Number :</label>
                     <input type="text" name="pgapp_id" id="pgapp_id" value="{{$key->rank_appid}}" class="form-control form-control-sm col-md-8" readonly=""/> 
                   </div> 
                    </div> 
                   </div> 
                  <div class="row">
                    <div class="col-lg-6"> 
                    <div class="form-group"> 
                        <label class="control-label" >Name of Applicant :</label>
                    <input type="text" name="pgapp_name" id="pgapp_name" class="form-control form-control-sm  col-md-8" value="{{$key->rank_stud_name}}" readonly=""/> 
                     </div>
                     </div>
                    <div class="col-lg-6">
                      <div class="form-group">   <label class="control-label ">Date Of Birth :</label>
                    <input type="text" name="pgapp_dob" id="pgapp_dob" class="form-control form-control-sm col-md-8" value="{{$key->dob}}"  readonly=""/> 
                    </div>
                    </div>
                  </div>
                  
                 @endforeach 
        @if($flags==3)         
                 <div class="row">
                    <div class="col-lg-6"> 
                    <div class="form-group"> 
                        <label class="control-label" >Study Campus I <font color="red">*</font></label>
                        <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                                onchange="centropt1()" >
                            <option value="" selected disabled >
                                 Select Centre I
                                 </option>
                              @foreach($centre_options as $cent)
                                <option value="{{$cent->centre_sl }}"   >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach     
                        </select>   
                         @if ($errors->has('center_sl1'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl1') }}
                        </p>
                    @endif
                    </div>
                     </div>
                    <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                      <div class="form-group"> 
                          <label class="control-label ">Study Campus II :</label>
                          <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" >
                            <option value="" selected disabled >
                                 Select Centre II
                                 </option>

                        </select>
                           @if ($errors->has('center_sl2'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl2') }}
                        </p>
                    @endif
                    </div>
                    </div>
                     <div class="col-lg-6"  id="cdiv3" id="cdiv3">
                      <div class="form-group"> 
                          <label class="control-label ">Study Campus III :</label>
                          <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" >
                            <option value="" selected disabled >
                                 Select Centre III
                            </option>

                        </select>
                           @if ($errors->has('center_sl3'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl3') }}
                        </p>
                    @endif
                    </div>
                    </div>
                  </div>         
        @elseif($flags==2)         
                 <div class="row">
                    <div class="col-lg-6"> 
                    <div class="form-group"> 
                        <label class="control-label" >Study Campus I <font color="red">*</font></label>
                        <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                                onchange="centropt1()" >
                            <option value="" selected disabled >
                                 Select Centre I
                                 </option>
                              @foreach($centre_options as $cent)
                                <option value="{{$cent->centre_sl }}"   >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach     
                        </select>   
                         @if ($errors->has('center_sl1'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl1') }}
                        </p>
                    @endif
                    </div>
                     </div>
                    <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                      <div class="form-group"> 
                          <label class="control-label ">Study Campus II :</label>
                          <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" >
                            <option value="" selected disabled >
                                 Select Centre II
                                 </option>

                        </select>
                           @if ($errors->has('center_sl2'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl2') }}
                        </p>
                    @endif
                    </div>
                    </div>
                  </div>
        
        @else
        <div class="row">
                    <div class="col-lg-6"> 
                    <div class="form-group"> 
                        <label class="control-label" >Study Campus I <font color="red">*</font></label>
                        <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                                onchange="centropt1()" >
                            <option value="" selected disabled >
                                 Select Centre I
                                 </option>
                              @foreach($centre_options as $cent)
                                <option value="{{$cent->centre_sl }}"   >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach     
                        </select>   
                         @if ($errors->has('center_sl1'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl1') }}
                        </p>
                    @endif
                    </div>
                     </div>
             </div>
          @endif
          <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 15px;"><b><u>Declaration</u> </b></p>   
          <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 13px;"><b>Admission will be based on the candidate position in ranklist and the centre of option of the candidate.
           The university reserves the right to direct any student to transfer from one Centre to another Centre in case there is a shortfall in the number of 
           students at any of the centre.</b></p>   
        <div class="row">   
        <label class="control-label col-md-12" style="color: red"> I accept the above declarations <input type="checkbox" name="option_declaration" id="option_declaration">
        </label>
        </div>
        </div>
        <div id='loader' class="overlay" style='display: none;'>
             <i class="fa fa-refresh fa-spin"></i>
          </div>
<!--        @if($option_stat==1)   
        <div class="card-footer" >   
        <a href="printoption" target="_blank" class="btn btn-flat btn-sm btn-danger float-right">
                        Print <i class="fa fa-download"></i></a>
       </div>                
        @else     
          <div class="card-footer" id="printoption" name="printoption">   
           
            <input type="submit" class="btn btn-info float-right" id="submitButton" value="Submit">
        </div>
        @endif-->
        <div class="card-footer" id="" name="">   
           
            <input type="submit" class="btn btn-info float-right" id="submitButton" value="Submit">
        </div>
       
        </form>

    </div>
</div>
         
    </div>
</div>
    </div>
 </section>
@endsection
