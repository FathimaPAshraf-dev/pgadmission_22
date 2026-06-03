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
                   <h5><b>SHORT LISTED CANDIDATES (Provisional) FOR PH.D 2021 </b></h5> 
              </div>
               
           
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="center table table-bordered table-hover ">
                 
                <tr>
                  <th>SL.NO</th>
                 
                  <th>ADMISSION NAME</th>
                  <th>DOWNLOAD</th>
                  <th>VIEW</th>
                  <th>SELECTION LIST</th>
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
                 <a href="/phd/ranklistdownload/{{$ckey->adsc_sl}}">  <small><button class="btn btn-info btn-sm" >Download <i style="font-size:20px;" class="fa fa-download"></i> </button></small>
                    </a>  
               </td>
                
                 <td>
                     <a href="/phd/ranklistview/{{$ckey->adsc_sl}}" target="_blank">  <small><button class="btn btn-info btn-sm" >view <i style="font-size:20px;" class="fa fa-eye"></i> </button></small>
                    </a>  
               </td> 
               @if($ckey->adsc_sl==807)
               <td>
                     <a href="/phd/selectionlist/{{$ckey->adsc_sl}}">  <small><button class="btn btn-info btn-sm" >Selection List <i style="font-size:20px;" class="fa fa-download"></i> </button></small>
                    </a>  
               </td>
             @else
               <td></td>
               @endif
               
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