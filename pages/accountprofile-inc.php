<?php
require_once '../pages/auth/dbh.class.php';

// Check if the ID is provided in the session
if(isset($_SESSION['userid'])) { // Change 'id' to 'userid'
    $id = $_SESSION['userid']; // Change 'id' to 'userid'

    try {
        // Create a new instance of Dbh and establish a database connection
        $dbh = new Dbh();
        $conn = $dbh->connect();

        // Fetch data from the database based on the provided ID using PDO
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Check if the query executed successfully
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $row['name'];
            $contact = $row['contact'];
            $gender = $row['gender'];
            $uid = $row['uid'];
            $password = $row['pwd'];
            $status = $row['status'];

            // Set the user ID in the session (This line is not necessary since it's already set)
            // $_SESSION['userid'] = $id;
        } else {
            echo "No user found with the provided ID.";
            exit(); // Exit if no user found
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    echo "Way ID Utrohon ra siolom";
    exit(); 
}
?>