<?php
require_once '../pages/auth/dbh.class.php';
session_start();

// Handle file upload if a new profile picture is submitted
if(isset($_FILES['profile'])) {
    $file = $_FILES['profile'];
    $id = $_SESSION['userid'];

    // Create a new instance of Dbh and establish a database connection
    $dbh = new Dbh();
    $conn = $dbh->connect();

    if(!$conn) {
        throw new Exception("Database connection failed.");
    }

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
    $newFileName = $id . '_profile.' . $fileExtension;

    // Define the path to save the uploaded file
    $destPath = $uploadDir . $newFileName;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($file['tmp_name'], $destPath)) {
        // Update the user's profile picture filename in the database
        try {
            // Update the user's profile picture filename in the database
            $sql = "UPDATE users SET display_img = :display_img WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':display_img', $newFileName);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Update the $_SESSION variable to reflect the new profile picture filename
            $_SESSION['displayImg'] = $newFileName;
            
            // Redirect back to accountprofile.php
            header('Location: accountprofile.php');
            exit();
        } catch (PDOException $e) {
            echo "Failed to update profile picture: " . $e->getMessage();
            exit();
        }
    } else {
        echo "Error moving uploaded file.";
        exit();
    }
}
?>
