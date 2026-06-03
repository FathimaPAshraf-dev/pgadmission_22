@if($pgotherinfo->isEmpty())
<form method="post" name="formotherinfo" id="formotherinfo"> 
    @csrf
    <div class="form-group row">
    <label class="control-label col-md-4" >Whether Eligible for Special Reservation ? </label> 
    <div class="col-md-2">
    <input name="pgapp_wh_special_reserv" id="pgapp_wh_special" type="radio"  value="1"/>
    <label for=""> Yes</label>
    <input name="pgapp_wh_special_reserv" id="pgapp_wh_special" type="radio" value="2"  >
    <label for=""> No </label>                     
        </div>
   </div> 
     <div class="form-group row" id="dvyes" style="display: none">
                  
        <label class="col-sm-4 control-label">Special reserve  Type</label>

        <div class="col-sm-8">
            
                 <input type="checkbox"  name="pgapp_ncc" id="pgapp_ncc"  value="2"  />NCC 
                &nbsp;&nbsp; <input type="checkbox"  name="pgapp_nss" id="pgapp_nss"  value="2"  />NSS 
                &nbsp;&nbsp; <input type="checkbox"  name="pgapp_sports" id="pgapp_sports"  value="2"  />SPORTS
                &nbsp;&nbsp; <input type="checkbox"  name="pgapp_arts" id="pgapp_arts"  value="2"  />ARTS
                &nbsp;&nbsp; <input type="checkbox"  name="pgapp_sp_resrve" id="pgapp_sp_resrve"  value="2"  />Ex-service men
            </select>     
        </div>
              
 </div>
<div class="form-group row">
        <label class="control-label col-md-4">Whether eligible for differently abled reservation?  </label>
        <div class="col-md-2">
        <input type="radio" id="chkYes" name="ph_status" value="1">
        <label for=""> Yes</label>
        <input type="radio" id="chkNo" name="ph_status" value="2">
        <label for=""> No </label>
                                       
        </div>
</div>
 
 <div class="form-group row" id="dvedu" style="display: none">
                  
        <label class="col-sm-4 control-label">Differently abled Type</label>

        <div class="col-sm-8">
            <select  class="form-control form-control-sm select2 col-sm-4"  id="ph_type" name="ph_type">
                <option value="" disabled="">Select</option>
                  <option value="1" >Visually challenged</option>
                  <option value="2" >Other Differently abled</option>
            </select>     
        </div>
              
 </div>
         

<!--<div class="form-group row">
    <label class="control-label col-md-4" >Number of years of teaching experience in the case of College/High School Teachers/Employed persons   : </label>
    <div class="col-md-8">
        <input type="text"  name="pgemployment_teach_exp" id="pgemployment_teach_exp" value="" class="form-control col-md-8" placeholder="Type..."/>
    </div>

</div>-->
   
<div class="form-group row">
    <label class="control-label col-md-4" >Annual Income of family : </label>
    <div class="col-md-8">
        
        <select class="form-control form-control-sm select2 col-sm-4"  id="pgapp_inc_sl" name="pgapp_inc_sl" required="">
         <option value="" disabled="" selected="">Select income</option>
           @foreach($entireTableinc as $prgm)
                          <option value="{{$prgm->inc_sl }}"  class="col-md-10" >

                           {{$prgm->inc_descp }}
                         </option>
                         @endforeach

        </select>  
             
    </div>

</div>
    <div class="form-group row" >
    <label class="control-label col-md-4" >Entrance Examination Centre : </label>
     <div class="col-md-8">
     @php
    $restrictedMapping = [
        1182 => 23,
        1183 => 23,
        1195 => 23,
        1184 => 23,
        1181 => 23,
        1194 => 23,
        
    ];

    $user_sl = Auth::user()->pgapp_adsc_sl;
    $restrictedCentre = $restrictedMapping[$user_sl] ?? null;
@endphp
        <!-- <select class="form-control form-control-sm select2 col-sm-5"  id="center_slexam" name="center_slexam" required="">
            <option value="" disabled="" selected="">Choose Entrance Examination Centre</option>
            @foreach($examcentre as $key)

            <option value="{{$key->centre_sl}}" > {{$key->centre_name}}</option>
            

            @endforeach 

            
        </select>   -->
        <select class="form-control form-control-sm select2 col-sm-5" id="center_slexam" name="center_slexam" required>
    <option value="" disabled {{ $restrictedCentre ? '' : 'selected' }}>Choose Entrance Examination Centre</option>
    
    @foreach($examcentre as $key)
        @if($restrictedCentre)
            @if($key->centre_sl == $restrictedCentre)
                <option value="{{ $key->centre_sl }}" selected>{{ $key->centre_name }}</option>
            @endif
        @else
            <option value="{{ $key->centre_sl }}">{{ $key->centre_name }}</option>
        @endif
    @endforeach
</select>
   
    </div>    
</div> 
    <button type="submit" style="display: none" id="btnotherinfo_ref" name="btnotherinfo_ref" class="btn btn-success">Save</button>  
     
</form>  
  

@else
<form method="post" name="formotherinfo" id="formotherinfo"> 
     @foreach($pgotherinfo as $key)
    <div class="form-group row">
    <label class="control-label col-md-4" >Whether Eligible for Special Reservation ? </label> 
    <div class="col-md-2">
    <input name="pgapp_wh_special_reserv" id="pgapp_wh_special" type="radio"  value="1"<?php echo ($key->pgapp_wh_special_reserv== '1') ?  "checked" : "" ;  ?>>
    <label for=""> Yes</label>
    <input name="pgapp_wh_special_reserv" id="pgapp_wh_special" type="radio" value="2" <?php echo ($key->pgapp_wh_special_reserv== '2') ?  "checked" : "" ;  ?>>
    <label for=""> No </label>                     
        </div>
   </div>
 <div class="form-group row" id="dvyes" style="display: none">
                  
        <label class="col-sm-4 control-label">Special reserve  Type</label>

        <div class="col-sm-8">
            
                 <input type="checkbox"  name="pgapp_ncc" id="pgapp_ncc"  value="2" <?php echo ($key->pgapp_ncc == "2")?"checked":"" ?>>NCC 
               &nbsp;&nbsp;  <input type="checkbox"  name="pgapp_nss" id="pgapp_nss"  value="2" <?php echo ($key->pgapp_nss == "2")?"checked":"" ?>>NSS 
                &nbsp;&nbsp; <input type="checkbox"  name="pgapp_sports" id="pgapp_sports"  value="2"  <?php echo ($key->pgapp_sports == "2")?"checked":"" ?>>SPORTS
                &nbsp;&nbsp; <input type="checkbox"  name="pgapp_arts" id="pgapp_arts"  value="2"  <?php echo ($key->pgapp_arts == "2")?"checked":"" ?>>ARTS 
                 &nbsp;&nbsp; <input type="checkbox"  name="pgapp_sp_resrve" id="pgapp_sp_resrve"  value="2"  <?php echo ($key->pgapp_sp_resrve == "2")?"checked":"" ?>>Ex-service men
            </select>     
        </div>
              
 </div>
     
<div class="form-group row">
        <label class="control-label col-md-4">Whether eligible for PH Reservation ?  </label>
        <div class="col-md-2">
        <input type="radio" id="chkYes" name="ph_status" value="1" <?php echo ($key->ph_status== '1') ?  "checked" : "" ;  ?>>
        <label for=""> Yes</label>
        <input type="radio" id="chkNo" name="ph_status" value="2" <?php echo ($key->ph_status== '2') ?  "checked" : "" ;  ?>>
        <label for=""> No </label>
                                       
        </div>
</div>
 
 <div class="form-group row" id="dvedu" style="display: none">
                  
        <label class="col-sm-4 control-label">Differently abled Type</label>

        <div class="col-sm-8">
            <select  class="form-control form-control-sm select2 col-sm-4"  id="ph_type" name="ph_type">
                 <option value="" disabled="" selected="">Select</option>
                  <option value="1" <?php echo ($key->ph_type == "1")?"selected":"" ?>>Visually challenged</option>
                  <option value="2"  <?php echo ($key->ph_type == "2")?"selected":"" ?>>Other differently abled</option>
            </select>     
        </div>
              
 </div>
        


<!--<div class="form-group row">
    <label class="control-label col-md-4" >Number of years of teaching experience in the case of College/High School Teachers/Employed persons   : </label>
    <div class="col-md-8">
        <input type="text"  name="pgemployment_teach_exp" id="pgemployment_teach_exp" value="{{$key->pgemployment_teach_exp}}" class="form-control col-md-8" placeholder="Type..."/>
    </div>

</div>-->

<div class="form-group row">
    <label class="control-label col-md-4" >Annual Income of family : </label>
    <div class="col-md-8">
        <select class="form-control form-control-sm select2 col-sm-5"  id="pgapp_inc_sl" name="pgapp_inc_sl" required="">
                   <option value="" disabled="">Select</option>
                   @foreach($entireTableinc as $prgm)
                   
                    @if($key->pgapp_inc_sl==$prgm->inc_sl)
                                  <option value="{{$prgm->inc_sl }}"    class="col-md-10"  selected>
                                 
                                   {{$prgm->inc_descp }} 
                                 </option>
                                  @else
                    
                    <option value="{{$prgm->inc_sl}}" > {{$prgm->inc_descp}}</option>

                                 @endif

@endforeach 
                                 
                           
                </select>  
   
    </div>

</div>

  <div class="form-group row" >
    <label class="control-label col-md-4" >Entrance Examination Centre : </label>
     <div class="col-md-8">

     @php
    $restrictedMapping = [
        1131 => 23,
        1113 => 23,
        1114 => 23,
        1115 => 23,
        1130 => 23,
        1112 => 23,
        1116 => 20,
    ];

    $user_sl = Auth::user()->pgapp_adsc_sl;
    $restrictedCentre = $restrictedMapping[$user_sl] ?? null;
@endphp
        <!-- <select class="form-control form-control-sm select2 col-sm-5" id="center_slexam" name="center_slexam" required>
    <option value="" disabled selected>Choose Entrance Examination Centre</option>
    @foreach($examcentre as $keyn)
        @php
            $restrictedUsers = [1131, 1113, 1114, 1115, 1130];
        @endphp

        @if(in_array(Auth::user()->pgapp_adsc_sl, $restrictedUsers))
            @if($keyn->centre_sl == 23)
                <option value="{{ $keyn->centre_sl }}" {{ $examcent == $keyn->centre_sl ? 'selected' : '' }}>
                    {{ $keyn->centre_name }}
                </option>
            @endif
        @else
            <option value="{{ $keyn->centre_sl }}" {{ $examcent == $keyn->centre_sl ? 'selected' : '' }}>
                {{ $keyn->centre_name }}
            </option>
        @endif
    @endforeach
</select> -->

<select class="form-control form-control-sm select2 col-sm-5" id="center_slexam" name="center_slexam" required>
    <option value="" disabled {{ $examcent ? '' : 'selected' }}>Choose Entrance Examination Centre</option>
    
    @foreach($examcentre as $keyn)
        @if($restrictedCentre)
            @if($keyn->centre_sl == $restrictedCentre)
                <option value="{{ $keyn->centre_sl }}" {{ $examcent == $keyn->centre_sl ? 'selected' : '' }}>
                    {{ $keyn->centre_name }}
                </option>
            @endif
        @else
            <option value="{{ $keyn->centre_sl }}" {{ $examcent == $keyn->centre_sl ? 'selected' : '' }}>
                {{ $keyn->centre_name }}
            </option>
        @endif
    @endforeach
</select>

   
    </div>    
</div>   
    

    <button type="submit" style="display: none" id="btnotherinfo_ref" name="btnotherinfo_ref" class="btn btn-success">Save</button>  
     
@endforeach
</form>
@endif