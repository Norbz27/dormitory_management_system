
<?php
include_once 'header.php';
include_once 'account_function.inc.php';
include 'accountprofile-inc.php';

$status = isset($_GET['status']) ? $_GET['status'] : '';
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
    width: 300px; /* Adjust as needed */
    height: 300px; /* Adjust as needed */
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
    font-size: 16px; /* Adjust font size */
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Somethings</button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg class for larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update_accountprofile.php" method="post">
            <div class="modal-body row">
                    <div class="col-md-4"> <!-- First column -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="edid" name="edid" value="<?php echo htmlspecialchars($id); ?>" hidden>
                            <label for="username" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                        </div>
                        <div class="form-group">
                            <label for="contact" class="col-form-label">Contact:</label>
                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>">
                        </div>
                    </div>
                    <div class="col-md-4"> <!-- Second column -->
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Gender:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male" <?php if ($gender === "Male") echo "selected"; ?>>Male</option>
                                <option value="Female" <?php if ($gender === "Female") echo "selected"; ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uid" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="uid" name="uid" value="<?php echo htmlspecialchars($uid); ?>">
                        </div>
                    </div>
                    <div class="col-md-4"> <!-- Third column -->
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
    </div>
    <div class="col-md-4">
        <div class="profile-wrapper text-center">
            <div class="profile-picture">
            <img src="assets/<?php echo $_SESSION["displayImg"] ?>" style="object-fit: cover; margin-right:8px" alt="profile"/>
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
    <?php
        if ($status === 'success') {
            echo 'swal({
                title: "Success",
                text: "New account have been added!",
                icon: "success",
                button: false,
              });
              ';
        } elseif ($status === 'stmtfailed') {
            echo 'swal({
                title: "Error",
                text: "No account have been added!",
                icon: "error",
                button: false,
              });
              ';
        } elseif ($status === 'updated') {
            echo 'swal({
                title: "Success",
                text: "Account have been Updated!",
                icon: "success",
                button: false,
              });
              ';
        }
    ?>
</script>
</body>

</html>
