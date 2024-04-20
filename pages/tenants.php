<?php
include_once 'header.php';
include 'tenantsfunc.php';
include_once '../pages/auth/dbh.class.php'; 

$dbh = new Dbh();
$pdo = $dbh->connect();
$users = getUsers($pdo);
$rooms = getAvailableRooms($pdo); 
$userTypes = getUserTypes($pdo);

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
                            <h3 class="font-weight-bold">Tenants</h3>
                        </div>
                        <div class="col-6 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button type="button" class="btn btn-primary btn-icon-text btn-sm" data-toggle="modal" data-target="#newTenant">
                                        <i class="icon-plus btn-icon-prepend"></i>
                                        New Tenant
                                    </button>
                                </div>
                            </div>
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
                                            <label for="tenantName" class="form-label">Tenant Name:</label>
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
                                                    <option value="<?php echo $type['user_type_id']; ?>"><?php echo $type['description']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="startDate" class="form-label">Start Date:</label>
                                            <input type="date" class="form-control" id="edstartDate" name="edstartDate" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edEquipments" class="form-label">Equipments::</label>
                                            <input type="text" class="form-control" id="edEquipments" name="edEquipments" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12"><h6><strong>Room Information</strong></h6></div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edroomName" class="form-label">Room Name:</label>
                                            <select class="form-control" id="edroomName" name="edroomName" disabled>
                                                <?php foreach ($rooms as $room): ?>
                                                    <!-- Embed floor belong data as data attribute -->
                                                    <option value="<?php echo $room['room_id']; ?>" data-floor-belong="<?php echo $room['floor_belong']; ?>"><?php echo $room['room_name']; ?></option>
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
                                            <label for="floorBelong" class="form-label">Floor Belong:</label>
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

            <!-- Modal -->
            <div class="modal fade" id="newTenant">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">New Tenant</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Profile Picture Placeholder -->
                            <div class="text-center mb-3">
                                <!-- Image container for user profile picture -->
                                <div id="profilePictureContainer">
                                    <img src="assets/profile.png" alt="Profile Picture" width="180px" class="img-fluid rounded-circle">
                                </div>
                            </div>

                            <!-- Profile and Room Selection -->
                            <form id="new-tenants">
                                <div class="form-group">
                                    <label for="profileSelect">Select User:</label>
                                    <select class="form-control" id="profileSelect" name="profileSelect">
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?php echo $user['id']; ?>" data-image="<?php echo $user['display_img']; ?>"><?php echo $user['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="userType">Tenant Type:</label>
                                    <select class="form-control" id="userType" name="userType">
                                        <?php foreach ($userTypes as $type): ?>
                                            <option value="<?php echo $type['user_type_id']; ?>"><?php echo $type['description']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                                <div class="form-group">
                                    <label for="roomSelect">Select Room:</label>
                                    <select class="form-control" id="roomSelect" name="roomSelect">
                                        <?php foreach ($rooms as $room): ?>
                                            <option value="<?php echo $room['room_id']; ?>"><?php echo $room['room_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="addEquipments">Equipments:</label>
                                    <input type="text" class="form-control" id="addEquipments" name="addEquipments" placeholder="Ex. Rice cooker, TV,....">
                                </div>
                                <div class="form-group">
                                    <label for="date">Additional Fee:</label>
                                    <input type="text" class="form-control" id="addFee" name="addFee">
                                </div>
                                <div class="form-group">
                                    <label for="date">Monthly Rate:</label>
                                    <input type="text" class="form-control" id="addmonthlyrate" name="monthlyrate">
                                </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary" id="saveTenantBtn">Save</button>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php getAllTenants()?>
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
    <script src="functions.js"></script>