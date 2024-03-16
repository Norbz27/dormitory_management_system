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
