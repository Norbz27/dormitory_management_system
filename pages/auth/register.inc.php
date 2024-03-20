<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $gender = $_POST["gender"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    // Check if file upload is set and not empty
    if (isset($_FILES['display_picture']) && !empty($_FILES['display_picture']['name'])) {
        $dp = $_FILES["display_picture"];

        // Debugging code to check file upload
        var_dump($dp); // Check the contents of the $dp array
        if ($dp['error'] !== UPLOAD_ERR_OK) {
            echo 'File upload error: ' . $dp['error'];
            exit; // Stop further execution
        }
    } else {
        $dp = null; // Set to a default value if no file is uploaded
    }

    require_once '../../db/db_conn.php';
    require_once 'register_function.php';

    if (emptyInputSignup($name, $contact, $gender, $uid, $pwd, $dp) !== false) {
        header("Location: ../auth/register.php?error=emptyinput");
        exit();
    }
    if (invalidUid($uid) !== false) {
        header("Location: ../auth/register.php?error=invaliduid");
        exit();
    }
    if (uidExist($conn, $uid) !== false) {
        header("Location: ../auth/register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $contact, $gender, $uid, $pwd, $dp);

} else {
    header("Location: ../auth/register.php");
}