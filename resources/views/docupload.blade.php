<form method="post" name="documentsupload" id="documentsupload">

<input type="hidden" id="directory_docs" value="{{ Auth::user()->directory_docs }}">
<input type="hidden" id="reservation_claim_status" value="{{ Auth::user()->reservation_claim_status }}">

@if(Auth::user()->reservation_claim_status==1)




<div class="form-group row">
        <label class="control-label col-md-4"> Upload
            Caste certificate or/and Non Creamy Layer Certificate(for OBC candidates) in a single pdf file. ) <b
                style="color: red">Helping tool for converting multiple images to pdf file<a
                    href="https://smallpdf.com/jpg-to-pdf" target="_blank"> Click Here</a></b></label>
        <div class="col-md-8">
            <input type="file" class="form-control form-control-sm col-md-8" id="doc" name="doc"
                onchange="return fileValidation()">
            <input type="hidden" class="form-control form-control-sm col-md-8" id="docuploaded" name="docuploaded"
                value="{{Auth::user()->directory_docs}}">

            <label for="inputEmail3" class="col-sm-10">

                *<font style="color: green"><b>The file type must be pdf</b></font><br>
                *<font style="color: green"><b>File size should be less than 1 MB</b></font><br>
                
                @if(Auth::user()->directory_docs!="")
                <a href="{{ asset('storage/' . Auth::user()->directory_docs) }}" target="_blank"
                    class="btn btn-xs btn-danger">
                    View file
                </a>

                @endif
            </label>


        </div>
    </div>

    @endif


    <input type="hidden" id="existing_sslc" value="{{ $fileUrl ?? '' }}">
    <input type="hidden" id="existing_hse" value="{{ $fileUrlhse ?? '' }}">
    <input type="hidden" id="existing_aadhar" value="{{ $fileUrlaadhar ?? '' }}">
    



    <div class="form-group row">
        <label class="control-label col-md-4">Upload Aadhar Card: </label>
        <div class="col-md-8">
            <input type="file" name="pdf_file_aadhar" id="pdf_file_aadhar" class="form-control form-control-sm col-md-8" onchange="return fileValidationAadhar()" />
            <span id="error_pdf_file" class="text-danger"></span>
        </div>
    
    @if($fileUrlaadhar)
    <a href="{{ $fileUrlaadhar }}" class="btn btn-primary" target="_blank">View Uploaded Certificate</a>
    @endif

    </div>


    <div class="form-group row">
        <label class="control-label col-md-4">Upload 10th Certificate: </label>
        <div class="col-md-8">
            <input type="file" name="pdf_file_sslc" id="pdf_file_sslc" class="form-control form-control-sm col-md-8" onchange="return fileValidationSSLC()" />
            <span id="error_pdf_file" class="text-danger"></span>
        </div>
    
    @if($fileUrl)
    <a href="{{ $fileUrl }}" class="btn btn-primary" target="_blank">View Uploaded Certificate</a>
    @endif

    </div>

    <div class="form-group row">
        <label class="control-label col-md-4">Upload Degree Certificate: (Please upload scanned copy of
            certificate or/and grade card in a single pdf file. ) <b
                style="color: red">Helping tool for converting multiple images to pdf file<a
                    href="https://smallpdf.com/jpg-to-pdf" target="_blank"> Click Here</a></b> </label>
        <div class="col-md-8">
            <input type="file" name="pdf_file_hse" id="pdf_file_hse" class="form-control form-control-sm col-md-8" onchange="return fileValidationHSE()"/>
            <span id="error_pdf_file_hse" class="text-danger"></span>
        </div>
   
    @if($fileUrlhse)
    <a href="{{ $fileUrlhse }}" class="btn btn-primary" target="_blank">View Certificate</a>
    @endif

    </div>

    <input type="hidden" id="special_reserv" value="{{ $pgapp_wh_special_reserv ?? 0 }}">

    <input type="hidden" id="existing_special" value="{{ $fileUrlSpecial ?? '' }}">
    @if($pgapp_wh_special_reserv==1)
    
    <div class="form-group row">
            <label class="control-label col-md-4">Upload Certificates:
                (Please upload a scanned copy of special reservation certificates in a single PDF file.)
                <b style="color: red">Helping tool for converting multiple images to PDF:
                    <a href="https://smallpdf.com/jpg-to-pdf" target="_blank">Click Here</a></b>
            </label>
            <div class="col-md-8">
                <input type="file" name="pdf_file_special" id="pdf_file_special"
                    class="form-control form-control-sm col-md-8" onchange="return fileValidationSpecial()" />
                <span id="error_pdf_file" class="text-danger"></span>
                @if($fileUrlSpecial)
                <a href="{{ $fileUrlSpecial }}" class="btn btn-primary" target="_blank">View Uploaded Certificate</a>
                @endif
            </div>
        </div>
        @endif

        <button type="submit" style="display: none" id="documentsupload_save" name="documentsupload_save"
        class="btn btn-success">Save</button>

 
</form>