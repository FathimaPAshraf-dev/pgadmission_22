

<form method="post" name="formpersonal" id="formpersonal">
    
 @foreach($pgapp as $key) 
 
<div class="row">
 <div class="col-lg-6">
 <div class="form-group">
<label for="exampleInputEmail1">Stream in which you are applied for... :</label>
<textarea name="pgapp_adsc_sl" id="pgapp_adsc_sl" class="form-control form-control-sm col-md-8" readonly="">{{$key->adsc_name}}</textarea>
</div> 
 </div> 
<div class="col-lg-6">
   <div class="form-group">
<label for="exampleInputEmail1">Application Number :</label>
  <input type="text" name="pgapp_id" id="pgapp_id" value="{{$key->pgapp_id}}" class="form-control form-control-sm col-md-8" readonly=""/> 
</div> 
 </div> 
</div>

  <div class="row">
        <div class="col-lg-6"> 
        <div class="form-group"> 
            <label class="control-label" >Name of Applicant :</label>
        <input type="text" name="pgapp_name" id="pgapp_name" class="form-control form-control-sm  col-md-8" value="{{$key->pgapp_name}}" readonly=""/> 
         </div>
         </div>
        <div class="col-lg-6">
          <div class="form-group">   <label class="control-label ">Date Of Birth :</label>
        <input type="text" name="pgapp_dob" id="pgapp_dob" class="form-control form-control-sm col-md-8" value="{{date('d-m-Y', strtotime($key->pgapp_dob))}}"  readonly=""/> 
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
         <div class="form-group">     <label class="control-label" >Gender :</label>
        <input type="text" name="pgapp_gender_sl" id="pgapp_gender_sl"  class="form-control form-control-sm form-control form-control-sm-sm col-md-8" value="{{$key->gender_name}}"  readonly=""/> 
         </div>
         </div>
        <div class="col-lg-6">
           <div class="form-group">    <label class="control-label ">Nationality :</label>
       <input type="text" name="pgapp_nationality" id="pgapp_nationality" placeholder="Enter nationality" value="{{$key->pgapp_nationality}}" class="form-control form-control-sm form-control form-control-sm-sm col-md-8"/> 
           <span id="error_nationality" class="text-danger"></span>        </div>
       </div>
     </div>
    
@endforeach

  
<div class="row">
        <div class="col-lg-6">
        <div class="form-group">    
        <label class="control-label" >Religion :</label>
         <select  class="form-control form-control-sm select2 col-md-8"  id="pgapp_religion" name="pgapp_religion" required>
             <option value="" disabled="" selected="">Select</option>
               @foreach($religion as $keyR)

               @if($key->pgapp_religion ==$keyR->relgn_name)  
                <option selected="" value="{{$key->pgapp_religion}}">{{$key->pgapp_religion}}</option> 
               @else                             
                 
               
                <option value="{{$keyR->relgn_name}}">{{$keyR->relgn_name}}</option>
                @endif
                @endforeach
         </select>
        <span id="error_religion" class="text-danger"></span>        
        </div>
        </div>
    <div class="col-lg-6">
         <div class="form-group">    
          <label class="control-label ">State :</label>
        <select  class="form-control form-control-sm select2 col-md-8"  id="pgapp_state" name="pgapp_state"  onchange="fordist()" required>
            <option value="" selected="" disabled="">Select</option>
               @foreach($state as $keyR)

               @if($key->pgapp_state ==$keyR->state_name)  
                <option selected="" value="{{$key->pgapp_state}}">{{$key->pgapp_state}}</option> 
               @else                             
                 
               
                <option value="{{$keyR->state_name}}">{{$keyR->state_name}}</option>
                @endif
                @endforeach
         </select>      
        </div>
        </div>
       
</div>

<div class="row">
     <div class="col-lg-6">
            <label class="control-label ">Community :</label>
        
        <div class="form-group"  id="commdiv" id="commdiv" >        
            
            <select  class="form-control form-control-sm select2 col-md-8"  id="pgapp_community" name="pgapp_community" required>

                      @if(!empty($key->pgapp_community))  
                     <option selected="" value="{{$key->pgapp_community}}">{{$key->pgapp_community}}</option> 
                    @else                                  
                     <option value="">Select</option>  
                     @endif
             </select>
        <span id="error_community" class="text-danger"></span>
        
        </div>
        </div>
    <div class="col-lg-6">
        <div class="form-group">    
           <label class="control-label" >District :</label>
       <input type="text" name="pgapp_district" id="pgapp_district" placeholder="Enter district" value="{{$key->pgapp_district}}" class="form-control form-control-sm  col-md-8"/> 
         </div>
         </div>
        
            
 </div>

@foreach($pgapp as $key)
<div class="row">
        <div class="col-lg-6"> 
         <label class="control-label" >Caste :</label>
        <div class="form-group" id="castediv" id="castediv">     
               
        <select  class="form-control form-control-sm select2 col-md-8"  id="pgapp_caste_sl" name="pgapp_caste_sl">
                 @if(!empty($key->pgapp_caste_sl))  
                <option selected="{{$key->pgapp_caste_sl}}" value="{{$key->pgapp_caste_sl}}">{{Auth::user()->subcaste_table->subcaste}}</option> 
               @else                                  
                <option value="">Select</option>  
                @endif                                
                
               
        </select>
        <span id="error_caste" class="text-danger"></span>
        </div>
        </div>   
        <div class="col-lg-6">
         <div class="form-group"> 
           <label class="control-label ">Name of Guardian  :</label>
        <input type="text" name="pgapp_father" id="pgapp_father" placeholder="Enter name of guardian" value="{{$key->pgapp_father}}" class="form-control form-control-sm col-md-8"/> 
       </div>
        </div>
    </div>
<div class="form-group">
    <label class="control-label" >Communication Address </label>
</div>
<div class="row">
        <div class="col-lg-6"> 
       <div class="form-group">
         <label class="control-label" >House Name :</label>
        <input type="text" name="comm_addressline1" id="comm_addressline1" value="{{$key->comm_addressline1}}" placeholder="Enter Your House Name" class=" form-control form-control-sm col-md-8"/> 
        <span id="error_address1" class="text-danger"></span>
        </div>
        </div>  
        <div class="col-lg-6">
        <div class="form-group">    
            <label class="control-label ">Place / Street Name :</label>
        <input type="text" name="comm_addressline2"id="comm_addressline2" value="{{$key->comm_addressline2}}" placeholder="Enter Your Street " class="form-control form-control-sm col-md-8"/> 
        <span id="error_address2" class="text-danger"></span>    
        </div>
        </div>    
    </div>
<div class="row">
        <div class="col-lg-6"> 
         <div class="form-group">   
              <label class="control-label" >Post Office :</label>
        <input type="text" name="comm_addressline3" id="comm_addressline3" value="{{$key->comm_addressline3}}" placeholder="Enter Your Post Office" class="form-control form-control-sm form-control form-control-sm-sm col-md-8"/> 
        <span id="error_address3" class="text-danger"></span>
        </div>
       </div>
    </div>
 
 <div class="row">
     
       <div class="col-lg-6">  <input type="checkbox" id="sameaddress" name="sameaddress" onclick="copyValue(this)" @if(old('sameaddress')) checked @endif>
     
           <label class="col-sm-6 control-label">Permanent Address : Same as above  </label></div>
       
  </div>
<div class="row">
        <div class="col-lg-6"> 
          <div class="form-group">     
            <label class="control-label" >House Name :</label>
        <input type="text" name="per_addressline1" id="per_addressline1" value="{{$key->per_addressline1}}" placeholder="Enter Your House Name" class="form-control form-control-sm col-md-8"/> 
        <span id="error_address1" class="text-danger"></span>
        </div>
        </div>
        <div class="col-lg-6"> 
          <div class="form-group">   <label class="control-label ">Place / Street Name :</label>
        <input type="text" name="per_addressline2"id="per_addressline2" value="{{$key->per_addressline2}}" placeholder="Enter Your Street " class="form-control form-control-sm col-md-8"/> 
        <span id="error_address2" class="text-danger"></span>    
         </div></div>
    </div>
<div class="row">
        <div class="col-lg-6">
         <div class="form-group"> 
            <label class="control-label" >Post Office :</label>
        <input type="text" name="per_addressline3" id="per_addressline3" value="{{$key->per_addressline3}}" placeholder="Enter Your Post Office " class="form-control form-control-sm col-md-8"/> 
        <span id="error_address1" class="text-danger"></span>
        </div>
        </div>
        <div class="col-lg-6"> 
        <div class="form-group">     
         <label class="control-label ">Pin Code : </label>
        <input type="text" name="pgapp_pincode" id="pgapp_pincode" placeholder="Enter pin code" value="{{$key->pgapp_pincode}}"  class="form-control form-control-sm col-md-8"/> 
        <span id="error_address2" class="text-danger"></span>    
        </div>
         </div>    
    </div>

<div class="row">
        <div class="col-lg-6"> 
        <div class="form-group">     
        <label class="control-label" >Mobile Number :</label>
        <input type="text" name="pgapp_mobile" id="pgapp_mobile" placeholder="Mobile Number" class="form-control form-control-sm col-md-8" value="{{$key->pgapp_mobile}}"  readonly=""/> 
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">      
        <label class="control-label ">Alternate Mobile Number : </label>
        <input type="text" name="pgapp_landphone" id="pgapp_landphone" placeholder="Enter alternate mobile number" class="form-control form-control-sm col-md-8" value="{{$key->pgapp_landphone}}"/> 
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
        <div class="form-group">     
         <label class="control-label" >E-mail ID :</label>
        <input type="text" name="pgapp_email" id="pgapp_email" placeholder="First Name" class="form-control form-control-sm col-md-8" value="{{$key->pgapp_email}}"  readonly=""/> 
        </div>
        </div>
      
    </div>

@endforeach
<button type="submit" style="display: none" name="btn_personal_ref" id="btn_personal_ref" class="btn btn-success">save</button>
</form>