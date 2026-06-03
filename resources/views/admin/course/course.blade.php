@extends('layouts.admin.adminmaster')
@section('adminstyles')

@stop
@section('adminscripts')
<script>
  $(function () {
      
  load_table_data();

//    load_table_student();
    
    
    
  });
  $(document).on('click', '#search', function(){
      load_table_student();
  });
  
  
  function load_table_student(){
      
      let prgmtype=$('#prgmtype').val();
      let center=$('#center').val();
      let year_of_adm=$('#year_of_adm').val();
//     alert(prgmtype);
        
        $("table#student").DataTable().destroy();

        $("table#student").DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            lengthChange: true,

           ajax: {
                    url: "/admin/createstudent",
                    method:"get",
                    data:{prgmtype:prgmtype,center:center,year_of_adm:year_of_adm},
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
                      {data: 'crsreg_regno',name: 'crsreg_regno',},
                      {data: 'crsreg_studname',name: 'crsreg_studname',},
                       {data: 'crsreg_sem',name: 'crsreg_sem',},
                      {data: 'created_at',name: 'created_at',},
                      {data: 'action',name: 'action',orderable: false}
                    ]
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
                     console.log(data);    
//                     $("#div_sended_drafts").hide();
//                     $('#showinwarddata .modal-body').html(data);
//                     $('#div_data').html(data);
                    },
                    error: function(e) {
//                    $('#div_data').html('<br/><label style="align:center" class="text-danger">Something went wrong...</label>');
                         } 
            });
            
            } else {
                return false;
}
  })
  
  
</script>
@stop


@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Course Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Course Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


<section class="content">
      <div class="container-fluid" id="app">

   
        
       <div class="card">
          
            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table id="example2" class="table table-bordered table-striped">
               <thead>
                    
                 <th>Type</th>
                  <th>Created at</th>
                 <th>Status</th>
                </thead>

                  <tbody></tbody>
            
                
              </table>
            </div>
           </div>
       </div>
          
              
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
                        <label>Center</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="center" name="center" data-select2-id="9" tabindex="-1" aria-hidden="true">
                     <option value="0">Select All</option>
                      @foreach($centre as $key)
                    <option value="{{$key->centre_sl}}">{{$key->centre_name}}</option>
                   
                    @endforeach
                  
                  </select>                      
                      </div>
                    </div>
                  </div>
                    
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Year Of Admission</label>
                        <select class="form-control select2 select2-hidden-accessible" id="year_of_adm" name="year_of_adm" style="width: 100%;" data-select2-id="9" tabindex="-1" aria-hidden="true">
                              <option value="0">Select All</option>
                            <option value="2016">2016</option>
                             <option value="2017">2017</option>
                             <option value="2018">2018</option>
                             <option value="2019">2019</option>
                             <option value="2020">2020</option>
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
                              <i class="fas fa-user"></i> Search</button>
                            
                        </div>
                    </div>

                
                </form>
              </div>
              <div class="card">
          
            <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <table id="student" class="table table-bordered table-striped">
                    <thead>
                      <th>crsreg_regno</th>
                       <th>Name</th>
                       <th>Semester</th>
                      <th>Status</th>
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
@endsection

