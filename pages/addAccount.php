<?php

 if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $gender = $_POST["gender"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once '../../db/db_conn.php';
    require_once '../pages/auth/register_function.php';

    if(emptyInputSignup($name, $contact, $gender, $uid, $pwd) !== false){
        header("Location: ../pages/accounts.php?error=emptyinput");
        exit();
        echo "<div>empty</div>";
    }
    if(invalidUid($uid) !== false){
        header("Location: ../pages/accounts.php?error=invaliduid");
        exit();
        echo "<div>invalid</div>";
    }
    if(uidExist($conn, $uid) !== false){
        header("Location: ../pages/accounts.php?error=usernametaken");
        exit();
        echo "<div>invalid</div>";
    }

    createUser($conn, $name, $contact, $gender, $uid, $pwd);

 }else{
    header("Location: ../pages/accounts.php");
    echo "<div>invalid</div>";
 }