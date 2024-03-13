<?php
    include_once '../db/db_conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include your database connection code here
        // Replace 'your_db_connection_file.php' with the actual file name
        include_once 'your_db_connection_file.php';
    
        // Retrieve form data
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $gender = $_POST['gender'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];
    
        // Call the addNewAccount function with the database connection and form data
        addNewAccount($conn, $name, $contact, $gender, $uid, $pwd);
    } else {
        // Redirect to the signup page if the form is not submitted
        header("Location: ../pages/accounts.php");
        exit();
    }
    
    function addNewAccount($conn, $name, $contact, $gender, $uid, $pwd){
        $sql = "INSERT INTO users (name, contact, gender, uid, pwd, status) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/accounts.php?status=stmtfailed");
            exit();
        }
    
        $status = "New";
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $contact, $gender, $uid, $hashedPwd, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        // Redirect back to the accounts page with a success status parameter
        header("Location: ../pages/accounts.php?status=success");
        exit();
    }
    
    
?>