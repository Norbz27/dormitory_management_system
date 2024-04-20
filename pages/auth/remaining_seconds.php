<?php
// Include the Dbh class to establish a database connection
require_once 'Dbh.class.php';

// Create a new instance of the Dbh class to connect to the database
$dbh = new Dbh();
$conn = $dbh->connect();

// Check if the IP address is provided in the query string
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];

    // Calculate the login cooldown time (60 seconds ago)
    $cooldownTime = time() - 60;

    // Prepare and execute the SQL query to fetch the last login attempt time
    $stmt = $conn->prepare("SELECT MAX(login_time) AS last_login FROM ip_details WHERE ip = '$ip'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $last_login_time = $row['last_login'];

    $current_time = time();
    $login_time = $last_login_time + 60; // 60 seconds time window
    $remaining_time = $login_time - $current_time;


    // Return the remaining seconds as JSON
    header('Content-Type: application/json');
    echo json_encode(['remainingSeconds' => $remaining_time]);
} else {
    // IP address not provided, return an error message
    header('Content-Type: application/json');
    echo json_encode(['error' => 'IP address not provided']);
}

// Close the database connection
$conn = null;
?>