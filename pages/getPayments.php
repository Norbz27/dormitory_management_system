<?php
// Include database connection or connection initialization code
require_once('../db/db_conn.php');

// Check if user_id is set in the POST data
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Prepare SQL statement using a parameterized query
    $sql = "SELECT * FROM payments WHERE user_id = ? AND status = 'Verified' ORDER BY payment_id DESC LIMIT 5";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    // Bind user_id parameter to prepared statement
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute prepared statement
    mysqli_stmt_execute($stmt);

    // Get result set
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row["payment_id"] . '</td>
                    <td>' . $row["amount"] . '</td>
                    <td>' . date('F Y', strtotime($row['month_of'])) . '</td>
                    <td>' . date('F d, Y', strtotime($row['date'])) . '</td>
                    <td><span class="badge badge-success">' . $row["status"] . '</span></td>
                  </tr>';
        }
    } else {
        echo "<tr><td colspan='3'>No payment transactions found.</td></tr>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request";
}
?>
