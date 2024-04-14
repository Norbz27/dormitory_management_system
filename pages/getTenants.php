<?php
// Include database connection or connection initialization code
require_once('../db/db_conn.php');


if (isset($_POST['roomID'])) {
    $roomID = $_POST['roomID'];

    // Prepare SQL statement using a parameterized query
    $sql = "SELECT users.name FROM `tenants` INNER JOIN room_details ON tenants.room_id = room_details.room_id INNER JOIN users ON tenants.user_id = users.id WHERE room_details.room_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    // Bind user_id parameter to prepared statement
    mysqli_stmt_bind_param($stmt, "i", $roomID);

    // Execute prepared statement
    mysqli_stmt_execute($stmt);

    // Get result set
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        echo 'Tenants;';
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row["name"] . '</li>';
        }
        echo '</ul>';
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request";
}