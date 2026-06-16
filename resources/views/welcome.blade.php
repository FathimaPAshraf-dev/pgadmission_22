@extends('layouts.app')


@section('content') 
<style>
.blink_text
{
    animation:1s blinker linear infinite;
    -webkit-animation:1s blinker linear infinite;
    -moz-animation:1s blinker linear infinite;
    color: #6b174e;
    font-size: 15px;
}

@-moz-keyframes blinker
{  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker
{  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker
{  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
 }

 </style>
<br>

    <div class="content">
      <div class="container">
       
<!--<marquee><font style="color: red ;font-size: 20px;">Last date for the submission of application for PG Diploma in Translation and office proceedings in Hindi is extended upto 17.07.23 and the date of entrance examination for the same is postponed to 20.07.23.-->
</marquee>
 
        <div class="row">
          <div class="col-lg-6">
             
            <div class="card card-info card-outline"> 
                
              <div class="card-body">
                  <h4 style="color: #6b174e"><b>ADMISSION TO MA/M Sc/MSW/MPES/MFA/DUAL MAIN MASTERS IN DISASTER MANAGEMENT/

P.G. DIPLOMA PROGRAMMES 2026 - 27 </b><br>   
                      <!--<img src="{{asset('/images/apply.jpg')}}">-->
                  </h4>
                 
                  <p>
                 <span class="blink_text "><b>Please read the instructions and notification carefully before going to apply / അപേക്ഷിക്കുന്നതിന് മുമ്പ് നിർദ്ദേശങ്ങൾ ശ്രദ്ധാപൂർവ്വം വായിക്കുക </b></span>  
                 <button type="button" class="btn btn-flat btn-xs btn-info" data-toggle="modal" data-target="#tallModal">
                Instructions <i class="fa fa-info-circle"></i>
                  </button></p>
                 
<!--                 <span style="color: red">The candidate who claims reservation under various category doesn't posses the relevant certificate while uploading shall submit a self declaration to the effect that the same shall be submitted at the time of admission.

 <br>  The candidature under reservation category will be forfeited the original documents are not submitted at the time of admission.</span><br>
 -->
   <span style="color: red">Candidates who wish to claim reservation under various categories but do not possess the relevant certificates at the time of application shall submit a self-declaration stating that the required certificates will be produced at the time of admission.
 <br>  The candidature under the reservation category will be forfeited if the original documents are not submitted at the time of admission.

</span><br>
                 
                 
    
   
    
<!--    <a href="https://ssus.ac.in/admission/pg-admission/pg-ranklist
" target="_blank" class="btn btn-flat btn-xs btn-danger">
    PG Entrance Examination 2025 Rank List <i class="fa fa-info-circle"></i></a><br><br> -->

<!--<a href="https://ssus.ac.in/files/300/PG-ADMISSION-2025/3096/PG-ENTRANCE-EXAMINATION-2025--TIME-TABLE.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
    PG Entrance Schedule 2025 <i class="fa fa-info-circle"></i></a><br><br>-->

                 <a href="https://ssus.ac.in/files/310/PG-Admission-2026/3945/PG-Notification-2026.pdf" target="_blank" class="btn btn-flat btn-xs btn-danger">
                         PG Notification  <i class="fa fa-info-circle"></i>
                 </a>
                <a href="https://ssus.ac.in/files/310/PG-Admission-2026/3946/PG-Prospectus-2026.pdf" target="_blank" class="btn btn-flat btn-xs btn-danger">
                       PG Prospectus  <i class="fa fa-info-circle"></i></a>

<!-- <a href="https://ssus.ac.in/files/283/PG-ADMISSION-2024/2480/MSW-Instructions-2024.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
    MSW Instructions 2024  <i class="fa fa-info-circle"></i></a><br><br> -->
    
    
    <!-- <a href="https://ssus.ac.in/files/283/PG-ADMISSION-2024/2507/PG-Entrance-Time-Table--2024---REVISED.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
    PG Entrance Examination 2024 Revised Time Table <i class="fa fa-info-circle"></i></a><br> -->
    
   
<!--<a href="https://ssus.ac.in/files/283/PG-ADMISSION-2024/2488/PG-Entrance-Schedule-2024.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
                       PG Entrance Schedule 2024  <i class="fa fa-info-circle"></i></a>-->
    
<!--     <a href="https://ssus.ac.in/files/158/EXAM-TIMETABLE/2499/Time-Table---PG-Entrance-2024.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
                       PG ENTRANCE EXAMINATION TIMETABLE 2024  <i class="fa fa-info-circle"></i></a>-->

                  
<!--                <a href="#" target="_blank" class="btn btn-flat btn-xs btn-info">
                          Admission to PG/PG Diploma Programmes under Project Mode Scheme 2023-24  <i class="fa fa-info-circle"></i></a> -->
                 
<!-- <a href="https://ssus.ac.in/files/265/Project-Mode-Scheme-2023/1964/Project-Mode-Notification-PG-PG-DIPLOMA.pdf" target="_blank" class="btn btn-flat btn-xs btn-info">
                         PG/PG Diploma Programmes under Project Mode Scheme 2023-24 Notification  <i class="fa fa-info-circle"></i></a>          -->

<!--<p><a href="https://ssus.ac.in/files/264/PG-Admission-2023/2070/PG-SC-ST-R-ENOTIFICATION.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
                        PG-SC-ST-RE-NOTIFICATION  <i class="fa fa-info-circle"></i></a> 
</p>-->

<!--<p><a href="https://ssus.ac.in/files/265/Project-Mode-Scheme-2023/2067/PG-Diploma-in-Sanskrit-computational-Linguistics-Re-Notification.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
                        P.G.Diploma in Sanskrit Computational Linguistics 2023 Admission Re-notification  <i class="fa fa-info-circle"></i></a> 
</p>
<p>
<a href="https://ssus.ac.in/files/264/PG-Admission-2023/2068/PG-Diploma-in-Translation-and-Office-Proceedings-in-Hindi---Notification.pdf
" target="_blank" class="btn btn-flat btn-xs btn-danger">
                        P.G.Diploma in Translation and office proceedings in Hindi 2023 Admission <i class="fa fa-info-circle"></i></a> 
</p>-->


<!--<a href="https://ssus.ac.in/files/173/Notification-New/1992/Project-Mode-NotificationRevised-2.pdf
" target="_blank" class="btn btn-flat btn-xs btn-info">
                        Revised PG/PG Diploma Programmes Project Mode Scheme 2023-24 Notification  <i class="fa fa-info-circle"></i></a>          

                 <a href="https://ssus.ac.in/files/264/PG-Admission-2023/1925/PG-NOTIFICATION-2023---24.pdf
" target="_blank" class="btn btn-flat btn-xs btn-info">
                          Notification  <i class="fa fa-info-circle"></i></a>
                <a href="https://ssus.ac.in/files/264/PG-Admission-2023/1928/PG-Prospectus-2023---24.pdf" target="_blank" class="btn btn-flat btn-xs btn-info">
                          Prospectus  <i class="fa fa-info-circle"></i></a>
                <a href="https://ssus.ac.in/files/264/PG-Admission-2023/1953/Time-Table---PG-Entrance-Examination-2023.pdf" target="_blank" class="btn btn-flat btn-xs btn-info">
                          Revised Time Table  <i class="fa fa-info-circle"></i></a>     
                <a href="https://ssus.ac.in/files/264/PG-Admission-2023/2030/PROGRAMME--CAMPUS-WISE-LIST.pdf"
                           class="btn btn-sm btn-secondary" target="_blank">PROGRAMME – CAMPUS WISE LIST  <i class="fa fa-info-circle"></i> </a>          -->
                <!--
-->                     <div class="form-group row">
                             
                               <p class="card-text">
                              <ul>
                                  <li style="font-size: 14px">Applicants are requested to complete the Part One registration by clicking the<b> Register Now</b> link / രജിസ്റ്റർ നൗ എന്ന ലിങ്കിൽ ക്ലിക്ക് ചെയ്ത് പാർട്ട് വൺ രജിസ്ട്രേഷൻ പൂർത്തിയാക്കാൻ അപേക്ഷകരോട് അഭ്യർത്ഥിക്കുന്നു</li>
                                  <li style="font-size: 14px">Please use your own/parents/guardian's mobile number.
                                Vital informations regarding admissions are being communicated through SMS or call to the registered
                                mobile number. Therefore, under any circumstances the mobile number of Akshaya centres,
                                <!--internet cafe or other agencies should not be submitted. / നിങ്ങളുടെ സ്വന്തം/മാതാപിതാക്കളുടെ/രക്ഷിതാവിന്റെ മൊബൈൽ നമ്പർ ഉപയോഗിക്കുക. അഡ്മിഷൻ സംബന്ധിച്ച സുപ്രധാന വിവരങ്ങൾ എസ്എംഎസ് മുഖേനയോ അല്ലെങ്കിൽ രജിസ്റ്റർ ചെയ്ത മൊബൈൽ നമ്പറിലേക്ക് വിളിച്ചോ അറിയിക്കുന്നു. അതിനാൽ ഒരു കാരണവശാലും അക്ഷയ കേന്ദ്രങ്ങളുടെയോ ഇന്റർനെറ്റ് കഫേയുടെയോ മറ്റ് ഏജൻസികളുടെയോ മൊബൈൽ നമ്പർ സമർപ്പിക്കാൻ പാടില്ല</li>-->
                                internet cafe or other agencies should not be submitted. / നിങ്ങളുടെ സ്വന്തം/മാതാപിതാക്കളുടെ/രക്ഷിതാവിന്റെ മൊബൈൽ നമ്പർ ഉപയോഗിക്കുക. അഡ്മിഷൻ സംബന്ധിച്ച സുപ്രധാന വിവരങ്ങൾ എസ്എംഎസ് മുഖേനയോ അല്ലെങ്കിൽ രജിസ്റ്റർ ചെയ്ത മൊബൈൽ നമ്പറിലേക്ക് വിളിച്ചോ അറിയിക്കുന്നതിനാൽ ഒരു കാരണവശാലും അക്ഷയ കേന്ദ്രങ്ങളുടെയോ ഇന്റർനെറ്റ് കഫേയുടെയോ മറ്റ് ഏജൻസികളുടെയോ മൊബൈൽ നമ്പർ സമർപ്പിക്കാൻ പാടില്ല.</li>
                                <li style="font-size: 14px">Please use your own or parent's email id. Those who do not have an email Id should create one and enter. Vital informations regarding the allotment and admissions will also be communicated through email. Therefore, under any circumstances the email id of Akshaya centres, internet cafe or other agencies should not be submitted
                                 / നിങ്ങളുടെ അല്ലെങ്കിൽ മാതാപിതാക്കളുടെ ഇമെയിൽ ഐഡി ഉപയോഗിക്കുക. ഇ-മെയിൽ ഐഡി ഇല്ലാത്തവർ ഒന്ന് ഉണ്ടാക്കി നൽകണം. അലോട്ട്‌മെന്റും പ്രവേശനവും സംബന്ധിച്ച സുപ്രധാന വിവരങ്ങളും ഇമെയിൽ വഴി അറിയിക്കും. അതിനാൽ, ഒരു കാരണവശാലും അക്ഷയ കേന്ദ്രങ്ങളുടെയോ ഇന്റർനെറ്റ് കഫേയുടെയോ മറ്റ് ഏജൻസികളുടെയോ ഇമെയിൽ ഐഡി സമർപ്പിക്കാൻ പാടില്ല.</li>
                               
                                  <li style="font-size: 14px">
                                   After the Successful completion of Part One you will get an email which containing your Application Number and Password which will be the  login credentials for allotment and admission process.Please keep the mail or remember your application number and password for future use. /
                                   ഒന്നാം ഭാഗം വിജയകരമായി പൂർത്തിയാക്കിയ ശേഷം, നിങ്ങളുടെ അപേക്ഷാ നമ്പറും പാസ്‌വേഡും അടങ്ങുന്ന ഒരു ഇമെയിൽ നിങ്ങൾക്ക് ലഭിക്കും, അത് അലോട്ട്‌മെന്റിനും പ്രവേശന പ്രക്രിയയ്ക്കുമുള്ള ലോഗിൻ ക്രെഡൻഷ്യലുകളായിരിക്കും. ദയവായി മെയിൽ സൂക്ഷിക്കുക അല്ലെങ്കിൽ ഭാവിയിലെ ഉപയോഗത്തിനായി നിങ്ങളുടെ ആപ്ലിക്കേഷൻ നമ്പറും പാസ്‌വേഡും ഓർക്കുക.
                                  </li>
                                <li style="font-size: 14px">You can login with your Application number and password to complete the Part Two. / ഭാഗം രണ്ട് പൂർത്തിയാക്കാൻ നിങ്ങൾക്ക് നിങ്ങളുടെ ആപ്ലിക്കേഷൻ നമ്പറും പാസ്‌വേഡും ഉപയോഗിച്ച് ലോഗിൻ ചെയ്യാം.</li>
                                <li style="font-size: 14px">
                                Admission will be canceled immediately if, at any stage before or after enrollment, it is found that the student is not an Indian citizen. Legal action may also be taken as per applicable regulations. /
                                പ്രവേശനത്തിനുശേഷമോ അതിനു മുൻപോ ഏതെങ്കിലും ഘട്ടത്തിൽ വിദ്യാർത്ഥി ഇന്ത്യൻ പൗരനല്ല എന്ന് കണ്ടെത്തിയാൽ, പ്രവേശനം ഉടനടി റദ്ദാക്കപ്പെടും. നിലവിലുള്ള നിയമങ്ങൾക്കനുസൃതമായി നിയമനടപടികളും സ്വീകരിക്കപ്പെടാം. 
                                </li>
                                <li style="font-size: 14px">
                                  You should upload your photo and signature.The image must be jpg or jpeg format. /
                                  നിങ്ങളുടെ ഫോട്ടോയും ഒപ്പും അപ്‌ലോഡ് ചെയ്യണം.ചിത്രം jpg അല്ലെങ്കിൽ jpeg ഫോർമാറ്റ് ആയിരിക്കണം. 
                                </li>
                                <li style="font-size: 14px">Maximum size of photograph is 50kb and minimum size is 20kb / ഫോട്ടോയുടെ പരമാവധി വലുപ്പം 50kb ഉം കുറഞ്ഞ വലുപ്പം 20kb ഉം ആണ്</li>
                                <li style="font-size: 14px">Maximum size of signature is 30kb and minimum size is 10kb / ഒപ്പിന്റെ പരമാവധി വലുപ്പം 30kb ഉം കുറഞ്ഞ വലുപ്പം 10kb ഉം ആണ്</li>
                                <li style="font-size: 14px">Applications are considered valid only after the successful payment of the fee in Part two of the application / അപേക്ഷയുടെ രണ്ടാം ഭാഗത്തിൽ ഫീസ് അടച്ചതിന് ശേഷം മാത്രമേ അപേക്ഷ സാധുവായി കണക്കാക്കൂ </li>
            <!--                    <li>Application fee Rs:150 required for doing online payment.</li>-->
                                <li style="font-size: 14px">For any issues related to online registration please write to us <b>helpdesk@ssus.ac.in</b> / ഓൺലൈൻ രജിസ്ട്രേഷനുമായി ബന്ധപ്പെട്ട എന്തെങ്കിലും പ്രശ്നങ്ങൾക്ക് helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ എഴുതുക</li>
                                
                            </ul>
                            </p>
                           
                            </div> 
              </div>
            
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-1"></div>
          <div class="col-lg-5">
           @include('auth.login')
            <div class="card-header ">
               <h5 class="card-title m-0 "><b>IMPORTANT DATES</b></h5>
           </div>
           <div class="card card-info card-outline"> 
               <div class="card-body">
                 <p><strong>LAST DATE FOR ONLINE APPLICATION :</strong> 30.04.2026</p>

<p><strong>DOWNLOADING OF HALL TICKET :</strong> 15-05-2026</p>

<p style="margin-bottom: 0;">
    <strong>DATE OF ENTRANCE EXAMINATION :</strong>
</p>

<p style="margin-left: 220px; margin-top: -20px; line-height: 1.8;">
    25-05-2026<br>
    26-05-2026<br>
    29-05-2026<br>
    30-05-2026
</p>

<p><strong>LAST DATE FOR UPLOADING MARKS :</strong> 03-06-2026</p>

<p><strong>PUBLICATION OF RANK LIST :</strong> 10-06-2026</p>

<p><strong>TRIAL ALLOTMENT :</strong> 13-06-2026</p>

<p><strong>CENTRE OPTION EDIT LAST DATE :</strong> 13-06-2026 to 16-06-2026</p>

<p><strong>FIRST ALLOTMENT :</strong> 19-06-2026</p>

<p><strong>ADMISSION :</strong> 22-06-2026 to 23-06-2026</p>

<p><strong>COMMENCEMENT OF CLASSES :</strong> 29-06-2026</p>
<p class="text-center mt-3">

    <a href="/storage/timetable2026.pdf"
       target="_blank"
       style="font-size: 15px; font-weight: 600; text-decoration: none;">

        <i class="fa fa-download text-primary"></i>
        Download Entrance Exam Time Table

    </a>

</p>
                 
  <br>
 </div>
            </div>
          </div>
        
        </div>
     
      </div>
    </div>

<div class="modal fade" id="tallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content text-sm">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">INSTRUCTIONS TO APPLICANTS / അപേക്ഷകർക്കുള്ള നിർദ്ദേശങ്ങൾ</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card card-info">
                          <div class="card-body">
                           <div class="form-group row">
                               <h5 for="scholar_name" class="col-sm-12" style="color: red">Please read the instructions carefully before going to apply /
                               അപേക്ഷിക്കുന്നതിന് മുമ്പ് നിർദ്ദേശങ്ങൾ ശ്രദ്ധാപൂർവ്വം വായിക്കുക 
                               </h5>
                               <p class="card-text">
                              <ul>
                                  <li style="font-size: 17px">Applicants are requested to complete the Part One registration by clicking the<b> Register Now</b> link / രജിസ്റ്റർ നൗ എന്ന ലിങ്കിൽ ക്ലിക്ക് ചെയ്ത് പാർട്ട് വൺ രജിസ്ട്രേഷൻ പൂർത്തിയാക്കാൻ അപേക്ഷകരോട് അഭ്യർത്ഥിക്കുന്നു</li>
                                  <li style="font-size: 17px">Please use your own/parents/guardian's mobile number.
                                Vital informations regarding admissions are being communicated through SMS or call to the registered
                                mobile number. Therefore, under any circumstances the mobile number of Akshaya centres,
                                internet cafe or other agencies should not be submitted. / നിങ്ങളുടെ സ്വന്തം/മാതാപിതാക്കളുടെ/രക്ഷകന്റെ മൊബൈൽ നമ്പർ ഉപയോഗിക്കുക. അഡ്മിഷൻ സംബന്ധിച്ച സുപ്രധാന വിവരങ്ങൾ എസ്എംഎസ് മുഖേനയോ അല്ലെങ്കിൽ രജിസ്റ്റർ ചെയ്ത മൊബൈൽ നമ്പറിലേക്ക് വിളിച്ചോ അറിയിക്കുന്നു. അതിനാൽ ഒരു കാരണവശാലും അക്ഷയ കേന്ദ്രങ്ങളുടെയോ ഇന്റർനെറ്റ് കഫേയുടെയോ മറ്റ് ഏജൻസികളുടെയോ മൊബൈൽ നമ്പർ സമർപ്പിക്കാൻ പാടില്ല</li>
                                <li style="font-size: 17px">Please use your own or parent's email id. Those who do not have an email Id should create one and enter. Vital informations regarding the allotment and admissions will also be communicated through email. Therefore, under any circumstances the email id of Akshaya centres, internet cafe or other agencies should not be submitted
                                 / നിങ്ങളുടെ അല്ലെങ്കിൽ മാതാപിതാക്കളുടെ ഇമെയിൽ ഐഡി ഉപയോഗിക്കുക. ഇ-മെയിൽ ഐഡി ഇല്ലാത്തവർ ഒന്ന് ഉണ്ടാക്കി നൽകണം. അലോട്ട്‌മെന്റും പ്രവേശനവും സംബന്ധിച്ച സുപ്രധാന വിവരങ്ങളും ഇമെയിൽ വഴി അറിയിക്കും. അതിനാൽ, ഒരു കാരണവശാലും അക്ഷയ കേന്ദ്രങ്ങളുടെയോ ഇന്റർനെറ്റ് കഫേയുടെയോ മറ്റ് ഏജൻസികളുടെയോ ഇമെയിൽ ഐഡി സമർപ്പിക്കാൻ പാടില്ല.</li>
                               
                                  <li style="font-size: 17px">
                                   After the Successful completion of Part One you will get an email which containing your Application Number and Password which will be the  login credentials for allotment and admission process.Please keep the mail or remember your application number and password for future use. /
                                   ഒന്നാം ഭാഗം വിജയകരമായി പൂർത്തിയാക്കിയ ശേഷം, നിങ്ങളുടെ അപേക്ഷാ നമ്പറും പാസ്‌വേഡും അടങ്ങുന്ന ഒരു ഇമെയിൽ നിങ്ങൾക്ക് ലഭിക്കും, അത് അലോട്ട്‌മെന്റിനും പ്രവേശന പ്രക്രിയയ്ക്കുമുള്ള ലോഗിൻ ക്രെഡൻഷ്യലുകളായിരിക്കും. ദയവായി മെയിൽ സൂക്ഷിക്കുക അല്ലെങ്കിൽ ഭാവിയിലെ ഉപയോഗത്തിനായി നിങ്ങളുടെ ആപ്ലിക്കേഷൻ നമ്പറും പാസ്‌വേഡും ഓർക്കുക.
                                  </li>
                                <li style="font-size: 17px">You can login with your Application number and password to complete the Part Two. / ഭാഗം രണ്ട് പൂർത്തിയാക്കാൻ നിങ്ങൾക്ക് നിങ്ങളുടെ ആപ്ലിക്കേഷൻ നമ്പറും പാസ്‌വേഡും ഉപയോഗിച്ച് ലോഗിൻ ചെയ്യാം.</li>
                                <li style="font-size: 17px">
                                  You should upload your photo and signature.The image must be jpg or jpeg format. /
                                  നിങ്ങളുടെ ഫോട്ടോയും ഒപ്പും അപ്‌ലോഡ് ചെയ്യണം.ചിത്രം jpg അല്ലെങ്കിൽ jpeg ഫോർമാറ്റ് ആയിരിക്കണം. 
                                </li>
                                <li style="font-size: 17px">Maximum size of photograph is 50kb and minimum size is 20kb / ഫോട്ടോയുടെ പരമാവധി വലുപ്പം 50kb ഉം കുറഞ്ഞ വലുപ്പം 20kb ഉം ആണ്</li>
                                <li style="font-size: 17px">Maximum size of signature is 30kb and minimum size is 10kb / ഒപ്പിന്റെ പരമാവധി വലുപ്പം 30kb ഉം കുറഞ്ഞ വലുപ്പം 10kb ഉം ആണ്</li>
                                <li style="font-size: 17px">Application are considered valid only after the successful payment of the fee in Part two of the application / അപേക്ഷയുടെ രണ്ടാം ഭാഗത്തിൽ ഫീസ് അടച്ചതിന് ശേഷം മാത്രമേ അപേക്ഷ സാധുവായി കണക്കാക്കൂ </li>
                                <li style="font-size: 17px">For any issues related to online registration please write to us <b>helpdesk@ssus.ac.in</b> / ഓൺലൈൻ രജിസ്ട്രേഷനുമായി ബന്ധപ്പെട്ട എന്തെങ്കിലും പ്രശ്നങ്ങൾക്ക് helpdesk@ssus.ac.in എന്ന വിലാസത്തിൽ എഴുതുക</li>
                                
                            </ul>
                            </p>
                           
                            </div>
                            </div>

                          </div>
                    </div>
                     </div>
                  </div>
                </div>   
@endsection
