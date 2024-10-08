<?php
include_once 'header.php';
include 'tenantsfunc.php';
include_once '../pages/auth/dbh.class.php'; 

$dbh = new Dbh();
$pdo = $dbh->connect();
$users = getUsers();
$rooms = getAvailableRooms(); 
$userTypes = getUserTypes();

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
                            <h3 class="font-weight-bold">Archive</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Modal -->
            <div class="modal fade" id="viewTenantModal" tabindex="-1" aria-labelledby="viewTenantModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Tenant Information</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="update_tenantInfo.php" method="post">
                            <div class="modal-body">
                                <div class="text-center mb-4">
                                    <!-- Image container for user profile picture -->
                                    <div id="">
                                        <img src="assets/profile.png" alt="Profile Picture" width="180px" id="edProfile" name="edProfile" class="img-fluid rounded-circle">
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="text" class="form-control" id="edid" name="edid" hidden>
                                    <div class="col-md-12"><h6><strong>Personal Information</strong></h6></div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tenantName" class="form-label">Name:</label>
                                            <input type="text" class="form-control" id="edtenantName" name="edtenantName" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender:</label>
                                            <input type="text" class="form-control" id="edgender" name="edgender" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactNo" class="form-label">Contact No.:</label>
                                            <input type="text" class="form-control" id="edcontactNo" name="edcontactNo" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="eduserType" class="form-label">Tenant Type:</label>
                                            <select class="form-control" id="eduserType" name="eduserType" disabled>
                                                <?php foreach ($userTypes as $type): ?>
                                                    <option value="<?php echo $type['tenant_type_id']; ?>"><?php echo $type['description']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="startDate" class="form-label">Start Date:</label>
                                            <input type="date" class="form-control" id="edstartDate" name="edstartDate" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edEquipments" class="form-label">Equipment:</label>
                                            <input type="text" class="form-control" id="edEquipments" name="edEquipments" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12"><h6><strong>Room Information</strong></h6></div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edroomName" class="form-label">Room No.:</label>
                                            <select class="form-control" id="edroomName" name="edroomName" disabled>
                                                <?php foreach ($rooms as $room): ?>
                                                    <!-- Embed floor belong data as data attribute -->
                                                    <option value="<?php echo $room['room_id']; ?>" data-floor-belong="<?php echo $room['floor']; ?>"><?php echo $room['room_no']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="monthlyRate" class="form-label">Monthly Rate:</label>
                                            <input type="text" class="form-control" id="edmonthlyRate" name="edmonthlyRate" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="totalFee" class="form-label">Total Fee:</label>
                                            <input type="text" class="form-control" id="edtotalFee" name="edtotalFee" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="floorBelong" class="form-label">Floor:</label>
                                            <input type="text" class="form-control" id="edfloorBelong" name="edfloorBelong" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="additionalFee" class="form-label">Additional Fee:</label>
                                            <input type="text" class="form-control" id="edadditionalFee" name="edadditionalFee" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" name="editTenantBtn" class="btn btn-primary" id="editTenantBtn">Edit Tenant</button>
                                <button type="submit" name="saveTenant" class="btn btn-primary" id="saveTenant"  style="display: none;">Save</button>
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
                                    <col style="width: auto;"> 
                                    <col style="width: 20px;"> 
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Room</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php getInactiveTenants()?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      feather.replace();
    </script>

<script>
// Your JavaScript code here
$(document).ready(function () {

    var tenants = <?php echo json_encode($users); ?>;

    $("#searchInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
<script src="functions.js"></script>
<script>
    <?php
        if ($status === 'success') {
            echo 'swal({
                title: "Success",
                text: "New tenant have been added!",
                icon: "success",
                button: false,
              });
              ';
        } elseif ($status === 'stmtfailed') {
            echo 'swal({
                title: "Error",
                text: "No tenant have been added!",
                icon: "error",
                button: false,
              });
              ';
        } elseif ($status === 'updated') {
            echo 'swal({
                title: "Success",
                text: "Tenant Information have been Updated!",
                icon: "success",
                button: false,
              });
              ';
        }
    ?>
</script>
<script>
    // JavaScript to update profile picture when a user is selected from the dropdown
    document.getElementById('profileSelect').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var imageUrl = selectedOption.getAttribute('data-image');
        var profilePictureContainer = document.getElementById('profilePictureContainer');
        // Update the image source
        profilePictureContainer.innerHTML = '<img src="assets/' + imageUrl + '" alt="Profile Picture" width="180px" style="height: 180px"class="img-fluid rounded-circle">';
    });
</script>

<?php include_once 'footer.php' ?>