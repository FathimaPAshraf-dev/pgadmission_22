@extends('layouts.app')
@section('content')

<head>
  <style type="text/css">
      
      .web{
          background-color: #701b50;
          color: white;
      } 
 .newapp{
          background-color: #59270e;
          color: white;
          
      } 
/* Popup box BEGIN */

  </style>
  
</head>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <!--<div class="col-xs-2"></div>-->
        <div class="col-xs-12">
        
          <!-- /.box -->
          

          <div class="card">
         
             
            <div class="card-header" align="center">
              <h3 class="box-title">PG ENTRANCE PROVISIONAL RANK LIST 2020</h3>
            </div>
              
            <!-- /.box-header -->
        <div class="card-body table-responsive">
        <table id="example1" class="table table-bordered table-striped table-responsive">
            <tr>
                <th style="text-align:center"><font >SLNO</font></th>
         <th width="40%" style="text-align:center"><font >ENTRANCE EXAM NAME</font></th>
         <th style="text-align:center">DOWNLOAD</th>
            </tr>
            
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
             @foreach($list as $ckey)
              
                <tr>
            
                  <input type="hidden" id="hidden_studid" name="hidden_studid" value="{{ $ckey->ent_exam_id }}" >
                  <input type="hidden" id="hidden_studregno" name="hidden_studregno" value="{{ $ckey->ent_exam_id }}" >
                  <td style="text-align:center">{{ ++$i }}</td>
                 
                
  
    <td>{{$ckey->ent_exam_name}}</td>

 
       @if($ckey->ranklist_status =='1')
       <td style="text-align:center">
        
               
<a href="/ranklistdownload/{{$ckey->ent_adscsl}}"><button  class="btn btn-github"><i class="fa fa-download"></i>DOWNLOAD RANKLIST</button></a>
            
       </td>        
           @else
           <td style="text-align:center">PUBLISHED ON 19/10/2020 at 2.00 PM</td>
           
           
           
           
           
           
           
           
<!--           <div class="box-body">
                   
             
                          <form  class="form-horizontal" enctype="multipart/form-data" method="get" id="create" action="{{url('/entrancehome')}}">
                        <div class="col-md-5"></div>
                            Published Sooon   
                            
                     
                          </form>
                  </div>-->
           @endif
    
       
     
           
<!--       <td>
                        <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">CLICK HERE TO VIEW RANLK-LIST
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
  @if($ckey->ranklist_status =='0')
   <li><a href="/notviewstudrank/{{$ckey->ent_adscsl}}">Not Announced</a></li>
    @else 
      <li><a href="/viewstudrank/{{$ckey->ent_adscsl}}">View Ranklist</a></li>
     @endif    
    </ul>
  </div>
       </td> -->
 
<!--entrance manage include genrate roll ,delete entrance,edit entrance-->


<!--<td>
                  
                <a href="/editentrance/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-pencil"></i></button></small>
                    </a></td>    -->
<!--                   <td>
                  
                <a href="/rollentrance/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-random"></i></button></small>
                    </a></td> -->
<!--<td>
                  
                <a href="/delentrance/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-remove"></i></button></small>
                    </a></td> -->
                    








         <!--          @if($ckey->ent_roll_status =='1') 




      <td><a href="/publishhallticket/{{$ckey->ent_exam_id}}" id="pub">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-"> PublishHallticket</i></button></small>
                    </a></td>         
@else($ckey->ent_roll_status =='0')
      <td>   </td>  


@endif  -->
<!-- 
                  @if($ckey->pub_hallticket =='1')         
      <td><a href="/publishhallticket/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-"> EditPublish</i></button></small>
                    </a></td>         
@else
      <td><a href="/publishhallticket/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-"> PublishHallticket</i></button></small>
                    </a></td>        
@endif -->


<!-- <a class="linkclass "href="@if(isset($disabled))#@else /link @endif"></a>
 -->

<!-- 
                  @if($ckey->pub_hallticket =='1')         
      <td><a href="/publishhallticket/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-"> EditPublish</i></button></small>
                    </a></td>         
@else
      <td><a href="/publishhallticket/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-"> PublishHallticket</i></button></small>
                    </a></td>        
@endif -->



              <!--   <a href="/publishhallticket/{{$ckey->ent_exam_id}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-"> PublishHallticket</i></button></small>
                    </a></td>   --> 

                </tr>


  



              @endforeach 
                
            
              </table>
            </div>
            
<!--               <div class="box-body">
                   
                    
                          <form  class="form-horizontal" enctype="multipart/form-data" method="get" id="create" action="{{url('/entrancehome')}}">
                        <div class="col-md-5"></div>
                        <div class="col-md-4"><button type="submit" name="home" id="home" class="btn btn-github"><i class="fa fa-home"></i> Home</button>
                  
                        </div>
                          </form>
               </div>-->
            
            
            
            
            
            
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
           
        <!-- /.col -->
      </div>
     
 


<div class="modal fade" id="modal-default" style="display: none;"  data-backdrop="false">
         
        <div class="modal-dialog">
            
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title"><b>Message &nbsp;<i class="fa fa-envelope-o"></i></b></h4>
              </div>
              <div class="modal-body">
<!--            <form role="form" class="form-horizontal" id="comments_save" name="comments_save" enctype="multipart/form-data" method="post" action="" >       -->
            <input type="hidden" id="hiddenid" name="hiddenid" value="" >
            <div class="box box-body">  

                 <div class="col-sm-12" id="res">
                     
                     
                  
         
<!--                </form>    -->
                  
                  
                  
              
              
              </div>
              <div class="modal-footer">
<!--                <button type="button" class="btn btn-instagram" data-dismiss="modal">Save</button>-->
             <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
          <!-- /.modal-dialog -->
</div>
        
<div class="modal fade" id="modal-history" style="display: none;"  data-backdrop="false">
         
        <div class="modal-dialog">
            
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title"><b>History &nbsp;<i class="fa fa-bell-o"></i></b></h4>
              </div>
              <div class="modal-body1">
            <form role="form" class="form-horizontal" id="comments_save" name="comments_save" enctype="multipart/form-data" method="post" action="" >       
            <input type="hidden" id="hiddenid" name="hiddenid" value="" >
            <div class="box box-body">  

                 <div class="col-sm-12">
                      <div id="result"></div>
                   
                
                 </div> 


            
              </div>  
                  
         
            </form>    
                  
                  
                  
              
              
              </div>
              <div class="modal-footer">
              
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
          <!-- /.modal-dialog -->
     </div>        
        
      <!-- /.row -->
      
      
               
              
      
      
    </section>
    <!-- /.content -->



<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- page script -->
<script>
  $(function () {
  //  $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
     $('#tb_outgoing').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  
    

</script>




<script>
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "10000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
	@if(Session::has('message'))
		var type="{{Session::get('alert-type','info')}}"

		switch(type){
			case 'info':
		         toastr.info("{{ Session::get('message') }}");
		         break;
	        case 'success':
	            toastr.success("{{ Session::get('message') }}");
	            break;
         	case 'warning':
	            toastr.warning("{{ Session::get('message') }}");
	            break;
	        case 'error':
		        toastr.error("{{ Session::get('message') }}");
		        break;
		}
	@endif
</script>

   <script>
        $('#modal-default').on('show.bs.modal', function (event) {
       console.log('model open');
  var button = $(event.relatedTarget) // Button that triggered the modal
 
           var message = button.data('message')
       var id = button.data('id') 
       
      console.log(id);
      
      $.ajax({
             type: "get",
              url: "/ajaxViewstudlist",
              data: {id},
   
          success: function(response){

              console.log(response);
              
              $("#res").html(response);
              
            
              
             
               
//           $(".modal-body1").html("");
//            let name=JSON.parse(response);
            },
          error:function()
                {
                     alert('OOps Something went wrong...');
                }
   
            });
  // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
//  modal.find('.modal-title').text('New message to ' + recipient)
 modal.find('.modal-body #hiddenid').val(id);
  modal.find('.modal-body #message').val(message);


});
</script>


 <script>
        $('#modal-history').on('show.bs.modal', function (event) {
            
           console.log('model open');
           var button = $(event.relatedTarget) // Button that triggered the modal
// alert('s');
           var message = button.data('message')
           var id = button.data('id') 
           var modal = $(this)

           modal.find('.modal-body #hiddenid').val(id);
  


});


</script>

 <script>
                     
$(document).ready(function() {
       
        $('.text-center').each(function () {

 let st= $(this).text().trim(); 

//  alert(stat);
//console.log(st);
 
       
         
            if(st=='Pending'){
//              alert('asfsadfdsafdf');
                 $(this).removeClass('bg-danger');
                 $(this).toggleClass('bg-red');
//                 return false;
            }
             if(st=='New'){
//                 alert(this.id);
                 $(this).removeClass('bg-danger');
                 $(this).toggleClass('bg-red-gradient');
            }
              if(st=='Processing'){
           
                 $(this).removeClass('bg-danger');
                 $(this).toggleClass('bg-orange');
            }
               if(st=='Resolved'){
//                 alert(this.id);
                 $(this).removeClass('bg-danger');
                 $(this).toggleClass('bg-success');
            }
               if(st=='Closed'){
//                 alert(this.id);
                 $(this).removeClass('bg-danger');
                 $(this).toggleClass('bg-primary');
            }
            
             
         });
        
   })                       
                     
$(document).ready(function(){
  
 
   $('#example1').DataTable( {
       'pageLength'      : 25,
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    
    
  $(".btn-instagram").click(function(){

         var formData = $('#comments_save').serialize();
//         alert(formData);
         
         let gid=document.getElementById("hiddenid").value;
//         alert(gid);
         
          $.ajax({
             type: "post",
              url: "/createcomments",
             data: {"_token": "{{ csrf_token() }}",formData},
   
          success: function(response){
       
          
           console.log(response);
            
         // alert(response);
           // return false;
            let name=JSON.parse(response);
            let sts= name[0]["status"];

            $('#comments'+gid).text(sts);
            
//            alert(sts);
            
//            console.log(sts);
            
             var list = document.getElementById('comments'+gid);
//            alert(list.className);
             str=list.className;
//           alert(str.substr(str.indexOf(' ')+12));
            
             let classname=(str.substr(str.indexOf(' ')+12)).trim()
            
//           alert(classname); 
            
            
//            if(sts=='Pending'){
////              alert('asfsadfdsafdf');
//                 $('#comments'+gid).removeClass(classname);
//                 $('#comments'+gid).toggleClass('bg-red');
////                 return false;
//            }
             if(sts=='New'){

                 $('#comments'+gid).removeClass(classname);
                 $('#comments'+gid).toggleClass('bg-red-gradient');
            }
              if(sts=='Processing'){
           
                $('#comments'+gid).removeClass(classname);
                $('#comments'+gid).toggleClass('bg-orange');
            }
               if(sts=='Resolved'){
//                 alert(this.id);
                 $('#comments'+gid).removeClass(classname);
                 $('#comments'+gid).toggleClass('bg-success');
            }
               if(sts=='Closed'){
//                 alert(this.id);
                 $('#comments'+gid).removeClass(classname);
                 $('#comments'+gid).toggleClass('bg-primary');
            }
            
//            
//            console.log(sts);
//         window.location.reload();
            
            },
          error:function()
                {
                     alert('OOps Something went wrong...');
                }
   
            });
   
   
  });
  
  $("#modal-default").on("hidden.bs.modal", function(){
    $("#comments").val("");
});
  //view history
 
        
 $(".bg-purple-gradient").click(function(){

         let gid=(this).value;
         
    

         
          $.ajax({
             type: "get",
              url: "/viewhistory",
              data: {gid},
   
          success: function(response){

              console.log(response);
              
              $("#result").html("");
              
              if ( JSON.parse(response).length == 0 ) {
                  
                  $("#result").append('No proceeding yet !!!');
                   $('#modal-history').modal('show');
                   }
              
              else{
          
                 $.each(JSON.parse(response), function(idx, obj) {
	         

                   $("#result").append(obj.nodal_status +'&nbsp;&nbsp;&nbsp;'+obj.nodal_comments+'&nbsp;&nbsp;&nbsp;'+ obj.created_at + '<br>');
               
                 });
             
             $('#modal-history').modal('show');
               
        }
               
//           $(".modal-body1").html("");
//            let name=JSON.parse(response);
            },
          error:function()
                {
                     alert('OOps Something went wrong...');
                }
   
            });
   
   
  });
  
  
  
  
});


</script>




  



@endsection



