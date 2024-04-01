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

    // Handle file upload if a new profile picture is submitted
    if(isset($_FILES['profile'])) {
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
        $newFileName = $id . '_profile.' . $fileExtension;

        // Define the path to save the uploaded file
        $destPath = $uploadDir . $newFileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($file['tmp_name'], $destPath)) {
            // Update the user's profile picture filename in the database
            try {
                // Re-establish the database connection
                $conn = $dbh->connect();

                // Update the user's profile picture filename in the database
                $sql = "UPDATE users SET display_img = :display_img WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':display_img', $newFileName);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                // Update the $displayImg variable to reflect the new profile picture filename
                $displayImg = $newFileName;
            } catch (PDOException $e) {
                echo "Failed to update profile picture: " . $e->getMessage();
                exit();
            } finally {
                // Close the database connection
                $conn = null;
            }
        } else {
            echo "Failed to move uploaded file.";
            exit();
        }
    }
} else {
    echo "User ID not found";
    exit();
}
?>
