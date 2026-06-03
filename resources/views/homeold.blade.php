@extends('layouts.app')

@section('styles')
<style>

* {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

p {
    color: grey
}

#heading {
    text-transform: uppercase;
    color: #673AB7;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

.form-card {
    text-align: left
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform input,
#msform textarea {
    /*padding: 8px 15px 8px 15px;*/
    border: 1px solid #ccc;
    
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #673AB7;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform .action-button:hover,
#msform .action-button:focus {
    background-color: #311B92
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    background-color: #000000
}


.fs-title {
    font-size: 25px;
    color: #673AB7;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #673AB7;
    font-weight: normal
}

.steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels {
    color: gray;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #673AB7
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 16%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #qualifications:before {
    font-family: FontAwesome;
    content: "\f13e";
    font-weight: 900;
}
#progressbar #others:before {
    font-family: FontAwesome;
    content: "\f13e";
    font-weight: 900;
}
#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007";
         font-weight: 900;
}
#progressbar #imageupload:before {
    font-family: FontAwesome;
    content: "\f007";
         font-weight: 900;
}
#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f030"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #673AB7
}

.progress {
    height: 10px
}

.progress-bar {
    background-color: #673AB7
}

.fit-image {
    width: 100%;
    object-fit: cover
}
</style>
@stop


@section('scripts')
<script type="text/javascript">
    $(function () {
        $("#postpgapp_religion").change(function () {
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            
//             alert("Selected Text: " + selectedText + " Value: " + selectedValue);
            
            
            
          $.ajax({
            type: 'get',
            url: '/religion',
            data:{"formData":selectedValue},
            success: function (response) {
                console.log(response);
            $("#commdiv").html(response);

          },
    //  error: function (res) {
    //  alert(res);
    //                              }
          });  
           
        });
        
        
        
    }); 
    
function commchange(){
 
    var f = document.getElementById("postpgapp_religion");
    var relgn = f.options[f.selectedIndex].value;

    var g = document.getElementById("postpgapp_community");
    var cmty = g.options[g.selectedIndex].value;


          $.ajax({
            type: 'get',
            url: '/community',
            data:{"relgn":relgn,"cmty":cmty},
            success: function (response) {
//            console.log(response);
            $("#castediv").html(response);

            },
//            error: function (res) {
//                alert(res);
//                                        
//            }
            }); 

}

function subchange(){
 
    var ff = document.getElementById("pgapp_relgn_sl");
    var relgn = ff.options[ff.selectedIndex].value;

    var gg = document.getElementById("pgapp_caste_sl");
    var cmty = gg.options[gg.selectedIndex].value;


         $.ajax({
            type: 'POST',
            url: '/subcaste',
            data:{"_token": "{{ csrf_token() }}","relgn":relgn,"caste":cmty},
            success: function (response) {
            $("#subcastediv").html(response);

            },
//  error: function (res) {
//  alert(res);
//                              }
         });


}
$(document).ready(function(){

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;
setProgressBar(current);

$("#msform").on('click','.next', function(e) {
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        next_fs.css({'opacity': opacity});
        },
        duration: 500
        });
        setProgressBar(++current);
   
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
    
return false;
})

});

 $("#formpersonal").on('click','.btn-success', function(e) {

        e.preventDefault(); 
        var formval= validateForm('formpersonal');
        if(formval){

            var formData = new FormData($('#formpersonal')[0]);


            $.ajax({
                type: "POST",
                url: "/storepersonal",
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    alert("Saved successfully");
                },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
        }
        else{
             return false;
        }

        

    });
 
 $("#formquali").on('click','.btn-primary', function(e) {

        e.preventDefault(); 
        var formval= validateForm('formquali');
        if(formval){

            var formData = new FormData($('#formquali')[0]);


            $.ajax({
                type: "POST",
                url: "/store_quali",
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    alert(response);
                },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
             $.ajax({
                type: "GET",
                url: "home",
            
                success: function(response){


                 $(".form").html(response);

                },
                error:function(response)
                            {
            //                     alert(response);
                            }

            });
        }
        else{
             return false;
        }

        

    });
 
 function validateForm(formval) {

  var error_nationality='';
  var error_religion='';
  var error_community='';
  var error_caste='';
  var error_subcaste='';
  var error_guardian_name='';
  var error_address1='';
  if ($.trim($('#postpgapp_nationality').val()) == "") {
    error_nationality = 'Nationality is required';
    $('#error_nationality').text(error_nationality);
    $('#postpgapp_nationality').addClass('has-error');
    $('#postpgapp_nationality').focus();
    return false;
  }
  else
  {
   error_nationality = '';
   $('#error_nationality').text(error_nationality);
   $('#postpgapp_nationality').removeClass('has-error');
  }
  if ($.trim($('#postpgapp_religion').val()) == "") {
    error_religion = 'Religion is required';
    $('#error_religion').text(error_religion);
    $('#postpgapp_religion').addClass('has-error');
    $('#postpgapp_religion').focus();
    return false;
  }
  else
  {
   error_religion = '';
   $('#error_religion').text(error_religion);
   $('#postpgapp_religion').removeClass('has-error');
  }
  if ($.trim($('#postpgapp_community_sl').val()) == "") {
    error_community = 'Community is required';
    $('#error_community').text(error_community);
    $('#postpgapp_community_sl').addClass('has-error');
    $('#postpgapp_community_sl').focus();
    return false;
  }
  else
  {
   error_community = '';
   $('#error_community').text(error_community);
   $('#postpgapp_community_sl').removeClass('has-error');
  }
  if ($.trim($('#postpgapp_caste_sl').val()) == "") {
    error_caste = 'Caste is required';
    $('#error_caste').text(error_caste);
    $('#postpgapp_caste_sl').addClass('has-error');
    $('#postpgapp_caste_sl').focus();
    return false;
  }
  else
  {
   error_caste = '';
   $('#error_caste').text(error_caste);
   $('#postpgapp_caste_sl').removeClass('has-error');
  }
  
  
  if ($.trim($('#postpgapp_father_guardian_name').val()) == "") {
    error_guardian_name = 'Name of Guardian is required';
    $('#error_guardian_name').text(error_guardian_name);
    $('#postpgapp_father_guardian_name').addClass('has-error');
    $('#postpgapp_father_guardian_name').focus();
    return false;
  }
  else
  {
   error_guardian_name = '';
   $('#error_guardian_name').text(error_guardian_name);
   $('#postpgapp_father_guardian_name').removeClass('has-error');
  }
   if ($.trim($('#postpgapp_comn_address').val()) == "") {
    error_address1 = 'Address Line1 is required';
    $('#error_address1').text(error_address1);
    $('#postpgapp_comn_address').addClass('has-error');
    $('#postpgapp_comn_address').focus();
    return false;
  }
  else
  {
   error_address1 = '';
   $('#error_address1').text(error_address1);
   $('#postpgapp_comn_address').removeClass('has-error');
  }

  return true;
  
}

function validatequali(formvalue) {

  var error_exam='';

  if ($.trim($('#postpgquali_exam').val()) == "") {
    error_exam = 'Exam is required';
    $('#error_exam').text(error_exam);
    $('#postpgquali_exam').addClass('has-error');
    $('#postpgquali_exam').focus();
    return false;
  }
  else
  {
   error_exam = '';
   $('#error_exam').text(error_exam);
   $('#postpgquali_exam').removeClass('has-error');
  }

  return true;
  
}
   
$("#formotherinfo").on('click','.btn-success', function(e) {

        e.preventDefault(); 
        var formval= validateForm('formotherinfo');
      

            var formData = new FormData($('#formotherinfo')[0]);


            $.ajax({
                type: "POST",
                url: "/store_otherinfo",
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    alert(response);
                },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
        

        

    });

$("#formimageupload").on('click','.btn-success', function(e) {

        e.preventDefault(); 
        var formval= validateForm('formimageupload');
      

            var formData = new FormData($('#formimageupload')[0]);


            $.ajax({
                type: "POST",
                url: "/store_image",
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    alert(response);
                },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
        

        

    });
function copyValue(Chk) {
        if (Chk.checked) {
            var adr1 = document.getElementById('comm_addressline1').value;
            document.getElementById('per_addressline1').value = adr1;
            var adr2 = document.getElementById('comm_addressline2').value;
            document.getElementById('per_addressline2').value = adr2;
            var adr3 = document.getElementById('comm_addressline3').value;
            document.getElementById('per_addressline3').value = adr3;
        }
        else {
            document.getElementById('per_addressline1').value = "";
            document.getElementById('per_addressline2').value = "";
            document.getElementById('per_addressline3').value = "";
        }
}
 $("input[name='ph_status']").click(function() {
    if ($("#chkYes").is(":checked")) {
       $("#dvedu").show();
     } else {
       $("#dvedu").hide();
     }
   }); 
   $("input[name='postpgjrf_option']").click(function() {
    if ($("#jrfYes").is(":checked")) {
       $("#dvjrf").show();
     } else {
       $("#dvjrf").hide();
     }
   });
   $("input[name='postpgemployment_option']").click(function() {
    if ($("#empYes").is(":checked")) {
       $("#dvemp").show();
     } else {
       $("#dvemp").hide();
     }
   });
    $("input[name='postpgpaperpublish_option']").click(function() {
    if ($("#papYes").is(":checked")) {
       $("#dvpap").show();
     } else {
       $("#dvpap").hide();
     }
   });
   
 function showPreviewphoto(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}  
 

</script>
 
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
                <h4 id="heading">Complete Your Profile</h4>
                <p>Fill all form field to go to next step</p>
                <div id="msform" method="post">
                   <!--  @csrf -->
                    <!-- progressbar -->
                    <ul id="progressbar" style="z-index: 0; border: none;   position: relative">
                       
                        <li class="active" id="personal"><strong>Personal</strong></li>
                        <li id="qualifications"><strong>Qualifications</strong></li>
                        <li  id="others"><strong>Others</strong></li>
                        <li  id="imageupload"><strong>Image</strong></li>
                        <li  id="payment"><strong>Payment</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                  
                    <fieldset>
                         <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Personal Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 6</h2>
                                </div>
                            </div> @include('personal')
                        </div> <label for="btn_personal_ref" type="submit" name="btn_personal" id="btn_personal" class="next action-button" >Next</label> 
                       
                    </fieldset>
                      <fieldset>
                       
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Educational Qualifications:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 6</h2>
                                </div>
                            </div> @include('qualification')
                        </div> <input type="button" name="btn_qualifications" id="btn_qualifications" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                       
                      </fieldset>
                       <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Other Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 6</h2>
                                </div>
                            </div> @include('otherinformation') 
                        </div> <label for="btnotherinfo_ref" type="submit" name="btn_otherinfo" id="btn_otherinfo" class="next action-button">Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Image Upload:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 6</h2>
                                </div>
                            </div> @include('imageupload') 
                        </div><input type="button" name="btn_image" id="btn_image" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                     <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Payment Details:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 5 - 6</h2>
                                </div>
                            </div> @include('payment')
                        </div><input type="button" name="btn_payment" id="btn_payment" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />

                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 6 - 6</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Completed</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
