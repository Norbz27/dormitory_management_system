  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="../js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/dashboard.js"></script>
  <script src="../js/Chart.roundedBarCharts.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- End custom js for this page-->

<script>
$(document).on("submit", "#survey-form", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("survey_form", true);

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
      } else if (res.status == 200) {
      }
    },
  });
});

$(document).on("submit", "#complain-form", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("complain_form", true);

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
        swal({
            title: "Error",
            text: "Failed to send compain.",
            icon: "error",
            button: false,
        });
      } else if (res.status == 200) {
        
        swal({
            title: "Success",
            text: "Compain sent to successfully!",
            icon: "success",
            button: false,
        });
      }
    },
  });
});
  </script>
</body>

</html>