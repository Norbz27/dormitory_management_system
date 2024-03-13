<?php

if (isset($_POST["submit"])) {
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "dbh.class.php";
    include "login.class.php";
    include "login-contr.class.php";
    $login = new LoginContr($uid, $pwd);

    // Assuming you have verified the user's credentials and obtained the user ID
    // Set the user ID in the session
    $_SESSION['userid'] = $id; // Replace $id with the actual user ID obtained from the database

    $login->loginUser();

    // Redirect to the next page with the user ID as a parameter in the URL
    header("index.php" . $_SESSION['userid'] . "&error=none");
    exit();
}
