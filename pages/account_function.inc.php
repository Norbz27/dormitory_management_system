<?php
    include_once '../db/db_conn.php';

    function getAllAccounts() {
        global $conn;
        $sql = "SELECT id, name, contact, gender FROM users WHERE status != 'admin'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr data-user-id="' . $row["id"] . '">
                        <td>' . $row["name"]. '</td>
                        <td>' . $row["gender"]. '</td>
                        <td>' . $row["contact"]. '</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td><div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Edit</a>
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
            var userId = row.data('user-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this account!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'deleteAccount.php',
                    type: 'POST',
                    data: {userId: userId},
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