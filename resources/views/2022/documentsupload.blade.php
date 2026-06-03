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
<!--<script>

$(document).ready(function(){
 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


 $("#submitButton").click(function(ev) {
    ev.preventDefault(); 

  var formval= validateupload('formdocupload');
  if(formval){
    var formData =document.getElementById('doc').value;

//    var formData = new FormData($('#formdocupload')[0]);
    console.log(formData);         
      $.ajax({
        type: 'POST',
        url: '/store_documents',
        data: formData,
        
        beforeSend: function(e){
                     $("#submitButton").prop('disabled', true);
                     $("#loader").show();
                     
                    if(confirm("Are you sure?"))
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
function validateupload(formval){  
    if ($.trim($('#doc').val()) == "") {
    error_center_sl1 = 'Select your certificates ';
    alert("Upload your certificates ");
    $('#error_center_sl1').text(error_center_sl1);
    $('#doc').addClass('has-error');
    $('#doc').focus();
    return false;
  } 
    
    return true;
  
}
</script>-->
<script>
 $(function() {
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $.validator.setDefaults({
    submitHandler: function () {
       var base_url = window.location.origin;
        var formData = new FormData($('#formdocupload')[0]);
        $('.btn_save').prop('disabled', true);
        
        $.ajax({
                url: base_url+"/store_documents",
                type: "POST",
                data:formData,
                contentType: false,
                cache:false,
                processData:false,
                success: function(response)
                {
                   alert(response.message);
                   window.location.href = "pay_details";
                   $('.btn_save').prop('disabled', false);

                   $('.nav-pills .active').parent().next('li').find('a').trigger('click');

                },
                error: function(data) 
                {
                    $('.btn_save').prop('disabled', false);

                    $( ".invalid-feedback" ).remove();
                    $.each(data.responseJSON.errors, function (key, value) {
                     var name = $("input[name='"+key+"']");
                     if(key.indexOf(".") != -1){
                       var arr = key.split(".");
                       name = $("input[name='"+arr[0]+"[]']:eq("+arr[1]+")");
                     }
                     
                   
                     name.parent().append('<div class="invalid-feedback" style="display: block; font-size:20px;"> <b>'+value[0]+'</b></div>');
                                    
                   });
                    
                }  
            })

    }
  });
  $('#formdocupload').validate({
     
      ignore: '',
      
    rules: {
        doc: {
          required: true,
         
        },
        
    },
    messages: {
//        name: {
//          required: "Permission is required.",
//          minlength: "Permission must be at least 2 characters long"
//        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
  });  
 
});  
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
                <h4>UPLOAD YOUR CERTIFICATES <br></h4>
            </div>
         <div class="row">  
              <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">INSTRUCTIONS - MALAYALAM</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">INSTRUCTIONS - ENGLISH</a>
                    </li>

                    </ul>
                    </div>
                    <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        2024 പി ജി എൻട്രൻസ് റാങ്ക് ലിസ്റ്റ് പ്രകാരം യോഗ്യതയുള്ള എല്ലാ അപേക്ഷകരും എസ് എസ് എൽ സി (ഫ്രണ്ട് പേജ്, മാർക്ക്‌ ലിസ്റ്റ് ), പ്ലസ് ടു, ഡിഗ്രി എന്നിവയുടെ മാർക്ക്‌ ലിസ്റ്റുകൾ, ഡിഗ്രി സർട്ടിഫിക്കറ്റ് എന്നിവ അപ്‌ലോഡ് ചെയ്യേണ്ടതാണ്. ഡിഗ്രി അവസാന സെമസ്റ്റർ പരീക്ഷ ഫലം കാത്തിരിക്കുന്ന വിദ്യാർത്ഥികൾ ആദ്യ നാല് സെമസ്റ്ററുകളുടെ മാർക്ക് ലിസ്റ്റുകൾ നിർബന്ധമായും അപ്‌ലോഡ് ചെയ്യേണ്ടതാണ്.റിസർവേഷൻ കാറ്റഗറിയിൽ(OBC) ഉള്ള അപേക്ഷകർ സാക്ഷ്യപെടുത്തിയ നോൺ ക്രീമി ലേയർ സർട്ടിഫിക്കറ്റും അപേക്ഷയിൽ അവകാശപെട്ടിരിക്കുന്ന മറ്റു ക്ലെമുകൾക്കുമുള്ള സർട്ടിഫിക്കറ്റും അപ്‌ലോഡ് ചെയ്യേണ്ടതാണ്. അല്ലാത്തപക്ഷം റിസർവേഷൻ ആനുകൂല്യം ലഭിക്കുന്നതല്ല. ട്രാൻസ്ഫർ സർട്ടിഫിക്കറ്റ്, മൈഗ്രേഷൻ സർട്ടിഫിക്കറ്റ്, അഡ്മിഷൻ സമയത്ത് ഹാജരാകേണ്ടതാണ്.
                    സർട്ടിഫിക്കറ്റ് അപ്‌ലോഡ് ചെയ്യുവാനുള്ള അവസാന തീയതി   02.06.2024, 10 pm.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <p>The qualified candidates of PG Entrance Examinations, 2023 are directed to upload
                            the following documents on or before<b> 02.06.2024, 10 pm.</b></p>
                        <ol>
                            <li >Copy of SSLC ( Front Page, Marklist)</li>
                            <li>Copy of plus two marklist</li>
                            <li>Copy of degree marlists & certificates</li>
                        </ol>
                        <ul>
                            <li>Those candidates who are awaiting for the release of final semester Degree
                                result should mandatorily upload the marklists of I to IV semester marlists.</li>
                            <li>The candidates of OBC category are directed to upload the copy of non-
                                creamy layer certificate without fail, so as to claim the reservation benefits,
                                else the same will be cancelled.</li>
                            <li>Transfer certificate & Migration certificate shall be produced at the time of
                                admission.</li>
                        </ul>                    </div>
                    </div>
                    </div>
                    </div>
                </div>
              </div>     
           
        <form class="form-horizontal" name="formdocupload" id="formdocupload" enctype="multipart/form-data" >
            {{csrf_field()}}       
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
                 
                  <div class="row">
                    <div class="col-lg-6"> 
                    <div class="form-group"> 
                        <label class="control-label" >Upload Certificates : ( Please upload all the required documents in a single pdf file. <b style="color: red">Helping tool for converting multiple images to pdf file<a href="https://smallpdf.com/jpg-to-pdf"  target="_blank"> Click Here</a></b> 
                     )</label>
                        
                            <input type="file" class="form-control form-control-sm col-md-8" id="doc" name="doc">
                            <label for="inputEmail3" class="col-sm-10">
                            
                             *<font style="color: green"><b>The file type must be pdf</b></font><br>
                             *<font style="color: green"><b>File size should be less than 2 MB</b></font><br>
                             
                            </label> 
                         
                       @if(Auth::user()->directory_docs!="")
                          <a href="{{url(Auth::user()->directory_docs)}}" target="_blank" class="btn btn-xs btn-danger">
                                               View uploaded file
                          </a>
                     
                       @endif
                    </div>
                     </div>
                                            
                  </div>
                  
                 @endforeach 
       
          
        </div>
       
        

        <div class="card-footer" id="" name="">   
           
       <button type="submit" class="btn btn-info float-right btn_save" id="btn_save"> Submit </button>        
        </div>
       
        </form>

    </div>
</div>
         </div> 
    </div>
</div>
    </div>
 </section>
@endsection
