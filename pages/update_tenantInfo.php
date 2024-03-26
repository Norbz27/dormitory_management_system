<?php
include_once '../db/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['edid'];
    $userType = $_POST['eduserType'];
    $roomId = $_POST['roomName'];
    $additionalFee = $_POST['edadditionalFee'];

    // Call the updateTenant function with the database connection and form data
    updateTenant($conn, $userType, $roomId, $additionalFee, $id);
} else {
    header("Location: ../pages/tenants.php?status='error'");
    exit();
}

function updateTenant($conn, $userType, $roomId, $additionalFee, $id) {
    // Prepare the UPDATE query for the tenant table
    $sql = "UPDATE tenants SET user_type=?, room_id=?, additional_fee=? WHERE tenants_id=?";

    // Prepare and execute the statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../pages/tenants.php?status=stmtfailed");
        exit();
    }

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "siii", $userType, $roomId, $additionalFee, $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect back to the account profile page with a success status parameter
    header("Location: ../pages/tenants.php?status=updated");
    exit();
}
?>
