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

    // Call the updateAccount function with the database connection and form data
    updateAccount($conn, $name, $contact, $gender, $uid, $pwd, $id);
} else {
    // Redirect to the accounts page if the form is not submitted
    header("Location: ../pages/accounts.php");
    exit();
}

function updateAccount($conn, $name, $contact, $gender, $uid, $pwd, $id){
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
    if($uid == $db_uid && password_verify($pwd, $db_pwd)) {
        // Redirect back with a status indicating no changes were made
        header("Location: ../pages/accounts.php?status=nochanges");
        exit();
    }

    // If UID or password are different, proceed with updating the account
    mysqli_stmt_close($stmt);

    // Check if the UID is taken
    $sql = "SELECT id FROM users WHERE uid=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accounts.php?status=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If a user with the UID already exists, redirect back with an error status
    if(mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: ../pages/accounts.php?status=uidtaken");
        exit();
    }

    // If UID is not taken and UID/pwd are different, proceed with updating the account
    mysqli_stmt_close($stmt);

    // Prepare the UPDATE query
    $sql = "UPDATE users SET name=?, contact=?, gender=?, uid=?, pwd=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../pages/accounts.php?status=stmtfailed");
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
    header("Location: ../pages/accounts.php?status=updated");
    exit();
}

?>
