@foreach($pgapp as $key)
 <?php $sslcregno=$key->sslc_regno;  ?>
@endforeach

@if($pgquali->isEmpty())
<form method="post" name="formquali" id="formquali">

 <div class="container">
     <p style="color: red; font-size: 16px;">SSLC/10th DETAILS</p>
 
    <div class="form-group row">
        <div class="col-6"> <label class="control-label" >SSLC/10th register number</label>
            <input type="text" name="sslc_regno" id="sslc_regno" placeholder="Enter" value="{{$sslcregno}}" readonly class="form-control form-control-sm col-md-9"/> 
         </div>
        <div class="col-6"> <label class="control-label ">SSLC/10th total mark/percentage</label>
       <input type="number" name="sslc_mark" id="sslc_mark" placeholder="Enter" step="any" class=" form-control form-control-sm col-md-9"/> 
        </div>
    </div>
   <p style="color: red; font-size: 16px;">DEGREE DETAILS</p>
   
    <div class="form-group row">
        <div class="col-6"> <label class="control-label" >College/Institute</label>
         <input type="text" name="pgquali_institute" id="pgquali_institute" placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
         </div>
        <div class="col-6"> <label class="control-label ">University</label>
       <input type="text" name="pgquali_university" id="pgquali_university" placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
        </div>
     </div>  
    <div class="form-group row">    
        <div class="col-6"> <label class="control-label" >Programme</label>
         <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_exam" name="pgquali_exam">
            <option value="" selected="" disabled="">Select</option>  
                        @foreach($ugquali as $keyn )
                        
                            <option value="{{$keyn->degq_name}}" class="col-md-10" >
                                 
                                   {{$keyn->degq_name}}
                                 </option>
                           @endforeach
                           <option value="OTHERS">OTHERS</option> <!-- Add this if not already present -->
         </select>
        <span id="error_exam" class="text-danger"></span>
           <!-- Hidden textbox for "OTHERS" -->
    <div id="other_degree_wrapper" style="display: none; margin-top: 10px;">
        <input type="text" class="form-control form-control-sm" id="other_degree" name="other_degree" placeholder="Enter degree name">
    </div>
        </div>
        <div class="col-6"> <label class="control-label "> Main Subject</label>
        <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_subject" name="pgquali_subject">
                            
                    <option value="" selected="" disabled="">Select</option>  
                        
                     @foreach($ugqualisubject as $keys )   
                        
                         <option value="{{$keys->dqsub_name}}"  >
                                 
                                   {{$keys->dqsub_name}}
                                 </option>
                           @endforeach
                              
        </select>
        <span id="error_exam" class="text-danger"></span>
        </div>
      </div>   
   <div class="form-group row">         
        <div class="col-6"> <label class="control-label" >Programme Type</label>
          <select  class="form-control form-control-sm select2 col-md-9"  id="coursetype" name="coursetype">
            <option value="" selected="" disabled="">Select</option>  
               <option value="SEMESTER WISE" >SEMESTER WISE</option>
                <option value="YEAR WISE" >YEAR WISE</option>
                       
         </select>
        </div>
<!--        <div class="col-6"> <label class="control-label ">Grade & Grade Point/Percentage of marks</label>
            <input type="text" name="pgquali_grade" id="pgquali_grade" placeholder="Enter" class="form-control form-control-sm col-md-9"/> 
        </div>-->
      <div class="col-6"> <label class="control-label ">Duration of Programme</label>
           <select  class="form-control form-control-sm select2 col-md-9"  id="courseduration" name="courseduration">
            <option value="" selected="" disabled="">Select</option>  
                       
                <option value="1" >1 Year</option>
                <option value="2" >2 Year</option>
                <option value="3" >3 Year</option>
                <option value="4" >4 Year</option>   
                <option value="5" >5 Year</option>       
         </select> 
        </div>
    </div>
    <div class="form-group row">         
        <div class="col-6"> <label class="control-label" >Period of study (Programme start year)</label>
          <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_year" name="pgquali_year">
                                                
                <option value="" selected="" disabled="">Select</option>  
                   <?php
                // Sets the top option to be the current year. (IE. the option that is chosen by default).
                $currently_selected = date('Y'); 
                // Year to start available options at
                $earliest_year = 1970; 
                // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                $latest_year = date('Y'); 
                ?>

                @foreach ( range( $latest_year, $earliest_year ) as $i )
                  <option value="{{$i}}" <?php echo($i === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$i}}</option> 

                @endforeach  
            </select>
        </div>
<!--        <div class="col-6"> <label class="control-label ">Grade & Grade Point/Percentage of marks</label>
            <input type="text" name="pgquali_grade" id="pgquali_grade" placeholder="Enter" class="form-control form-control-sm col-md-9"/> 
        </div>-->
      <div class="col-6"> <label class="control-label" >Period of study (Programme end year)</label>
          <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_endyear" name="pgquali_endyear">
                                                
                <option value="" selected="" disabled="">Select</option>  
                   <?php
                // Sets the top option to be the current year. (IE. the option that is chosen by default).
                $currently_selected = date('Y'); 
                // Year to start available options at
                $earliest_year = 1971; 
                // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                $latest_year = date('Y'); 
                ?>

                @foreach ( range( $latest_year, $earliest_year ) as $e )
                  <option value="{{$e}}" <?php echo($e === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$e}}</option> 

                @endforeach  
            </select>
        </div>
    </div>
   <div class="form-group row">
        <div class="col-6"> <label class="control-label" >Register number</label>
         <input type="text" name="regnodegree" id="regnodegree"  placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
         </div>
        <div class="col-6"> <label class="control-label ">Aggregate percentage / CGPA</label>
       <input type="number" name="degree_aggregate" id="degree_aggregate"  placeholder="Enter" step="any" class=" form-control form-control-sm col-md-9"/> 
        </div>
        
     </div> 
 
<!--            <div class="form-group row">
                <label class="control-label col-md-4" >Main/Core Subjects: </label>
                <div class="col-md-8">
                    <input type="text" name="pgquali_subject" id="pgquali_subject" placeholder="Enter" class="form-control form-control-sm col-md-9"/> 
               </div>
            </div>-->
            
    <div class="form-group row">
     @foreach($pgapp as $key) 
       <div class="col-md-2">
            <label class="control-label" >UG Result awaiting : </label> <br>
<!--            <label class="control-label col-sm-12">if you are result waiting must add record with aggregate mark/grade</label>-->
        </div>
       <div class="col-md-2">
        <input type="checkbox" name="ugcourse_status" id="ugcourse_status" <?php if ($key->ugcourse_status == 1) echo 'checked'; ?> >
       </div>
     @endforeach
    </div>
    
</div>

    <button type="submit" style="display: none" name="btn_resultawaiting" id="btn_resultawaiting" class="btn btn-success">save</button>

</form>

@else
<form method="post" name="formquali" id="formquali">
   @foreach($pgquali as $key)   
 <div class="container">
     <p style="color: red; font-size: 16px;">SSLC DETAILS</p>
 
    <div class="form-group row">
        <div class="col-6"> <label class="control-label" >SSLC register number</label>
         <input type="text" name="sslc_regno" id="sslc_regno" placeholder="Enter" value="{{$sslcregno}}" readonly class="form-control form-control-sm col-md-9"/> 
         </div>
        <div class="col-6"> <label class="control-label ">Percentage</label>
       <input type="text" name="sslc_mark" id="sslc_mark" placeholder="Enter" value="{{$key->sslc_mark}}" class=" form-control form-control-sm col-md-9"/> 
        </div>
    </div>
   <p style="color: red; font-size: 16px;">DEGREE DETAILS</p>
   
    <div class="form-group row">
        <div class="col-6"> <label class="control-label" >College/Institute</label>
         <input type="text" name="pgquali_institute" id="pgquali_institute" value="{{$key->pgquali_institute}}" placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
         </div>
        <div class="col-6"> <label class="control-label ">University</label>
       <input type="text" name="pgquali_university" id="pgquali_university" value="{{$key->pgquali_university}}" placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
        </div>
        
     </div>  
   
    <div class="form-group row">    
        <div class="col-6"> <label class="control-label" >Programme</label>
         <select class="form-control form-control-sm select2 col-md-9" id="pgquali_exam" name="pgquali_exam">
            <option value="" selected="" disabled="">Select</option>  
                        
                @foreach($ugquali as $keyn )
                  @if($key->pgquali_exam ==$keyn->degq_name)  
                    <option selected="" value="{{$key->pgquali_exam}}">{{$key->pgquali_exam}}</option> 
                  @else                             
                    <option value="{{$keyn->degq_name}}">{{$keyn->degq_name}}</option>
                  @endif
               
                @endforeach
                <option value="OTHERS">OTHERS</option> <!-- Add this if not already present -->
         </select>
        <span id="error_exam" class="text-danger"></span>
        <div id="other_degree_wrapper" 
     style="display: {{ $key->pgquali_exam == 'OTHERS' ? 'block' : 'none' }}; margin-top: 10px;">
    <input type="text" class="form-control form-control-sm" id="other_degree" name="other_degree"
           placeholder="Enter degree name"
           value="{{ $key->degree_other_sub ?? '' }}">
</div>

        </div>
        <div class="col-6"> <label class="control-label "> Main Subject</label>
        <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_subject" name="pgquali_subject">
                            
                    <option value="" selected="" disabled="">Select</option>  
                        
                     @foreach($ugqualisubject as $keys )   
                      @if($key->pgquali_subject ==$keys->dqsub_name)  
                        <option selected="" value="{{$key->pgquali_subject}}">{{$key->pgquali_subject}}</option> 
                      @else                             
                        <option value="{{$keys->dqsub_name}}">{{$keys->dqsub_name}}</option>
                      @endif
                       
                    @endforeach
                              
        </select>
        <span id="error_exam" class="text-danger"></span>
        </div>
      </div>   
   <div class="form-group row">

  <div class="col-6"> <label class="control-label" >Programme Type</label>
          <select  class="form-control form-control-sm select2 col-md-9"  id="coursetype" name="coursetype">
                <option value="{{$key->coursetype}}" selected="" >{{$key->coursetype}}</option>  

            <option value=""  disabled="">Select</option>  
                <option value="SEMESTER WISE" >SEMESTER WISE</option>
                <option value="YEAR WISE" >YEAR WISE</option>
                   
         </select>
        </div>
   <div class="col-6"> <label class="control-label ">Duration of Programme</label>
           <select  class="form-control form-control-sm select2 col-md-9"  id="courseduration" name="courseduration">
            <option value=""  disabled="">Select</option>  
                <option  value="{{$key->courseduration}}" selected >{{$key->courseduration}} Year</option>      
                <option value="1">1 Year</option>
                <option value="2" >2 Year</option>
                <option value="3" >3 Year</option>
                <option value="4" >4 Year</option>    
                <option value="5" >5 Year</option>   
         </select> 
        </div>
 </div>
    <div class="form-group row">         
        <div class="col-6"> <label class="control-label" >Period of study (Programme start year)</label>
          <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_year" name="pgquali_year">
                <option  value="{{$key->pgquali_year}}" selected >{{$key->pgquali_year}} </option>                                
                <option value=""  disabled="">Select</option>  
                   <?php
                // Sets the top option to be the current year. (IE. the option that is chosen by default).
                $currently_selected = date('Y'); 
                // Year to start available options at
                $earliest_year = 2005; 
                // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                $latest_year = date('Y'); 
                ?>
                
                
                      
                @foreach ( range( $latest_year, $earliest_year ) as $i )
                
                @if($key->pgquali_year ==$i)  
                 <option selected="" value="{{$key->pgquali_year}}">{{$key->pgquali_year}}</option> 
                @else                             
                 <option value="{{$i}}" <?php echo($i === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$i}}</option> 

                @endif
                  
                @endforeach  
            </select>
        </div>
<!--        <div class="col-6"> <label class="control-label ">Grade & Grade Point/Percentage of marks</label>
            <input type="text" name="pgquali_grade" id="pgquali_grade" value="{{$key->pgquali_grade}}" placeholder="Enter" class="form-control form-control-sm col-md-9"/> 
        </div>-->
         <div class="col-6"> <label class="control-label" >Period of study (Programme end year)</label>
          <select  class="form-control form-control-sm select2 col-md-9"  id="pgquali_endyear" name="pgquali_endyear">
                <option  value="{{$key->pgquali_endyear}}" selected >{{$key->pgquali_endyear}} </option>                                   
                <option value=""  disabled="">Select</option>  
                   <?php
                // Sets the top option to be the current year. (IE. the option that is chosen by default).
                $currently_selected = date('Y'); 
                // Year to start available options at
                $earliest_year = 2005; 
                // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                $latest_year = date('Y'); 
                ?>
                
                
                      
                @foreach ( range( $latest_year, $earliest_year ) as $e )
                
                @if($key->pgquali_endyear ==$e)  
                 <option selected="" value="{{$key->pgquali_endyear}}">{{$key->pgquali_endyear}}</option> 
                @else                             
                 <option value="{{$e}}" <?php echo($e === $currently_selected ? ' selected="selected"' : ''); ?>  >{{$e}}</option> 

                @endif
                  
                @endforeach  
            </select>
        </div>
    </div>
  
<!--            <div class="form-group row">
                <label class="control-label col-md-4" >Main/Core Subjects: </label>
                <div class="col-md-8">
                    <input type="text" name="pgquali_subject" id="pgquali_subject" placeholder="Enter" class="form-control form-control-sm col-md-9"/> 
               </div>
            </div>-->
            
    <div class="form-group row">
        <div class="col-6"> <label class="control-label" >Register number</label>
         <input type="text" name="regnodegree" id="regnodegree" value="{{$key->regnodegree}}" placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
         </div>
        <div class="col-6"> <label class="control-label ">Aggregate percentage / CGPA</label>
       <input type="text" name="degree_aggregate" id="degree_aggregate" value="{{$key->degree_aggregate}}" placeholder="Enter" class=" form-control form-control-sm col-md-9"/> 
        </div>
        
     </div> 
   <div class="form-group row">
     @foreach($pgapp as $key) 
       <div class="col-md-4">
            <label class="control-label" >UG Result awaiting /യു ജി ഫലം കാത്തിരിക്കുന്നു : </label> <br>
        </div>
       <div class="col-md-2">
        <input type="checkbox" name="ugcourse_status" id="ugcourse_status" <?php if ($key->ugcourse_status == 1) echo 'checked'; ?> >
       </div>
     @endforeach
    </div>
</div>
   
   @endforeach
    <button type="submit" style="display: none" name="btn_resultawaiting" id="btn_resultawaiting" class="btn btn-success">save</button>

</form>
@endif

<script>
    $(document).ready(function() {
        $('#pgquali_exam').change(function() {
            if ($(this).val() === 'OTHERS') {
                $('#other_degree_wrapper').show();
            } else {
                $('#other_degree_wrapper').hide();
                $('#other_degree').val('');
            }
        });
    });
</script>



    