<?php


include "dbh.class.php";

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    include "login.class.php";
    exit();
}

// Fetch data from the database
$sql = "SELECT * FROM users WHERE id = '{$_SESSION['id']}'";
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['name']; // assuming 'name' is the column name for username
    $contact = $row['contact'];
    $gender = $row['gender'];
    $uid = $row['uid'];
    $password = $row['pwd'];
    $age = $row['age']; // assuming 'age' is the column name for age
    $status = $row['status']; // assuming 'status' is the column name for status
    // Add more fields as needed
} else {
    echo "No records found in the database.";
}

mysqli_close($conn);
?>
