<?php
include_once 'header.php';
include_once '../db/db_conn.php';

// Fetch data from the database
$totalRoomsQuery = "SELECT COUNT(*) AS total_rooms FROM room_details";
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$totalTenantsQuery = "SELECT COUNT(*) AS total_tenants FROM tenants";
$totalPendingQuery = "SELECT COUNT(*) AS totalPendingPaid FROM payments WHERE status = 'Pending'";

$resultRooms = mysqli_query($conn, $totalRoomsQuery);
$resultUsers = mysqli_query($conn, $totalUsersQuery);
$resultTenants = mysqli_query($conn, $totalTenantsQuery);
$resultPending = mysqli_query($conn, $totalPendingQuery);

$rowRooms = mysqli_fetch_assoc($resultRooms);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$rowTenants = mysqli_fetch_assoc($resultTenants);
$rowPending = mysqli_fetch_assoc($resultPending);

// Transaction History
if ($_SESSION["username"] != 'admin') {
  $user_id = $_SESSION["userid"];
  $sql_transactions = "SELECT * FROM payments WHERE user_id = $user_id ORDER BY date ASC LIMIT 5";
  $result_transactions = $conn->query($sql_transactions);
}
?>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="../css/style.css">
<?php 
if ($_SESSION["username"] != 'admin') {
?>
<style>
.head-day {
  font-size: 8em;
  line-height: 1;
  color: #fff; }

.head-month {
  font-size: 2em;
  line-height: 1;
  color: #fff;
  font-size: 14px;
  text-transform: uppercase; }
</style>
<?php 
} else {
?>
<style>
.head-day {
  font-size: 3em;
  line-height: 1;
  color: #fff; }

.head-month {
  line-height: 1;
  color: #fff;
  font-size: 13px;
  text-transform: uppercase; }
</style>
<?php
}
?>
<style>
  .card-data {
    height: 150px;
  }
</style>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <?php echo $_SESSION["usersname"] ?> </h3>
          </div>
        </div>
      </div>
    </div>
    <?php if ($_SESSION["username"] == 'admin') { ?>
      <div class="row">
        <div class="col-md-6">
            <section class="ftco-section">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="elegant-calencar d-md-flex">
                      <div class="wrap-header d-flex align-items-center">
                        <p id="reset">reset</p>
                        <div id="header" class="p-0">
                          <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                          <div class="head-info">
                              <div class="head-day" ></div>
                              <div class="head-month"></div>
                          </div>
                          <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                        </div>
                      </div>
                      <div class="calendar-wrap">
                        <table id="calendar">
                          <thead>
                              <tr>
                                  <th>Sun</th>
                                  <th>Mon</th>
                                  <th>Tue</th>
                                  <th>Wed</th>
                                  <th>Thu</th>
                                  <th>Fri</th>
                                  <th>Sat</th>
                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
        </div>
        <div class="col-md-6 grid-margin transparent">
          <div class="row">
            <div class="col-md-12 mb-3" style="text-align: right;">
              <button type="button" class="btn btn-none btn-icon-text btn-sm" style="color: #4B49AC;" id="notifyBtn1">
                  <i class="icon-bell btn-icon-prepend"></i>
                  Notify Tenants
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent card-data">
              <div class="card card-tale">
                <div class="card-body">
                  <p class="mb-4">Total Rooms</p>
                  <p class="fs-30 mb-2"><?php echo $rowRooms['total_rooms']; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent card-data">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Total Users</p>
                  <p class="fs-30 mb-2"><?php echo $rowUsers['total_users']; ?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent card-data">
              <div class="card card-light-blue">
                <div class="card-body">
                  <p class="mb-4">Total Tenants</p>
                  <p class="fs-30 mb-2"><?php echo $rowTenants['total_tenants']; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card transparent card-data">
              <div class="card card-light-danger">
                <div class="card-body">
                  <p class="mb-4">Pending Payments</p>
                  <p class="fs-30 mb-2"><?php echo $rowPending['totalPendingPaid']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <?php } else { ?>
      
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="col-md-12">
            <section class="ftco-section">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="elegant-calencar d-md-flex">
                      <div class="wrap-header d-flex align-items-center">
                        <p id="reset">reset</p>
                        <div id="header" class="p-0">
                          <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                          <div class="head-info">
                              <div class="head-day"></div>
                              <div class="head-month"></div>
                          </div>
                          <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                        </div>
                      </div>
                      <div class="calendar-wrap">
                        <table id="calendar">
                          <thead>
                              <tr>
                                  <th>Sun</th>
                                  <th>Mon</th>
                                  <th>Tue</th>
                                  <th>Wed</th>
                                  <th>Thu</th>
                                  <th>Fri</th>
                                  <th>Sat</th>
                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      
      <div class="row">
        <!-- Transaction History -->
        <div class="col-md-12 grid-margin transparent">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Transaction History</h4>
                <div class="table-responsive">
                  <table class="table">
                    <colgroup>
                        <col style="width: auto;"> 
                        <col style="width: auto;"> 
                        <col style="width: auto;"> 
                        <col style="width: 100px;"> 
                    </colgroup>
                    <thead>
                      <tr>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result_transactions->num_rows > 0) {
                        while ($row = $result_transactions->fetch_assoc()) {
                          $badge_color = ($row["status"] == 'Verified') ? 'badge-success' : 'badge-danger';
                          $formattedAmount = number_format($row['amount'], 2);
                          ?>
                          <tr>
                            <td><?php echo $formattedAmount; ?></td>
                            <td><?php echo $row['month_of']; ?></td>
                            <td><?php echo date('F d, Y', strtotime($row['date'])); ?></td>
                            <td><?php echo $row['reason']; ?></td>
                            <td><span class="badge <?php echo $badge_color; ?>"><?php echo $row['status']; ?></span></td>
                          </tr>
                        <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="4">No transactions found.</td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    <?php } ?>
  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<script>
  $(document).ready(function() {
    // When Notify button is clicked
    $('#notifyBtn1').click(function() {
        // Make AJAX request to your PHP script
        $.ajax({
            url: 'sendsmsapi.php', // Replace 'send_sms.php' with the path to your PHP script
            type: 'POST',
            success: function(response) {
                // Handle success response if needed
                console.log(response);
                swal({
                    title: "Success",
                    text: "SMS sent to tenants successfully!",
                    icon: "success",
                    button: false,
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                swal({
                    title: "Error",
                    text: "Failed to send SMS to tenants.",
                    icon: "error",
                    button: false,
                });
            }

        });
    });
});
</script>
  <script src="../js/main.js"></script>
  <?php include_once 'footer.php' ?>
