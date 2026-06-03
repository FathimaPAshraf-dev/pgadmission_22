    
 <form method="post" name="formsignupload" id="formsignupload">
<div class="form-group row">

<div class="col-md-12">
<label for="inputEmail3" >
    <u>  Please read the instructions carefully before uploading your Signature</u><br>
                                *<font style="color: red"><i>Candidate put his/her signature in an area of 2" × 1" on paper with a black ball point pen.  </i></font><br>

                            *<font style="color: red"><i>Scan that paper jpeg format.</i></font><br>
                            *<font style="color: red"><i> Cut Signature area of 2" × 1" and save it as "Candidate Signature.jpg". Keep size of Signature minimum, as the
maximum size limit is 30 KB.   </i></font><br> 
*<font style="color: red"><i>Candidates must  signature to correct specified fields. Do not make any mistake in
uploading signature .</i></font><br>

                            
</label>
</div>
 </div>

<div class="form-group row">
<label class="col-md-3 control-label">Upload your  Signature:</label>
<div class="col-md-4">
  <input type="hidden" name="pgapp_sign" id="pgapp_sign">   
  <input type="file" name="pgapp_sign" id="pgapp_sign" accept="image/*" onchange="showPreviewsign(event);">
 <input type="submit" value="Upload" class="btn btn-sm btn-info upload-image1"  id="upload" name="upload"> 
</div>
<div class="preview col-md-4">
        <img id="file-is-1-preview" width="200px;" height="100px;">
 </div>
<input type="hidden" name="img_hidden" id="img_hidden" value="{{Auth::user()->pgapp_sign}}">
 <div id='loader' class="overlay" style='display: none;'>
                                     <i class="fa fa-refresh fa-spin"></i>
                                </div>
 
 </div>

<div class="form-group row">

<div class="col-md-3">
<button type="submit" style="display: none" name="btn_signupload" id="btn_signupload" class="btn btn-success">save</button>
</div>
 </div>
    @foreach($pgsign as $key)
 @if($key->pgapp_sign)
 <div class="form-group row">

                <img src="{{ URL::asset('images/pgsign/'.$key->pgapp_sign)}}" width="200" height="100">
        </div>
         @endif
@endforeach 
 </form>     
 