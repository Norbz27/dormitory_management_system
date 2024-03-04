<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SEC Admin</title>
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
  .card{
    margin-bottom: 20px;
    border-radius: 10px;
  }
  .card .btn{
    border-bottom-left-radius: 9px;
    border-bottom-right-radius: 9px;
    border-top-right-radius: 0;
    border-top-left-radius: 0;
    width: 100%;
    height: 100%;
    padding: 2px;
    background-color: #4B49AC;
    border-color: #4B49AC;
  }
  .card-body .card-title{
    margin-bottom: 10px;
  }
  .card .card-footer{
    padding: 0;
    height: 40px;
  }
  .badge{
    padding: 8px 12px;
    font-weight: 500;
  }
  .carousel-control-next{
    border: none;
    background-color: transparent;
  }
  .carousel-control-prev{
    border: none;
    background-color: transparent;
  }
</style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5" href="../../index.php"><img src="../../images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.php"><img src="../../images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
        
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
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
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/Announcements/announcement.php">
              <i class="icon-bell menu-icon"></i>
              <span class="menu-title">Announcements</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/Tenants/tenants.php">
              <i class="icon-paper-stack menu-icon"></i>
              <span class="menu-title">Tenants</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/Rooms/rooms.php">
              <i class="icon-location menu-icon"></i>
              <span class="menu-title">Rooms</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/Payments/payments.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Payments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/Reports/reports.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Reports</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/Accounts/accounts.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Accounts</span>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Rooms</h3>
                        </div>
                        <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">    
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button type="button" class="btn btn-primary btn-icon-text btn-sm">
                                    <i class="icon-plus btn-icon-prepend"></i>
                                    Add Room
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <h3 class="font-weight-bold">Floor 1</h3>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-1">
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 101</h5>
                            <span class="badge badge-pill badge-success">Available</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                          <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 102</h5>
                            <span class="badge badge-pill badge-danger">Occupied</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 103</h5>
                            <span class="badge badge-pill badge-warning">Lacking</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 104</h5>
                            <span class="badge badge-pill badge-success">Available</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 104</h5>
                            <span class="badge badge-pill badge-danger">Occupied</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h3 class="font-weight-bold">Floor 2</h3>
                    <div class="row row-cols-1 row-cols-md-5 g-1">
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 201</h5>
                            <span class="badge badge-pill badge-warning">Lacking</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 202</h5>
                            <span class="badge badge-pill badge-danger">Occupied</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 203</h5>
                            <span class="badge badge-pill badge-success">Available</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 204</h5>
                            <span class="badge badge-pill badge-danger">Occupied</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="card">
                          <img src="../../images/rooms/room1.jpg" class="card-img-top" style="height: 20vh; object-fit: cover;" alt="Room 1">
                          <div class="card-body">
                            <h5 class="card-title">Room 104</h5>
                            <span class="badge badge-pill badge-success">Available</span>
                            <p class="card-text" style="margin-top: 10px;">This room is equipped with two beds, two desks and chairs, two wardrobes or closets, and shared amenities such as bathrooms and common areas.</p>
                          </div>
                          <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-circle " data-toggle="modal" data-target="#exampleModal">View</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Room 101</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px;">
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                  <img src="../../images/rooms/dormroom.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                  <img src="../../images/rooms/dormroom.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                  <img src="../../images/rooms/dormroom.jpg" class="d-block w-100" alt="...">
                                </div>
                              </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </button>
                            </div>
                            <h5>Room Details</h5>
                            <div class="d-flex flex-column bd-highlight">
                              <div class="bd-highlight">Bed: 1</div>
                              <div class="bd-highlight">Closet: Large</div>
                              <div class="bd-highlight">Comfort Room: 1</div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
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
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/chart.js"></script>
  <!-- End custom js for this page-->
</body>

</html>