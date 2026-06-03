@extends('layouts.rankapp')

@section('content')
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
                   <h5><b>PG PROVISIONAL RANK LIST </b></h5> 
              </div>
               
           
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="center table table-bordered table-hover ">
                 
                <tr>
                  <th>SL.NO</th>
                 
                  <th>EXAM NAME</th>
                  <th>PROVISIONAL RANK LIST</th>
                  
                  
                </tr>
               
               <?php 
               $tot=0;
                    $i=0;
               ?> 
                    
            
                    
             @foreach($list as $ckey)
              
                <tr>
            
                 
                  <td>{{ ++$i }}</td>
                 
                  <td><b>{{ $ckey->ent_exam_name }}</b></td>
   <td>
                 <a href="/pg/ranklist/{{$ckey->ent_adscsl}}">  <small><button class="btn btn-info" >Download <i style="font-size:20px;" class="fa fa-download"></i> </button></small>
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