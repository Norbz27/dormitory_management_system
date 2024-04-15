<?php
require_once('../db/db_conn.php');
// Check if tenantId and status are set in POST request
if(isset($_POST['tenantId']) && isset($_POST['status'])) {
    // Get tenantId and status from POST request
    // Get tenant ID and status from POST request
    $tenantId = $_POST['tenantId'];
    $status = $_POST['status']; // Assuming the status is 'Inactive'

    // Retrieve user ID from tenants table
    $sql = "SELECT user_id FROM tenants WHERE tenants_id = $tenantId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["user_id"];

        // Update status in the users table
        $sql = "UPDATE users SET status = '$status' WHERE id = $userId";

        if ($conn->query($sql) === TRUE) {
            echo "Tenant status updated successfully";
        } else {
            echo "Error updating tenant status: " . $conn->error;
        }
    } else {
        echo "No tenant found with ID: $tenantId";
    }

    $conn->close();
} else {
    // If tenantId or status are not set, return error response
    $response = array('success' => false, 'message' => 'Invalid request.');
    echo json_encode($response);
}
?>
