<!--    <input type="text" value="{{$pgpgm_flag}}"/>-->
  @if($pgpgm_flag== '1')
  
<form method="post" name="formoptions" id="formoptions"> 
    @csrf
   @foreach($pgapp as $key)     
<div class="form-group row">
        <label class="control-label col-md-4" >Stream in which you are applied for : </label>
    <div class="col-md-8">
        <input type="text" name="pgapp_adsc_sl" id="pgapp_adsc_sl" value="{{$key->adsc_name}}" class="form-control col-md-8" readonly=""/> 
   </div>
    </div>
   
  @endforeach 

   @if($flags==3)
   @foreach($pgpgm3 as $key) 

  <div class="form-group row" id="cdiv1" name="cdiv1">
    <label class="control-label col-md-4" >Study Centre I : </label>
    <div class="col-md-8" id="cdiv1" name="cdiv1">
       <select class="form-control select2 col-md-8" id="center_sl1" name="center_sl1" required="" onchange="centropt1()">
<option value="0" class="col-md-10" >
                                 
                                 -----Select Centre I-----
                                 </option>

               @foreach($centre_options as $cent)
               @if($pgopt1==$cent->centre_sl)
               <option value="{{$cent->centre_sl }}"   class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
               @else
             <option value="{{$cent->centre_sl }}"   class="col-md-10"  >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                 @endif
                                    @endforeach

                  </select>    

        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 
  <div class="form-group row" id="div2" name="div2" style="" >
    <label class="control-label col-md-4" >Study Centre II : </label>
    <div class="col-md-8" id="cdiv2" id="cdiv2">
      <select class="form-control select2 col-md-8" id="center_sl2" name="center_sl2" required="">
                  <option value="0" class="col-md-10"   >
                                 
                                 -----Select centre II-----
                           
                            </option>       

              
               @foreach($centre_options as $cent)
               @if($pgopt2==$cent->centre_sl)
               <option value="{{$cent->centre_sl }}"   class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                 @endif
                                    @endforeach
                            
                  </select>  

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 <div class="form-group row" id="div3" name="div3" style="" >
    <label class="control-label col-md-4" >Study Centre III : </label>
    <div class="col-md-8" id="cdiv3" id="cdiv3">
      <select class="form-control select2 col-md-8" id="center_sl3" name="center_sl3" required="">
          <option value="0" class="col-md-10"  >
                                 
                                 -----Select Centre III-----
                           
                            </option>       
 @foreach($centre_options as $cent)
               @if($pgopt3==$cent->centre_sl)
               <option value="{{$cent->centre_sl }}"   class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                 @endif
                                    @endforeach
                  </select>  

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 @endforeach
  @elseif($flags==2) 
 @foreach($pgpgm2 as $key) 
    <div class="form-group row" id="cdiv1" name="cdiv1">
    <label class="control-label col-md-4" >Study Centre I : </label>
    <div class="col-md-8" id="cdiv1" name="cdiv1">
       <select class="form-control select2 col-md-8" id="center_sl1" name="center_sl1" required="" onchange="centropt1()">
<option value="0" class="col-md-10" >
                                 
                                 -----Select Centre I-----
                                 </option>

               @foreach($centre_options as $cent)
                @if($pgopt1==$cent->centre_sl)
                   <option value="{{$cent->centre_sl }}"   class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                  @else
                                  <option value="{{$cent->centre_sl }}"   class="col-md-10"  >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                 @endif
                                    @endforeach

                  </select>    

        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 
  <div class="form-group row" id="div2" name="div2" style="" >
    <label class="control-label col-md-4" >Study Centre II : </label>
    <div class="col-md-8" id="cdiv2" id="cdiv2">
      <select  id="center_sl2" name="center_sl2" required="">
          
                  <option value="0" class="col-md-10"   >
                                 
                                 -----Select centre II-----
                           
                            </option>       
@foreach($centre_options as $cent)
               @if($pgopt2==$cent->centre_sl)
               <option value="{{$cent->centre_sl }}"   class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                 @endif
                                    @endforeach
                  </select>  

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
   @endforeach
  @else  
   @foreach($pgpgm1 as $key) 
    <div class="form-group row" id="cdiv1" name="cdiv1">
    <label class="control-label col-md-4" >Study Centre I : </label>
    <div class="col-md-8" id="cdiv1" name="cdiv1">
       <select class="form-control select2 col-md-8" id="center_sl1" name="center_sl1" required="" onchange="centropt1()">
<option value="0" class="col-md-10" >
                                 
                                 -----Select Centre I-----
                                 </option>

               @foreach($centre_options as $cent)
             @if($key->pgpgm_centre_sl==$cent->centre_sl)
                   <option value="{{$cent->centre_sl }}"   class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                               @else
                    
                    <option value="{{$cent->centre_sl }}" > {{$cent->centre_name }}</option>
                               @endif
                                    @endforeach
                           
                  </select>    

        
        <span id="error_options" class="text-danger"></span>
   </div>
</div>  
   @endforeach
   @endif
  
  
  <div class="form-group row" >
    <label class="control-label col-md-4" >Entrance Examination Centre : </label>
    <div class="col-md-8" id="examdiv1" name="examdiv1">
       <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
<option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options as $cent)
                @if($key->pgpgm_centre_sl==$cent->centre_sl)
               <option value="{{$cent->centre_sl }}"      class="col-md-10" selected >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                  @else
                    
                    <option value="{{$cent->centre_sl }}" > {{$cent->centre_name }}</option>
                               @endif
                                    @endforeach

                  </select>    

       
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div>   
    
    
    
    
    


    <button type="submit" style="display: none" id="btnother" name="btnother" class="btn btn-success">Save</button>  
     

</form>  
@else
<!--  <input type="text" value="{{$flags}}"/>-->
<form method="post" name="formoptions" id="formoptions"> 
    @csrf
    

   @foreach($pgapp as $key)     
<div class="form-group row">
        <label class="control-label col-md-4" >Stream in which you are applied for : </label>
    <div class="col-md-8">
        <input type="text" name="pgapp_adsc_sl" id="pgapp_adsc_sl" value="{{$key->adsc_name}}" class="form-control col-md-8" readonly=""/> 
   </div>
    </div>
   
  @endforeach 
   
  
  
  
    @if($flags==3)

  <div class="form-group row" id="cdiv1" name="cdiv1">
    <label class="control-label col-md-4" >Study Centre I : </label>
    <div class="col-md-8" id="cdiv1" name="cdiv1">
       <select class="form-control select2 col-md-8" id="center_sl1" name="center_sl1" required="" onchange="centropt1()">
<option value="0" class="col-md-10" >
                                 
                                 -----Select Centre I-----
                                 </option>

               @foreach($centre_options as $cent)
                   <option value="{{$cent->centre_sl }}"   class="col-md-10" >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach

                  </select>    

        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 
  <div class="form-group row" id="div2" name="div2" style="display: none;" >
    <label class="control-label col-md-4" >Study Centre II : </label>
    <div class="col-md-8" id="cdiv2" id="cdiv2">
      <select  id="center_sl2" name="center_sl2" required="">
                  <option value="0" class="col-md-10"   <?php echo ($cent->centre_sl )?"selected":"" ?>>
                                 
                                 -----Select centre II-----
                           
                            </option>       

                  </select>  

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 <div class="form-group row" id="div3" name="div3" style="display: none;" >
    <label class="control-label col-md-4" >Study Centre III : </label>
    <div class="col-md-8" id="cdiv3" id="cdiv3">
      <select  id="center_sl3" name="center_sl3" required="">
          <option value="0" class="col-md-10"  >
                                 
                                 -----Select Centre III-----
                           
                            </option>       

                  </select>  

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 
  @elseif($flags==2)  
    <div class="form-group row" id="cdiv1" name="cdiv1">
    <label class="control-label col-md-4" >Study Centre I : </label>
    <div class="col-md-8" id="cdiv1" name="cdiv1">
       <select class="form-control select2 col-md-8" id="center_sl1" name="center_sl1" required="" onchange="centropt1()">
<option value="0" class="col-md-10" >
                                 
                                 -----Select Centre I-----
                                 </option>

               @foreach($centre_options as $cent)
                   <option value="{{$cent->centre_sl }}"   class="col-md-10" >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach

                  </select>    

        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
 
  <div class="form-group row" id="div2" name="div2" style="display: none;" >
    <label class="control-label col-md-4" >Study Centre II : </label>
    <div class="col-md-8" id="cdiv2" id="cdiv2">
      <select  id="center_sl2" name="center_sl2" required="">
                  <option value="0" class="col-md-10"   <?php echo ($cent->centre_sl )?"selected":"" ?>>
                                 
                                 -----Select centre II-----
                           
                            </option>       

                  </select>  

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div> 
   
  @else  
    <div class="form-group row" id="cdiv1" name="cdiv1">
    <label class="control-label col-md-4" >Study Centre I : </label>
    <div class="col-md-8" id="cdiv1" name="cdiv1">
       <select class="form-control select2 col-md-8" id="center_sl1" name="center_sl1" required="" onchange="centropt1()">
<option value="0" class="col-md-10" >
                                 
                                 -----Select Centre I-----
                                 </option>

               @foreach($centre_options as $cent)
                   <option value="{{$cent->centre_sl }}"   class="col-md-10" >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach

                  </select>    

        
        <span id="error_options" class="text-danger"></span>
   </div>
</div>  
   
   @endif

  <div class="form-group row" >
    <label class="control-label col-md-4" >Exam Centre : </label>
    <div class="col-md-8" id="examdiv1" name="examdiv1">
       <select class="form-control select2 col-md-8" id="center_slexam" name="center_slexam" required="" >
<option value="0" class="col-md-10" >
                                 
                                 ----- Select Exam Centre-----
                                 </option>

               @foreach($centre_options as $cent)
                   <option value="{{$cent->centre_sl }}"      class="col-md-10" >
                                 
                                   {{$cent->centre_name }}
                                 </option>
                                    @endforeach

                  </select>    

        
        
        <span id="error_options" class="text-danger"></span>
   </div>
</div>   
     
    
    
    
    


    <button type="submit" style="display: none" id="btnother" name="btnother" class="btn btn-success">Save</button>  
   

</form>  
  @endif