$(document).on("submit", "#add_room", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("add_room", true);

  $.ajax({
    type: "POST",
    url: "room_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        console.log(res); // Log the response for debugging
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 200) {
        $("#errorMessage").addClass("d-none");
        $("#staticBackdrop").modal("hide");
        $("#add_room")[0].reset();
        playNotificationSound();
        setTimeout(function () {
          showToast("Patient Registration", "Patient Added");
        }, 1000);

        $("#nav_buttons").load(location.href + " #nav_buttons");
        $("#table").load(location.href + " #table");
      }
    },
  });
});
