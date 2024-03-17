<?php
// Include the necessary database connection file
require_once '../pages/auth/dbh.class.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data sent via POST
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $uid = $_POST['uid'];

    // Check if the received data is valid (perform additional validation if necessary)

    try {
        // Create a new instance of Dbh and establish a database connection
        $dbh = new Dbh();
        $conn = $dbh->connect();

        // Prepare the SQL statement to update the user profile
        $sql = "UPDATE users SET name = :username, contact = :contact, gender = :gender WHERE uid = :uid";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':uid', $uid);

        // Execute the update statement
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
            // Return a success message (this will be sent back to the AJAX success callback)
            echo "Profile updated successfully!";
        } else {
            // Return an error message if no rows were affected (this will be sent back to the AJAX error callback)
            echo "Failed to update profile. No rows affected.";
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    // Return an error message if the request method is not POST
    echo "Invalid request method.";
}
?>
