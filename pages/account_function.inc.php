<?php
    include_once '../db/db_conn.php';

    function getAllAccounts() {
        global $conn;
        $sql = "SELECT id, name, contact, gender FROM users WHERE status != 'admin'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr><td>' . $row["name"]. '</td>
                        <td>' . $row["gender"]. '</td>
                        <td>' . $row["contact"]. '</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td><div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div></td>
                        
                    </tr>';
            }
        } else {
            echo "0 results";
        }
    }

    function addAccount($name, $gender, $contact, $username, $password) {
        global $conn;
    
        // Perform data sanitization and validation as needed
    
        // Hash the password for security (use appropriate password hashing method)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare the SQL statement
        $sql = "INSERT INTO user (name, gender, contact, username, password) VALUES (?, ?, ?, ?, ?)";
        
        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($conn, $sql);
    
        if ($stmt) {
            // Bind parameters to the statement
            mysqli_stmt_bind_param($stmt, "sssss", $name, $gender, $contact, $username, $hashedPassword);
    
            // Execute the statement
            $success = mysqli_stmt_execute($stmt);
    
            // Check if the insertion was successful
            if ($success) {
                echo "Account added successfully!";
            } else {
                echo "Error adding account: " . mysqli_error($conn);
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }
?>
