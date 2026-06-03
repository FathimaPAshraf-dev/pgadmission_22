<form class="form-horizontal" name="formcampus" id="formcampus"  method="post" >
             {{csrf_field()}}
             
             <input type="hidden" value="{{$flags}}" name="flags" id="flags">     
            <div class="card-body">
                
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                   @if(Auth::user()->pgapp_adsc_sl=975 || Auth::user()->pgapp_adsc_sl=976 || Auth::user()->pgapp_adsc_sl=977 || Auth::user()->pgapp_adsc_sl=970)     
                   <!--<label>സർവകലാശാലയുടെ പയ്യന്നൂർ പ്രാദേശിക കേന്ദ്രത്തിൽ 2023-24 അക്കാദമിക വർഷം മുതൽ പിജി മലയാളം പ്രോഗ്രാം (20 സീറ്റ്) ആരംഭിക്കുവാൻ  തീരുമാനിച്ചിരിക്കുന്ന സാഹചര്യത്തിൽ  സെൻറർ ഓപ്ഷൻ നൽകി മൂന്ന് അലോട്മെൻ്റി ലൂടെ അഡ്മിഷൻ നേടിയ വിദ്യാർത്ഥികൾക്കും നാളിതുവരെ ഓപ്ഷൻ നൽകാൻ സാധിക്കാത്ത വിദ്യാർത്ഥികൾക്കും മേൽ സൂചിപ്പിച്ച ക്യാമ്പസ് കൂടി ഉൾപെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ തീരുമാനിച്ചിരിക്കുന്നു. റീ ഓപ്ഷൻ നൽകാൻ താല്പര്യമുള്ള വിദ്യാർത്ഥികൾ മാത്രം 10.07. 2023 മുതൽ 12.07.2023 വരെയുള്ള തീയതികുള്ളിൽ ഈ അവസരം ഉപയോഗപ്പെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ അറിയിക്കുന്നു.</label>-->
                   <!--<label>സർവകലാശാലയുടെ പ്രാദേശിക കേന്ദ്രത്തിൽ അക്കാദമിക് പുന: സംഘടനത്തിന്റെ ഭാഗമായി നിർത്തലാക്കിയ ചില പി ജി പ്രോഗ്രാമുകൾ (കൊയിലാണ്ടി - സംസ്‌കൃതം വേദാന്ത (10 സീറ്റ് ),തിരൂർ - ഇംഗ്ലീഷ് (20 സീറ്റ് ), പൻമന- ഹിന്ദി(20സീറ്റ് ),തിരുവനന്തപുരം - മലയാളം (20 സീറ്റ് ))2023-24 അക്കാദമിക വർഷം തന്നെ പുന : സ്ഥാപിക്കാൻ സിൻഡിക്കേറ്റ് തീരുമാനിച്ച സാഹചര്യത്തിൽ  സെൻറർ ഓപ്ഷൻ നൽകി അഞ്ച് അലോട്മെൻ്റി ലൂടെ അഡ്മിഷൻ നേടിയ വിദ്യാർത്ഥികൾക്കും നാളിതുവരെ ഓപ്ഷൻ നൽകാൻ സാധിക്കാത്ത വിദ്യാർത്ഥികൾക്കും മേൽ സൂചിപ്പിച്ച ക്യാമ്പസ് കൂടി ഉൾപെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ തീരുമാനിച്ചിരിക്കുന്നു. റീ ഓപ്ഷൻ നൽകാൻ താല്പര്യമുള്ള വിദ്യാർത്ഥികൾ മാത്രം 11.08. 2023 മുതൽ 16.08.2023 വരെയുള്ള തീയതികുള്ളിൽ ഈ അവസരം ഉപയോഗപ്പെടുത്തി റീ ഓപ്ഷൻ നൽകുവാൻ അറിയിക്കുന്നു. 2023 ഓഗസ്റ്റ്‌ 20 ന് അലോട്മെന്റ് പ്രക്രിയ നടത്തി ഓഗസ്റ്റ്‌ 23,24 തീയതികളിലായി പ്രവേശന നടപടി പൂർത്തിയാക്കുന്നതാണ്.</label>--> 
                   
                   @else
                   <!--<label for="exampleInputEmail1">2023 പി ജി എൻട്രൻസ് റാങ്ക് ലിസ്റ്റ് പ്രകാരം യോഗ്യതയുള്ള എല്ലാ അപേക്ഷകരും അറ്റാച്ച് ചെയ്ത പട്ടിക പ്രകാരം പ്രോഗ്രാം ഓഫർ ചെയ്യുന്ന ക്യാമ്പസ്സുകളുടെ പേര് 28.05.2023 ഉച്ചയ്ക്ക് ശേഷം 3   മുതൽ 31.05 2023 ഉച്ചയ്ക്ക് ശേഷം 5 മണിവരെ സമയ പരിധിക്കുള്ളിൽ തിരഞ്ഞെടുക്കാൻ  അഭ്യർത്ഥിക്കുന്നു. ഒന്നിലധികം സെന്ററുകൾ പ്രോഗ്രാം ഓഫർ ചെയ്യുന്ന സാഹചര്യത്തിൽ, അപേക്ഷകർക്ക് അവരുടെ ഇഷ്ടത്തിനനുസരിച്ച പരമാവധി ക്യാമ്പസ്സും തിരഞ്ഞെടുത്ത് ചേരാവന്നതാണ്.അലോട്ട്‌മെന്റ് മെമ്മോ ലഭിച്ചതിന് ശേഷം ഓരോരുത്തർക്കും മെമ്മോ പ്രകാരം പ്രവേശനം ലഭിക്കുന്ന ക്യാമ്പസ്സിലെ പ്രോഗ്രാമിൽ ചേർന്നില്ലെങ്കിൽ മറ്റ് ക്യാമ്പസ്സുകളിലേക്കുള്ള പ്രവേശനത്തിനുള്ള അവകാശം സ്വയമേവ ഇല്ലാതാകും. എന്നിരുന്നാൽ ഉയർന്ന ഓപ്ഷൻ തേടുന്ന അപേക്ഷകർക്ക് താഴ്ന്ന ഓപ്ഷനിൽ പ്രവേശിച്ചതിന് ശേഷം ഒഴിവ് വരുന്ന മുറയ്ക്ക്  ഓപ്ഷൻ പ്രകാരമുള്ള മാറ്റം അനുവദിക്കുന്നതാണ് .</label>-->
                  
                   @endif
                    </div> 
                    </div> 
                   
                   </div>
                
            @php  
                $opt1=0;
                $opt2=0;
                $opt3=0;
                $opt4=0;
                $opt5=0;
                $opt6=0;
            @endphp
            
            @if($pgpgm_flag1== '1') 
            @foreach($pgpgm_count1 as $key)
             @php 
              $opt1=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag2== '1') 
            @foreach($pgpgm_count2 as $key)
             @php 
              $opt2=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag3== '1') 
            @foreach($pgpgm_count3 as $key)
             @php 
              $opt3=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag4== '1') 
            @foreach($pgpgm_count4 as $key)
             @php 
              $opt4=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag5== '1') 
            @foreach($pgpgm_count5 as $key)
             @php 
              $opt5=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            @if($pgpgm_flag6== '1') 
            @foreach($pgpgm_count6 as $key)
             @php 
              $opt6=$key->pgpgm_centre_sl;
              $cent1=$key->cent;
             @endphp
            @endforeach
            @endif
            
            
                
        
        @if($flags==6)         
         <div class="row">
            <div class="row">
              <div class="col-lg-6"> 
                <div class="form-group"> 
                    <label class="control-label" >Study Campus I <font color="red">*</font></label>
                    <!-- <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                    onchange="centropt1()" > -->

                            <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            onchange="centropt1()" >
                        <option value="" selected disabled >
                             Select Centre I
                             </option>
                             
                          @foreach($centre_options as $cent)
                          
                           @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach     
                    </select>   
                     @if ($errors->has('center_sl1'))
                    <p style="color: red">
                                {{ $errors->first('center_sl1') }}
                    </p>
                @endif
                </div>
                 </div>
                <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                          
                            <option value="" selected disabled >
                             Select Centre II
                             </option>
                          @foreach($centre_options as $cent)
                          
                           @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach   

                    </select>
                       @if ($errors->has('center_sl2'))
                    <p style="color: red">
                                {{ $errors->first('center_sl2') }}
                    </p>
                @endif
                </div>
                </div>
                 <div class="col-lg-6"  id="cdiv3" id="cdiv3">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv4" id="cdiv4">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus IV <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}" id="center_sl4" name="center_sl4" required="" >
                        <option value="" selected disabled >
                             Select Centre IV
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt4==$cent->centre_sl)  
                            <option selected="" value="{{$opt4}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl4'))
                    <p style="color: red">
                                {{ $errors->first('center_sl4') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv5" id="cdiv5">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus V <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}" id="center_sl5" name="center_sl5" required="" >
                        <option value="" selected disabled >
                             Select Centre V
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt5==$cent->centre_sl)  
                            <option selected="" value="{{$opt5}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl5'))
                    <p style="color: red">
                                {{ $errors->first('center_sl5') }}
                    </p>
                    @endif
                </div>
                </div>
                
               <div class="col-lg-6"  id="cdiv6" id="cdiv6">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus VI <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}" id="center_sl6" name="center_sl6" required="" >
                        <option value="" selected disabled >
                             Select Centre VI
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt6==$cent->centre_sl)  
                            <option selected="" value="{{$opt6}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl6'))
                    <p style="color: red">
                                {{ $errors->first('center_sl6') }}
                    </p>
                    @endif
                </div>
                </div> 
             
         </div>
             
         </div>         
        
        @elseif($flags==5)         
         <div class="row">
              <div class="col-lg-6"> 
                <div class="form-group"> 
                    <label class="control-label" >Study Campus I <font color="red">*</font></label>
                    <!-- <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                             > -->

                            <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            onchange="centropt1()" >
                        <option value="" selected disabled >
                             Select Centre I
                             </option>
                             
                          @foreach($centre_options as $cent)
                          
                           @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach     
                    </select>   
                     @if ($errors->has('center_sl1'))
                    <p style="color: red">
                                {{ $errors->first('center_sl1') }}
                    </p>
                @endif
                </div>
                 </div>
                <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                          
                            <option value="" selected disabled >
                             Select Centre II
                             </option>
                          @foreach($centre_options as $cent)
                          
                           @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach   

                    </select>
                       @if ($errors->has('center_sl2'))
                    <p style="color: red">
                                {{ $errors->first('center_sl2') }}
                    </p>
                @endif
                </div>
                </div>
                 <div class="col-lg-6"  id="cdiv3" id="cdiv3">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv4" id="cdiv4">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus IV <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}" id="center_sl4" name="center_sl4" required="" >
                        <option value="" selected disabled >
                             Select Centre IV
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt4==$cent->centre_sl)  
                            <option selected="" value="{{$opt4}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl4'))
                    <p style="color: red">
                                {{ $errors->first('center_sl4') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv5" id="cdiv5">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus V <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}" id="center_sl5" name="center_sl5" required="" >
                        <option value="" selected disabled >
                             Select Centre V
                        </option>
                        @foreach($centre_options as $cent)
                          
                           @if($opt5==$cent->centre_sl)  
                            <option selected="" value="{{$opt5}}">{{$cent->centre_name}}</option> 
                           @else  
                            <option value="{{$cent->centre_sl }}"   > {{$cent->centre_name }}</option>
                          @endif  
                           @endforeach 
                    </select>
                    @if ($errors->has('center_sl5'))
                    <p style="color: red">
                                {{ $errors->first('center_sl5') }}
                    </p>
                    @endif
                </div>
                </div>
             
         </div>
        
        
        @elseif($flags==4)         
         <div class="row">
              <div class="col-lg-6"> 
                <div class="form-group"> 
                    <label class="control-label" >Study Campus I <font color="red">*</font></label>
                    <!-- <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                           > -->

                            <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            onchange="centropt1()" >
                        <option value="" selected disabled >
                             Select Centre I
                             </option>
                          @foreach($centre_options as $cent)
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach     
                    </select>   
                     @if ($errors->has('center_sl1'))
                    <p style="color: red">
                                {{ $errors->first('center_sl1') }}
                    </p>
                @endif
                </div>
                 </div>
                <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                        <option value="" selected disabled >
                             Select Centre II
                             </option>
                              @foreach($centre_options as $cent)
                          @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach   
                    </select>
                       @if ($errors->has('center_sl2'))
                    <p style="color: red">
                                {{ $errors->first('center_sl2') }}
                    </p>
                @endif
                </div>
                </div>
                 <div class="col-lg-6"  id="cdiv3" id="cdiv3">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                         @foreach($centre_options as $cent)
                          @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach   
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
             <div class="col-lg-6"  id="cdiv4" id="cdiv4">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus IV <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}" id="center_sl4" name="center_sl4" required="" >
                        <option value="" selected disabled >
                             Select Centre IV
                        </option>
                         @foreach($centre_options as $cent)
                          @if($opt4==$cent->centre_sl)  
                            <option selected="" value="{{$opt4}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach   
                    </select>
                    @if ($errors->has('center_sl4'))
                    <p style="color: red">
                                {{ $errors->first('center_sl4') }}
                    </p>
                    @endif
                </div>
                </div>
         </div>            
        @elseif($flags==3)         
            <div class="row">
                <div class="col-lg-6"> 
                <div class="form-group"> 
                    <label class="control-label" >Study Campus I <font color="red">*</font></label>
                    <!-- <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            > -->

                            <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            onchange="centropt1()" >
                        <option value="" selected disabled >
                             Select Centre I
                             </option>
                         @foreach($centre_options as $cent)
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach     
                    </select>   
                     @if ($errors->has('center_sl1'))
                    <p style="color: red">
                                {{ $errors->first('center_sl1') }}
                    </p>
                @endif
                </div>
                 </div>
                <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" 
                               >
                        <option value="" selected disabled >
                             Select Centre II
                             </option>
                             @foreach($centre_options as $cent)
                          @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach 
                    </select>
                       @if ($errors->has('center_sl2'))
                    <p style="color: red">
                                {{ $errors->first('center_sl2') }}
                    </p>
                @endif
                </div>
                </div>
                 <div class="col-lg-6"  id="cdiv3" id="cdiv3">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus III <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}" id="center_sl3" name="center_sl3" required="" >
                        <option value="" selected disabled >
                             Select Centre III
                        </option>
                        @foreach($centre_options as $cent)
                          @if($opt3==$cent->centre_sl)  
                            <option selected="" value="{{$opt3}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach 
                    </select>
                    @if ($errors->has('center_sl3'))
                    <p style="color: red">
                                {{ $errors->first('center_sl3') }}
                    </p>
                    @endif
                </div>
                </div>
      </div>                  
        @elseif($flags==2)         
            <div class="row">
                <div class="col-lg-6"> 
                <div class="form-group"> 
                    <label class="control-label" >Study Campus I <font color="red">*</font></label>
                    <!-- <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            > -->

                            <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                            onchange="centropt1()" >
                        <option value="" selected disabled >
                             Select Centre I
                             </option>
                          @foreach($centre_options as $cent)
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach     
                    </select>   
                     @if ($errors->has('center_sl1'))
                    <p style="color: red">
                                {{ $errors->first('center_sl1') }}
                    </p>
                @endif
                </div>
                 </div>
                <div class="col-lg-6"  id="cdiv2" id="cdiv2">
                  <div class="form-group"> 
                      <label class="control-label ">Study Campus II <font color="red">*</font></label>
                      <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}" id="center_sl2" name="center_sl2" required="" >
                        <option value="" selected disabled >
                             Select Centre II
                             </option>
                             @foreach($centre_options as $cent)
                          @if($opt2==$cent->centre_sl)  
                            <option selected="" value="{{$opt2}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach 
                    </select>
                       @if ($errors->has('center_sl2'))
                    <p style="color: red">
                                {{ $errors->first('center_sl2') }}
                    </p>
                @endif
                </div>
                </div>
              </div>
        
        @else
        <div class="row">
                    <div class="col-lg-6"> 
                    <div class="form-group"> 
                        <label class="control-label" >Study Campus I <font color="red">*</font></label>
                        <!-- <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                                > -->

                                <select class="form-control form-control-sm select2 col-md-8 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"  id="center_sl1" name="center_sl1" required=""
                                onchange="centropt1()" >
                            <option value="" selected disabled >
                                 Select Centre I
                                 </option>
                             @foreach($centre_options as $cent)
                          @if($opt1==$cent->centre_sl)  
                            <option selected="" value="{{$opt1}}">{{$cent->centre_name}}</option> 
                           @else 
                            <option value="{{$cent->centre_sl }}"   >

                               {{$cent->centre_name }}
                             </option>
                             @endif
                                @endforeach     
                        </select>   
                         @if ($errors->has('center_sl1'))
                        <p style="color: red">
                                    {{ $errors->first('center_sl1') }}
                        </p>
                    @endif
                    </div>
                     </div>
             </div>
        
            
          @endif
          <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 15px;"><b><u>Declaration</u> </b></p>   
          <p style="text-align: left;  font-family: arial, sans-serif; color: black; font-size: 13px;"><b>The Allotment of Campus will be based on the position of the candidate in the ranklist, availability of seats (should be within the sanctioned strength 
                  approved by the University) and the option exercised by the candidate.
           The university reserves the right to direct any student to transfer from one Campus to another Campus in case there is a shortfall in the number of 
           students at any of the Campus.</b></p>   
        <div class="row">   
        <label class="control-label col-md-12" style="color: red"> I accept the above declarations <input type="checkbox" name="option_declaration" id="option_declaration">
        </label>
        </div>
        </div>
        <div id='loader' class="overlay" style='display: none;'>
             <i class="fa fa-refresh fa-spin"></i>
          </div>
<!--        @if($option_stat==1)   
        <div class="card-footer" >   
        <a href="printoption" target="_blank" class="btn btn-flat btn-sm btn-danger float-right">
                        Print <i class="fa fa-download"></i></a>
       </div>                
        @else     
          <div class="card-footer" id="printoption" name="printoption">   
           
            <input type="submit" class="btn btn-info float-right" id="submitButton" value="Submit">
        </div>
        @endif-->
        <div class="card-footer" id="" name="">   

        <!-- <button type="submit" style="display: none" name="btn_option_ref1" id="btn_option_ref1" class="btn btn-success">save</button> -->

            <!-- <input type="submit" class="btn btn-info float-right" id="submitButton" value="Submit">
            <a class="btn btn-danger float-left" href="/pay_details">Cancel</a> -->


        </div>
       
        <button type="submit" style="display: none" id="btn_campus" name="btn_campus" class="btn btn-success">Save</button>  
        </form>