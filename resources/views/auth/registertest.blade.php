@extends('layouts.app')
@section('style')
  <style>
        .red {
            background-color: red;
        }
    </style>
@stop
@section('scripts')

<script>
 
$(function() {

  $("form[name='formpgapp']").validate({
    // Specify validation rules
    rules: {
        pgapp_stream_id:{
            required: true,
        },
        pgapp_adsc_sl:{
            required: true,
        },
       password: {
         required: true,
         minlength: 8
       },
       password_confirmation: {
       	      required: true,
               equalTo: "#password"
       },
       pgapp_name: {
         required: true,
         minlength: 2
       },
       sslc_regno: {
         required: true
        
       },
       pgapp_gender_sl: {
         required: true
        
       },
       pgapp_dob: {
         required: true
         
       },
        pgapp_mobile: {
         required: true,
         minlength: 10,
         maxlength:10,
         digits: true,
       },
        pgapp_mobile1: {
            equalTo: '[name="pgapp_mobile"]',
            required: true,
        },
       pgapp_adhar: {
         required: true,
         minlength: 12,
         maxlength:12,
         digits: true,
       },
       pgapp_email: {
            required: true,
            email:true
        },
       pgapp_email1: {
            equalTo: '[name="pgapp_email"]',
            required: true,
        }
     
    },
    // Specify validation error messages
    messages: {
     
    },
     errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.col-sm-5').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        $('#btnsubmit').prop('disabled', true);

       form.submit();
    }
  });
});

</script>
<script>
     
    function studdata()
    
    {
        //alert("dsvvv");
        var regno=document.getElementById("sslc_regno").value;
        
       
        
        
        
               $.ajax({
      type: 'POST',
     url: '/getexiststudata',
      //url: 'http://localhost/certificateapp/public/',


        data:{"_token": "{{ csrf_token() }}","regno":regno},
      

      success: function (response) {

   if(response=="0")
   {
alert("Application Limit Exeeded!"); 
$('#sslc_regno').val('');
   }
//$("#commdiv").html(response);
//if(response=="SUCCESS")
    //location.reload(true);
  //window.location='/nonteachingfeedback';
      },
 
 error: function (res) {
  alert(res);
              
                }
  

      });
        
        
    }
 function findage()
    
    {
        var f=0;
        var ddd= new Date();
        //alert("dsvvv");
        var a=document.getElementById('pgapp_dob').value;
         // alert(a);
       values=a.split('-');
       var dobmnth=values[1];
       //alert(dobdate);
       var dobdate=values[0] ;
      // alert(dobmnth);
       var dobyr=values[2] ; 
//        alert(dobyr);
       var currmonth1=ddd.getMonth();
       var currmonth=currmonth1+1;
       // alert(currmonth);
       var currdat=ddd.getDate(); 
      // alert(currdat);
       var curryr=ddd.getFullYear();
       // alert(curryr);       
      var f=Number(curryr)-Number(dobyr);    
     // alert(f);   
     
     var strm=document.getElementById('pgapp_stream_id').value;
    if(strm=="3")
        
        {
           if(f>28) 
               
            {
                alert("age limit exceeded");
                
                $('#pgapp_adhar').val('');
            }
            
            else
            {
               
            }
            
        }
    }
    
    
    
   $(document).ready(function(){
      
    document.getElementById("pgapp_adhar").addEventListener("keyup", testpassword2);
    document.getElementById("pgapp_adhar1").addEventListener("keyup", testpassword2);
    document.getElementById("pgapp_mobile").addEventListener("keyup", testpassword2);
    document.getElementById("pgapp_mobile1").addEventListener("keyup", testpassword2);
    document.getElementById("pgapp_email").addEventListener("keyup", testpassword2);
    document.getElementById("pgapp_email1").addEventListener("keyup", testpassword2);
    
    function testpassword2() {
      var pgapp_adhar = document.getElementById("pgapp_adhar");
      var pgapp_adhar1 = document.getElementById("pgapp_adhar1");
      var pgapp_mobile = document.getElementById("pgapp_mobile");
      var pgapp_mobile1 = document.getElementById("pgapp_mobile1");
      var pgapp_email = document.getElementById("pgapp_email");
      var pgapp_email1 = document.getElementById("pgapp_email1");
      if (pgapp_adhar.value == pgapp_adhar1.value) {  
        pgapp_adhar1.style.borderColor = "gray";
      }
      else {
        pgapp_adhar1.style.borderColor = "red";
      }
      if (pgapp_mobile.value == pgapp_mobile1.value) {  
        pgapp_mobile1.style.borderColor = "gray";
      }
      else {
        pgapp_mobile1.style.borderColor = "red";
      }
       if (pgapp_email.value == pgapp_email1.value) {  
        pgapp_email1.style.borderColor = "gray";
      }
      else {
        pgapp_email1.style.borderColor = "red";
      }
    }
   }) ;
 
 $("#pgapp_dob" ).datepicker({ dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
           yearRange: "-70:+0",
            maxDate: '-1D',
            onSelect: function (dateText, inst) {
              
                   // validateChellanDate();
            }, 
    
 });
 function forsub()

{

  var pgapp_stream_id= document.getElementById('pgapp_stream_id').value;

  // alert(pgapp_cstream);
   
        $.ajax({
        type: 'POST',
        url: '/forsubject',
        data:{"_token": "{{ csrf_token() }}","formData":pgapp_stream_id},
        success: function (response) {
           
$("#divsub").html(response);

      },
                             
      }); 
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
                <h4>PG PART I REGISTRATION FORM<BR></h4>
            </div>
              
           <form class="form-horizontal" name="formpgapp" id="formpgapp" method="post" action="{{route('register')}}">
               {{csrf_field()}}
            <div class="offset-md-2">   
                @if(session()->has('message'))
                    <div class="alert alert-success" id="successMessage">
                            {{ session()->get('message') }}
                    </div>
                @endif
              <div class="card-body">
                  <p style="color: red; text-align: center">* fields are required</p>

                   <div class="form-group row">
                  <label class="col-sm-4 control-label">Stream in which you are applied for <font color="red">*</font></label>
                  <div class="col-sm-5">
                     <select  id="pgapp_stream_id" name="pgapp_stream_id"  class="form-control form-control-sm select2 {{ $errors->has('pgapp_stream_id') ? 'is-invalid' : '' }}" onchange="forsub()" >
                         <option value="" selected="" disabled="">Select</option>
                         <option value='3'>M.PEd</option> 
                         <option value='2'>M.S.W</option>
                        <option value='6'>MFA</option> 
                        <option value='1'>M.A</option>
                         <option value='8'>MSc</option>
                        <option value='9'>P.G. Diploma</option>
                        <option value='3'>M.PES</option>
                    </select>  
                       @if ($errors->has('pgapp_stream_id'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_stream_id') }}
                        </p>
                    @endif
                  </div>
                </div>
                  
                 <div class="form-group row">
                  <label class="col-sm-4 control-label">Program  which you are applied for <font color="red">*</font></label>

                  <div class="col-sm-5" id="divsub" name="divsub">
                 <select  id="pgapp_adsc_sl" name="pgapp_adsc_sl"  class="form-control form-control-sm select2  {{ $errors->has('pgapp_adsc_sl') ? 'is-invalid' : '' }}"  >
                 <option value="" selected="" disabled="">
                                     Select
                </option>
                  </select>
                      @if ($errors->has('pgapp_adsc_sl'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_adsc_sl') }}
                        </p>
                    @endif
                  </div>
                </div>  
  
            
                <div class="form-group row"> 
                  <label class="col-sm-4 control-label">Name as in SSLC<font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm {{ $errors->has('pgapp_name') ? 'is-invalid' : '' }}"  value="{{ old('pgapp_name') }}"
                             id="pgapp_name" name="pgapp_name" placeholder="Enter your name">
                      @if ($errors->has('pgapp_name'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_name') }}
                        </p>
                    @endif
                  </div>
                   
                </div>
                 
                 <div class="form-group row">
                  <label class="col-sm-4 control-label">Date of birth<font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm {{ $errors->has('pgapp_dob') ? 'is-invalid' : '' }}" value="{{ old('pgapp_dob') }}"
                             id="pgapp_dob" name="pgapp_dob" placeholder="Enter your date of birth"  >
                    @if ($errors->has('pgapp_dob'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_dob') }}
                        </p>
                    @endif
                  </div>
                   
                </div>  
                <div class="form-group row">
                  <label class="col-sm-4 control-label">Gender <font color="red">*</font></label>
                 
                  <div class="col-sm-5">
                        <input type="radio" id="male" name="pgapp_gender_sl" value="2" @if(old('pgapp_gender_sl')==2) checked @endif>
                        <label for="male"> Male</label>
                        <input type="radio" id="female" name="pgapp_gender_sl" value="5" @if(old('pgapp_gender_sl')==5) checked @endif>
                        <label for="female"> Female </label>
                        <input type="radio" id="transgender" name="pgapp_gender_sl" value="7" @if(old('pgapp_gender_sl')==7) checked @endif>
                        <label for="other"> Transgender</label>
                         
                    @if ($errors->has('pgapp_gender_sl'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_gender_sl') }}
                        </p>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 control-label">SSLC/ICSE/CBSE register number<font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm {{ $errors->has('sslc_regno') ? 'is-invalid' : '' }}" onblur="studdata()" value="{{ old('sslc_regno') }}" id="sslc_regno" name="sslc_regno" placeholder="Enter your sslc register no">
                      @if ($errors->has('sslc_regno'))
                        <p style="color: red">
                                    {{ $errors->first('sslc_regno') }}
                        </p>
                    @endif
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-4 control-label">Aadhaar number <font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm {{ $errors->has('pgapp_adhar') ? 'is-invalid' : '' }}" value="{{ old('pgapp_adhar') }}" id="pgapp_adhar" name="pgapp_adhar" placeholder="Enter your aadhaar number" onblur="findage()">
                       @if ($errors->has('pgapp_adhar'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_adhar') }}
                        </p>
                    @endif
                  </div>
                </div>   
                <div class="form-group row">
                  <label class="col-sm-4 control-label">Re-enter aadhaar number <font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm {{ $errors->has('pgapp_adhar1') ? 'is-invalid' : '' }}" value="{{ old('pgapp_adhar1') }}" id="pgapp_adhar1" name="pgapp_adhar1" placeholder="Enter your aadhaar number">
                      @if ($errors->has('pgapp_adhar1'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_adhar1') }}
                        </p>
                    @endif
                  </div>
                </div>     
                <div class="form-group row">
                  <label class="col-sm-4 control-label">Mobile no <font color="red">(Please use your own/parents/guardian's mobile number)*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm{{ $errors->has('pgapp_mobile') ? 'is-invalid' : '' }}" value="{{ old('pgapp_mobile') }}" id="pgapp_mobile" name="pgapp_mobile" placeholder="Enter your mobile no">
                       @if ($errors->has('pgapp_mobile'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_mobile') }}
                        </p>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 control-label">Re-enter mobile no <font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="text" class="form-control form-control-sm{{ $errors->has('pgapp_mobile1') ? 'is-invalid' : '' }}" value="{{ old('pgapp_mobile1') }}" id="pgapp_mobile1" name="pgapp_mobile1" placeholder="Enter your mobile no">
                       @if ($errors->has('pgapp_mobile1'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_mobile1') }}
                        </p>
                    @endif
                  </div>
                </div>   
                <div class="form-group row">
                    <label class="col-sm-4 control-label">Email <font style="color: red">(Note :Please use your own/parents/guardian's Email-id. Email-id of Akshaya centres, internet cafe or other agencies should not be submitted) *</font></label>

                  <div class="col-sm-5">
                      <input type="email" class="form-control form-control-sm{{ $errors->has('pgapp_email') ? 'is-invalid' : '' }}" value="{{ old('pgapp_email') }}" id="pgapp_email" name="pgapp_email" placeholder="Enter your email">
                     @if ($errors->has('pgapp_email'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_email') }}
                        </p>
                    @endif
                  </div>
                </div>
                  <div class="form-group row">
                  <label class="col-sm-4 control-label">Re-enter email <font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="email" class="form-control form-control-sm{{ $errors->has('pgapp_email1') ? 'is-invalid' : '' }}" value="{{ old('pgapp_email1') }}" id="pgapp_email1" name="pgapp_email1" placeholder="Enter your email">
                     @if ($errors->has('pgapp_email1'))
                        <p style="color: red">
                                    {{ $errors->first('pgapp_email1') }}
                        </p>
                    @endif
                  </div>
                </div>
                 <div class="form-group row">
                     <label class="col-sm-4 control-label">Choose a password <font style="color: red">(Min 8 characters. Remember your password for future use) *</font></label>

                  <div class="col-sm-5">
                      <input type="password" class="form-control form-control-sm{{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}" id="password" name="password" placeholder="Enter your password">
                      @if ($errors->has('password'))
                        <p style="color: red">
                                    {{ $errors->first('password') }}
                        </p>
                    @endif
                  </div>
                </div>
                   <div class="form-group row">
                  <label class="col-sm-4 control-label">Confirm your password <font color="red">*</font></label>

                  <div class="col-sm-5">
                      <input type="password" class="form-control form-control-sm{{ $errors->has('password-confirm') ? 'is-invalid' : '' }}" value="{{ old('password-confirm') }}" id="password-confirm" name="password_confirmation" placeholder="Enter your password">
                      @if ($errors->has('password-confirm'))
                        <p style="color: red">
                                    {{ $errors->first('password-confirm') }}
                        </p>
                    @endif
                  </div>
                </div>
                   

              </div>
               
       </div>  
      
              <div class="card-footer">
                    <p style="font-size: 16px">After registering you cannot edit it again. Thus please check all the data is correct /
                      രജിസ്റ്റർ ചെയ്തതിന് ശേഷം നിങ്ങൾക്ക് ഇത് വീണ്ടും എഡിറ്റ് ചെയ്യാൻ കഴിയില്ല. അതിനാൽ എല്ലാ ഡാറ്റയും ശരിയാണോ എന്ന് പരിശോധിക്കുക </p>
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <input type="submit" class="btn btn-info float-right" value="Submit">
              </div>
            </form>
 </div>
 </div>       
 </div>
          </div>
      </div>
</section>
        

@endsection
