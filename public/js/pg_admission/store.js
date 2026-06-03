// $("#msform").on("click", ".next", function (e) {
//   //  alert('ss');
//   e.preventDefault();
//   var btn_id = $(this).attr("id");
//   var img_nm = $("#img_hidden").val();

//   if (btn_id === "btn_personal123") {
//     var formval = validateForm("formpersonal");
//     var formData = new FormData($("#formpersonal")[0]);
//     var url = "/storepersonal";
//     if (formval) {
//       $.ajax({
//         type: "POST",
//         url: url,
//         data: formData,
//         processData: false,
//         contentType: false,

//         success: function (response) {
//           //                    alert(response.status);
//         },
//         error: function (errResponse) {
//           console.log(errResponse);
//         },
//       });
//     } else {
//       return false;
//     }
//   } else if (btn_id === "btn_educational") {
//     var formval = validateQuali("formquali");
//     var ugcourse_status = $('input[name="ugcourse_status"]').prop("checked");

//     if (ugcourse_status) {
//       ugcourse_status = 1;
//     } else {
//       ugcourse_status = 0;
//     }
//     var formData = new FormData($("#formquali")[0]);
//     formData.append("ugcourse_status", ugcourse_status);
//     var url = "/store_quali";
//     if (formval) {
//       $.ajax({
//         type: "POST",
//         url: url,
//         data: formData,
//         processData: false,
//         contentType: false,

//         success: function (response) {
//           $("#course").text("Course : " + " " + response.pgquali_exam);
//           $("#sub").text("Main Subject : " + " " + response.pgquali_subject);
//           $("#pgyear").text("Year : " + " " + response.pgquali_year);
//           $("#duratn").text(
//             "Duration of course : " + " " + response.courseduration
//           );
//           $("#hidduratn").val(response.courseduration);
//           $("#hidresultwait").val(response.ugcourse_status);
//           add_inputs();
//           if (response.ugcourse_status == 1) {
//             var ugcourse_status = "Yes";
//           } else {
//             var ugcourse_status = "No";
//           }
//           $("#resultwait").text(
//             " UG Result awaiting : " + " " + ugcourse_status
//           );

//           //                    alert(response.status);
//         },
//         error: function (errResponse) {
//           console.log(errResponse);
//         },
//       });
//     } else {
//       return false;
//     }
//   } else if (btn_id === "btn_semdetails") {
//     var formval = true;
//     //    $('.name_input').each(function() {
//     //
//     //    });

//     var courseduration = document.getElementById("hidduratn").value;
//     var resultwait = document.getElementById("hidresultwait").value;

//     var formData = new FormData($("#formsem")[0]);
//     var url = "/storesemester";
//     if (formval) {
//       $.ajax({
//         type: "POST",
//         url: url,
//         data: formData,
//         processData: false,
//         contentType: false,

//         success: function (response) {
//           //                   alert(response.status);
//         },
//         error: function (errResponse) {
//           console.log(errResponse);
//         },
//       });
//     } else {
//       return false;
//     }
//   } else if (btn_id === "btn_otherinfo") {
//     var formval = validateOther("formotherinfo");
//     var formData = new FormData($("#formotherinfo")[0]);
//     var url = "/store_otherinfo";
//     if (formval) {
//       $.ajax({
//         type: "POST",
//         url: url,
//         data: formData,
//         processData: false,
//         contentType: false,

//         success: function (response) {
//           //                    alert(response.status);
//         },
//         error: function (errResponse) {
//           console.log(errResponse);
//         },
//       });
//     } else {
//       return false;
//     }
//   } else if (btn_id === "btn_image") {
//     if (img_nm === "") {
//       alert("Upload image");
//       return false;
//     }

//     var formval = false;
//     var formData = "";
//     var url = "/getpreview";
//     $.ajax({
//       type: "POST",
//       url: url,
//       data: formData,
//       processData: false,
//       contentType: false,

//       success: function (responseim) {
//         $("#previewpay").html(responseim);
//       },
//       error: function (errResponse) {
//         console.log(errResponse);
//       },
//     });
//   } else if (btn_id === "btn_sign") {
//     if (img_nm === "") {
//       alert("Upload image");
//       return false;
//     }

//     var formval = false;
//     var formData = "";
//     var url = "/getpreview";
//     $.ajax({
//       type: "POST",
//       url: url,
//       data: formData,
//       processData: false,
//       contentType: false,

//       success: function (responseim) {
//         $("#previewpay").html(responseim);
//       },
//       error: function (errResponse) {
//         console.log(errResponse);
//       },
//     });
//   }

//   current_fs = $(this).parent();
//   next_fs = $(this).parent().next();

//   //Add Class Active
//   $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//   //show the next fieldset
//   next_fs.show();
//   //hide the current fieldset with style
//   current_fs.animate(
//     { opacity: 0 },
//     {
//       step: function (now) {
//         // for making fielset appear animation
//         opacity = 1 - now;

//         current_fs.css({
//           display: "none",
//           position: "relative",
//         });
//         next_fs.css({ opacity: opacity });
//       },
//       duration: 500,
//     }
//   );
//   setProgressBar(++current);
// });

function storePersonal() {
  $.ajax({
    type: "POST",
    url: url,
    data: formData,
    processData: false,
    contentType: false,

    success: function (response) {
      //                    alert(response.status);
    },
    error: function (errResponse) {
      console.log(errResponse);
    },
  });
}

$.validator.setDefaults({
  submitHandler: function () {
    var formData = new FormData($("#formpersonal")[0]);

    var btn_val = $(document.activeElement).val();
    //        $('#btn_save_filecontent').prop('disabled', true);
    //        $('#btn_forward_filecontent').prop('disabled', true);
    formData.append("btn_val", btn_val);
    $(".btn-spinner").prop("disabled", true);

    $.ajax({
      url: "/storepersonal",
      type: "POST",
      data: formData,
      contentType: false,
      dataType: "json",
      cache: false,
      processData: false,
      success: function (response) {
        //   $(".btn-spinner").prop("disabled", false);
        // $("#formpersonal")[0].reset();
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li")
          .eq($("fieldset").index(next_fs))
          .addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate(
          { opacity: 0 },
          {
            step: function (now) {
              // for making fielset appear animation
              opacity = 1 - now;

              current_fs.css({
                display: "none",
                position: "relative",
              });
              next_fs.css({ opacity: opacity });
            },
            duration: 500,
          }
        );
        setProgressBar(++current);
      },
      error: function (data) {
        console.log(data);

        //   $(".progress-bar").hide();
        //   $(".btn-spinner").prop("disabled", false);

        $.each(data.responseJSON.errors, function (key, value) {
          var name = $("[name='" + key + "']");
          if (key.indexOf(".") != -1) {
            var arr = key.split(".");
            name = $("[name='" + arr[0] + "[]']:eq(" + arr[1] + ")");
          }
          name
            .parent()
            .append(
              '<div class="invalid-feedback" style="display: block;"> ' +
                value[0] +
                "</div>"
            );
        });
        $(".invalid-feedback").fadeOut(20000);
      },
    });
  },
});
$("#formpersonal").validate({
  //   ignore: '',

  rules: {
    pgapp_nationality: {
      required: true,
      //   minlength: 2,
    },
  },
  messages: {},
  errorElement: "span",
  errorPlacement: function (error, element) {
    error.addClass("invalid-feedback");
    element.closest(".col-sm-6").append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass("is-invalid");
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass("is-invalid");
  },
});

$.validator.setDefaults({
  submitHandler: function () {
    var formData = new FormData($("#formquali")[0]);

    var btn_val = $(document.activeElement).val();
    //        $('#btn_save_filecontent').prop('disabled', true);
    //        $('#btn_forward_filecontent').prop('disabled', true);
    formData.append("btn_val", btn_val);
    $(".btn-spinner").prop("disabled", true);

    $.ajax({
      url: "/store_quali",
      type: "POST",
      data: formData,
      contentType: false,
      dataType: "json",
      cache: false,
      processData: false,
      success: function (response) {
        //   $(".btn-spinner").prop("disabled", false);
        // $("#formpersonal")[0].reset();
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li")
          .eq($("fieldset").index(next_fs))
          .addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate(
          { opacity: 0 },
          {
            step: function (now) {
              // for making fielset appear animation
              opacity = 1 - now;

              current_fs.css({
                display: "none",
                position: "relative",
              });
              next_fs.css({ opacity: opacity });
            },
            duration: 500,
          }
        );
        setProgressBar(++current);
      },
      error: function (data) {
        console.log(data);

        //   $(".progress-bar").hide();
        //   $(".btn-spinner").prop("disabled", false);

        $.each(data.responseJSON.errors, function (key, value) {
          var name = $("[name='" + key + "']");
          if (key.indexOf(".") != -1) {
            var arr = key.split(".");
            name = $("[name='" + arr[0] + "[]']:eq(" + arr[1] + ")");
          }
          name
            .parent()
            .append(
              '<div class="invalid-feedback" style="display: block;"> ' +
                value[0] +
                "</div>"
            );
        });
        $(".invalid-feedback").fadeOut(20000);
      },
    });
  },
});
$("#formquali").validate({
  //   ignore: '',

  rules: {
    pgapp_nationality: {
      required: true,
      //   minlength: 2,
    },
  },
  messages: {},
  errorElement: "span",
  errorPlacement: function (error, element) {
    error.addClass("invalid-feedback");
    element.closest(".col-sm-6").append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass("is-invalid");
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass("is-invalid");
  },
});
