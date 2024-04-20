<?php
// Include your database connection file
include_once '../db/db_conn.php';

// Check if the payment ID is provided and it's not empty
if(isset($_POST['payment_id']) && !empty($_POST['payment_id'])) {
    // Sanitize the input to prevent SQL injection
    $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);
    
    // SQL query to delete the payment record
    $sql = "DELETE FROM payments WHERE payment_id = '$payment_id'";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // If deletion is successful, return success response
        echo json_encode(array("status" => "success", "message" => "Payment deleted successfully."));
    } else {
        // If there's an error, return error response
        echo json_encode(array("status" => "error", "message" => "Error deleting payment: " . mysqli_error($conn)));
    }
} else {
    // If payment ID is not provided, return error response
    echo json_encode(array("status" => "error", "message" => "Payment ID is missing."));
}
?>
