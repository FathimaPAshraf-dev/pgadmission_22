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

function centropt2()
{
    var f = document.getElementById("center_sl1");
    var cent1 = f.options[f.selectedIndex].value;
    var s = document.getElementById("center_sl2");
    var cent2 = s.options[s.selectedIndex].value;
// console.log(f);
        $.ajax({
        type: 'POST',
        url: '/centopt2',
        data:{"_token": "{{ csrf_token() }}","cent2":cent2,"cent1":cent1},
        success: function (response) {
            
            $("#cdiv3").html(response);

            $("#div3").show();
        }
                             
      });

}

function centropt3()
{
    var f = document.getElementById("center_sl1");
    var cent1 = f.options[f.selectedIndex].value;
    var s = document.getElementById("center_sl2");
    var cent2 = s.options[s.selectedIndex].value;
    var c3 = document.getElementById("center_sl3");
    var cent3 = c3.options[c3.selectedIndex].value;
// console.log(f);
        $.ajax({
        type: 'POST',
        url: '/centopt3',
        data:{"_token": "{{ csrf_token() }}","cent3":cent3,"cent2":cent2,"cent1":cent1},
        success: function (response) {
            
            $("#cdiv4").html(response);

            $("#div4").show();
        }
                             
      });

}

function centropt4()
{
    var f = document.getElementById("center_sl1");
    var cent1 = f.options[f.selectedIndex].value;
    var s = document.getElementById("center_sl2");
    var cent2 = s.options[s.selectedIndex].value;
    var c3 = document.getElementById("center_sl3");
    var cent3 = c3.options[c3.selectedIndex].value;
    var c4 = document.getElementById("center_sl4");
    var cent4 = c4.options[c4.selectedIndex].value;
// console.log(f);
        $.ajax({
        type: 'POST',
        url: '/centopt4',
        data:{"_token": "{{ csrf_token() }}","cent4":cent4,"cent3":cent3,"cent2":cent2,"cent1":cent1},
        success: function (response) {
            
            $("#cdiv5").html(response);

            $("#div5").show();
        }
                             
      });

}


function centropt5()
{
    var f = document.getElementById("center_sl1");
    var cent1 = f.options[f.selectedIndex].value;
    var s = document.getElementById("center_sl2");
    var cent2 = s.options[s.selectedIndex].value;
    var c3 = document.getElementById("center_sl3");
    var cent3 = c3.options[c3.selectedIndex].value;
    var c4 = document.getElementById("center_sl4");
    var cent4 = c4.options[c4.selectedIndex].value;
    var c5 = document.getElementById("center_sl5");
    var cent5 = c5.options[c5.selectedIndex].value;
// console.log(f);
        $.ajax({
        type: 'POST',
        url: '/centopt5',
        data:{"_token": "{{ csrf_token() }}","cent5":cent5,"cent4":cent4,"cent3":cent3,"cent2":cent2,"cent1":cent1},
        success: function (response) {
            
            $("#cdiv6").html(response);

            $("#div6").show();
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
//  var formval=true;
  
  if(formval){
             var flag = document.getElementById('flags').value;
             if(flag==1){
               var center_sl1 = document.getElementById('center_sl1').value;  
             }
             else if(flag==2){
                var center_sl1 = document.getElementById('center_sl1').value;
                var center_sl2 = document.getElementById('center_sl2').value;
             }
             else if(flag==3){
                var center_sl1 = document.getElementById('center_sl1').value;
                var center_sl2 = document.getElementById('center_sl2').value;
                var center_sl3 = document.getElementById('center_sl3').value;
             }
             else if(flag==4){
                var center_sl1 = document.getElementById('center_sl1').value;
                var center_sl2 = document.getElementById('center_sl2').value;
                var center_sl3 = document.getElementById('center_sl3').value;
                var center_sl4 = document.getElementById('center_sl4').value;
             }
             else if(flag==5){
                var center_sl1 = document.getElementById('center_sl1').value;
                var center_sl2 = document.getElementById('center_sl2').value;
                var center_sl3 = document.getElementById('center_sl3').value;
                var center_sl4 = document.getElementById('center_sl4').value;
                var center_sl5 = document.getElementById('center_sl5').value;
             }
             else if(flag==6){
                var center_sl1 = document.getElementById('center_sl1').value;
                var center_sl2 = document.getElementById('center_sl2').value;
                var center_sl3 = document.getElementById('center_sl3').value;
                var center_sl4 = document.getElementById('center_sl4').value;
                var center_sl5 = document.getElementById('center_sl5').value;
                var center_sl6 = document.getElementById('center_sl6').value;
             }

//      alert("yyyyy");
      $.ajax({
        type: 'POST',
        url: '/store_options',
        data:{ "center_sl1":center_sl1,"center_sl2":center_sl2,"center_sl3":center_sl3,"center_sl4":center_sl4,
        "center_sl5":center_sl5,"center_sl6":center_sl6},
        
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
//   alert(flag);
  
if(flag==1){
if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice';
    alert("Select your I st Centre Choice");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  } 
  
  if(option_declaration==false){
        alert('Please accept the declarations.');
        return false;
    }
}
else if(flag==2){
    if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice ';
    alert("Select your I st Centre Choice!");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  }
  if ($.trim($('#center_sl2').val()) == "") {
    error_center_sl2 = 'Select your II nd Centre Choice ';
    alert("Select your second Centre Choice");
    $('#error_center_sl2').text(error_center_sl2);
    $('#center_sl2').addClass('has-error');
    $('#center_sl2').focus();
    return false;
  }
  if(option_declaration==false){
        alert('Please accept the declarations.');
        return false;
    }
}

else if(flag==3){
    if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice ';
    alert("Select your I st Centre Choice!");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  }
  if ($.trim($('#center_sl2').val()) == "") {
    error_center_sl2 = 'Select your second nd Centre Choice ';
    alert("select your II nd Centre Choice");
    $('#error_center_sl2').text(error_center_sl2);
    $('#center_sl2').addClass('has-error');
    $('#center_sl2').focus();
    return false;
  }
  if ($.trim($('#center_sl3').val()) == "") {
    error_center_sl3 = 'Select your third Centre Choice ';
    alert("select your third Centre Choice");
    $('#error_center_sl3').text(error_center_sl3);
    $('#center_sl3').addClass('has-error');
    $('#center_sl3').focus();
    return false;
  }
  if(option_declaration==false){
        alert('Please accept the declarations.');
        return false;
    }
} 

else if(flag==4){
    if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice ';
    alert("Select your I st Centre Choice!");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  }
  if ($.trim($('#center_sl2').val()) == "") {
    error_center_sl2 = 'Select your II nd Centre Choice ';
    alert("select your second Centre Choice");
    $('#error_center_sl2').text(error_center_sl2);
    $('#center_sl2').addClass('has-error');
    $('#center_sl2').focus();
    return false;
  }
  if ($.trim($('#center_sl3').val()) == "") {
    error_center_sl3 = 'Select your III rd Centre Choice ';
    alert("select your third Centre Choice");
    $('#error_center_sl3').text(error_center_sl3);
    $('#center_sl3').addClass('has-error');
    $('#center_sl3').focus();
    return false;
  }
  if ($.trim($('#center_sl4').val()) == "") {
    error_center_sl4 = 'Select your IV th Centre Choice ';
    alert("select your fourth Centre Choice");
    $('#error_center_sl4').text(error_center_sl4);
    $('#center_sl4').addClass('has-error');
    $('#center_sl4').focus();
    return false;
  }
  if(option_declaration==false){
        alert('Please accept the declarations.');
        return false;
    }
} 
 
else if(flag==5){
  if ($.trim($('#center_sl1').val()) == "") {
    error_center_sl1 = 'Select your I st Centre Choice ';
    alert("Select your I st Centre Choice!");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  }
  if ($.trim($('#center_sl2').val()) == "") {
    error_center_sl2 = 'Select your II nd Centre Choice ';
    alert("select your second Centre Choice");
    $('#error_center_sl2').text(error_center_sl2);
    $('#center_sl2').addClass('has-error');
    $('#center_sl2').focus();
    return false;
  }
  if ($.trim($('#center_sl3').val()) == "") {
    error_center_sl3 = 'Select your III rd Centre Choice ';
    alert("select your third Centre Choice");
    $('#error_center_sl3').text(error_center_sl3);
    $('#center_sl3').addClass('has-error');
    $('#center_sl3').focus();
    return false;
  }
  if ($.trim($('#center_sl4').val()) == "") {
    error_center_sl4 = 'Select your fourth Centre Choice ';
    alert("select your fourth Centre Choice");
    $('#error_center_sl4').text(error_center_sl4);
    $('#center_sl4').addClass('has-error');
    $('#center_sl4').focus();
    return false;
  }
  if ($.trim($('#center_sl5').val()) == "") {
    error_center_sl5 = 'Select your Vth Centre Choice ';
    alert("select your 5th Centre Choice");
    $('#error_center_sl4').text(error_center_sl5);
    $('#center_sl5').addClass('has-error');
    $('#center_sl5').focus();
    return false;
  }
  if(option_declaration==false){
       alert('Please accept the declarations.');
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
                <h4>STUDY CAMPUS OPTION ENTRY FORM<br></h4>
            </div>
           <!--<marquee><font style="color: red ;font-size: 20px;">You are not allowed to edit the option, once you submit the option.</marquee>-->

        <form class="form-horizontal" name="formoption" id="formoption"  method="post" >
             {{csrf_field()}}
             
             <input type="hidden" value="{{$flags}}" name="flags" id="flags">     
            <div class="card-body">
                
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                   @if(Auth::user()->pgapp_adsc_sl=975 || Auth::user()->pgapp_adsc_sl=976 || Auth::user()->pgapp_adsc_sl=977 || Auth::user()->pgapp_adsc_sl=970)     
                   <!--<label>സർവകലാശാലയുടെ പയ്യന്നൂർ പ്രാദേശിക കേന്ദ്രത്തിൽ 2023-24 അക്കാദമിക വർഷം മുതൽ പിജി മലയാളം പ്രോഗ്രാം (20 സീറ്റ്) ആരംഭിക്കുവാൻ  തീരുമാനിച്ചിരിക്കുന്ന സാഹചര്യത്തിൽ  സെൻറർ ഓപ്ഷൻ നൽകി മൂന്ന് അലോട്മെൻ്റി ലൂടെ അഡ്മിഷൻ നേടിയ വിദ്യാർത്ഥികൾക്കും നാളിതുവരെ ഓപ്ഷൻ നൽകാൻ സാധിക്കാത്ത വിദ്യാർത്ഥികൾക്കും മേൽ സൂചിപ്പിച്ച ക്യാമ്പസ് കൂടി ഉൾപെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ തീരുമാനിച്ചിരിക്കുന്നു. റീ ഓപ്ഷൻ നൽകാൻ താല്പര്യമുള്ള വിദ്യാർത്ഥികൾ മാത്രം 10.07. 2023 മുതൽ 12.07.2023 വരെയുള്ള തീയതികുള്ളിൽ ഈ അവസരം ഉപയോഗപ്പെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ അറിയിക്കുന്നു.</label>-->
                   <!--<label>സർവകലാശാലയുടെ പ്രാദേശിക കേന്ദ്രത്തിൽ അക്കാദമിക് പുന: സംഘടനത്തിന്റെ ഭാഗമായി നിർത്തലാക്കിയ ചില പി ജി പ്രോഗ്രാമുകൾ (കൊയിലാണ്ടി - സംസ്‌കൃതം വേദാന്ത (10 സീറ്റ് ),തിരൂർ - ഇംഗ്ലീഷ് (20 സീറ്റ് ), പൻമന- ഹിന്ദി(20സീറ്റ് ),തിരുവനന്തപുരം - മലയാളം (20 സീറ്റ് ))2023-24 അക്കാദമിക വർഷം തന്നെ പുന : സ്ഥാപിക്കാൻ സിൻഡിക്കേറ്റ് തീരുമാനിച്ച സാഹചര്യത്തിൽ  സെൻറർ ഓപ്ഷൻ നൽകി അഞ്ച് അലോട്മെൻ്റി ലൂടെ അഡ്മിഷൻ നേടിയ വിദ്യാർത്ഥികൾക്കും നാളിതുവരെ ഓപ്ഷൻ നൽകാൻ സാധിക്കാത്ത വിദ്യാർത്ഥികൾക്കും മേൽ സൂചിപ്പിച്ച ക്യാമ്പസ് കൂടി ഉൾപെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ തീരുമാനിച്ചിരിക്കുന്നു. റീ ഓപ്ഷൻ നൽകാൻ താല്പര്യമുള്ള വിദ്യാർത്ഥികൾ മാത്രം 11.08. 2023 മുതൽ 16.08.2023 വരെയുള്ള തീയതികുള്ളിൽ ഈ അവസരം ഉപയോഗപ്പെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ അറിയിക്കുന്നു. 2023 ഓഗസ്റ്റ്‌ 20 ന് അലോട്മെന്റ് പ്രക്രിയ നടത്തി ഓഗസ്റ്റ്‌ 23,24 തീയതികളിലായി പ്രവേശന നടപടി പൂർത്തിയാക്കുന്നതാണ്.</label>--> 
                   
                   @else
                   <!--<label for="exampleInputEmail1">2023 പി ജി എൻട്രൻസ് റാങ്ക് ലിസ്റ്റ് പ്രകാരം യോഗ്യതയുള്ള എല്ലാ അപേക്ഷകരും അറ്റാച്ച് ചെയ്ത പട്ടിക പ്രകാരം പ്രോഗ്രാം ഓഫർ ചെയ്യുന്ന ക്യാമ്പസ്സുകളുടെ പേര് 28.05.2023 ഉച്ചയ്ക്ക് ശേഷം 3   മുതൽ 31.05 2023 ഉച്ചയ്ക്ക് ശേഷം 5 മണിവരെ സമയ പരിധിക്കുള്ളിൽ തിരഞ്ഞെടുക്കാൻ  അഭ്യർത്ഥിക്കുന്നു. ഒന്നിലധികം സെന്ററുകൾ പ്രോഗ്രാം ഓഫർ ചെയ്യുന്ന സാഹചര്യത്തിൽ, അപേക്ഷകർക്ക് അവരുടെ ഇഷ്ടത്തിനനുസരിച്ച പരമാവധി ക്യാമ്പസ്സും തിരഞ്ഞെടുത്ത് ചേരാവന്നതാണ്.അലോട്ട്‌മെന്റ് മെമ്മോ ലഭിച്ചതിന് ശേഷം ഓരോരുത്തർക്കും മെമ്മോ പ്രകാരം പ്രവേശനം ലഭിക്കുന്ന ക്യാമ്പസ്സിലെ പ്രോഗ്രാമിൽ ചേർന്നില്ലെങ്കിൽ മറ്റ് ക്യാമ്പസ്സുകളിലേക്കുള്ള പ്രവേശനത്തിനുള്ള അവകാശം സ്വയമേവ ഇല്ലാതാകും. എന്നിരുന്നാൽ ഉയർന്ന ഓപ്ഷൻ തേടുന്ന അപേക്ഷകർക്ക് താഴ്ന്ന ഓപ്ഷനിൽ പ്രവേശിച്ചതിന് ശേഷം ഒഴിവ് വരുന്ന മുറയ്ക്ക്  ഓപ്ഷൻ പ്രകാരമുള്ള മാറ്റം അനുവദിക്കുന്നതാണ് .</label>-->
                  
                   @endif
                    </div> 
                    </div> 
                   
                   </div>
                
            @php  
                $opt1=0;
                $opt2=0;
                $opt3=0;
                $opt4=0;
                $opt5=0;
                $opt6=0;
            @endphp
            
            @if($pgpgm_flag1== '1') 
            @foreach($pgpgm_count1 as $key)
             @php 
              $opt1=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag2== '1') 
            @foreach($pgpgm_count2 as $key)
             @php 
              $opt2=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag3== '1') 
            @foreach($pgpgm_count3 as $key)
             @php 
              $opt3=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag4== '1') 
            @foreach($pgpgm_count4 as $key)
             @php 
              $opt4=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag5== '1') 
            @foreach($pgpgm_count5 as $key)
             @php 
              $opt5=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag6== '1') 
            @foreach($pgpgm_count6 as $key)
             @php 
              $opt6=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            
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
        
        @if($flags==6)         
         <div class="row">
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
                          
                           @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
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
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                          
                            <option value="" selected disabled >
                             Select Centre II
                             </option>
                          @foreach($centre_options as $cent)
                          
                           @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach   

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
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv4" id="cdiv4">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus IV <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}" id="center_sl4" name="center_sl4" required="" >
                        <option value="" selected disabled >
                             Select Centre IV
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt4==$cent->centre_sl)  
                            <option selected="" value="{{$opt4}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl4'))
                    <p style="color: red">
                                {{ $errors->first('center_sl4') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv5" id="cdiv5">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus V <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}" id="center_sl5" name="center_sl5" required="" >
                        <option value="" selected disabled >
                             Select Centre V
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt5==$cent->centre_sl)  
                            <option selected="" value="{{$opt5}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl5'))
                    <p style="color: red">
                                {{ $errors->first('center_sl5') }}
                    </p>
                    @endif
                </div>
                </div>
                
               <div class="col-lg-6"  id="cdiv6" id="cdiv6">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus VI <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}" id="center_sl6" name="center_sl6" required="" >
                        <option value="" selected disabled >
                             Select Centre VI
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt6==$cent->centre_sl)  
                            <option selected="" value="{{$opt6}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl6'))
                    <p style="color: red">
                                {{ $errors->first('center_sl6') }}
                    </p>
                    @endif
                </div>
                </div> 
             
         </div>
             
         </div>         
        
        @elseif($flags==5)         
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
                          
                           @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
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
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                          
                            <option value="" selected disabled >
                             Select Centre II
                             </option>
                          @foreach($centre_options as $cent)
                          
                           @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach   

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
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv4" id="cdiv4">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus IV <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}" id="center_sl4" name="center_sl4" required="" >
                        <option value="" selected disabled >
                             Select Centre IV
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt4==$cent->centre_sl)  
                            <option selected="" value="{{$opt4}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl4'))
                    <p style="color: red">
                                {{ $errors->first('center_sl4') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv5" id="cdiv5">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus V <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}" id="center_sl5" name="center_sl5" required="" >
                        <option value="" selected disabled >
                             Select Centre V
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt5==$cent->centre_sl)  
                            <option selected="" value="{{$opt5}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl5'))
                    <p style="color: red">
                                {{ $errors->first('center_sl5') }}
                    </p>
                    @endif
                </div>
                </div>
             
         </div>
        
        
        @elseif($flags==4)         
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
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
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
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                        <option value="" selected disabled >
                             Select Centre II
                             </option>
                              @foreach($centre_options as $cent)
                          @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach   
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
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                         @foreach($centre_options as $cent)
                          @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach   
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv4" id="cdiv4">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus IV <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}" id="center_sl4" name="center_sl4" required="" >
                        <option value="" selected disabled >
                             Select Centre IV
                        </option>
                         @foreach($centre_options as $cent)
                          @if($opt4==$cent->centre_sl)  
                            <option selected="" value="{{$opt4}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach   
                    </select>
                    @if ($errors->has('center_sl4'))
                    <p style="color: red">
                                {{ $errors->first('center_sl4') }}
                    </p>
                    @endif
                </div>
                </div>
         </div>            
        @elseif($flags==3)         
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
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
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
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                        <option value="" selected disabled >
                             Select Centre II
                             </option>
                             @foreach($centre_options as $cent)
                          @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach 
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
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                        @foreach($centre_options as $cent)
                          @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach 
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
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
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
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" >
                        <option value="" selected disabled >
                             Select Centre II
                             </option>
                             @foreach($centre_options as $cent)
                          @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach 
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
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
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
          <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 13px;"><b>The Transfer of Campus will be based on the position of the candidate in the ranklist, availability of seats (should be within the sanctioned strength 
                  approved by the University) and the option exercised by the candidate.
           The university reserves the right to direct any student to transfer from one Campus to another Campus in case there is a shortfall in the number of 
           students at any of the Campus.</b></p>   
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
            <a class="btn btn-danger float-left" href="/pay_details">Cancel</a>
        </div>
       
        </form>

    </div>
</div>
         
    </div>
        </div>
        <div class="modal fade" id="tallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">INSTRUCTIONS TO APPLICANTS / അപേക്ഷകർക്കുള്ള നിർദ്ദേശങ്ങൾ</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                          <div class="card-body">
                           <div class="form-group row">
                               <h5 for="scholar_name" class="col-sm-12" style="color: red">Please read the instructions carefully before going to apply /
                               അപേക്ഷിക്കുന്നതിന് മുമ്പ് നിർദ്ദേശങ്ങൾ ശ്രദ്ധാപൂർവ്വം വായിക്കുക 
                               </h5>
                               <p class="card-text">
                              <ul>
                                 <li style="font-size: 17px">
                                     
                                   2023 പി ജി എൻട്രൻസ് റാങ്ക് ലിസ്റ്റ് പ്രകാരം യോഗ്യതയുള്ള എല്ലാ അപേക്ഷകരും അറ്റാച്ച് ചെയ്ത പട്ടിക പ്രകാരം പ്രോഗ്രാം ഓഫർ ചെയ്യുന്ന ക്യാമ്പസ്സുകളുടെ പേര് 28.05.2023 ഉച്ചയ്ക്ക് ശേഷം 3   മുതൽ 31.05 2023 ഉച്ചയ്ക്ക് ശേഷം 5 മണിവരെ സമയ പരിധിക്കുള്ളിൽ തിരഞ്ഞെടുക്കാൻ  അഭ്യർത്ഥിക്കുന്നു. ഒന്നിലധികം സെന്ററുകൾ പ്രോഗ്രാം ഓഫർ ചെയ്യുന്ന സാഹചര്യത്തിൽ, അപേക്ഷകർക്ക് അവരുടെ ഇഷ്ടത്തിനനുസരിച്ച പരമാവധി ക്യാമ്പസ്സും തിരഞ്ഞെടുത്ത് ചേരാവന്നതാണ്.അലോട്ട്‌മെന്റ് മെമ്മോ ലഭിച്ചതിന് ശേഷം ഓരോരുത്തർക്കും മെമ്മോ പ്രകാരം പ്രവേശനം ലഭിക്കുന്ന ക്യാമ്പസ്സിലെ പ്രോഗ്രാമിൽ ചേർന്നില്ലെങ്കിൽ മറ്റ് ക്യാമ്പസ്സുകളിലേക്കുള്ള പ്രവേശനത്തിനുള്ള അവകാശം സ്വയമേവ ഇല്ലാതാകും. എന്നിരുന്നാൽ ഉയർന്ന ഓപ്ഷൻ തേടുന്ന അപേക്ഷകർക്ക് താഴ്ന്ന ഓപ്ഷനിൽ പ്രവേശിച്ചതിന് ശേഷം ഒഴിവ് വരുന്ന മുറയ്ക്ക്  ഓപ്ഷൻ പ്രകാരമുള്ള മാറ്റം അനുവദിക്കുന്നതാണ് .  
                                 </li>    
                                 <li style="font-size: 17px">For any issues related to online registration please write to us <b>helpdesk@ssus.ac.in</b> / ഓൺലൈൻ രജിസ്ട്രേഷനുമായി ബന്ധപ്പെട്ട എന്തെങ്കിലും പ്രശ്നങ്ങൾക്ക് helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ എഴുതുക</li>
                                
                            </ul>
                            </p>
                           
                            </div>
                            </div>

                          </div>
                    </div>
                     </div>
                  </div>
                </div>  
    </div>
 </section>
@endsection
