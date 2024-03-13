<?php
session_start();
include "dbh.class.php";

// Check if the ID is provided in the session
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

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
            $age = $row['age'];
            $status = $row['status'];
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
    echo "Bulok man kaw na jawa kaw balik saimo condition mali imo pag tawag bulok piste yawa animal";
    exit(); 
}
?>
