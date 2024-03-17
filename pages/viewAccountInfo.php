<?php
// Include database connection
include_once '../db/db_conn.php';

// Check if user ID is provided via POST
if(isset($_POST['userId'])) {
    // Sanitize the input to prevent SQL injection
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);

    // Query to fetch user information based on user ID
    $sql = "SELECT id, name, contact, gender, uid, pwd FROM users WHERE id = '$userId'";
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
