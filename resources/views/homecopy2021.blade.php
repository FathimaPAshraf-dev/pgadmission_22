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
    width: 19%;
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
#progressbar #options:before {
    
           font-family: 'Font Awesome 5 Free';
  content: "\f0000";
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
console.log(btn_id);
console.log(img_nm);

if(btn_id==='btn_personal'){

   var formval= validateForm('formpersonal');
   var formData = new FormData($('#formpersonal')[0]);
   var url="/storepersonal";
//alert(formval);
}

else if(btn_id==='btn_educational')
{
   var ugcourse_status = $('input[name="ugcourse_status"]').prop('checked'); 
   var mphilcourse_status = $('input[name="mphilcourse_status"]').prop('checked'); 
   if(ugcourse_status==true){
         var ugcourse_status=1;
     }
     
     else{
         var ugcourse_status=0;
     }
     
     var formval=true;
    var formData = new FormData($('#formresultawaiting')[0]);

     formData.append('ugcourse_status',ugcourse_status);
     formData.append('mphilcourse_status',mphilcourse_status);
     var url="/store_resultawaiting";
//     console.log(formData);
}

else if(btn_id==='btn_otherinfo')
{
//return"kkk";
//alert("yes1");
  var formval= validateOther('formotherinfo');
//var formval=true;
   var formData = new FormData($('#formotherinfo')[0]);
   var url="/store_otherinfo";
}
else if(btn_id==='btnoptions')
{
   // alert("yes");
//return"kkk";
  var formval= validateOther2('formoptions');
//var formval=true;
 //alert("yes2");

   var formData = new FormData($('#formoptions')[0]);
   var url="/store_options";
}

else if(btn_id==='btn_image')
{
  // alert( "hhh");
  console.log('inside image');
  if(img_nm==='')
  {
    console.log('test'+img_nm);
    alert("Upload image");
    return false;
  }
  
//  var formval= validateOther('formotherinfo');
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

                        $("#previewpay").html(responseim);
                                    },
                error: function(errResponse) {
                    console.log(errResponse);
                }
            });
}


         if(formval){

//alert("hhhhh");

            $.ajax({
                type: "POST",
                url: url,
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
         }
         
//         else if(url==="/getoptions"){
//           //  alert("dddsdsd");
//  
//               } 
         
         else if(url==="/getpreview"){
           //  alert("dddsdsd");
         }
       else{
         //  alert('fails');
              return false;
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

$('#edit').on('show.bs.modal', function (event) {
      
      
      console.log('model opened');
      var button = $(event.relatedTarget);
      var pgquali_exam = button.data('pgquali_exam');
      var pgquali_institute = button.data('pgquali_institute');
      var pgquali_university = button.data('pgquali_university');
      var pgquali_subjects = button.data('pgquali_subjects');
      var pgquali_year = button.data('pgquali_year');
      var pgquali_grade = button.data('pgquali_grade');
       
      var postpgquali_serial = button.data('postpgquali_serial');
//      alert(id);
      var modal = $(this)
      modal.find('.modal-body #pgquali_exam').val(pgquali_exam);
      modal.find('.modal-body #pgquali_institute').val(pgquali_institute);
      modal.find('.modal-body #pgquali_university').val(pgquali_university);
      modal.find('.modal-body #pgquali_subjects').val(pgquali_subjects);
      modal.find('.modal-body #pgquali_year').val(pgquali_year);
      modal.find('.modal-body #pgquali_grade').val(pgquali_grade);
      
      modal.find('.modal-body #postpgquali_serial').val(postpgquali_serial);
 
   
})


});

 
 
 $("#formquali").on('click','.btn-primary', function(e) {

        e.preventDefault(); 
         var formval= validateQuali('formquali');
         if(formval){

            var formData = new FormData($('#formquali')[0]);


            $.ajax({
                type: "POST",
                url: "/store_quali",
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(response) {
                    console.log(response);
                    $(".modal").removeClass("in");
                    $(".modal-backdrop").remove();
                    $('#formquali')[0].reset(); 
                    $('#modal-lg').modal('hide');
                    $("#education").html(response);
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
 
 $("#editform_edu").on('click','.btn-primary', function(e) {

        e.preventDefault(); 
     //  var formval= validateQuali('form_student');
//   if(formval){
        var formData = new FormData($('#editform_edu')[0]);

        $.ajax({
            type: "POST",
            url: "/update_quali",
            data: formData,
            processData: false,
            contentType: false,
            
            success: function(response) {
        console.log(response);
          $(".modal").removeClass("in");
                    $(".modal-backdrop").remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $(".modal").hide();
                    $("#education").html(response);



       

            },
            error: function(errResponse) {
                console.log(errResponse);
            }
        });

//    }    
//    else{
//        return false;
//    }       
        

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
   if ($.trim($('#pgapp_state').val()) == "") {
    alert("State is required");
    $('#pgapp_state').focus();
    return false;
  }
//  if ($.trim($('#pgapp_district').val()) == "") {
//    alert("District is required");
//    $('#pgapp_district').focus();
//    return false;
//  }
  if ($.trim($('#pgapp_pincode').val()) == "") {
    alert("Pin Code is required");
    $('#pgapp_pincode').focus();
    return false;
  }
  return true;
  
}

function validateQuali(formvalue) {

  if ($.trim($('#pgquali_exam').val()) == "") {
    alert('Exam is required');
    
    $('#pgquali_exam').focus();
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
    if ($.trim($('#pgquali_subject').val()) == "") {
    alert('Main/Core Subjects is required');
    
    $('#pgquali_subjects').focus();
    return false;
  }
    if ($.trim($('#pgquali_year').val()) == "") {
    alert('Year is required');
    
    $('#pgquali_year').focus();
    return false;
  }
  if ($.trim($('#pgquali_grade').val()) == "") {
    alert('Grade & Grade Point/Percentage of marks is required');
    
    $('#pgquali_grade').focus();
    return false;
  }


  return true;
  
}

function validateOther(formval){
   
 //   alert($('input[name="ph_status"]:checked').val());
    
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
function validateimage(formval){
    
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
    
    $('#message').addClass(data.class_name);
//    $('#uploaded_image').html(data.uploaded_image);
    $('#postpgapp_photo').val(data.uploaded_image);
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
                <h4 id="heading">Complete Your Online Registration</h4>
                <p>Fill all form field to go to next step</p>
                <div id="msform" method="post">
                   <!--  @csrf -->
                    <!-- progressbar -->
                    <ul id="progressbar" style="z-index: 0; border: none;   position: relative">
                       
                        <li class="active" id="personal"><strong>Personal</strong></li>
                        <li id="qualifications"><strong>Qualifications</strong></li>
                        <li  id="others"><strong>Others</strong></li>
                        <li  id="options"><strong>options</strong></li>
                        <li  id="imageupload"><strong>Photograph</strong></li>
                      
                        <li  id="payment"><strong>Payment</strong></li>
<!--                        <li id="confirm"><strong>Finish</strong></li>-->
                         
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
                        </div> <label for="btn_personal_ref"  name="btn_personal" id="btn_personal" class="next action-button" >Save & Next</label> 
                       
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
                            </div>
                           
                            @include('qualification')
                        </div><label for="btn_resultawaiting"  name="btn_educational" id="btn_educational" class="next action-button" >Save & Next</label>  <input type="button" name="previous" class="previous action-button-previous"  value="Previous" />
                       
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
                        </div> <label for="btnotherinfo_ref"  name="btn_otherinfo" id="btn_otherinfo" class="next action-button">Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                     <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Options:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 6</h2>
                                </div>
                            </div> @include('options') 
                        </div> <label for="btnoptions"  name="btnoptions" id="btnoptions" class="next action-button">Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    
                  
                    
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Photograph:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 5 - 6</h2>
                                </div>
                            </div> @include('imageupload') 
                        </div> <label for="btn_imageupload" name="btn_image" id="btn_image" class="next action-button" >Save & Next</label><input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                  
                     <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Preview & Payment Details:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 6 - 6</h2>
                                </div>
                            </div> 
                             <div class="form-group row" id="previewpay"></div>
                         
                        </div>
                         
                         <form action="{{ route('postpgpayment') }}" name="postpgpayment" method="post">
                             @csrf
                             <button type="submit" name="btn_payment" id="btn_payment" class="action-button" value="Submit">Submit</button> 
                         </form>
                         <input type="button" name="previous" form="postpgpayment" class="previous action-button-previous" value="Previous" />
                    </fieldset>
<!--                    <fieldset>
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
                    </fieldset>-->
                </div>
            </div>
        </div>
    </div>
</div>
         
    </div>
</div>

@endsection
