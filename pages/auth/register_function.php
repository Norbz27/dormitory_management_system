<?php

function emptyInputSignup($name, $contact, $gender, $uid, $pwd){
    $result = true;
    if(empty($name) || empty($contact) || empty($gender) || empty($uid) || empty($pwd)){
        $result = true;
    }else{
        $result = false;
    }return $result;
}

function invalidUid($uid){
    $result = true;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)){
        $result = true;
    }else{
        $result = false;
    }return $result;
}

function uidExist($conn, $uid){
    $sql = "SELECT * FROM users WHERE uid = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $contact, $gender, $uid, $pwd){
    $sql = "INSERT INTO users (name, contact, gender, uid, pwd, status) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $status = "New";
    $hasshedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $contact, $gender, $uid, $hasshedPwd, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: login.php?error=none");
    exit();
}