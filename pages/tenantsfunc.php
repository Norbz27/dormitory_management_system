<?php
include_once '../pages/auth/dbh.class.php';
include_once '../db/db_conn.php';

function getUsers() {
    try {
        
        $dbh = new Dbh();
       
        $pdo = $dbh->connect();
        
        $sql = "SELECT id, name FROM users"; 
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
        
        $sql = "SELECT room_id, room_name FROM room_details WHERE status = 'available'";
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
            $badge_color = ($row["status"] == 'New') ? 'badge-success' : 'badge-warning';
            echo '<tr data-tenant-id="' . $row["tenants_id"] . '">
                    <td>' . $row["room_name"]. '</td>
                    <td><img src="assets/' . $row["display_img"] . '" alt="User Image" style="width: 50px; height: 50px;"></td>
                    <td>' . $row["name"]. '</td>
                    <td>' . $row["contact"]. '</td>
                    <td><span class="badge ' . $badge_color . '">' . $row["status"]. '</span></td>
                    <td><div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view-btn" href="" data-toggle="modal" data-target="#viewAccountModal">View</a>
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
    });
</script>
