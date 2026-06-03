<div class="card-body" style="text-align: left">
     
       <label class="control-label col-md-12" ><marquee>
  Result awaiting students can add records with  aggregate marks obtained till now</marquee>
 </label>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg" >
     <i class="fa fa-plus" id ="add" name="add" aria-hidden="true" ></i>Add Records
    </button>
 
</div>
<form method="post" name="formresultawaiting" id="formresultawaiting">
    <div class="form-group row">
         @foreach($pgapp as $key) 

        <div class="col-md-2">
            <label class="control-label" >UG Result awaiting : </label> <br>
<!--            <label class="control-label col-sm-12">if you are result waiting must add record with aggregate mark/grade</label>-->
        </div>
       <div class="col-md-2">
        <input type="checkbox" name="ugcourse_status" id="ugcourse_status" <?php if ($key->ugcourse_status == 'on') echo 'checked'; ?> >
       </div>
    
        
         @endforeach
    </div>
    <button type="submit" style="display: none" name="btn_resultawaiting" id="btn_resultawaiting" class="btn btn-success">save</button>

</form>
<form method="post" name="formquali" id="formquali">

 <div class="modal fade" id="modal-lg" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Education Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
         
            <div class="modal-body">
             
             <div class="form-group row">
                <label class="control-label col-md-4" >Exam : </label>
                <div class="col-md-8">
                    <select  class="form-control select2 col-md-9"  id="pgquali_course" name="pgquali_course">
<!--                           <option value="">--Select--</option>  -->
                           
                           <option value="UG">UG </option >
                    </select>
                    <span id="error_exam" class="text-danger"></span>
               </div>
            </div>
           <div class="form-group row">
            <label class="control-label col-md-4" >College/Institute : </label>
            <div class="col-md-8">
                <input type="text" name="pgquali_institute" id="pgquali_institute" placeholder="Enter" class="form-control col-md-9"/> 
           </div>
           </div>  
            <div class="form-group row">
                <label class="control-label col-md-4" >University: </label>
                <div class="col-md-8">
                    <input type="text" name="pgquali_university" id="pgquali_university" placeholder="Enter" class="form-control col-md-9"/> 
               </div>
            </div>
                
                <div class="form-group row">
                <label class="control-label col-md-4" >Course : </label>
                <div class="col-md-8">
                    
                    <select  class="form-control select2 col-md-9"  id="pgquali_exam" name="pgquali_exam">
                             <option value="0">--Select--</option>  
                        @foreach($ugquali as $keyn )
                        
                            <option value="{{$keyn->degq_name}}" class="col-md-10" >
                                 
                                   {{$keyn->degq_name}}
                                 </option>
                           @endforeach
                    </select>
                    <span id="error_exam" class="text-danger"></span>
               </div>
            </div>
                  <div class="form-group row">
                <label class="control-label col-md-4" > Main Subject : </label>
                <div class="col-md-8">
                    <select  class="form-control select2 col-md-9"  id="pgquali_subject" name="pgquali_subject">
                            
                       <option value="0">--Select--</option>  
                        
                     @foreach($ugqualisubject as $keys )   
                        
                         <option value="{{$keys->dqsub_name}}" class="col-md-10" >
                                 
                                   {{$keys->dqsub_name}}
                                 </option>
                           @endforeach
                        
                        
                           
                    </select>
                    <span id="error_exam" class="text-danger"></span>
               </div>
            </div>
<!--            <div class="form-group row">
                <label class="control-label col-md-4" >Main/Core Subjects: </label>
                <div class="col-md-8">
                    <input type="text" name="pgquali_subject" id="pgquali_subject" placeholder="Enter" class="form-control col-md-9"/> 
               </div>
            </div>-->
            <div class="form-group row">
                <label class="control-label col-md-4" >Year: </label>
                <div class="col-md-8">
                    <select  class="form-control select2 col-md-9"  id="pgquali_year" name="pgquali_year">
                                                
                                        <option value="">--Select--</option>  
                                           <?php
                                        // Sets the top option to be the current year. (IE. the option that is chosen by default).
                                        $currently_selected = date('Y'); 
                                        // Year to start available options at
                                        $earliest_year = 1960; 
                                        // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                                        $latest_year = date('Y'); 
                                        ?>
                                       
                                        @foreach ( range( $latest_year, $earliest_year ) as $i )
                                          <option value="{{$i}}" <?php echo($i === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$i}}</option> 
                                       
                                        @endforeach  
        </select>
               </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-4" >Grade & Grade Point/Percentage of marks: </label>
                <div class="col-md-8">
                    <input type="text" name="pgquali_grade" id="pgquali_grade" placeholder="Enter" class="form-control col-md-9"/> 
               </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
      
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
    
    </form>
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
              <h4 class="modal-title">Edit Education Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
<form action="" method="post" id="editform_edu">
                                {{csrf_field()}}
                                
                                  <div class="modal-body">
                                    <input type="hidden" name="pgquali_sl" id="pgquali_sl" value="">
                                      <div class="form-group row">
                                        <label class="control-label col-md-4" >Course: </label>
                                        <div class="col-md-8">
                    <select  class="form-control select2 col-md-9"  id="pgquali_course" name="pgquali_course" >
<!--                           <option value="">--Select--</option>  -->
                           <option value="UG">UG</option>  
                           
                    </select>
                    <span id="error_exam" class="text-danger"></span>
               </div>
                                    </div>
                                    <div class="form-group row">
                                     <label class="control-label col-md-4" >College/Institut : </label>
                                     <div class="col-md-8">
                                         <input type="text" name="pgquali_institute" id="pgquali_institute" placeholder="Enter" class="form-control col-md-9"/> 
                                    </div>
                                    </div>  
                                     <div class="form-group row">
                                         <label class="control-label col-md-4" >University: </label>
                                         <div class="col-md-8">
                                             <input type="text" name="pgquali_university" id="pgquali_university" placeholder="Enter" class="form-control col-md-9"/> 
                                        </div>
                                     </div>
                                    
                                      <div class="form-group row">
                <label class="control-label col-md-4" >Course : </label>
                <div class="col-md-8">
                    
                    <select  class="form-control select2 col-md-9"  id="pgquali_exam" name="pgquali_exam">
                             <option value="0">--Select--</option>  
                        @foreach($ugquali as $keyn )
                        @if($pgquali_exam==$keyn->degq_name)
                            <option value="{{$keyn->degq_name}}" class="col-md-10" selected>
                                 
                                   {{$keyn->degq_name}}
                                 </option>
                                 @else
                                  <option value="{{$keyn->degq_name}}" class="col-md-10" >
                                 
                                   {{$keyn->degq_name}}
                                 </option>
                                 @endif
                           @endforeach
                    </select>
                    <span id="error_exam" class="text-danger"></span>
               </div>
            </div>
                  <div class="form-group row">
                <label class="control-label col-md-4" > Main Subject : </label>
                <div class="col-md-8">
                    <select  class="form-control select2 col-md-9"  id="pgquali_subject" name="pgquali_subject">
                            
<!--                       <option value="0">--Select--</option>  -->
                        
                     @foreach($ugqualisubject as $keys )   
                         @if($pgquali_subject==$keys->dqsub_name)
                         <option value="{{$keys->dqsub_name}}" class="col-md-10" selected>
                                 
                                   {{$keys->dqsub_name}}
                                 </option>
                                 @else
                                   <option value="{{$keys->dqsub_name}}" class="col-md-10" >
                                 
                                   {{$keys->dqsub_name}}
                                 </option>
                                 @endif
                           @endforeach
                        
                        
                           
                    </select>
                    <span id="error_exam" class="text-danger"></span>
               </div>
            </div>
                                    
                                    
                                    
                                    
                                    
                                    
<!--                                     <div class="form-group row">
                                         <label class="control-label col-md-4" >Main/Core Subjects: </label>
                                         <div class="col-md-8">
                                             <input type="text" name="pgquali_subject" id="pgquali_subject" placeholder="Enter" class="form-control col-md-9"/> 
                                        </div>
                                     </div>-->
                                     <div class="form-group row">
                                         <label class="control-label col-md-4" >Year: </label>
                                         <div class="col-md-8">
                                             <select  class="form-control select2 col-md-9"  id="pgquali_year" name="pgquali_year">

                                                                 <option value="">--Select--</option>  
                                                                    <?php
                                                                 // Sets the top option to be the current year. (IE. the option that is chosen by default).
                                                                 $currently_selected = date('Y'); 
                                                                 // Year to start available options at
                                                                 $earliest_year = 1960; 
                                                                 // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                                                                 $latest_year = date('Y'); 
                                                                 ?>

                                                                 @foreach ( range( $latest_year, $earliest_year ) as $i )
                                                                   <option value="{{$i}}" <?php echo($i === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$i}}</option> 

                                                                 @endforeach  
                                 </select>
                                        </div>
                                     </div>
                             <div class="form-group row">
                                <label class="control-label col-md-4" >Grade & Grade Point/Percentage of marks: </label>
                                <div class="col-md-8">
                                    <input type="text" name="pgquali_grade" id="pgquali_grade" placeholder="Enter" class="form-control col-md-9"/> 
                               </div>
                            </div>                                 

                              </div>
                                <div id='loaderedit' class="overlay" style='display: none;'>
                                     <i class="fa fa-refresh fa-spin"></i>
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="edit1">Save</button>
                              </div>
                      </form>
                    </div>
                      
                  </div>
                </div>


        <div class="form-group ">
                        <div class="col-sm-12 table-responsive" id="education">
                            
                            <table id="tb_student" class="table table-bordered table-hover">
                                <thead>
                                  <th>Course</th>   
                                <th>Exam</th>
                               
                                <th>College/Institute</th>
                                <th>University</th>
                                <th>Main/Core Subjects</th>
                                <th>Year</th>
                                <th>Grade & Grade Point/Percentage of marks</th>
                                <th>Action</th>
                                                       
                            </thead>
                            @foreach($pgquali as $key)
                            <tr>
                                <td>{{$key->pgquali_course}}</td>
                                <td>{{$key->pgquali_exam}}</td>
                                <td>{{$key->pgquali_institute}}</td>
                                <td>{{$key->pgquali_university}}</td>
                                <td>{{$key->pgquali_subject}}</td>
                                <td>{{$key->pgquali_year}}</td>
                                 <td>{{$key->pgquali_grade}}</td>
                                 <td><button class="btn btn-success" data-pgquali_sl="{{$key->pgquali_sl}}" data-pgquali_exam="{{$key->pgquali_exam}}" 
                                             data-pgquali_institute="{{$key->pgquali_institute}}" data-pgquali_university="{{$key->pgquali_university}}" 
                                      data-pgquali_subject="{{$key->pgquali_subject}}" data-pgquali_year="{{$key->pgquali_year}}" 
                                     data-pgquali_grade="{{$key->pgquali_grade}}"  data-toggle="modal" data-target="#edit">Edit<span class="fa fa-edit"></span></button>
                                
                            </tr>
                            @endforeach

                        </table>
                        </div>
                       
                  
                </div>