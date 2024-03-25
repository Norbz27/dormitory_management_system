<?php
// Include database connection
include_once '../db/db_conn.php';

// Check if user ID is provided via POST
if(isset($_POST['tenantId'])) {
    // Sanitize the input to prevent SQL injection
    $tenantId = mysqli_real_escape_string($conn, $_POST['tenantId']);

    // Query to fetch user information based on user ID
    $sql = "SELECT t.tenants_id, r.room_name, u.display_img, u.id, u.name, u.contact, u.gender, r.floor_belong, ut.monthly_rate, ut.description, t.Date FROM tenants t LEFT JOIN users u ON t.user_id = u.id LEFT JOIN user_type ut ON t.user_type = ut.user_type_id LEFT JOIN room_details r ON t.room_id = r.room_id WHERE t.tenants_id = 125;";
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Fetch user data
        $userData = mysqli_fetch_assoc($result);
        // Close the database connection
        mysqli_close($conn);
        // Return user data as JSON response
        echo json_encode($userData);
    } else {
        // Handle query error
        echo json_encode(array('error' => 'Failed to fetch user information'));
    }
} else {
    // Handle case where user ID is not provided
    echo json_encode(array('error' => 'User ID not provided'));
}
?>
