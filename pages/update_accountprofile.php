<?php
include_once '../db/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['edid'];
    $name = $_POST['username'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $uid = $_POST['uid'];
    $pwd = $_POST['password'];

    
    updateAccount($conn, $name, $contact, $gender, $uid, $pwd, $id);
} else {
    
    header("Location: ../pages/accountprofile.php?status='error'");
    exit();
}

function updateAccount($conn, $name, $contact, $gender, $uid, $pwd, $id){
  
    $sql = "SELECT uid, pwd FROM users WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accountprofile.php?status=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $db_uid, $db_pwd);
    mysqli_stmt_fetch($stmt);

    // If UID and password are the same, don't update
    if($uid == $db_uid && password_verify($pwd, $db_pwd)) {
        // Redirect back with a status indicating no changes were made
        header("Location: ../pages/accountprofile.php?status=nochanges");
        exit();
    }

    // If UID or password are different, proceed with updating the account
    mysqli_stmt_close($stmt);

    // Check if the UID is taken by other users (except the current one)
    $sql = "SELECT id FROM users WHERE uid=? AND id != ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accountprofile.php?status=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If a user with the UID already exists (except the current one), redirect back with an error status
    if(mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: ../pages/accountprofile.php?status=uidtaken");
        exit();
    }

    // If UID is not taken and UID/pwd are different, proceed with updating the account
    mysqli_stmt_close($stmt);

    // Prepare the UPDATE query
    $sql = "UPDATE users SET name=?, contact=?, gender=?, uid=?, pwd=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accountprofile.php?status=stmtfailed");
        exit();
    }

    // Hash the password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $contact, $gender, $uid, $hashedPwd, $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect back to the accounts page with a success status parameter
    header("Location: ../pages/accountprofile.php?status=updated");
    exit();

    echo "<script>window.location.reload();</script>";
}

?>
