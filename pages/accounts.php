<?php
require_once '../db/db_conn.php';
include_once 'header.php';
include_once 'account_function.inc.php';

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .btn-group .dropdown-toggle::after {
            content: none;
        }

        .dropdown-item{
            width: 95%;
            margin-left: 4px;
        }

        .profile-picture {
            position: relative;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            width: 180px; 
            height: 180px;
            border-radius: 50%;
            cursor: pointer;
        }

        .profile-picture:hover .overlay {
            opacity: 1;
        }
        .form-label{
            font-size: 14px;
        }
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Accounts</h3>
                        </div>
                        <div class="col-6 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button type="button" class="btn btn-primary btn-icon-text btn-sm" data-toggle="modal" data-target="#addAccountModal">
                                        <i class="icon-plus btn-icon-prepend"></i>
                                        Add Account
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <!-- Modal -->
          <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="addAccountModalLabel">Add Account</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="addAccount.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                         <!-- Profile Picture Placeholder -->
                            <div class="profile-wrapper text-center">
                                <div class="profile-picture">
                                    <label for="adprofile">
                                        <img src="../images/profile.webp" id="adprofilePreview" alt="Profile Picture" style="width:180px; height: 180px; object-fit: cover;" class="img-fluid rounded-circle">
                                        <div class="overlay">
                                            <p style="font-size: 14px">Upload new profile</p>
                                        </div>
                                        <input type="file" name="adprofile" id="adprofile" onchange="previewImageAdd()" accept="image/*" hidden>
                                    </label>
                                </div>
                            </div>
                              <div class="row">
                                  <!-- Full Name -->
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="fullName">Full Name</label>
                                          <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter full name">
                                      </div>
                                  </div>
                                  <!-- Other Fields in Two Columns -->
                                  <div class="col-md-6">
                                      <!-- Phone Number -->
                                      <div class="form-group">
                                          <label for="phoneNumber">Phone Number</label>
                                          <input type="tel" class="form-control" id="phoneNumber" name="contact" placeholder="Enter phone number">
                                      </div>
                                      <!-- Username -->
                                      <div class="form-group">
                                          <label for="username">Username</label>
                                          <input type="text" class="form-control" id="username" name="uid" placeholder="Enter username">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <!-- Gender -->
                                      <div class="form-group">
                                          <label for="gender">Gender</label>
                                          <select class="form-control" id="gender" name="gender">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                          </select>
                                      </div>
                                      <!-- Password -->
                                      <div class="form-group">
                                          <label for="password">Password</label>
                                          <input type="password" class="form-control" id="password" name="pwd" placeholder="Enter password">
                                      </div>
                                  </div>
                              </div>
                              <!-- Add more form fields as needed -->
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary btn-md">Save</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
           <!-- View Modal -->
            <div class="modal fade" id="viewAccountModal" tabindex="-1" role="dialog" aria-labelledby="viewAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="editAccount.php"  method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                 <!-- Profile Picture Placeholder -->
                                <div class="profile-wrapper text-center">
                                    <div class="profile-picture">
                                    <label for="viewprofile">
                                        <img src="../images/profile.webp" alt="Profile Picture" id="profilePic" style="width:180px; height: 180px; object-fit: cover;" class="img-fluid rounded-circle">
                                        <div class="overlay">
                                            <p style="font-size: 14px">Upload new profile</p>
                                        </div>
                                        <input type="file" name="viewprofile" id="viewprofile" hidden disabled onchange="previewImage()" accept="image/*">
                                    </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="edid" name="edid" hidden>
                                            <label for="fullName">Full Name</label>
                                            <input type="text" class="form-control" id="edfullName" name="edname" placeholder="Enter full name" disabled>
                                        </div>
                                    </div>
                                    <!-- Other Fields in Two Columns -->
                                    <div class="col-md-6">
                                        <!-- Phone Number -->
                                        <div class="form-group">
                                            <label for="phoneNumber">Phone Number</label>
                                            <input type="tel" class="form-control" id="edphoneNumber" name="edcontact" placeholder="Enter phone number"  disabled>
                                        </div>
                                        <!-- Username -->
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="edusername" name="eduid" placeholder="Enter username" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Gender -->
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="edgender" name="edgender" disabled>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="edpassword" name="edpwd" placeholder="Enter password" disabled>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more form fields as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close-btn" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                                <button type="button" id="editAccountBtn" class="btn btn-primary btn-md">Edit Details</button>
                                <button type="submit" class="btn btn-primary btn-md" style="display: none;">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <div class="search-box mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
          </div>
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <colgroup>
                                    <col style="width: auto;"> 
                                    <col style="width: auto;"> 
                                    <col style="width: auto;"> 
                                    <col style="width: auto;"> 
                                    <col style="width: 20px;"> 
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        getAllAccounts();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

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
<script>
        function previewImage() {
            const fileInput = document.getElementById('viewprofile');
            const img = document.getElementById('profilePic');
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                img.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
        function previewImageAdd() {
            const fileInput = document.getElementById('adprofile');
            const img = document.getElementById('adprofilePreview');
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                img.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
        document.addEventListener("DOMContentLoaded", function() {
            var phoneInput = document.getElementById("phoneNumber");
            
            phoneInput.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var sanitizedValue = inputValue.replace(/[^0-9\+]/g, ''); // Remove any characters that are not numbers or +
                sanitizedValue = sanitizedValue.slice(0, 13); // Limit to 12 characters
                event.target.value = sanitizedValue;
            });

            var phoneInput = document.getElementById("edphoneNumber");
            
            phoneInput.addEventListener("input", function(event) {
                var inputValue = event.target.value;
                var sanitizedValue = inputValue.replace(/[^0-9\+]/g, ''); // Remove any characters that are not numbers or +
                sanitizedValue = sanitizedValue.slice(0, 13); // Limit to 12 characters
                event.target.value = sanitizedValue;
            });
        });
  </script>
</body>

</html>


