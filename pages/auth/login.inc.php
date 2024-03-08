<?php

if (isset($_POST["submit"])) {
    
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "dbh.class.php";
    include "login.class.php";
    include "login-contr.class.php";
    $login = new LoginContr($uid, $pwd);

    $login->loginUser();

    header("Location: ../index.php?error=none");
    exit();
}