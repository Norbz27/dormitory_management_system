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

function getAvailableRooms() {
    try {
        // Create an instance of the Dbh class
        $dbh = new Dbh();
        // Call the connect method to establish a database connection
        $pdo = $dbh->connect();
        
        $sql = "SELECT room_id, room_name FROM room_details WHERE status = 'available'"; // Adjusted SQL query to filter by status
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array in case of an error
    }
}

function getUserTypes() {
    try {
        // Create an instance of the Dbh class
        $dbh = new Dbh();
        // Call the connect method to establish a database connection
        $pdo = $dbh->connect();
        
        $sql = "SELECT user_type_id, description FROM user_type"; // Adjusted SQL query for user types
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array in case of an error
    }
}

function saveTenant($userId, $userTypeId, $roomId, $date, $role) {
    try {
        // Create an instance of the Dbh class
        $dbh = new Dbh();
        // Call the connect method to establish a database connection
        $pdo = $dbh->connect();
        
        // Prepare SQL statement
        $sql = "INSERT INTO tenants (user_id, user_type_id, room_id, date, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(1, $userId, PDO::PARAM_INT);
        $stmt->bindParam(2, $userTypeId, PDO::PARAM_INT);
        $stmt->bindParam(3, $roomId, PDO::PARAM_INT);
        $stmt->bindParam(4, $date, PDO::PARAM_STR);
        $stmt->bindParam(5, $role, PDO::PARAM_STR);
        
        // Execute the statement
        $stmt->execute();
        
        // Return true if the insertion was successful
        return true;
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
        return false; // Return false if the insertion failed
    }
}

?>
