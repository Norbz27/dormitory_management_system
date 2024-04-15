<?php

if (isset($_POST["submit"])) {
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "dbh.class.php";
    include "login.class.php";
    include "login-contr.class.php";
    $login = new LoginContr($uid, $pwd);

    // Track login attempts before authenticating user
    $login->trackLoginAttempts($_SERVER['REMOTE_ADDR']);

    $login->loginUser();

    // Redirect to the next page with the user ID as a parameter in the URL
    header("Location: index.php?userid=" . $_SESSION['userid'] . "&error=none");
    exit();
}