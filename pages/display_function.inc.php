<?php

include_once '../db/db_conn.php';

function getRoom1($floor) {
    global $conn;

    // Perform the query to fetch paginated rows from the "patients" table
    $sql = "SELECT room_details.*, tenants.tenants_id, (room_details.occupy_num - SUM(CASE WHEN users.status != 'Inactive' THEN 1 ELSE 0 END)) AS available_occupation FROM room_details LEFT JOIN tenants ON room_details.room_id = tenants.room_id LEFT JOIN users ON tenants.user_id = users.id WHERE room_details.floor = $floor GROUP BY room_details.room_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch all rows into an associative array
        $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of patients
        return $patients;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
        return array();
    }
}

function getAnnouncements() {
    global $conn;

    // Perform the query to fetch paginated rows from the "patients" table
    $sql = "SELECT * FROM announcements ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch all rows into an associative array
        $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of patients
        return $patients;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
        return array();
    }
}