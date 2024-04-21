<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Signup Page</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  <style>
    .content-wrapper {
      background-image: url('../assets/bg.png');
      background-size: cover;
      background-repeat: no-repeat;
    }
    .col-9 {
      margin: 0 auto; 
      text-align: left; 
      display: absolute;
      top: 20px;
    }
    h3{
      font-weight: bold;
      font-size: 30px
    }
</style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
              <div class="row">
                  <div class="col-3">
                    <img src="../../images/logo.svg" alt="logo">
                  </div>
                  <div class="col-9">
                    <h3>SEC Dormitory</h3>
                  </div>
                </div>
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="register.inc.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputName" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputPhone" name="contact" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" style="padding-left: 30px" id="exampleInputGender" name="gender" required>
                    <option selected disabled value="">Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername" name="uid" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword" name="pwd" placeholder="Password">
                </div>
                <div class="form-group">
                <label>Profile Picture</label>
                    <input type="file" class="form-control-file" name="display_picture" required>
                </div>
                <div class="mb-4">
                  <!--<div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>-->
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var phoneInput = document.getElementById("exampleInputPhone");
        
        phoneInput.addEventListener("input", function(event) {
            var inputValue = event.target.value;
            var sanitizedValue = inputValue.replace(/[^0-9\+]/g, ''); // Remove any characters that are not numbers or +
            sanitizedValue = sanitizedValue.slice(0, 13); // Limit to 12 characters
            event.target.value = sanitizedValue;
        });
    });
  </script>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
