<?php
include_once '../db/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['edid'];
    $name = $_POST['edname'];
    $contact = $_POST['edcontact'];
    $gender = $_POST['edgender'];
    $uid = $_POST['eduid'];
    $pwd = $_POST['edpwd'];

    if (isset($_FILES["viewprofile"]) && $_FILES["viewprofile"]["error"] === UPLOAD_ERR_OK) {
        // Upload image
        $target_dir = "assets/";
        $originalFileName = basename($_FILES["viewprofile"]["name"]);
        $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        // Generate a random string
        $randomString = bin2hex(random_bytes(8));

        // Create a new filename with random string appended
        $newFileName = $randomString . '_' . $originalFileName;

        // Set the target file with the new filename
        $target_file = $target_dir . $newFileName;

        move_uploaded_file($_FILES["viewprofile"]["tmp_name"], $target_file);
        
        // Exclude "assets/" prefix from $target_file
        $relative_path = substr($target_file, strlen($target_dir));

        // Call the updateAccount function with the database connection and form data
        updateAccount($conn, $relative_path, $name, $contact, $gender, $uid, $pwd, $id);
    } else {
        // No new profile picture uploaded, use the existing one
        $img = getUserProfileImage($conn, $id);
        // Call the updateAccount function with the database connection and form data
        updateAccount($conn, $img, $name, $contact, $gender, $uid, $pwd, $id);
    }

    
} else {
    // Redirect to the accounts page if the form is not submitted
    header("Location: ../pages/accounts.php");
    exit();
}

function getUserProfileImage($conn, $id) {
    $sql = "SELECT display_img FROM users WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $display_img);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $display_img;
}

function updateAccount($conn, $img, $name, $contact, $gender, $uid, $pwd, $id){
    // Check if the UID and password are the same as those in the database
    $sql = "SELECT uid, pwd FROM users WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accounts.php?status=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $db_uid, $db_pwd);
    mysqli_stmt_fetch($stmt);

    // If UID and password are the same, don't update
    if(password_verify($pwd, $db_pwd) || $pwd == $db_pwd) {
        $sql = "UPDATE users SET display_img=?, name=?, contact=?, gender=?, uid=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/accounts.php?status=stmtfailed");
            exit();
        }

        // Hash the password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssssss", $img, $name, $contact, $gender, $uid, $id);

        // Execute the statement
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect back to the accounts page with a success status parameter
        header("Location: ../pages/accounts.php?status=updated");
        exit();
    }

    // If UID or password are different, proceed with updating the account
    mysqli_stmt_close($stmt);

    // Check if the UID is taken by other users (except the current one)
    $sql = "SELECT id FROM users WHERE uid=? AND id != ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accounts.php?status=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If a user with the UID already exists (except the current one), redirect back with an error status
    if(mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: ../pages/accounts.php?status=uidtaken");
        exit();
    }

    // If UID is not taken and UID/pwd are different, proceed with updating the account
    mysqli_stmt_close($stmt);

    // Prepare the UPDATE query
    $sql = "UPDATE users SET display_img=?, name=?, contact=?, gender=?, uid=?, pwd=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accounts.php?status=stmtfailed");
        exit();
    }

    // Hash the password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sssssss", $img, $name, $contact, $gender, $uid, $hashedPwd, $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect back to the accounts page with a success status parameter
    header("Location: ../pages/accounts.php?status=updated");
    exit();
}

?>
