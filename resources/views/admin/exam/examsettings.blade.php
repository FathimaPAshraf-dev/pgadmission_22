@extends('layouts.admin.adminmaster')
@section('adminstyles')

@stop
@section('adminscripts')
<script>
  $(function () {
      
//  load_table_data();

//    load_table_student();
    
    
    
  });
  $(document).on('click', '#search', function(){
      load_table_exam();
  });
  
  
  function load_table_exam(){
      
      let prgmtype=$('#prgmtype').val();
      let year=$('#year').val();
      let month=$('#month').val();
      let sem=$('#sem').val();

      $("table#student").DataTable().destroy();
      $("table#student").DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            

           ajax: {
                    url: "/admin/getexam",
                    method:"get",
                    data:{prgmtype:prgmtype,year:year,month:month,sem:sem},
//               dataFilter: function(response){
//            // this to see what exactly is being sent back
//            console.log(response.data);
//            return response;
//        },
//        error: function(error) {
//            // to see what the error is
//             console.log(error);
//        }
               },
               
            columns: [
                
                     
                      {data: 'exam_name',name: 'exam_name',},
                      {data: 'exam_sem_sl',name: 'exam_sem_sl',},
                      {data: 'exam_year',name: 'exam_year',},
                      {data: 'exam_month',name: 'exam_month',},
                      {data: 'action',name: 'action',orderable: false}
                    ],
     
               
                    
 });
 
  }
  function load_table_data(){
    
        $("table#example2").DataTable().destroy();

        $("table#example2").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            ajax: {
                    url: "/admin/coursedata",
                    method:"get",

//               dataFilter: function(response){
//            // this to see what exactly is being sent back
//            console.log(response);
//            return response;
//        },
//        error: function(error) {
//            // to see what the error is
//             console.log(error);
//        }   
               },
            columns: [{data: 'name',name: 'name',},
                      {data: 'created_at',name: 'created_at',},
                      {data: 'action',name: 'action',orderable: false}
                    ]
    });    
 
  }
  
  $(document).on('click', '.course', function(){
      var id=($(this).attr("value"));
      var status=($(this).attr("status"));
      if (confirm('Do you want to change status')) {

          $.ajax({
                    url:"/admin/coursestore",
                    method:"get",
                    data:{ id: id,status:status},
                    beforeSend:function(){
//                    $('#div_data').html('<br/><label style="align:center" class="text-primary">Please wait loading...</label>');
                   }, 
                    success:function(data)
                    {
                        load_table_data();
//                     console.log(data);    
//                     $("#div_sended_drafts").hide();
//                     $('#showinwarddata .modal-body').html(data);
//                     $('#div_data').html(data);
                    },
                    error: function(e) {
//                    $('#div_data').html('<br/><label style="align:center" class="text-danger">Something went wrong...</label>');
                         } 
            });
            
            } 
            else {
                return false;
            }
  })
  
   $(document).on('click', '.view', function(){
      var crsreg_id=($(this).attr("crsreg_id"));
      var crsreg_sem=($(this).attr("crsreg_sem"));
      var crsreg_regno=($(this).attr("crsreg_regno"));
//    
//    alert(crsreg_sem);
//    
//   
//    modal.show(exampleModalCenter);

          $.ajax({
                    url:"/admin/coursestudentdata",
                    method:"get",
                    data:{ crsreg_id: crsreg_id, sturegsem:crsreg_sem, regno:crsreg_regno},
                    beforeSend:function(){
//                    $('#div_data').html('<br/><label style="align:center" class="text-primary">Please wait loading...</label>');
                   }, 
                    success:function(data)
                    {
                        
//                        alert(data);
//                        load_table_data();
                     console.log(data);    
//                     $("#div_sended_drafts").hide();
                     $('#showinwarddata').html(data);
                      $('#exampleModalCenter').modal('show')
//                     $('#div_data').html(data);
                    },
                    error: function(e) {
//                    $('#div_data').html('<br/><label style="align:center" class="text-danger">Something went wrong...</label>');
                         } 
            });
            
           
  })
  
  
  
</script>
@stop


@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exam Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exam Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


<section class="content">
      <div class="container-fluid" id="app">

            <!-- general form elements disabled -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">General Elements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Program type</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="prgmtype" name="prgmtype" data-select2-id="9" tabindex="-1" aria-hidden="true">
                    <option value="0">Select All</option>
                      @foreach($programtype as $key)
                    <option value="{{$key->pgtype_sl}}">{{$key->pgtype_name}}</option>
                   
                    @endforeach
                  </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Exam Year</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="year" name="year" data-select2-id="9" tabindex="-1" aria-hidden="true">
                     <option value="0">Select All</option>
                    @foreach($exam as $key)
                    <option value="{{$key->exam_year}}">{{$key->exam_year}}</option>
                   
                    @endforeach
                  
                  </select>                      
                      </div>
                    </div>
                  </div>
                    
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Exam month</label>
                        <select class="form-control select2 select2-hidden-accessible" id="month" name="month" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
                              <option value="0">Select All</option>
                            <option value="1">January</option>
                             <option value="2">February</option>
                             <option value="3">March</option>
                             <option value="4">April</option>
                             <option value="5">May</option>
                             <option value="6">June</option>
                             <option value="7">July</option>
                             <option value="8">August</option>
                             <option value="9">September</option>
                             <option value="10">October</option>
                             <option value="11">November</option>
                             <option value="12">December</option>
                        </select>                     
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                     
                       <label>Semester</label>
                      <select class="form-control select2" id="sem" name="sem" style="width: 100%;" tabindex="-1" aria-hidden="true">
                             <option value="0">Select All</option>
                            <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                             <option value="5">5</option>
                             <option value="6">6</option>
                        </select> 
                      
                      </div>
                    </div>
                  </div>
                    
                    <div class="card card-footer">
                        
                        <div class="text-right">
                           
                            <button type="button" id="search" name="search" class="btn btn-sm btn-primary">
                              <i class="fas fa-search"></i> Search</button>
                            
                        </div>
                    </div>

                
                </form>
              </div>
              <div class="card">
          
            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                      
                      <th>Exam name</th>
                       <th>Semester</th>
                       <th>Year</th>
                      <th>Month</th>
                      <th>Action</th>
                    </thead>
                  <tbody></tbody>
              </table>
            </div>
           </div>
       </div>
          
              <!-- /.card-body -->
            </div>

          </div>
   
    
    </section>





<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="showinwarddata">
              
          </div>
      </div>
      
    </div>
  </div>
</div>
@endsection

