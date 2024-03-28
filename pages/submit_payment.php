<?php
include_once '../db/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $month_of = $_POST['month_of'];
    $amount = $_POST['amount'];
    
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

    $stmt = $conn->prepare("INSERT INTO payments (user_id, amount, receipt_img, month_of, date) VALUES (?, ?, ?, ?, ?)");
    $user_id = 1; // Assuming user_id is 1 for this example
    $stmt->bind_param("idsss", $user_id, $amount, $relative_path, $month_of, $date);    
    
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
