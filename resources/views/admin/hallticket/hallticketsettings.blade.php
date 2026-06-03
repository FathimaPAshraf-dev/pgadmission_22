@extends('layouts.admin.adminmaster')
@section('adminstyles')
@stop
@section('adminscripts')
<script>
$( document ).ready(function() {
   $('#exam').DataTable();
});
    $(document).on('click', '#search', function(){
        load_table_exam();
  
    });

  function load_table_exam(){
      
      let sem=$('#sem').val();
      let month=$('#month').val();
      let year=$('#year').val();
      let pgm=$('#pgm').val();
      
            $.ajax({
                    type: "get",
                    url: "/admin/search",
                    data:{sem:sem,month:month,year:year,pgm:pgm},
                    
                    success: function(response) {
                      console.log(response);
                    },
                    error: function(errResponse) {
                        console.log(errResponse);
                    }
                });

  }
  $('#frm-exam').on('submit', function(e){
  
    e.preventDefault();
  var form = this;

      var rows_selected = $("table#exam").DataTable().column(4).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         alert('ss');
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });
   });
   

  
</script>   
@stop
@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hallticket Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Hallticket Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<section class="content">
    
       <div class="card card-default">
              
              <!-- /.card-header -->
        <div class="card-body">
        <form action="" method="get" id="formhallticket">
            @csrf
        <div class="row">
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
                <div class="col-sm-6">
                    <div class="form-group">
                    <label>Exam Month</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" id="month" name="month" size='1'>
                         <option value="0">--Select--</option>  
                        <?php
                        for ($i = 0; $i < 12; $i++) {
                            $time = strtotime(sprintf('%d months', $i));   
                            $label = date('F', $time);   
                            $value = date('n', $time);
                           
                            echo "<option value='$value'>$label</option>";
                        } 
                        ?>
                         
                    </select>   
                   
                    </div>
                </div>
                     
                
                <div class="col-sm-6">
                <div class="form-group">
                <label>Exam Year</label>
                    <select  class="form-control select2"  id="year" name="year">
                                                
                        <option value="0">--Select--</option>  
                            <?php
                                $currently_selected = date('Y'); 
                                $earliest_year = 2015; 
                                $latest_year = date('Y'); 
                            ?>
                                       
                            @foreach(range( $latest_year, $earliest_year ) as $i )
                                <option value="{{$i}}" <?php echo($i === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$i}}</option> 
                            @endforeach  
                    
                    </select>                    
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Programme</label>
                        <select class="form-control select2 select2-hidden-accessible" id="pgm" name="pgm">
                            <option value="0">--Select--</option>
                            @foreach($prgm as $key)
                            <option value="{{$key->pgtype_sl}}">{{$key->pgtype_name}}</option>
                            @endforeach
                                                                        
                        </select>
                    </div>   
                </div>
                           
                <div class="col-sm-6">
                    <label></label>
                    <div class="form-group">
                        <button type="button" id="search" name="search" class="btn btn-sm btn-primary">
                              <i class="fas fa-search"></i> Search
                    </button>
                    </div>    
                </div>   
        </div>
                      
        </form>
            <form name="frm-exam" id="frm-exam" >

             <div class="form-group">
                        <div class="col-sm-12 table-responsive" id="table_div_course">
                        
                        </div>
             </div>
            </form>
        </div>
                       
              <!-- /.card-body -->
            </div>

       
</section>

@endsection