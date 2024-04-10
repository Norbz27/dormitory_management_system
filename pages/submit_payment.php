<?php
include_once '../db/db_conn.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $month_from = $_POST['month_of'];
    $month_to = $_POST['month_to'];
    $amount = $_POST['amount'];
    $month_of = $month_from ." - ". $month_to;

    // Upload image
    $target_dir = "assets/";
    $originalFileName = basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

    // Generate a random string
    $randomString = bin2hex(random_bytes(8));

    // Create a new filename with random string appended
    $newFileName = $randomString . '_' . $originalFileName;

    // Set the target file with the new filename
    $target_file = $target_dir . $newFileName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // Exclude "assets/" prefix from $target_file
    $relative_path = substr($target_file, strlen($target_dir));
    
    // Insert data into database
    $date = date("Y-m-d"); // Get current date

    $status = 'Pending'; // Assign 'Pending' to a variable

    $stmt = $conn->prepare("INSERT INTO payments (user_id, amount, receipt_img, month_of, date, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("idssss", $_SESSION['userid'], $amount, $relative_path, $month_of, $date, $status); // Pass the variable to bind_param
    
    if ($stmt->execute()) {
        // Success
        header("Location: ../pages/payments-user.php?status=success");
    } else {
        // Error
        header("Location: ../pages/payments-user.php?status=stmtfailed");
    }
    
    $stmt->close();
    $conn->close();
}
?>
