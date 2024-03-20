<?php

function emptyInputSignup($name, $contact, $gender, $uid, $pwd, $dp){
    $result = false;

    if(empty($name) || empty($contact) || empty($gender) || empty($uid) || empty($pwd) || empty($dp)){
        $result = true;
    }
    return $result;
}


function invalidUid($uid){
    $result = true;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)){
        $result = true;
    }else{
        $result = false;
    }return $result;
}

function uidExist($conn, $uid){
    $sql = "SELECT * FROM users WHERE uid = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../auth/register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $contact, $gender, $uid, $pwd, $dp)
{
    // Check if a file was uploaded
    if ($dp !== null && $dp['error'] == 0 && is_uploaded_file($dp['tmp_name'])) {

        if ($dp['error'] !== UPLOAD_ERR_OK) {
            echo 'File upload error: ' . $dp['error'];
            exit; // Stop further execution
        }

        $uploadDir = '../assets/'; // Choose your upload directory
        $originalFileName = basename($dp['name']);

        // Generate a random string (you can use any suitable method)
        $randomString = bin2hex(random_bytes(8));

        // Combine the random string and original file name
        $newFileName = $randomString . '_' . $originalFileName;
        $uploadFile = $uploadDir . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($dp['tmp_name'], $uploadFile)) {
            // File has been successfully uploaded
            $fileName = $newFileName; // Store the new file name in the database
        } else {
            // Handle file upload error
            header("Location: ../auth/register.php?error=fileuploaderror");
            exit; // Stop further execution
        }
    } else {
        // No file was uploaded or there was an error
        $fileName = null; // Set to a default value or handle as needed
    }

    $sql = "INSERT INTO users (name, contact, gender, uid, pwd, status, display_img) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $status = "New";
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $name, $contact, $gender, $uid, $hashedPwd, $status, $fileName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: login.php?error=none");
    exit();
}