@extends('layouts.app')
@section('content')
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> -->
<script src="{{ asset('js/croppie.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/croppie.css')}}">
<section class="content">
    <form role="form" class="form-horizontal" id="frm_syl" name="frm_syl"   enctype="multipart/form-data">
     <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
        <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"  ><font color="white"><b>Documements Uploadff</b></font></h3>
        </div>
        <div class="callout callout- bg-info color-palette">
       <div class="row">
        <div class="col-lg-2 col-xs-12"> 
            <label class="col-md-12">&nbsp;&nbsp;Tc Upload&nbsp;<font color="#FF0000" style="color: red;">*</font>:</label></div>
            <div class="col-lg-10 col-xs-12" align="center">
             <input type="hidden"  class="form-control "  id="hdnsylUpload" name="hdnsylUpload">
             <input type="file" class=" form-control input-res col-md-11" style="white-space: pre-line;" id="filesyl" name="filesyl" class=""  >
         <center><input type="submit" class="form-control input-res bg-aqua " style="white-space: pre-line;" value="Click here to Upload Syllabus" class="btn btn-sm btn-info upload-image10"  id="frm_syl" name="frm_syl"/></center>
           </div>
            </div>
        </div>
      </div>
</form>
</section>

 
              


                                    <script type="text/javascript">

                                            $('#fileTc1').bind('change', function () {

                                                //this.files[0].size gets the size of your file.
                                                alert(this.files[0].size);

                                                //alert(this.files[0].width);

                                            }

                                        });

                                    </script>



                                    <script type="text/javascript">

                                        $("#frm_syl").on('submit', function (e)
                                        {

                                            e.preventDefault();

                                            console.log(e);

                                            var uploadButton = e.currentTarget.attributes[2].nodeValue;

                                            if (uploadButton === 'frm_syl')
                                            {
                                                var newtest = document.getElementById("filesyl").value;



                                                document.getElementById("hdnsylUpload").value = "file_q142";

                                            }
                                            //             

                                            $.ajax({

                                                url: '/eligibilitytc_upload',
                                                type: "POST",
                                                data: new FormData(this),
                                                //data:{"_token": "{{ csrf_token() }}",  "newtest":newtest},
                                                contentType: false,
                                                cache: false,
                                                processData: false,

                                                success: function (data)
                                                {
                                                    //alert(data);


                                                    if (data === 'null')
                                                    {
                                                        alert('No files selected');
                                                    } else if (data == '5')
                                                    {
                                                        alert('please upload pdf format only')
                                                    } else if (data === 'exist')

                                                    {

                                                        alert('already exist');

                                                    } else
                                                    {



                                                        alert('File Uploaded Successfully.');
                                                        // $("#tc").attr("src",data);

                                                        var file = document.getElementById("hdnsylUpload").value;



                                                        // alert(file);


                                                    }



                                                },
                                                error: function ()
                                                {

                                                }
                                            });




                                        });



                                    </script>  













                     




                                    @endsection
