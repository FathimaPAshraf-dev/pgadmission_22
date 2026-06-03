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
    color: #0b6e9d;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
    /*margin-top: 5px*/
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
    background: #0b6e9d;  
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
    font-size: 22px;
    color: #0b6e9d;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #0b6e9d;
    font-weight: normal
}

.steps {
    font-size: 22px;
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
    color: #0b6e9d
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 14%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #qualifications:before {
   
     font-family: 'Font Awesome 5 Free';
  content: "\f044";
  font-weight: 900;
    
}
#progressbar #others:before {
    
       font-family: 'Font Awesome 5 Free';
  content: "\f009";
  font-weight: 900;
}
#progressbar #semester:before {
    
           font-family: 'Font Awesome 5 Free';
  content: "\f19d";
  font-weight: 900;
}
#progressbar #personal:before {
    
           font-family: 'Font Awesome 5 Free';
  content: "\f007";
  font-weight: 900;
}
#progressbar #imageupload:before {
     font-family: 'Font Awesome 5 Free';
    content: "\f12e";
         font-weight: 900;
}
#progressbar #signupload:before {
     font-family: 'Font Awesome 5 Free';
    content: "\f12e";
         font-weight: 900;
}

#progressbar #payment:before {
    font-family:'Font Awesome 5 Free';
    content: "\f156";
        font-weight: 900;  
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
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
    background: #0b6e9d
}

.progress {
    height: 10px
}

.progress-bar {
    background-color: #0b6e9d
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
        $("#pgapp_state").change(function () {
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            
        //     alert("Selected Text: " + selectedText + " Value: " + selectedValue);

          $.ajax({
             // alert("hhhh");
            type: 'get',
            url: '/state',
            data:{"formData":selectedValue},
            success: function (response) {
                console.log(response);
            $("#districtdiv").html(response);

          },
    //  error: function (res) {
    //  alert(res);
    //                              }
          });  
           
        });
        
   
  
    }); 

    $(function () {
        $("#pgapp_religion").change(function () {
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
    
  function  fordist()
  {
      
      
      
  var f = document.getElementById("pgapp_state");
 var dist = f.options[f.selectedIndex].value;

  var div = document.getElementById("districtdiv");  
  
  var div2 = document.getElementById("otherdist_div");
         if(dist!="Kerala")
         {
             div.style.display = "none";  
             
             div2.style.display = "block"; 
         
         }
 
    else
         {
             div.style.display = "block"; 
             
              div2.style.display = "none"; 
         
         }
  }
   
    function centropt1()

{

// alert("option11111");
  var f = document.getElementById("center_sl1");
 var cent1 = f.options[f.selectedIndex].value;
 
        $.ajax({
        type: 'POST',
        url: '/centopt1',
        data:{"_token": "{{ csrf_token() }}","cent1":cent1},
        success: function (response) {
            
           
$("#cdiv2").html(response);

$("#div2").show();
      },
                             
      });

}
function centropt2()

{
// alert("option22222");
  var f = document.getElementById("center_sl1");
 var cent1 = f.options[f.selectedIndex].value;

 var f2 = document.getElementById("center_sl2");
 var cent2 = f2.options[f2.selectedIndex].value;
    
        $.ajax({
        type: 'POST',
        url: '/centopt2',
        data:{"_token": "{{ csrf_token() }}","cent1":cent1,"cent2":cent2},
        success: function (response) {

$("#cdiv3").html(response);

$("#div3").show();
      },
                             
      });

}

function commchange(){
 
    var f = document.getElementById("pgapp_religion");
    var relgn = f.options[f.selectedIndex].value;

    var g = document.getElementById("pgapp_community");
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
//  alert('ss');
 e.preventDefault(); 
 var btn_id=$(this).attr('id');
 var img_nm=$('#img_hidden').val()
 var sign_nm=$('#sign_hidden').val()

if(btn_id==='btn_personal'){

   var formval= validateForm('formpersonal');
   var formData = new FormData($('#formpersonal')[0]);
  
   var url="/storepersonal_data";
   if(formval){

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    alert(response.status);
                },
                error: function(errResponse) {
                    console.log(errResponse); 
                }
            });
         }
   
   else{
       return false;
   }
}

else if(btn_id==='btn_educational')
{
   var ugcourse_status = $('input[name="ugcourse_status"]').prop('checked'); 

    var formval= validateQuali('formquali',ugcourse_status);  
   console.log(ugcourse_status);
     if(ugcourse_status){
      $('#degree_aggregate').val("Nil");

        ugcourse_status=1;
     }
     
     else{
        ugcourse_status=0;
     }
     var formData = new FormData($('#formquali')[0]);
     formData.append('ugcourse_status',ugcourse_status);
     var url="/store_quali";
    if(formval){

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    $('#course').text("Course : "+ " "+response.pgquali_exam);
                    $('#sub').text("Main Subject : "+ " "+response.pgquali_subject);
                    $('#pgyear').text("Start Year : "+ " "+response.pgquali_year);
                    $('#pgyearend').text("End Year : "+ " "+response.pgquali_endyear);
                    $('#type').text("Course Type : "+ " "+response.coursetype);
                    $('#duratn').text("Duration of course : "+ " "+response.courseduration+' Year');
                    $('#hidtype').val(response.coursetype);
                    $('#hidduratn').val(response.courseduration);

                    $('#hidresultwait').val(response.ugcourse_status);
//                    add_inputs();
            $('#add_div').html(response.html);

                    if(response.ugcourse_status==1){
                     var ugcourse_status="Yes" ;  
                    }
                    else{
                     var ugcourse_status="No" ;     
                    }
                    $('#resultwait').text(" UG Result awaiting : "+ " "+ugcourse_status);
                   
                    
                    alert(response.status);
                },
                error: function(errResponse) {
                    console.log(errResponse); 
                }
            });
         }
    
     else{
          return false;
     } 
    
}
else if(btn_id==='btn_semdetails') 
{
    var courseduration=document.getElementById('hidduratn').value;
    
    var resultwait=document.getElementById('hidresultwait').value;
    var coursetype=document.getElementById('hidtype').value;
    if(coursetype=="SEMESTER WISE"){
        var formval=validateformsem(courseduration,resultwait);
    }
    else if(coursetype=="YEAR WISE"){
        var formval=validateformyear(courseduration,resultwait);
    }
    
    var formData = new FormData($('#formsem')[0]);
    var url="/storesemester";
    if(formval){

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                   alert(response.status);
                },
                error: function(errResponse) {
                    console.log(errResponse); 
                }
            });
      }

      else{
             return false;
       }
    
}

else if(btn_id==='btn_projectmode')
{

  var formval= validatepmode('formpmode');
  var formData = new FormData($('#formpmode')[0]);
  var url="/store_pmodestream";
  if(formval){

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                  
                    alert(response.status);
                },
                error: function(errResponse) {
                    console.log(errResponse); 
                }
            });
    }
  
  else{
         return false;
   }
            
}
else if(btn_id==='btn_otherinfo')
{

  var formval= validateOther('formotherinfo');
  var formData = new FormData($('#formotherinfo')[0]);
  var url="/store_otherinfo";
  if(formval){

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                  
                    alert(response.status);
                },
                error: function(errResponse) {
                    console.log(errResponse); 
                }
            });
    }
  
  else{
         return false;
   }
            
}


else if(btn_id==='btn_image')
{
  if(img_nm==='')
  {
    alert("Upload image");
    return false;
  }
  
var formval=false;
   var formData = new FormData($('#formimageupload')[0]);

   var url="/store_image";
        $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(responseim) {

//                        $("#previewpay").html(responseim);
                },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
}

else if(btn_id==='btn_sign')
{
    
  if(sign_nm==='')
  {
    alert("Upload signature");
    return false;
  }
  
var formval=false;
   var formData = '';
   var url="/getpreview";
        $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(responseim) {
//                    console.log(responseim);
                $('#photo').text(responseim.file_name1);
                        $("#previewpay").html(responseim);
                                    },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
}

else if(btn_id==='btn_payment')
{
 
  var formval= validateFinalstage('pgpayment');
  var formData = new FormData($('#pgpayment')[0]);
  var url="/pgpayment";
  if(formval){
        document.getElementById("pgpayment").submit();

    }
  
  else{
         return false;
   }
//   alert('test');
            
}

 
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

 

 function validateForm(formval) {

  var error_nationality='';
  var error_religion='';
  var error_community='';
  var error_caste='';
  var error_subcaste='';
  var error_guardian_name='';
  var error_address1='';
  if ($.trim($('#pgapp_nationality').val()) == "") {
    error_nationality = 'Nationality is required';
    alert("Nationality is required");
    $('#error_nationality').text(error_nationality);
    $('#pgapp_nationality').addClass('has-error');
    $('#pgapp_nationality').focus();
    return false;
  }
  else
  {
   error_nationality = '';
   $('#error_nationality').text(error_nationality);
   $('#pgapp_nationality').removeClass('has-error');
  }
  
  
  if ($.trim($('#pgapp_religion').val()) == "") {
    error_religion = 'Religion is required';
    alert("Religion is required");
    $('#error_religion').text(error_religion);
    $('#pgapp_religion').addClass('has-error');
    $('#pgapp_religion').focus();
    return false;
  }
  else
  {
   error_religion = '';
   $('#error_religion').text(error_religion);
   $('#pgapp_religion').removeClass('has-error');
  }
  if ($.trim($('#pgapp_community').val()) == "") {
    error_community = 'Community is required';
    alert("Community is required");
    $('#error_community').text(error_community);
    $('#pgapp_community').addClass('has-error');
    $('#pgapp_community').focus();
    return false;
  }
  else
  {
   error_community = '';
   $('#error_community').text(error_community);
   $('#pgapp_community').removeClass('has-error');
  }
  if ($.trim($('#pgapp_caste_sl').val()) == "") {
    error_caste = 'Caste is required';
    alert("Caste is required");
    $('#error_caste').text(error_caste);
    $('#pgapp_caste_sl').addClass('has-error');
    $('#pgapp_caste_sl').focus();
    return false;
  }
  else
  {
   error_caste = '';
   $('#error_caste').text(error_caste);
   $('#pgapp_caste_sl').removeClass('has-error');
  }
  if ($.trim($('#pgapp_state').val()) == "") {
    alert("State is required");
    $('#pgapp_state').focus();
    return false;
  }
  if ($.trim($('#pgapp_district').val()) == "") {
    alert("District is required");
    $('#pgapp_district').focus();
    return false;
  }
  if ($.trim($('#pgapp_father').val()) == "") {
    error_guardian_name = 'Name of Guardian is required';
    alert("Name of Guardian is required");
    $('#error_guardian_name').text(error_guardian_name);
    $('#pgapp_father').addClass('has-error');
    $('#pgapp_father').focus();
    return false;
  }
  else
  {
   error_guardian_name = '';
   $('#error_guardian_name').text(error_guardian_name);
   $('#pgapp_father').removeClass('has-error');
  }
   if ($.trim($('#comm_addressline1').val()) == "") {
    error_address1 = 'Communication Address Line1 is required';
    alert("Communication Address Line1 is required");
    $('#error_address1').text(error_address1);
    $('#comm_addressline1').addClass('has-error');
    $('#comm_addressline1').focus();
    return false;
  }
  else
  {
   error_address1 = '';
   $('#error_address1').text(error_address1);
   $('#comm_addressline1').removeClass('has-error');
  }
  if ($.trim($('#comm_addressline2').val()) == "") {
    error_address1 = 'Communication Address Line2 is required';
    alert("Communication Address Line2 is required");
//    $('#error_address1').text(error_address1);
//    $('#comm_addressline1').addClass('has-error');
    $('#comm_addressline2').focus();
    return false;
  }
  if ($.trim($('#comm_addressline3').val()) == "") {
    error_address1 = 'Communication Address Line3 is required';
    alert("Communication Address Line3 is required");
//    $('#error_address1').text(error_address1);
//    $('#comm_addressline1').addClass('has-error');
    $('#comm_addressline3').focus();
    return false;
  }
  if ($.trim($('#per_addressline1').val()) == "") {
    error_address1 = 'Permanent Address Line1 is required';
    alert("Permanent Address Line1 is required");
    $('#per_addressline1').focus();
    return false;
  }
 
  if ($.trim($('#per_addressline2').val()) == "") {
    alert("Permanent Address Line2 is required");
    $('#per_addressline2').focus();
    return false;
  }
  if ($.trim($('#per_addressline3').val()) == "") {
    alert("Permanent Address Line3 is required");
    $('#per_addressline3').focus();
    return false;
  }
   
  
  if ($.trim($('#pgapp_pincode').val()) == "") {
    alert("Pin Code is required");
    $('#pgapp_pincode').focus();
    return false;
  }
  return true;
  
}

function validatepmode(formval){
   if ($.trim($('#course1').val()) == "") {
    error_course1 = 'Course which you are applied for ';
    alert("Course which you are applied for is required");
    $('#error_course1').text(error_course1);
    $('#course1').addClass('has-error');
    $('#course1').focus();
    return false;
    }
    else
    {
     error_course1 = '';
     $('#error_nationality').text(error_course1);
     $('#course1').removeClass('has-error');
    }
    return true;
  
}
function validateQuali(formvalue,ugcourse_status) {
  
  if ($.trim($('#sslc_mark').val()) == "") {
    alert('Total Mark/Percentage of sslc is required');
    
    $('#sslc_mark').focus();
    return false;
  }
  
    if ($.trim($('#pgquali_institute').val()) == "") {
    alert('College/Institute is required');
    
    $('#pgquali_institute').focus();
    return false;
  }
    if ($.trim($('#pgquali_university').val()) == "") {
    alert('University is required');
    
    $('#pgquali_university').focus();
    return false;
  }
  if ($.trim($('#pgquali_exam').val()) == "") {
    alert('Course is required');
    
    $('#pgquali_exam').focus();
    return false;
  }
    if ($.trim($('#pgquali_subject').val()) == "") {
    alert('Main/Core Subjects is required');
    
    $('#pgquali_subjects').focus();
    return false;
  }
  if ($.trim($('#coursetype').val()) == "") {
    alert('Course type is required');
    
    $('#coursetype').focus();
    return false;
  }
  if ($.trim($('#pgquali_year').val()) == "") {
    alert('Course Start Year is required');
    
    $('#pgquali_year').focus();
    return false;
  }
    if ($.trim($('#pgquali_endyear').val()) == "") {
    alert('Course End Year is required');
    
    $('#pgquali_endyear').focus();
    return false;
  }
  if ($.trim($('#courseduration').val()) == "") {
    alert('Duration of course is required');
    
    $('#courseduration').focus();
    return false;
  }
 
  if ($.trim($('#regnodegree').val()) == "") {
    alert('Degree Register number is required');
    
    $('#regnodegree').focus();
    return false;
  }
  if(ugcourse_status==false){
   if ($.trim($('#degree_aggregate').val()) == "") {
    alert('Aggregate percentage / CGPA is required');
    
    $('#degree_aggregate').focus();
    return false;
  }
}
  
  
//  if ($.trim($('#pgquali_grade').val()) == "") {
//    alert('Grade & Grade Point/Percentage of marks is required');
//    
//    $('#pgquali_grade').focus();
//    return false;
//  }


  return true;
  
}
function validateformsem(courseduration,resultwait,coursetype) {

 var i;
 var x=0;
 if(resultwait==1){
     x=2;
 }
 for(i=1;i<=(courseduration*2-x);i++){
     
  if ($.trim($('#name_'+i).val()) == "") {
      var name = $("input[name='name_" + i + "']");
    name.parent().append(
                  '<div class="invalid-feedback" style="display: block; "> <b>' +
                    "SGPA/Percentage of sem  "+i+" is required'</b></div>"
                );
    $('#name_'+i).focus();
    $(".invalid-feedback").fadeOut(20000);
    return false;
  }
 }
  
  return true;
  
}
function validateformyear(courseduration,resultwait,coursetype) {

 var i;
 var x=0;
 if(resultwait==1){
     x=1;
 }
 for(i=1;i<=(courseduration-x);i++){
     
  if ($.trim($('#yr_'+i).val()) == "") {
      var name = $("input[name='yr_" + i + "']");
    name.parent().append(
                  '<div class="invalid-feedback" style="display: block; "> <b>' +
                    "SGPA/Percentage of year  "+i+" is required'</b></div>"
                );
    $('#yr_'+i).focus();
    $(".invalid-feedback").fadeOut(20000);
    return false;
  }
 }
  
  return true;
  
}



function validateOther(formval){
   
  if($('input[name="ph_status"]:checked').val()==1){
      if ($.trim($('#ph_type').val()) == ""){
                alert("please select differently abled type");
    return false;

      }
  }
  if ($.trim($('#pgapp_inc_sl').val()) == "") {
    error_pgapp_inc_sl = 'Income is required';
    alert("Income is required");
    $('#error_pgapp_inc_sl').text(error_pgapp_inc_sl);
    $('#pgapp_pgapp_inc_sl').addClass('has-error');
    $('#pgapp_pgapp_inc_sl').focus();
    return false;
  } 
  if ($.trim($('#center_slexam').val()) == "") {
    error_center_slexam = 'Entrance Examination Centre is required';
    alert("Entrance Examination Centre is required");
    $('#error_center_slexam').text(error_center_slexam);
    $('#error_center_slexam').addClass('has-error');
    $('#error_center_slexam').focus();
    return false;
  }
  
  
  
  return true;
  
}
 
function validateOther2(formval){
   

if ($.trim($('#center_sl1').val()) == "0") {
    error_center_sl1 = 'select your Ist Centre Choice ';
    alert("select your Ist Centre Choice");
    $('#error_center_sl1').text(error_center_sl1);
    $('#center_sl1').addClass('has-error');
    $('#center_sl1').focus();
    return false;
  } 
  if ($.trim($('#center_slexam').val()) == "0") {
    error_center_slexam = 'select your Exam Centre ';
    alert("select your Exam Centre ");
    $('#error_center_slexam').text(error_center_slexam);
    $('#center_slexam').addClass('has-error');
    $('#center_slexam').focus();
    return false;
  } 
  return true;
  
}

function validateFinalstage(formval){
   
  var declaration_status = $('input[name="declaration_status"]').prop('checked'); 
  
  if(declaration_status==false){
      alert('Please accept the declartions.')
      return false;
  }
  else{
  return true;
  }
  
}

  $('#formimageupload').on('submit', function(event){
  event.preventDefault();
  
  $.ajax({
   url:"{{ route('store_image') }}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
  beforeSend: function(){
        $("#upload").prop('disabled', true);
        $("#loader").show();
    },
   success:function(data)
   {
    $('#message').css('display', 'block');
    $('#message').html(data.message);
    console.log(data);
    $('#message').addClass(data.class_name);
//    $('#uploaded_image').html(data.uploaded_image);
    $('#pgapp_photo').val(data.uploaded_image);
    $("#upload").prop('disabled', false);
    if(data.status==1){
      $('#img_hidden').val("success");
    }
    

     alert(data.message);
   },
   complete:function(data){
    // Hide image container
    $("#loader").hide();
    $("#upload").prop('disabled', false);
   }
  
  })
 });
// 
   $('#formsignupload').on('submit', function(event){
  event.preventDefault();
  
  $.ajax({
   url:"{{ route('store_sign') }}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
  beforeSend: function(){
        $("#upload").prop('disabled', true);
        $("#loader").show();
    },
   success:function(data)
   {
    $('#message').css('display', 'block');
    $('#message').html(data.message);
    
    $('#message').addClass(data.class_name);
    $('#pgapp_sign').val(data.uploaded_sign);
    $("#upload").prop('disabled', false);
    if(data.status==1){
      $('#sign_hidden').val("success");
    }
    
console.log(data.uploaded_sign);
     alert(data.message);
   },
   complete:function(data){
    // Hide image container
    $("#loader").hide();
    $("#upload").prop('disabled', false);
   }
  
  })
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
 $("input[name='yes']").click(function() {
    if ($("#Yes").is(":checked")) {
       $("#dveduy").show();
     } else {
       $("#dveduy").hide();
     }
   }); 
 
 $("input[name='ph_status']").click(function() {
    if ($("#chkYes").is(":checked")) {
       $("#dvedu").show();
     } else {
       $("#dvedu").hide();
     }
   }); 
    $("input[name='pgapp_wh_special_reserv']").click(function() {
    if ($("#pgapp_wh_special").is(":checked")) {
       $("#dvyes").show();
     } else {
       $("#dvyes").hide();
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
 function showPreviewsign(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-is-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
 
</script>
 

<!--<script>
    $('select').on('change', function() {
  $('option').prop('disabled', false);
  $('select').each(function() {
    var val = this.value;
    $('select').not(this).find('option').filter(function() {
      return this.value === val;
    }).prop('disabled', true);
  });
}).change();

</script>    -->

@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
                <h4 id="heading">Complete Your Online Registration</h4>
                <p>Fill all form field to go to next step</p>
                <div id="msform" method="post">
                   <!--  @csrf -->
                    <!-- progressbar -->
                    <ul id="progressbar" style="z-index: 0; border: none;   position: relative">
                       
                        <li class="active" id="personal"><strong>Personal</strong></li>
                        <li id="qualifications"><strong>Qualifications</strong></li>
                        <li  id="semester"><strong>Course details</strong></li>
                         @if(Auth::user()->pgapp_adsc_sl==998)
                        <li  id="others"><strong>Programme Options</strong></li>
                        @endif
                        <li  id="others"><strong>Others</strong></li>
                        
                        <li  id="imageupload"><strong>Photograph</strong></li>
                        <li  id="signupload"><strong>Signature</strong></li>

                        <li  id="payment"><strong>Preview & Payment</strong></li>
<!--                        <li id="confirm"><strong>Finish</strong></li>-->
                         
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                  
                    <fieldset>
                         <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h6 class="fs-title">Personal Information:</h6>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 7</h2>
                                </div>
                            </div> @include('personalpmode')
                        </div> <label for="btn_personal_ref"  name="btn_personal" id="btn_personal" class="next action-button" >Save & Next</label> 
                       
                    </fieldset>
                      <fieldset>
                       
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Educational Qualifications:</h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 7</h2>
                                </div>
                            </div>
                           
                            @include('qualification')
                        </div><label for="btn_resultawaiting"  name="btn_educational" id="btn_educational" class="next action-button" >Save & Next</label>  <input type="button" name="previous" class="previous action-button-previous"  value="Previous" />
                       
                      </fieldset>
                    <fieldset>
                       
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Course Details:</h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 7</h2>
                                </div>
                            </div>
                           
                            @include('semdetails')
                        </div><label for="btn_semdetailsref"  name="btn_semdetails" id="btn_semdetails" class="next action-button" >Save & Next</label>  <input type="button" name="previous" class="previous action-button-previous"  value="Previous" />
                       
                      </fieldset>
                   @if(Auth::user()->pgapp_adsc_sl==998)
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Programme Options:</h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 7</h2>
                                </div>
                            </div> @include('projectmodeoptions') 
                        </div> <label for="btnprojectmode_ref"  name="btn_projectmode" id="btn_projectmode" class="next action-button">Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                   @endif
                       <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Other Information:</h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 7</h2>
                                </div>
                            </div> @include('otherinformation') 
                        </div> <label for="btnotherinfo_ref"  name="btn_otherinfo" id="btn_otherinfo" class="next action-button">Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                 
                    
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Photograph </h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 5 - 7</h2>
                                </div>
                            </div> @include('imageupload') 
                        </div> <label for="btn_imageupload" name="btn_image" id="btn_image" class="next action-button" >Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                     <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Signature </h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 6 - 7</h2>
                                </div>
                            </div> @include('signupload') 
                        </div> <label for="btn_signupload" name="btn_sign" id="btn_sign" class="next action-button" >Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                  
                     <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Preview & Payment Details:</h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 7 - 7</h2>
                                </div>
                            </div> 
                             <div class="form-group row" id="previewpay"></div>
                         
                        </div>
                         

                  <label for="btn_payment" name="btn_payment" id="btn_payment" class="next action-button" >Submit</label>
                  
                         <input type="button" name="previous" form="pgpayment" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
