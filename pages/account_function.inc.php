<?php
    include_once '../db/db_conn.php';

    function getAllAccounts() {
        global $conn;
        $sql = "SELECT id, name, contact, gender, status FROM users WHERE status != 'admin'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $badge_color = ($row["status"] == 'New') ? 'badge-success' : 'badge-warning';
                echo '<tr data-user-id="' . $row["id"] . '">
                        <td>' . $row["name"]. '</td>
                        <td>' . $row["gender"]. '</td>
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
        var userId = row.data('user-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this account!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
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
    $(document).ready(function() {
        $('#editAccountBtn').on('click', function() {
            // Make specific input fields editable
            $('#edfullName, #edphoneNumber, #edusername, #edgender, #edpassword').prop('disabled', false);
            // Toggle visibility of buttons
            $('#editAccountBtn').hide();
            $('button[type="submit"]').show();
        });
    });


    // Fetch user information and populate the modal on view button click
    $('#viewAccountModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.closest('tr').data('user-id'); // Extract user ID from data attribute
        var modal = $(this);

        // AJAX call to fetch user information
        $.ajax({
            url: 'viewAccountInfo.php', // Modify the URL according to your setup
            type: 'POST',
            data: {userId: userId},
            success: function(response) {
                // Parse the JSON response
                var userData = JSON.parse(response);
                // Populate modal fields with user data
                modal.find('#edid').val(userId);
                modal.find('#edfullName').val(userData.name);
                modal.find('#edphoneNumber').val(userData.contact);
                modal.find('#edusername').val(userData.uid);
                modal.find('#edpassword').val(userData.pwd);
                // Populate gender dropdown with text
                var genderSelect = modal.find('#edgender');
                genderSelect.empty(); // Clear previous options
                var genderOptions = {
                    'Male': 'Male',
                    'Female': 'Female',
                    'Other': 'Other'
                };
                $.each(genderOptions, function(value, text) {
                    genderSelect.append($('<option></option>').val(value).text(text));
                });
                // Set selected gender
                genderSelect.val(userData.gender);
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

</script>