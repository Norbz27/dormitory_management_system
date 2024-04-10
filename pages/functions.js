$(document).on("submit", "#add_room", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("add_room", true);

  $.ajax({
    type: "POST",
    url: "server_function.php",
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
        $("#addRoom").modal("hide");
        $("#add_room")[0].reset();
        location.reload();
      }
    },
  });
});

$(document).on("submit", "#new-tenants", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("add_tenants", true);

  $.ajax({
    type: "POST",
    url: "server_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = JSON.parse(response);
      if (res.status == 500) {
        console.log(res); // Log the response for debugging
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 200) {
        $("#errorMessage").addClass("d-none");
        $("#newTenant").modal("hide");
        $("#new-tenants")[0].reset();
        window.location.href = "../pages/tenants.php?status=success";
      }
    },
  });
});

$(document).on("click", "#view_button", function (e) {
  e.preventDefault();
  var thisroom_id = $(this).val();

  $.ajax({
    type: "GET",
    url: "server_function.php?view_room_id=" + thisroom_id,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        $("#floor").text(res.data.floor_belong);
        $("#occupy_num").text(res.data.available_occupation);
        $("#status").text(res.data.status);
        $("#room_name").text(res.data.room_name);
        $("#edit_button").val(thisroom_id);
        $("#display_img").attr("src", "assets/" + res.data.display_img);
        //$("#new_room_id").val(thisroom_id);
      }
    },
  });
});

$(document).on("click", "#edit_button", function (e) {
  e.preventDefault();
  var thisroom_id = $(this).val();
  $("#exampleModal").modal("hide");
  $.ajax({
    type: "GET",
    url: "server_function.php?view_room_id=" + thisroom_id,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        $("#new_room_name").val(res.data.room_name);
        $("#new_occupy_num").val(res.data.occupy_num);
        $("#new_floor_belong").val(res.data.floor_belong);
        $("#new_status").val(res.data.status);
        $("#new_room_id").val(res.data.room_id);
        $("#new_display_img").attr("src", "assets/" + res.data.display_img);
        $("#imageSrc").val(res.data.display_img);
        $("#editRoom").modal("show");
      }
    },
  });
});

$(document).ready(function () {
  // Open file input when the button is clicked
  $("#openFileBtn").click(function () {
    $("#fileInput").click();
  });

  // Handle file selection
  $("#fileInput").change(function () {
    // Get the selected file
    var selectedFile = this.files[0];

    if (selectedFile) {
      // Create a FileReader to read the selected file
      var reader = new FileReader();

      // Set the image source when the FileReader has loaded the file
      reader.onload = function (e) {
        $("#new_display_img").attr("src", e.target.result);
      };

      // Read the selected file as a data URL
      reader.readAsDataURL(selectedFile);
    }
  });
});

$(document).on("submit", "#edit_room", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("edit_room", true);

  $.ajax({
    type: "POST",
    url: "server_function.php",
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
        $("#editRoom").modal("hide");
        location.reload();
      }
    },
  });
});
$(document).on("submit", "#addAnnouncement", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("add_announcement", true);

  $.ajax({
    type: "POST",
    url: "server_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        console.log(res);
      } else if (res.status == 200) {
        $("#announcement").modal("hide");
        $("#addAnnouncement")[0].reset();
        location.reload();
      }
    },
  });
});

$(document).on("click", "#ann_edit", function (e) {
  e.preventDefault();
  var ann_id = $(this).val();

  $.ajax({
    type: "GET",
    url: "server_function.php?view_announcement_id=" + ann_id,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        $("#title_edit").val(res.data.title);
        $("#description_edit").val(res.data.description);
        $("#date_edit").val(res.data.date);
        $("#time_edit").val(res.data.time);
        $("#ann_id").val(res.data.id);
        $("#ann_delete").val(res.data.id);
        $("#announcement_edit").modal("show");
      }
    },
  });
});

$(document).on("submit", "#addAnnouncement_edit", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("edit_announcement", true);

  $.ajax({
    type: "POST",
    url: "server_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        console.log(res);
      } else if (res.status == 200) {
        $("#announcement").modal("hide");
        $("#addAnnouncement")[0].reset();
        location.reload();
      }
    },
  });
});

$(document).on("click", "#ann_delete", function (e) {
  e.preventDefault();
  if (confirm("Are you sure you want to delete this announcement?")) {
    var ann_id = $(this).val();
    $.ajax({
      type: "GET",
      url: "server_function.php?delete_announcement_id=" + ann_id,
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 422) {
          alert(res.message);
        } else if (res.status == 200) {
          $("#announcement_edit").modal("hide");
          location.reload();
        }
      },
    });
  } else {
    $("#announcement_edit").modal("hide");
  }
});

$("#floor_belong").change(function () {
  var selectedValue = $(this).val();

  $.ajax({
    type: "GET",
    url: "server_function.php?get_latest_room=" + selectedValue,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        alert(res.message);
      } else if (res.status == 200) {
        var roomData = res.data.room_name;
        var roomNumber = parseInt(roomData.match(/\d+/)[0]);
        roomNumber++;
        var updatedRoomData = roomData.replace(/\d+/, roomNumber);
        $("#auto_room_name").val(updatedRoomData);
      }
    },
  });
});
