<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SignIn</title>
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
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="login.inc.php" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="uid" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="pwd" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <?php
                if (isset($_GET['error']) && $_GET['error'] == 'loginblocked') {
                  ?>
                  <div class="mt-3 text-center text-danger">
                    <p>Login is blocked. Wait after <span id="remainingSeconds">60</span> seconds</p>
                  </div>
                  <div id="countdown">
                    <div id="seconds" class="text-center"></div>
                  </div>
                <?php
                } else if (isset($_GET['error']) && $_GET['error'] == 'usernotfound') {
                  echo '<div class="mt-3 text-center text-danger">
                              <p>Incorrect password or username</p>
                          </div>';
                }
                ?>
                <!--<div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>-->
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- endinject -->

  <!-- JavaScript for countdown -->
  <script>
document.addEventListener("DOMContentLoaded", function() {
  <?php
  if (isset($_GET['error']) && $_GET['error'] == 'loginblocked') {
    ?>
    const remainingSecondsElement = document.getElementById('remainingSeconds');
    const secondsElement = document.getElementById('seconds');
    let secondsLeft = parseInt(remainingSecondsElement.innerText);
    let countdownInterval = null;

    const updateCountdown = () => {
      if (secondsLeft > 0) {
        secondsElement.innerText = secondsLeft + 's';
        console.log('Countdown:', secondsLeft + 's');
        secondsLeft--;
      } else {
        clearInterval(countdownInterval);
        document.getElementById('countdown').innerHTML = '<center><p>Countdown is over!</p></center>';
        window.location.href = 'login.php'; // Redirect to login.php
      }
    };

    const startCountdown = () => {
      if (countdownInterval === null && secondsLeft > 0) {
        updateCountdown();
        countdownInterval = setInterval(updateCountdown, 1000);
      }
    };

    // Fetch remaining seconds from the server and start the countdown
    fetch('remaining_seconds.php?ip=<?php echo $_SERVER['REMOTE_ADDR']; ?>')
      .then(response => response.json())
      .then(data => {
        secondsLeft = data.remainingSeconds;
        startCountdown();
      });

    // Update the countdown every second
    setInterval(() => {
      fetch('remaining_seconds.php?ip=<?php echo $_SERVER['REMOTE_ADDR']; ?>')
        .then(response => response.json())
        .then(data => {
          secondsLeft = data.remainingSeconds;
        });
    }, 1000);
  <?php
  }
  ?>
});
</script>
</body>

</html>