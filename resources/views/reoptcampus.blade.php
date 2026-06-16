<form class="form-horizontal" name="formcampus" id="formcampus" method="post">
    {{ csrf_field() }}

    <input type="hidden" value="{{ $flags }}" name="flags" id="flags">

    <div class="card-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    {{-- Instruction label can be placed here if needed --}}
                </div>
            </div>
        </div>

        @php
            $opt1 = 0; $opt2 = 0; $opt3 = 0;
            $opt4 = 0; $opt5 = 0; $opt6 = 0;
        @endphp

        @if($pgpgm_flag1 == '1')
            @foreach($pgpgm_count1 as $key)
                @php $opt1 = $key->pgpgm_centre_sl; @endphp
            @endforeach
        @endif

        @if($pgpgm_flag2 == '1')
            @foreach($pgpgm_count2 as $key)
                @php $opt2 = $key->pgpgm_centre_sl; @endphp
            @endforeach
        @endif

        @if($pgpgm_flag3 == '1')
            @foreach($pgpgm_count3 as $key)
                @php $opt3 = $key->pgpgm_centre_sl; @endphp
            @endforeach
        @endif

        @if($pgpgm_flag4 == '1')
            @foreach($pgpgm_count4 as $key)
                @php $opt4 = $key->pgpgm_centre_sl; @endphp
            @endforeach
        @endif

        @if($pgpgm_flag5 == '1')
            @foreach($pgpgm_count5 as $key)
                @php $opt5 = $key->pgpgm_centre_sl; @endphp
            @endforeach
        @endif

        @if($pgpgm_flag6 == '1')
            @foreach($pgpgm_count6 as $key)
                @php $opt6 = $key->pgpgm_centre_sl; @endphp
            @endforeach
        @endif

        {{-- ===================================================
             CAMPUS DROPDOWNS — rendered based on $flags value.
             All share the same sequential JS logic.
             Dropdowns 2–N start disabled; JS unlocks them after
             the previous one is selected.
             =================================================== --}}

        <div class="row" id="campus-dropdowns-wrapper">

            {{-- CAMPUS I — always shown, always required --}}
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">
                        Study Campus I <font color="red">*</font>
                    </label>
                    <select class="form-control form-control-sm select2 {{ $errors->has('center_sl1') ? 'is-invalid' : '' }}"
                            id="center_sl1" name="center_sl1" required>
                        <option value="" selected disabled>Select Centre I</option>
                        @foreach($centre_options as $cent)
                            <option value="{{ $cent->centre_sl }}"
                                {{ $opt1 == $cent->centre_sl ? 'selected' : '' }}>
                                {{ $cent->centre_name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('center_sl1'))
                        <p style="color:red">{{ $errors->first('center_sl1') }}</p>
                    @endif
                    <small id="error_center_sl1" class="text-danger"></small>
                </div>
            </div>

            {{-- CAMPUS II — shown when flags >= 2 --}}
            @if($flags >= 2)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Study Campus II</label>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-control form-control-sm select2 {{ $errors->has('center_sl2') ? 'is-invalid' : '' }}"
                                id="center_sl2" name="center_sl2"
                                {{ $opt2 == 0 ? 'disabled' : '' }}>
                            <option value="" selected disabled>Select Centre II</option>
                            @foreach($centre_options as $cent)
                                <option value="{{ $cent->centre_sl }}"
                                    {{ $opt2 == $cent->centre_sl ? 'selected' : '' }}>
                                    {{ $cent->centre_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button"
                                id="clear_btn_2"
                                class="btn btn-sm btn-outline-secondary campus-clear-btn"
                                onclick="clearCentreFrom(2)"
                                {{ $opt2 == 0 ? 'disabled' : '' }}
                                title="Clear Campus II and below"
                                style="white-space:nowrap; margin-left:6px;">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                    @if($errors->has('center_sl2'))
                        <p style="color:red">{{ $errors->first('center_sl2') }}</p>
                    @endif
                    <small id="error_center_sl2" class="text-danger"></small>
                </div>
            </div>
            @endif

            {{-- CAMPUS III — shown when flags >= 3 --}}
            @if($flags >= 3)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Study Campus III</label>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-control form-control-sm select2 {{ $errors->has('center_sl3') ? 'is-invalid' : '' }}"
                                id="center_sl3" name="center_sl3"
                                {{ $opt3 == 0 ? 'disabled' : '' }}>
                            <option value="" selected disabled>Select Centre III</option>
                            @foreach($centre_options as $cent)
                                <option value="{{ $cent->centre_sl }}"
                                    {{ $opt3 == $cent->centre_sl ? 'selected' : '' }}>
                                    {{ $cent->centre_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button"
                                id="clear_btn_3"
                                class="btn btn-sm btn-outline-secondary campus-clear-btn"
                                onclick="clearCentreFrom(3)"
                                {{ $opt3 == 0 ? 'disabled' : '' }}
                                title="Clear Campus III and below"
                                style="white-space:nowrap; margin-left:6px;">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                    @if($errors->has('center_sl3'))
                        <p style="color:red">{{ $errors->first('center_sl3') }}</p>
                    @endif
                    <small id="error_center_sl3" class="text-danger"></small>
                </div>
            </div>
            @endif

            {{-- CAMPUS IV — shown when flags >= 4 --}}
            @if($flags >= 4)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Study Campus IV</label>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-control form-control-sm select2 {{ $errors->has('center_sl4') ? 'is-invalid' : '' }}"
                                id="center_sl4" name="center_sl4"
                                {{ $opt4 == 0 ? 'disabled' : '' }}>
                            <option value="" selected disabled>Select Centre IV</option>
                            @foreach($centre_options as $cent)
                                <option value="{{ $cent->centre_sl }}"
                                    {{ $opt4 == $cent->centre_sl ? 'selected' : '' }}>
                                    {{ $cent->centre_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button"
                                id="clear_btn_4"
                                class="btn btn-sm btn-outline-secondary campus-clear-btn"
                                onclick="clearCentreFrom(4)"
                                {{ $opt4 == 0 ? 'disabled' : '' }}
                                title="Clear Campus IV and below"
                                style="white-space:nowrap; margin-left:6px;">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                    @if($errors->has('center_sl4'))
                        <p style="color:red">{{ $errors->first('center_sl4') }}</p>
                    @endif
                    <small id="error_center_sl4" class="text-danger"></small>
                </div>
            </div>
            @endif

            {{-- CAMPUS V — shown when flags >= 5 --}}
            @if($flags >= 5)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Study Campus V</label>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-control form-control-sm select2 {{ $errors->has('center_sl5') ? 'is-invalid' : '' }}"
                                id="center_sl5" name="center_sl5"
                                {{ $opt5 == 0 ? 'disabled' : '' }}>
                            <option value="" selected disabled>Select Centre V</option>
                            @foreach($centre_options as $cent)
                                <option value="{{ $cent->centre_sl }}"
                                    {{ $opt5 == $cent->centre_sl ? 'selected' : '' }}>
                                    {{ $cent->centre_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button"
                                id="clear_btn_5"
                                class="btn btn-sm btn-outline-secondary campus-clear-btn"
                                onclick="clearCentreFrom(5)"
                                {{ $opt5 == 0 ? 'disabled' : '' }}
                                title="Clear Campus V and below"
                                style="white-space:nowrap; margin-left:6px;">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                    @if($errors->has('center_sl5'))
                        <p style="color:red">{{ $errors->first('center_sl5') }}</p>
                    @endif
                    <small id="error_center_sl5" class="text-danger"></small>
                </div>
            </div>
            @endif

            {{-- CAMPUS VI — shown when flags >= 6 --}}
            @if($flags >= 6)
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Study Campus VI</label>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-control form-control-sm select2 {{ $errors->has('center_sl6') ? 'is-invalid' : '' }}"
                                id="center_sl6" name="center_sl6"
                                {{ $opt6 == 0 ? 'disabled' : '' }}>
                            <option value="" selected disabled>Select Centre VI</option>
                            @foreach($centre_options as $cent)
                                <option value="{{ $cent->centre_sl }}"
                                    {{ $opt6 == $cent->centre_sl ? 'selected' : '' }}>
                                    {{ $cent->centre_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button"
                                id="clear_btn_6"
                                class="btn btn-sm btn-outline-secondary campus-clear-btn"
                                onclick="clearCentreFrom(6)"
                                {{ $opt6 == 0 ? 'disabled' : '' }}
                                title="Clear Campus VI"
                                style="white-space:nowrap; margin-left:6px;">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                    @if($errors->has('center_sl6'))
                        <p style="color:red">{{ $errors->first('center_sl6') }}</p>
                    @endif
                    <small id="error_center_sl6" class="text-danger"></small>
                </div>
            </div>
            @endif

        </div>{{-- end .row --}}

        {{-- Declaration --}}
        <p style="text-align:left; font-family:arial,sans-serif; color:black; font-size:15px; margin-top:15px;">
            <b><u>Declaration</u></b>
        </p>
        <p style="text-align:left; font-family:arial,sans-serif; color:black; font-size:13px;">
            <b>The Transfer of Campus will be based on the position of the candidate in the ranklist,
            availability of seats (should be within the sanctioned strength approved by the University)
            and the option exercised by the candidate. The university reserves the right to direct any
            student to transfer from one Campus to another Campus in case there is a shortfall in the
            number of students at any of the Campus.</b>
        </p>

        <div class="row">
            <label class="control-label col-md-12" style="color:red;">
                I accept the above declarations
                <input type="checkbox" name="option_declaration" id="option_declaration">
            </label>
        </div>

    </div>{{-- end .card-body --}}

    <div id="loader" class="overlay" style="display:none;">
        <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="card-footer"></div>

    <button type="submit" style="display:none;" id="btn_campus_submit" name="btn_campus_submit"
            class="btn btn-success">Save</button>

</form>