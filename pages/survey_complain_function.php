<?php
    include_once '../db/db_conn.php';

    function getAllSeurveys() {
        global $conn;
        $sql = "SELECT survey.id as survey_id, users.id as users_id, users.name,survey.date FROM survey INNER JOIN users ON survey.tenants_id = users.id;";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }
    
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr data-payment-id="' . $row["survey_id"] . '">
                        <td>' . $row["name"] . '</td>
                        <td>' . $row["date"] . '</td>
                        <td> <button class="dropdown-item" id="view-survey" style="cursor:pointer" value="' . $row["survey_id"] . '">View Details</button></td>
                      </tr>';
            }
        } else {
            echo "0 results";
        }
        
    }

    function getAllComplains() {
        global $conn;
        $sql = "SELECT complain.id as complain_id, users.id as users_id, users.name,complain.date FROM complain INNER JOIN users ON complain.tenants_id = users.id;";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }
    
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr data-payment-id="' . $row["complain_id"] . '">
                        <td>' . $row["name"] . '</td>
                        <td>' . $row["date"] . '</td>
                        <td> <button class="dropdown-item" id="view-complain" style="cursor:pointer" value="' . $row["complain_id"] . '">View Details</button></td>
                      </tr>';
            }
        } else {
            echo "0 results";
        }
        
    }
?>
