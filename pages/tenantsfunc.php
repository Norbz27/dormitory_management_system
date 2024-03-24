<?php
include_once '../pages/auth/dbh.class.php';

function getUsers() {
    try {
        // Create an instance of the Dbh class
        $dbh = new Dbh();
        // Call the connect method to establish a database connection
        $pdo = $dbh->connect();
        
        $sql = "SELECT id, name FROM users"; // Select only the id and name columns
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array in case of an error
    }
}
?>
