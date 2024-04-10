<?php
require_once '../pages/auth/dbh.class.php';

// Check if the ID is provided in the session
if(isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];

    try {
        // Create a new instance of Dbh and establish a database connection
        $dbh = new Dbh();
        $conn = $dbh->connect();

        if(!$conn) {
            throw new Exception("Database connection failed.");
        }

        // Fetch user data from the database
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
            $displayImg = $row['display_img']; // Get current profile picture filename
        } else {
            echo "No user found with the provided ID.";
            exit(); // Exit if no user found
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    } finally {
        // Close the database connection
        $conn = null;
    }

    
} else {
    echo "User ID not found";
    exit();
}

?>
