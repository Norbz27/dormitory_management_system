<?php
session_start();

if (!isset($_SESSION["account"])) {
  header("Location: auth/login.php");
  exit();
}


if (!isset($_SESSION["account"])) {
  header("Location: auth/login.php");
  exit();
}
?>  

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SEC Dormitory</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css"/>
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
    <!-- Include Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="../js/select.dataTables.min.css">
  
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-6" style="color: black; font-size: 16px; font-weight: bold" href="index.php"><img src="../images/logo.svg" class="mr-2" alt="logo"/>SEC Dormitory</a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../images/logo1.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
        
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <?php 
            // Check if the session variable for the profile image exists and use it
            if(isset($_SESSION["displayImg"])) {
              echo '<img src="assets/' . $_SESSION["displayImg"] . '" style="object-fit: cover; margin-right:8px" alt="profile"/>';
            } else {
              // Use a default image if the session variable doesn't exist
              echo '<img src="assets/profile.png" style="object-fit: cover; margin-right:8px" alt="profile"/>';
            }
          ?>
          <span><?php echo $_SESSION["usersname"] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="../pages/accountprofile.php?id=<?php echo $_SESSION['userid']; ?>">
                <i class="bi bi-person-circle"></i>
                Profile
              </a>
              <a class="dropdown-item" href="auth/logout.inc.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SETTINGS</p>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
            <div class="accordion" id="accordionExample">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;color:black;">
                    SURVEY FORM
                  </button>
                </h2>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="height: 100vh; margin-bottom:100px">
                <div class="card-body">
                  <form id="survey-form">
                  <div class="p-4">
                    <p>How satisfied are you with the overall cleanliness and condition of your dorm room and common areas?</p>
                  </div>
                  <div class="d-flex flex-row p-4">
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="1-1" name="question1" value="Very Much">
                      <label class="form-check-label ml-1" for="1-1">
                      Very Much
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="1-2" name="question1"value="Somewhat">
                      <label class="form-check-label ml-1" for="1-2">
                      Somewhat
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="1-3" name="question1" value="Not At All">
                      <label class="form-check-label ml-1" for="1-3">
                      Not At All
                      </label>
                    </div>
                  </div>
                  <div class="p-4">
                    <p>To what extent do you feel your current roommate situation contributes to a positive and productive living environment?</p>
                  </div>
                  <div class="d-flex flex-row p-4">
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="2-1" name="question2" value="Very Much">
                      <label class="form-check-label ml-1" for="2-1">
                      Very Much
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="2-2" name="question2"value="Somewhat">
                      <label class="form-check-label ml-1" for="2-2">
                      Somewhat
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="2-3" name="question2" value="Not At All">
                      <label class="form-check-label ml-1" for="2-3">
                      Not At All
                      </label>
                    </div>
                  </div>
                  <div class="p-4">
                    <p>How often are you disturbed by noise levels in your dorm (from roommates, hallway activity, etc.) that make it difficult to study, sleep, or relax?</p>
                  </div>
                  <div class="d-flex flex-row p-4">
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="3-1" name="question3" value="Very Often">
                      <label class="form-check-label ml-1" for="3-1">
                      Very Often
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="3-2" name="question3"value="Sometimes">
                      <label class="form-check-label ml-1" for="3-2">
                      Sometimes
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="3-3" name="question3" value="Never">
                      <label class="form-check-label ml-1" for="3-3">
                      Never
                      </label>
                    </div>
                  </div>
                  <div class="p-4">
                    <p>Besides your dorm room, are there adequate study spaces available in the dormitory or nearby buildings that you find conducive to focused work?</p>
                  </div>
                  <div class="d-flex flex-row p-4">
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="4-1" name="question4" value="Yes">
                      <label class="form-check-label ml-1" for="4-1">
                      Yes
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="4-2" name="question4"value="No">
                      <label class="form-check-label ml-1" for="4-2">
                      No
                      </label>
                    </div>
                  </div>
                  <div class="p-4">
                    <p>How confident do you feel in the overall security measures in place for the dormitory (building access control, security personnel, etc.)?</p>
                  </div>
                  <div class="d-flex flex-row p-4">
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="5-1" name="question5" value="Very">
                      <label class="form-check-label ml-1" for="5-1">
                      Very
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="5-2" name="question5"value="Somewhat">
                      <label class="form-check-label ml-1" for="5-2">
                      Somewhat
                      </label>
                    </div>
                    <div class="form-check m-auto">
                      <input class="form-check-input" type="radio" id="5-3" name="question5" value="Not At All">
                      <label class="form-check-label ml-1" for="5-3">
                      Not At All
                      </label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center p-4">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </div>
                  </form>
                </div>
              </div>
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: none;color:black;">
                    COMPLAIN FORM
                  </button>
                </h2>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="height: 100vh; margin-bottom:100px">
                <div class="card-body">
                  <form id="complain-form">
                  <div class="form-group">
                    <label>Type here...</label>
                    <textarea class="form-control" name="complain" rows="5" required></textarea>
                    <div class="d-flex justify-content-center p-4">
                      <button type="submit" name="submit" class="btn btn-primary" style="margin-bottom: 120px;">Submit</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <?php 
              if ($_SESSION["status"] == 'admin') {
               ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="announcement.php">
              <i class="icon-bell menu-icon"></i>
              <span class="menu-title">Announcements</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tenants.php">
              <i class="icon-paper-stack menu-icon"></i>
              <span class="menu-title">Tenants</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rooms.php">
              <i class="icon-location menu-icon"></i>
              <span class="menu-title">Rooms</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payments-admin.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Payments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reports.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Tenant Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="accounts.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Accounts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="survey_complain.php">
              <i class="icon-folder menu-icon"></i>
              <span class="menu-title">Surveys / Complains</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="archive.php">
              <i class="icon-briefcase menu-icon"></i>
              <span class="menu-title">Archive</span>
            </a>
          </li>  
          <?php 
            }else{
              ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="announcement.php">
              <i class="icon-bell menu-icon"></i>
              <span class="menu-title">Announcements</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rooms.php">
              <i class="icon-location menu-icon"></i>
              <span class="menu-title">Rooms</span>
            </a>
          </li>
          <?php 
              if ($_SESSION["status"] == 'Tenant') {
               ?>
          <li class="nav-item">
            <a class="nav-link" href="payments-user.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Payments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contract.php">
              <i class="icon-briefcase menu-icon"></i>
              <span class="menu-title">Contract</span>
            </a>
          </li>
     <?php 
              }
            }
              ?>
          
        </ul>
      </nav>