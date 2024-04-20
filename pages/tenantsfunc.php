<?php
include_once '../pages/auth/dbh.class.php';
include_once '../db/db_conn.php';

function getUsers() {
    try {
        $dbh = new Dbh();
        $pdo = $dbh->connect();
        
        // Modify the SQL query to check if users exist in tenants table
        $sql = "SELECT u.id, u.name, u.display_img FROM users u LEFT JOIN tenants t ON u.id = t.user_id WHERE t.user_id IS NULL AND u.status != 'admin'";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
        return []; 
    }
}


function getAvailableRooms() {
    try {
    
        $dbh = new Dbh();
        $pdo = $dbh->connect();
        
        $sql = "SELECT room_id, room_name, floor_belong FROM room_details WHERE status = 'available' OR status = 'lacking'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; 
    }
}

function getUserTypes() {
    try {
        $dbh = new Dbh();
        $pdo = $dbh->connect();

        $sql = "SELECT user_type_id, description FROM user_type";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return []; 
    }
}

function getAllTenants() {
    global $conn;
    $sql = "SELECT t.tenants_id, r.room_name, u.display_img, u.id, u.name, u.contact, u.status FROM tenants t LEFT JOIN users u ON t.user_id = u.id LEFT JOIN user_type ut ON t.user_type = ut.user_type_id LEFT JOIN room_details r ON t.room_id = r.room_id;";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Handle the query error
        die("Query failed: " . mysqli_error($conn));
    }


    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $badge_color = ($row["status"] == 'Tenant') ? 'badge-warning' : 'badge-danger';
            
            $profileImage = 'assets/profile.png';
            if($row["display_img"] !== NULL && $row["display_img"] !== "")
                $profileImage = 'assets/' . $row["display_img"];

            echo '<tr data-tenant-id="' . $row["tenants_id"] . '">
                    <td>' . $row["room_name"]. '</td>
                    <td><img src="' . $profileImage . '" style="width: 50px; height: 50px;"></td>
                    <td>' . $row["name"]. '</td>
                    <td>' . $row["contact"]. '</td>
                    <td><span class="badge ' . $badge_color . '">' . $row["status"]. '</span></td>
                    <td><div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view-btn" href="" data-toggle="modal" data-target="#viewTenantModal">View</a>
                            <a class="dropdown-item active-btn" href="#">Set as Active</a>
                            <a class="dropdown-item inactive-btn" href="#">Set as Inactive</a>
                            <a class="dropdown-item delete-btn" href="#">Delete</a>
                        </div>
                    </div></td>
                </tr>';
        }
    } else {
        echo "0 results";
    }

}
?>
<script>
    $(document).ready(function() {
        $('.inactive-btn').on('click', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tenantId = row.data('tenant-id');
            swal({
                title: "Are you sure?",
                text: "Once marked as inactive, this tenant account will be deactivated!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willInactive) => {
                if (willInactive) {
                    $.ajax({
                        url: 'updateTenantStatus.php',
                        type: 'POST',
                        data: {tenantId: tenantId, status: 'Inactive'}, // Pass status as Inactive
                        success: function(response) {
                            // Optionally update row's status cell with "Inactive"
                            row.find('.status').text('Inactive');
                            // Optionally display a success message
                            swal({
                                title: "Success",
                                text: "Tenant status updated to Inactive!",
                                icon: "success",
                                button: false,
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            swal({
                                title: "Error",
                                text: "Failed to update tenant status!",
                                icon: "error",
                                button: false,
                            });
                        }
                    });
                }
            });
        });
        $('.active-btn').on('click', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tenantId = row.data('tenant-id');
            swal({
                title: "Are you sure?",
                text: "Once marked as active, this tenant account will be activated!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willInactive) => {
                if (willInactive) {
                    $.ajax({
                        url: 'updateTenantStatus.php',
                        type: 'POST',
                        data: {tenantId: tenantId, status: 'Tenant'}, // Pass status as Inactive
                        success: function(response) {
                            // Optionally update row's status cell with "Inactive"
                            row.find('.status').text('Inactive');
                            // Optionally display a success message
                            swal({
                                title: "Success",
                                text: "Tenant status updated to Inactive!",
                                icon: "success",
                                button: false,
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            swal({
                                title: "Error",
                                text: "Failed to update tenant status!",
                                icon: "error",
                                button: false,
                            });
                        }
                    });
                }
            });
        });
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var tenantId = row.data('tenant-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this tenant record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'deleteTenant.php',
                        type: 'POST',
                        data: {tenantId: tenantId},
                        success: function(response) {
                            // Remove the row from the table
                            row.remove();
                            // Optionally display a success message
                            swal({
                                title: "Success",
                                text: "User deleted successfully!",
                                icon: "success",
                                button: false,
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            swal({
                                title: "Error",
                                text: "No account have been added!",
                                icon: "error",
                                button: false,
                            });
                        }
                    });
                }
            });
        });

        $('#editTenantBtn').on('click', function() {
            // Make specific input fields editable
            $('#eduserType, #roomName, #edadditionalFee, #edroomName ,#edmonthlyRate').prop('disabled', false);
            // Toggle visibility of buttons
            $('#editTenantBtn').hide();
            $('button[type="submit"]').show();
        });

        $('#close-btn').on('click', function() {
            // Make specific input fields editable
            $('#eduserType, #roomName, #edadditionalFee, #edroomName').prop('disabled', true)
            // Toggle visibility of buttons
            $('#editTenantBtn').show();
            $('button[type="submit"]').hide();
        });
       
        $('#viewTenantModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var tenantId = button.closest('tr').data('tenant-id'); // Extract user ID from data attribute
        var modal = $(this);

        // AJAX call to fetch user information
        $.ajax({
            url: 'viewTenantsInfo.php', // Modify the URL according to your setup
            type: 'POST',
            data: {tenantId: tenantId},
            success: function(response) {
                var tenantData = JSON.parse(response);

                // Populate modal fields with user data
                modal.find('#edid').val(tenantData.tenants_id);
                modal.find('#edProfile').attr('src', tenantData.display_img !== null ? 'assets/' + tenantData.display_img : 'assets/profile.png');
                modal.find('#edtenantName').val(tenantData.name);
                modal.find('#edgender').val(tenantData.gender);
                modal.find('#edcontactNo').val(tenantData.contact);
                modal.find('#eduserType').val(tenantData.user_type_id);
                modal.find('#edstartDate').val(tenantData.Date);
                modal.find('#edroomName').val(tenantData.room_id); // Set the value of the select element directly
                modal.find('#edfloorBelong').val(tenantData.floor_belong);
                modal.find('#edEquipments').val(tenantData.equipments);

                // Calculate total fee
                var monthlyRate = parseFloat(tenantData.monthlyrate);
                var additionalFee = parseFloat(tenantData.additional_fee);
                var totalFee = monthlyRate + additionalFee;

                modal.find('#edmonthlyRate').val(monthlyRate);
                modal.find('#edadditionalFee').val(additionalFee);
                modal.find('#edtotalFee').val(totalFee);
            },

            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                swal({
                    title: "Error",
                    text: "Failed to fetch user information!",
                    icon: "error",
                    button: false,
                });
            }
        });
    });



    });

    $(document).ready(function() {
    // Function to update floor belong based on selected room name
    $('#roomName').on('change', function() {
        // Get the selected room ID and floor belong data
        var room_id = $(this).val();
        var floor_belong = $(this).find('option:selected').data('floor-belong');

        // Update the floor belong field with the fetched value
        $('#edfloorBelong').val(floor_belong);
    });
});

</script>
