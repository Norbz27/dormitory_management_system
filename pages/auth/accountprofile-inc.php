<?php
session_start();

include "dbh.class.php";

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    include "login.class.php";
    exit();
}

// Fetch data from the database
$sql = "SELECT * FROM users WHERE username = '{$_SESSION['username']}'";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $age = $row['age'];
    $contact = $row['contact']; // Add this line to fetch contact
    $gender = $row['gender']; // Add this line to fetch gender
    $uid = $row['uid']; // Add this line to fetch uid
    $password = $row['password']; // Add this line to fetch password
    $status = $row['status']; // Add this line to fetch status
    // Add more fields as needed
} else {
    // Handle no results found
}

// Close the database connection
mysqli_close($conn);
?>
