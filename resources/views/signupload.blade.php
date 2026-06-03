    
 <form method="post" name="formsignupload" id="formsignupload">
<div class="form-group row">

<div class="col-md-12">
<label for="inputEmail3" >
    <u>  Please read the instructions carefully before uploading your signature</u><br>
                        *<font style="color: red"><i>Candidates need to sign with a black pen on white paper. </i></font><br>
                        *<font style="color: red"><i>They must ensure that it is their signature and not someone else’s. 
                            If the signature on the answer sheet does not match the signature of the candidate in the application form,
                            he/she will be disqualified to appear at entrance exam </i></font><br>
                                *<font style="color: red"><i>Signature Image Size : 10 Kb to 30 Kb  </i></font><br>

                            *<font style="color: red"><i>Signature Background : White</i></font><br>
                            *<font style="color: red"><i> Image Format : jpg/jpeg only</i></font><br> 
*<font style="color: red"><i> After choosing image, click on Upload button </i></font><br>

                            
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
<input type="hidden" name="sign_hidden" id="sign_hidden" value="{{Auth::user()->pgapp_sign}}">
 <div id='loader' class="overlay" style='display: none;'>
                                     <i class="fa fa-refresh fa-spin"></i>
                                </div>
 
 </div>

<div class="form-group row">

<div class="col-md-3">
<button type="submit" style="display: none" name="btn_signupload" id="btn_signupload" class="btn btn-success">save</button>
</div>
 </div>
@foreach($pgapp as $key)
 @if($key->pgapp_sign)

 <div class="form-group row">

                <img src="{{ URL::asset('images/pgsign/'.$key->pgapp_sign)}}?{{filemtime( public_path('images/pgsign/'.$key->pgapp_sign) ) }}" width="200" height="100">
        </div>
         @endif
@endforeach 
 </form>     
 