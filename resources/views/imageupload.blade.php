<form method="post" name="formimageupload" id="formimageupload">
<div class="form-group row">

<div class="col-md-12">
<label for="inputEmail3" >
    <u>  Please read the instructions carefully before uploading your photo</u><br>
                                *<font style="color: red"><i>Application without photo will be rejected.</i></font><br>

                            *<font style="color: red"><i>Photograph must be in color with a light color background,white is preferable.It must be taken in a proffessional  studio ,photo taken by mobile phone/tab is not accepted</i></font><br>
                            *<font style="color: red"><i> photograph should be in passport size format.Front view of fill face and shoulder portion of candidate is to be seen clearly in the photograph </i></font><br>     
                            *<font style="color: red"><i>Photo wearing cap and dark glass will be rejected.</i> </font><br>
                            *<font style="color: red"><i>The image type must be jpg or jpeg format</i></font><br>
                            *<font style="color: red"><i>max size of photograph should be 50kb and min size is 20kb </i></font><br>

                            *<font style="color: red"><i>After choosing file, click on <b>Upload button</b></i> </font>
</label>
</div>
 </div>

<div class="form-group row">
<label class="col-md-3 control-label">Upload Your Photo:</label>
<div class="col-md-4">
  <input type="hidden" name="pgapp_photo" id="pgapp_photo">   
  <input type="file" name="pgapp_photo" id="pgapp_photo" accept="image/*" onchange="showPreviewphoto(event);">
 <input type="submit" value="Upload" class="btn btn-sm btn-info upload-image12"  id="upload" name="upload"> 
</div>

<div class="preview col-md-4">
        <img id="file-ip-1-preview" width="130px;" height="160px;">
 </div>
<input type="hidden" name="img_hidden" id="img_hidden" value="{{Auth::user()->pgapp_photo}}">
 <div id='loader' class="overlay" style='display: none;'>
                                     <i class="fa fa-refresh fa-spin"></i>
                                </div>
 
 </div>

<div class="form-group row">

<div class="col-md-3">
<button type="submit" style="display: none" name="btn_imageupload" id="btn_imageupload" class="btn btn-success">save</button>
</div>
 </div>
    @foreach($pgapp as $key)
 @if($key->pgapp_photo)
        <div class="form-group row">

                <img src="{{ URL::asset('images/pgphoto/'.$key->pgapp_photo)}}" width="130" height="160">
        </div>
      
 @endif
@endforeach 
 </form>     
 