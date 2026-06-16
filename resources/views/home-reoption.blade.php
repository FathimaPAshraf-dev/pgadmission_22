@extends('layouts.app')

@section('styles')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

* { margin: 0; padding: 0 }
html { height: 100% }
p { color: grey }

#heading {
    text-transform: uppercase;
    color: #0b6e9d;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

.form-card { text-align: left }

#msform fieldset:not(:first-of-type) { display: none }

#msform input,
#msform textarea {
    border: 1px solid #ccc;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #0b6e9d;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform .action-button:hover,
#msform .action-button:focus { background-color: #311B92 }

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus { background-color: #000000 }

.fs-title {
    font-size: 22px;
    color: #0b6e9d;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text { color: #17a2b8; font-weight: normal }

.steps {
    font-size: 22px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels { color: gray; text-align: left }

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active { color: #0b6e9d }

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 14%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #campus:before {
    font-family: 'Font Awesome 5 Free';
    content: "\f1ad";
    font-weight: 900;
}

#progressbar #payment:before {
    font-family: 'Font Awesome 5 Free';
    content: "\f06e";
    font-weight: 900;
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after { background: #0b6e9d }

.progress { height: 10px }
.progress-bar { background-color: #0b6e9d }
.fit-image { width: 100%; object-fit: cover }

/* Clear button style */
.campus-clear-btn {
    height: 31px;
    line-height: 1;
    padding: 0 10px;
    font-size: 12px;
}

/* Disabled select visual cue */
select:disabled {
    background-color: #f5f5f5 !important;
    cursor: not-allowed;
    opacity: 0.7;
}
</style>
@stop


@section('scripts')
<script type="text/javascript">

/* ============================================================
   SEQUENTIAL CAMPUS SELECTION + CLEAR BUTTONS
   Rules:
   - Campus I is mandatory
   - Campuses II–VI unlock only AFTER the previous is selected
   - Clear button on any slot resets that slot AND all below it
   - Same campus cannot be selected in two slots
   ============================================================ */
(function () {

    var MAX_CENTRES = 6;

    function getSelect(i) {
        return document.getElementById('center_sl' + i);
    }
    function getClearBtn(i) {
        return document.getElementById('clear_btn_' + i);
    }

    /* Unlock next dropdown after a selection is made */
    function onCentreChange(idx) {
        var sel = getSelect(idx);
        if (!sel || !sel.value) return;

        filterDuplicateOptions();

        /* Enable the NEXT slot if it exists in DOM */
        var next = getSelect(idx + 1);
        if (next) {
            next.disabled = false;
        }

        /* Enable clear button for current slot (slot 1 has no clear btn) */
        if (idx > 1) {
            var btn = getClearBtn(idx);
            if (btn) btn.disabled = false;
        }
    }

    /* Clear this slot and every slot after it, then re-lock them */
    window.clearCentreFrom = function (idx) {
        for (var i = idx; i <= MAX_CENTRES; i++) {
            var sel = getSelect(i);
            if (!sel) continue;
            sel.value = '';
            if (i > 1) sel.disabled = true;

            var btn = getClearBtn(i);
            if (btn) btn.disabled = true;
        }

        /* Re-enable the cleared slot itself if the previous slot still has a value */
        if (idx > 1) {
            var prev = getSelect(idx - 1);
            if (prev && prev.value) {
                var cur = getSelect(idx);
                if (cur) cur.disabled = false;
            }
        }

        filterDuplicateOptions();
    };

    /* Grey-out options that are already chosen in another slot */
    function filterDuplicateOptions() {
        var chosen = {};
        for (var i = 1; i <= MAX_CENTRES; i++) {
            var s = getSelect(i);
            if (s && s.value) chosen[i] = String(s.value);
        }
        for (var i = 1; i <= MAX_CENTRES; i++) {
            var s = getSelect(i);
            if (!s) continue;
            for (var j = 0; j < s.options.length; j++) {
                var opt = s.options[j];
                if (!opt.value) continue;
                var takenByOther = false;
                for (var k in chosen) {
                    if (parseInt(k) !== i && chosen[k] === String(opt.value)) {
                        takenByOther = true;
                        break;
                    }
                }
                opt.disabled = takenByOther;
            }
        }
    }

    /* On DOM ready: wire up events and restore state for pre-selected values */
    $(document).ready(function () {

        /* Bind change events for all campus selects */
        for (var i = 1; i <= MAX_CENTRES; i++) {
            (function (idx) {
                var sel = getSelect(idx);
                if (!sel) return;
                sel.addEventListener('change', function () {
                    onCentreChange(idx);
                });
            })(i);
        }

        /* Restore sequential unlock state for pre-saved options (re-option page) */
        for (var i = 1; i <= MAX_CENTRES; i++) {
            var sel = getSelect(i);
            if (!sel) continue;

            if (sel.value) {
                /* This slot has a pre-saved value — enable it and unlock next */
                sel.disabled = false;
                if (i > 1) {
                    var btn = getClearBtn(i);
                    if (btn) btn.disabled = false;
                }
                var next = getSelect(i + 1);
                if (next) next.disabled = false;
            } else {
                /* No value — ensure it's disabled unless previous has a value */
                if (i > 1) {
                    var prev = getSelect(i - 1);
                    if (!prev || !prev.value) {
                        sel.disabled = true;
                    }
                }
            }
        }

        filterDuplicateOptions();
    });

})();


/* ============================================================
   MULTI-STEP FORM NAVIGATION
   ============================================================ */
$(document).ready(function () {

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    var current_fs, next_fs, previous_fs;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    setProgressBar(current);

    $("#msform").on('click', '.next', function (e) {
        e.preventDefault();
        var btn_id = $(this).attr('id');

        if (btn_id === 'btn_campus') {

            var formval = validate_campus('formcampus');
            var formData = new FormData($('#formcampus')[0]);
            var url = "/store_options";

            if (formval) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Options Saved Successfully',
                            confirmButtonText: 'Continue',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.href = "/pay_details";
                        });
                    },
                    error: function (errResponse) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                        console.log(errResponse);
                    }
                });
            } else {
                return false;
            }
        }

        else if (btn_id === 'btn_payment') {
            var formval = validateFinalstage('pgpayment');
            if (formval) {
                document.getElementById("pgpayment").submit();
            } else {
                return false;
            }
        }

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        next_fs.show();
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;
                current_fs.css({ 'display': 'none', 'position': 'relative' });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(++current);
    });


    $(".previous").click(function () {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        previous_fs.show();
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;
                current_fs.css({ 'display': 'none', 'position': 'relative' });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width", percent + "%");
    }

    $(".submit").click(function () { return false; });

});


/* ============================================================
   CAMPUS VALIDATION
   Only center_sl1 is mandatory. Slots 2–6 are optional.
   ============================================================ */
function validate_campus(formval) {

    var center1 = $('#center_sl1');
    var selectedValue1 = center1.val();

    if (!selectedValue1 || selectedValue1 === "0" || selectedValue1 === "") {
        alert("Please select your Study Campus (Campus I is required).");
        $('#error_center_sl1').text("Select your Study Campus");
        center1.addClass('is-invalid');
        center1.focus();
        return false;
    } else {
        $('#error_center_sl1').text("");
        center1.removeClass('is-invalid');
    }

    /* Check declaration checkbox */
    if (!$('#option_declaration').is(':checked')) {
        alert("Please accept the declaration before proceeding.");
        $('#option_declaration').focus();
        return false;
    }

    return true;
}


/* ============================================================
   FINAL STAGE VALIDATION
   ============================================================ */
function validateFinalstage(formval) {
    var declaration_status = $('input[name="declaration_status"]').prop('checked');
    if (declaration_status == false) {
        alert('Please accept the declarations.');
        return false;
    }
    return true;
}


/* ============================================================
   PREVIEW LOADER
   ============================================================ */
function review() {
    $.ajax({
        type: "POST",
        url: "/getpreview",
        data: '',
        processData: false,
        contentType: false,
        success: function (responseim) {
            $('#photo').text(responseim.file_name1);
            $("#previewpay").html(responseim);
        },
        error: function (errResponse) {
            console.log(errResponse);
        }
    });
}

</script>
@stop


@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card px-3 pt-4 pb-0 mt-3 mb-3">

                        <h4 id="heading">Complete Your Campus Re-option</h4>

                        <div id="msform" method="post">

                            <!-- Progress Bar -->
                            <ul id="progressbar" style="z-index:0; border:none; position:relative;">
                                <li id="campus"><strong>Campus Re-Option</strong></li>
                                <li id="payment"><strong>Preview</strong></li>
                            </ul>

                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                     role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>

                            <!-- =====================
                                 STEP 1: CAMPUS RE-OPTION
                                 ===================== -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="fs-title">Change Campus Options :</h3>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 2</h2>
                                        </div>
                                    </div>

                                    @include('reoptcampus')

                                </div>

                                <label for="btn_campus_submit"
                                       name="btn_campus"
                                       id="btn_campus"
                                       class="next action-button">
                                    Save &amp; Next
                                </label>

                                <input hidden="true" type="button" name="previous"
                                       class="previous action-button-previous" value="Previous" />
                            </fieldset>


                            <!-- =====================
                                 STEP 2: PREVIEW
                                 ===================== -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="fs-title">Preview :</h3>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 2</h2>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="previewpay"></div>
                                </div>

                                <div hidden="true">
                                    @if(Auth::user()->onlinepay_status == 1)
                                        <label for="btn_payment" name="btn_payment" id="btn_payment"
                                               class="next action-button">Submit</label>
                                    @endif
                                </div>

                                <input type="button" name="previous" form="pgpayment"
                                       class="previous action-button-previous" value="Previous" />

                                <input type="button" class="previous action-button-previous"
                                       value="Back to Home Page"
                                       onclick="window.location.href='{{ route('home') }}'" />
                            </fieldset>

                        </div>{{-- end #msform --}}

                    </div>{{-- end .card --}}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection