@extends('layouts.app')

@section('styles')

@stop


@section('scripts')
 <script type="text/javascript">
  $("#frm_syl").on('submit',function(e)
                      {
alert("yes");


    }
 
 
 
 </script>
@stop
@section('tittle')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">PG ALLOTMENT -2021</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop
@section('content')
<section class="content-header">
    <div class="card card-info">
      <div class="card-header">
                <h3 class="card-title"><b>PG Admission-2021</b></h3>
            </div>  
        <br>@foreach($results as $key)
<marquee   behavior="alternate" direction="left"><p style="font-size: 17px;"><b>Hi {{$key->pgapp_name}}  !!! Upload All The certificates </b></p></marquee>
@endforeach
    </div> 
</section>
 <br>
 
<div class="card-body">
            <div class="form-group row">
                  <input type="hidden" id="bladename" value=""> 
                <label for="inputEmail3" class="col-sm-8 col-form-label">Transfer Certificate</label>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-flat btn-info btn-sm " data-toggle="modal" data-target="#md_tc">
                Add Records
                </button>
                </div>
               </div>
             <div class="form-group row">
                  <input type="hidden" id="bladename" value=""> 
                <label for="inputEmail3" class="col-sm-8 col-form-label">Conduct Certificate</label>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-flat btn-info btn-sm " data-toggle="modal" data-target="#md_cc">
                Add Records
                </button>
                </div>
              </div>
    <div class="form-group row">
                  <input type="hidden" id="bladename" value=""> 
                <label for="inputEmail3" class="col-sm-8 col-form-label">Grade Sheet/Marklist</label>
                <div class="col-sm-2">
                <button type="button" class="btn btn-flat btn-info btn-sm " data-toggle="modal" data-target="#md_gs">
                Add Records
                </button>
                </div>
    </div>
    <div class="form-group row">
                  <input type="hidden" id="bladename" value=""> 
                <label for="inputEmail3" class="col-sm-8 col-form-label">Provisional / Original Digree Certificate</label>
                <div class="col-sm-2">
                <button type="button" class="btn btn-flat btn-info btn-sm " data-toggle="modal" data-target="#md_pro">
                Add Records
                </button>
                </div>
    </div>
     <div class="form-group row">
                  <input type="hidden" id="bladename" value=""> 
                <label for="inputEmail3" class="col-sm-8 col-form-label">Caste / Community Certificate</label>
                <div class="col-sm-2">
                <button type="button" class="btn btn-flat btn-info btn-sm " data-toggle="modal" data-target="#md_caste">
                Add Records
                </button>
                </div>
    </div>
<div class="modal fade" id="md_tc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     

                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Transfer Certificate</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                          <form role="form" class="form-horizontal" id="frm_syl" name="frm_syl"  method="post" action="" enctype="multipart/form-data">
          <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  <input type="hidden" class="block" style="white-space: pre-line;" name="txtAddDet" id="txtAddDet"> 
                             <div class="form-group row">
                                  <label for="topic" class="col-sm-4 col-form-label ">Upload Transfer certificate from  where you last studied</label>
                                  <div class="col-sm-8">
                                       <input type="hidden"  class="form-control "  id="hdnsylUpload" name="hdnsylUpload">
                          <input type="file" class=" form-control input-res col-md-11" style="white-space: pre-line;" id="filesyl" name="filesyl" class=""  >
  
<!--                                      <input type="file" class="form-control form-control-sm" id="tc" name="tc">-->
                                  </div>
                                </div> 
      <div class="card-footer">
  <input type="submit" class="btn btn-secondary " style="white-space: pre-line;" value=" Upload TC " class="btn btn-sm btn-info upload-image16"  id="frm_syl" name="frm_syl"/>
  
      </div>
                          </form>
                              </div> 

<!--                              <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary float-right form_journal">Save changes</button>
                              </div>-->
                              <!-- /.card-footer -->
                           
                          </div>
                    </div>
                     </div>

</div>
<div class="modal fade" id="md_cc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Conduct Certificate</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                            <form class="form-horizontal" id="form_cc" name="form_cc">
                             <div class="form-group row">
                                  <label for="topic" class="col-sm-4 col-form-label ">Upload Conduct  certificate from  where you last studied</label>
                                  <div class="col-sm-8">
                                      <input type="file" class="form-control form-control-sm" id="cc" name="cc">
                                  </div>
                                </div> 
                            </form>
                              </div> 

                              <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary float-right form_journal">Save changes</button>
                              </div>
                              <!-- /.card-footer -->
                           
                          </div>
                    </div>
                     </div>
</div>
<div class="modal fade" id="md_gs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Grade Sheet/Marklist</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                            <form class="form-horizontal" id="form_gs" name="form_gs">
                             <div class="form-group row">
                                  <label for="topic" class="col-sm-4 col-form-label ">Upload Grade sheet of qualifying Exam(UG)</label>
                                  <div class="col-sm-8">
                                      <input type="file" class="form-control form-control-sm" id="gs" name="gs">
                                  </div>
                                </div> 
                            </form>
                              </div> 

                              <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary float-right form_journal">Save changes</button>
                              </div>
                              <!-- /.card-footer -->
                           
                          </div>
                    </div>
                     </div>
</div>
<div class="modal fade" id="md_pro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Grade Sheet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                            <form class="form-horizontal" id="form_pro" name="form_pro">
                             <div class="form-group row">
                                  <label for="topic" class="col-sm-4 col-form-label ">Upload Provisional / Original Digree Certificates</label>
                                  <div class="col-sm-8">
                                      <input type="file" class="form-control form-control-sm" id="pro" name="pro">
                                  </div>
                                </div> 
                            </form>
                              </div> 

                              <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary float-right form_journal">Save changes</button>
                              </div>
                              <!-- /.card-footer -->
                           
                          </div>
                    </div>
                     </div>
</div>
<div class="modal fade" id="md_caste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Caste / Community Certificate</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                            <form class="form-horizontal" id="form_caste" name="form_caste">
                             <div class="form-group row">
                                  <label for="topic" class="col-sm-4 col-form-label ">Upload Caste / Community Certificate ( validy within 6 months) </label>
                                  <div class="col-sm-8">
                                      <input type="file" class="form-control form-control-sm" id="caste" name="caste">
                                  </div>
                                </div> 
                            </form>
                              </div> 

                              <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary float-right form_journal">Save changes</button>
                              </div>
                              <!-- /.card-footer -->
                           
                          </div>
                    </div>
                     </div>
</div>
                </div>
                
 
 <div class="card-footer">
            <button type="button" class="btn btn-success btnPrev">Previous</button>
            <button type="button" class="btn btn-danger btnNext">Next</button>
          </div> 

  

 <script type="text/javascript">
  $("#frm_syl1").on('submit',function(e)
                      {
alert("yes");


                          
                             e.preventDefault();
          
                 console.log(e);
//                 return;
         var uploadButton=e.currentTarget.attributes[2].nodeValue;
//         console.log(uploadButton);
//           alert(uploadButton);
//                // document.getElementById("hiddenfile12").value="file_q12";
////              alert(   document.getElementById("hiddenfile12").value);
////                alert(var);
                if(uploadButton==='frm_syl')
                {  
 var newtest=document.getElementById("filesyl").value;



                    document.getElementById("hdnsylUpload").value="file_q142";
//document.getElementById("upload1600").value="file_q14";
                }
//             


                 
                $.ajax({

url: '/eligibilitytc_upload',
type: "POST",
data:  new FormData(this),
//data:{"_token": "{{ csrf_token() }}",  "newtest":newtest},
contentType: false,
                        cache: false,
processData:false,


success: function(data)
   {
//alert(data);



                  
                      
                                if(data==='null')
                                    {
                                     alert('No files selected');
                                    }

                                    else if(data=='5')
                                    {
                                      alert('please upload pdf format only')
                                    }


else if(data==='exist')

{

alert('already exist');

}

                                    else
                                    {



                                    alert('File Uploaded Successfully.');
                                   // $("#tc").attr("src",data);
           
                                    var file= document.getElementById("hdnsylUpload").value;


                                   
                                    // alert(file);

   
    }
                       
     
                       
   },
  error: function()
                    {
                       
                    }        
  });
               
               


  });
  
 
 
 
 
 </script>
 
 
  
    @endsection
