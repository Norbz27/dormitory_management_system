<?php
include_once 'header.php';
include_once '../db/db_conn.php';

// Fetch data from the database
$totalRoomsQuery = "SELECT COUNT(*) AS total_rooms FROM room_details";
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$totalTenantsQuery = "SELECT COUNT(*) AS total_tenants FROM tenants";
$totalIncomeQuery = "SELECT SUM(amount) AS total_income FROM payments";

$resultRooms = mysqli_query($conn, $totalRoomsQuery);
$resultUsers = mysqli_query($conn, $totalUsersQuery);
$resultTenants = mysqli_query($conn, $totalTenantsQuery);
$resultIncome = mysqli_query($conn, $totalIncomeQuery);

$rowRooms = mysqli_fetch_assoc($resultRooms);
$rowUsers = mysqli_fetch_assoc($resultUsers);
$rowTenants = mysqli_fetch_assoc($resultTenants);
$rowIncome = mysqli_fetch_assoc($resultIncome);

// Transaction History
if ($_SESSION["username"] != 'admin') {
  $user_id = $_SESSION["userid"];
  $sql_transactions = "SELECT * FROM payments WHERE user_id = $user_id ORDER BY payment_id DESC LIMIT 5";
  $result_transactions = $conn->query($sql_transactions);
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
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card tale-bg">
            <div class="card-people mt-auto">
              <img src="../images/dashboard/people.svg" alt="people">
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
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
                  <p class="mb-4">Total Income</p>
                  <p class="fs-30 mb-2"><?php echo $rowIncome['total_income']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card tale-bg">
            <div class="card-people mt-auto">
              <img src="../images/dashboard/people.svg" alt="people">
            </div>
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
                    <thead>
                      <tr>
                        <th>Payment ID</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result_transactions->num_rows > 0) {
                        while ($row = $result_transactions->fetch_assoc()) {
                          ?>
                          <tr>
                            <td><?php echo $row['payment_id']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo date('F Y', strtotime($row['month_of'])); ?></td>
                            <td><?php echo date('F d, Y', strtotime($row['date'])); ?></td>
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

<!-- plugins:js -->
<script src="../vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../vendors/chart.js/Chart.min.js"></script>
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="js/dataTables.select.min.js"></script>

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
<!-- End custom js for this page-->
</body>

</html>
