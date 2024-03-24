<?php
  include_once '../db/db_conn.php';
// Include your database connection file here if it's not already included

function getTenants($pdo) {
    // Query to fetch tenant data including names
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
