 @if($pflag== '0')
 <form method="post" name="formpmode" id="formpmode">
 <div class="row">
  <div class="col-lg-6">
        <div class="form-group">    
         <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course1" name="course1" required>
         
            <option value="" >Select Option 1 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION" class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>


     </select>      

    </div>
    </div>
 
  <div class="col-lg-6">
        <div class="form-group">    
         <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course2" name="course2" required>
         
            <option value="" >Select Option 2 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION" class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>


     </select>      

    </div>
    </div>
 </div>   
<div class="row"> 
 <div class="col-lg-6">
        <div class="form-group">    
         <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course3" name="course3" required>
         
            <option value="" >Select Option 3 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION" class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>


     </select>      

    </div>
    </div>
 
  <div class="col-lg-6">
        <div class="form-group">    
         <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course4" name="course4" required>
         
            <option value="" >Select Option 4</option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION" class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
        <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>


     </select>      

    </div>
    </div>
  </div>   
 </form>  
@else 
<form method="post" name="formpmode" id="formpmode">

    @foreach($pmodeoption as $key)
    
    @if($key->p_option==1)
    <div class="row">
     <div class="col-lg-6">
        <div class="form-group">    
            <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course1" name="course1" required>
           <?php  $sel="selected";?>
           
            <option value="" >Select Option 1 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION"  <?php if( $key->p_stream=="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION") echo $sel; ?> class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MA IN SOCIOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION") echo $sel; ?> class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>
          

         </select>      
       
        </div>
     </div>
        
        
    @endif
    @if($key->p_option==2)
     <div class="col-lg-6">
        <div class="form-group">    
            <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course2" name="course2" required>
           <?php  $sel="selected";?>
           
            <option value="" >Select Option 2 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION"  <?php if( $key->p_stream=="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION") echo $sel; ?> class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MA IN SOCIOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION") echo $sel; ?> class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>
          

         </select>      
       
        </div>
     </div>
    </div>
    @endif
    
    @if($key->p_option==3)
    <div class="row">
     <div class="col-lg-6">
        <div class="form-group">    
            <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course3" name="course3" required>
           <?php  $sel="selected";?>
           
            <option value="" >Select Option 3 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION"  <?php if( $key->p_stream=="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION") echo $sel; ?> class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MA IN SOCIOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION") echo $sel; ?> class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>
          

         </select>      
       
        </div>
     </div>
    @endif
    @if($key->p_option==4)
     <div class="col-lg-6">
        <div class="form-group">    
            <label class="control-label" >Stream which you are applied for :</label>
     
         <select  class="form-control form-control-sm select2 col-md-8"  id="course4" name="course4" required>
           <?php  $sel="selected";?>
           
            <option value="" >Select Option 4 </option>
           <option value="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION"  <?php if( $key->p_stream=="MSC IN GEOGRAPHY AND DMM 2023 ADMISSION") echo $sel; ?> class="gdmm">MSC IN GEOGRAPHY AND DMM 2023 ADMISSION</option>
            <option value="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="pdmm">MSC IN PSYCHOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MA IN SOCIOLOGY AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MA IN SOCIOLOGY AND DMM 2023 ADMISSION") echo $sel; ?> class="sdmm"> MA IN SOCIOLOGY AND DMM 2023 ADMISSION</option>
            <option value="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION" <?php if( $key->p_stream=="MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION") echo $sel; ?> class="swdmm">MASTERS IN SOCIAL WORK AND DMM 2023 ADMISSION</option>
          

         </select>      
       
        </div>
     </div>
    </div>
    @endif
    
    
    @endforeach
     
    

  

<button type="submit" style="display: none" name="btn_personal_ref" id="btn_personal_ref" class="btn btn-success">save</button>
</form>

@endif