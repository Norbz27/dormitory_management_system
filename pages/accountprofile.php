
<?php
include_once 'header.php';
include_once 'account_function.inc.php';
include 'accountprofile-inc.php';
?>
  <style>
.profile-wrapper {
    display: flex;
    justify-content: center;
}

.profile-picture {
    margin-bottom: 20px;
}

.profile-info-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start; /* Align to the left */
    text-align: left; /* Align text to the left */
  }

 /* Style for profile picture */
.profile-picture img {
    width: 180px; /* Adjust as needed */
    height: 180px; /* Adjust as needed */
    border-radius: 50%; /* Makes the image round */
}

/* Style for profile name */
.profile-name {
    color: #333; /* Change text color */
    font-weight: bold;
    margin-bottom: 18px; /* Add some space below the name */
}

/* Style for profile info */
.profile-info {
    color: #666; /* Change text color */
    font-size: 20px; /* Adjust font size */
    margin-bottom: 10px; /* Add some space below each info */
}

/* Style for profile wrapper */
.profile-wrapper {
    margin-bottom: 30px; /* Add space below each profile block */
}

.profile-info-wrapper input[type="password"] {
    border: none;
    background: none;
    outline: none; /* Remove outline when clicked */
    /* Optionally, you can adjust other styles as needed */
  }
</style>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Profile</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 ">
        <div class="row">
          <div class="col-md-8">
          <div class="profile-info-wrapper text-center">
            <h2 class="profile-name"><?php echo $username; ?></h2>
            <p class="profile-info">Contact: <?php echo $contact; ?></p>
            <p class="profile-info">Gender: <?php echo $gender; ?></p>
            <h4 class="profile-name mt-5">Log in credentials</h4>
            <p class="profile-info">Username: <?php echo $uid; ?></p>
            <p class="profile-info">Password: 
              <input type="password"  value="<?php echo substr($password, 0, 10); ?>" maxlength="12" readonly>
            </p>
          </div>
          </div>
          <div class="col-md-4">
            <div class="profile-wrapper text-center">
              <div class="profile-picture">
                <img src="../images/profile.png" class="rounded" alt="Profile">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/chart.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      feather.replace();
    </script>
    <script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

</body>

</html>
