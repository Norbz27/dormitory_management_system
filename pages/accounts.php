<?php
<<<<<<< HEAD
=======
require_once '../db/db_conn.php';
>>>>>>> 3a78ebbadc8d12b84a328bdc4ff17263dda6d1cb
include_once 'header.php';
include_once 'account_function.inc.php';
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
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Accounts</h3>
                        </div>
                        <div class="col-12 col-xl-4">
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
                      <form action="addAccount.php" method="post">
                      <div class="modal-body">
                          
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
                                              <option value="male">Male</option>
                                              <option value="female">Female</option>
                                              <option value="other">Other</option>
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
                          <button type="submit" class="btn btn-primary btn-md">Save</button>
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
                                        <th>Username</th>
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
  <!-- End custom js for this page-->
  <script>
    function previewProfilePicture(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var profilePicturePreview = document.getElementById('profilePicturePreview');
            profilePicturePreview.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
  </script>
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

