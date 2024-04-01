<?php
session_start(); // Start the session

if (isset($_SESSION['userid']) && isset($_FILES['profile'])) {
    $userId = $_SESSION['userid'];
    $file = $_FILES['profile'];

    // Check if there was an error with the file upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading file.";
        exit();
    }

    // Define allowed file types
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

    // Get file extension
    $fileName = $file['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file extension is allowed
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Invalid file format. Please upload an image file (jpg, jpeg, png, gif).";
        exit();
    }

    // Define directory to save uploaded files
    $uploadDir = 'assets/';

    // Create a unique filename
    $newFileName = $userId . '_profile.' . $fileExtension;

    // Define the path to save the uploaded file
    $destPath = $uploadDir . $newFileName;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($file['tmp_name'], $destPath)) {
        // Update the database record for the user's profile picture
        require_once '../pages/auth/dbh.class.php';
        try {
            $dbh = new Dbh();
            $conn = $dbh->connect();

            // Update the user's profile picture filename in the database
            $sql = "UPDATE users SET display_img = :display_img WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':display_img', $newFileName);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            // Redirect back to the profile page or wherever you want
            header("Location: accountprofile-inc.php");
            exit();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        } finally {
            // Close the database connection
            $conn = null;
        }
    } else {
        echo "Failed to move uploaded file.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
