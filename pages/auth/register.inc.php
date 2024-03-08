<?php

 if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $gender = $_POST["gender"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once '../../db/db_conn.php';
    require_once 'register_function.php';

    if(emptyInputSignup($name, $contact, $gender, $uid, $pwd) !== false){
        header("Location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($uid) !== false){
        header("Location: ../signup.php?error=invaliduid");
        exit();
    }
    if(uidExist($conn, $uid) !== false){
        header("Location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $contact, $gender, $uid, $pwd);

 }else{
    header("Location: ../signup.php");
 }