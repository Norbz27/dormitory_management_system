<?php
include "dbh.class.php";

// Check if the ID is provided (you may get it from URL or any other source)
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the database based on the provided ID
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
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
} else {
    echo "Way ID Tanga bobo.";
    exit(); 
}

mysqli_close($conn);
?>
