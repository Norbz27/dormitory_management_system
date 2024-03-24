<?php
include_once 'header.php';
include_once 'tenantsfunc.php'; // Include the tenantfunc.php file
include_once '../pages/auth/dbh.class.php'; // Include the database connection file

$dbh = new Dbh();
$pdo = $dbh->connect();
$users = getUsers($pdo);
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
        <img src="../images/profile.webp" alt="Profile Picture" width="180px" class="img-fluid rounded-circle">
    </div>
    
    <!-- Profile and Room Selection -->
    <div class="form-group">
        <label for="profileSelect">Select User:</label>
        <select class="form-control" id="profileSelect">
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="userType">User Type:</label>
        <select class="form-control" id="userType">
            <option value="Student">Student</option>
            <option value="Teacher">Teacher</option>
            <option value="Staff">Staff</option>
        </select>
    </div>
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date">
    </div>
    <div class="form-group">
        <label for="roomSelect">Select Room:</label>
        <select class="form-control" id="roomSelect">
            <option>Room 1</option>
            <option>Room 2</option>
            <option>Room 3</option>
        </select>
    </div>
</div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>

                    </div>
                </div>
            </div>

            <div class="search-box mb-3">
                <input type="text" class="form-control" placeholder="Search...">
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
                                    <col style="width: auto;"> 
                                    <col style="width: 20px;"> 
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Room</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view-btn" href="" data-toggle="modal" data-target="#viewAccountModal">View</a>
                                                    <a class="dropdown-item delete-btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>101</td>
                                        <td></td>
                                        <td>Jacob</td>
                                        <td>Male</td>
                                        <td>53275531</td>
                                        <td><span class="badge badge-warning">Inactive</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view-btn" href="" data-toggle="modal" data-target="#viewAccountModal">View</a>
                                                    <a class="dropdown-item delete-btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
<script>
$(document).ready(function () {
        // Function to update tenant's name based on selected profile
        $('#profileSelect').on('change', function () {
            var selectedProfile = $(this).val();
            var selectedTenant = <?php echo json_encode($tenants); ?>.find(tenant => tenant.id == selectedProfile);
            $('#tenantNamePlaceholder').text(selectedTenant.name);
        });

        // Function to filter table rows based on search input
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });

</script>
    <?php include_once 'footer.php' ?>

