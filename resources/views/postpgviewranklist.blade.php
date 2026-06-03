@extends('layouts.app')

@section('styles')
<style>
      
    th{
        font-size: 14px;
        text-align: center;
    }
    td{
        font-size: 13px;
        text-align: center;
    }
    .card-header{
        text-align: center;
    }
    </style>
    
<section class="container-fluid">
        
        
        

      <div class="card">
<!--          <div class="col-xs-2"></div>-->
        
        
          <!-- /.box -->

          <div class="card-body">
               <div class="card-header">
                   <h5><b>M.PHIL SELECTION  LIST 2020-21</b></h5> 
              </div>
               
           
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="center table table-bordered table-hover ">
                 
                <tr>
                  <th>SL.NO</th>
                 
                  <th>ADMISSION NAME</th>
                  <th>SELECTION  LIST</th>
                </tr>
               
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
             @foreach($count as $ckey)
              <?php  $tot+=$ckey->count; ?>
                <tr>
            
                 
                  <td>{{ ++$i }}</td>
                 
                  <td><b>{{ $ckey->adsc_name }}</b></td>
                   
     
<!--                      <td>
                  
                <a href="/view_applicants/{{$ckey->adsc_sl}}">  <small><button class="btn bg-red-gradient btn-xs" ><i class="fa fa-envelope-o"></i> View Applicants</button></small>
                    </a></td>-->
                     <td>
                 <a href="/mphil/selectionlist/{{$ckey->adsc_sl}}">  <small><button class="btn btn-info" >Download <i style="font-size:20px;" class="fa fa-download"></i> </button></small>
                    </a>  
               </td>
                
                    
                </tr>
              @endforeach 
                
                
              </table>
            </div>
            
               
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
           
      
     
 

</section>
@stop