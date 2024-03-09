<?php

session_start();

include_once '../db/db_conn.php';

    // Redirect to the login page
    header("Location: ../index.php");
    session_destroy();
    exit();
?>
