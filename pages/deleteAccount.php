<?php
include_once '../db/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    // Perform the deletion query
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        // Return a success response
        echo "success";
    } else {
        // Return an error response
        http_response_code(500);
        echo "Error: Statement preparation failed.";
    }
} else {
    http_response_code(400);
    echo "Bad Request";
}
?>
