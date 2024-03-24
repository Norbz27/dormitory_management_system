<?php
include_once '../pages/auth/dbh.class.php';

function getUsers() {
    try {
        
        $dbh = new Dbh();
       
        $pdo = $dbh->connect();
        
        $sql = "SELECT id, name FROM users"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
        return []; 
    }
}

function getAvailableRooms() {
    try {
    
        $dbh = new Dbh();
        $pdo = $dbh->connect();
        
        $sql = "SELECT room_id, room_name FROM room_details WHERE status = 'available'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; 
    }
}

function getUserTypes() {
    try {
        $dbh = new Dbh();
        $pdo = $dbh->connect();

        $sql = "SELECT user_type_id, description FROM user_type";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return []; 
    }
}

function saveTenant($userId, $userTypeId, $roomId, $date, $role) {
    try {
        $dbh = new Dbh();
        $pdo = $dbh->connect();
        
        
        $sql = "INSERT INTO tenants (user_id, user_type_id, room_id, date, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        
        $stmt->bindParam(1, $userId, PDO::PARAM_INT);
        $stmt->bindParam(2, $userTypeId, PDO::PARAM_INT);
        $stmt->bindParam(3, $roomId, PDO::PARAM_INT);
        $stmt->bindParam(4, $date, PDO::PARAM_STR);
        $stmt->bindParam(5, $role, PDO::PARAM_STR);
        
        // Execute the statement
        $stmt->execute();
        
        
        return true;
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return false; 
    }
}

?>
