<?php
    include_once '../db/db_conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include your database connection code here
        // Replace 'your_db_connection_file.php' with the actual file name
    
        // Retrieve form data
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $gender = $_POST['gender'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        if (isset($_FILES["adprofile"]) && $_FILES["adprofile"]["error"] === UPLOAD_ERR_OK) {
            // Upload image
            $target_dir = "assets/";
            $originalFileName = basename($_FILES["adprofile"]["name"]);
            $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
    
            // Generate a random string
            $randomString = bin2hex(random_bytes(8));
    
            // Create a new filename with random string appended
            $newFileName = $randomString . '_' . $originalFileName;
    
            // Set the target file with the new filename
            $target_file = $target_dir . $newFileName;
    
            move_uploaded_file($_FILES["adprofile"]["tmp_name"], $target_file);
            
            // Exclude "assets/" prefix from $target_file
            $relative_path = substr($target_file, strlen($target_dir));
    
            
            addNewAccount($conn, $relative_path, $name, $contact, $gender, $uid, $pwd);
        }
        
    } else {
        // Redirect to the signup page if the form is not submitted
        header("Location: ../pages/accounts.php");
        exit();
    }
    
    function addNewAccount($conn, $img , $name, $contact, $gender, $uid, $pwd){
        $sql = "INSERT INTO users (display_img, name, contact, gender, uid, pwd, status) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/accounts.php?status=stmtfailed");
            exit();
        }
    
        $status = "New";
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
        mysqli_stmt_bind_param($stmt, "sssssss", $img, $name, $contact, $gender, $uid, $hashedPwd, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        // Redirect back to the accounts page with a success status parameter
        header("Location: ../pages/accounts.php?status=success");
        exit();
    }
    
    
?>