<?php
    include_once '../db/db_conn.php';

    function getAllAccounts() {
        global $conn;
        $sql = "SELECT id, name, contact, gender FROM MyGuests";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr><td>' . $row["name"]. '</td>
                        <td>' . $row["gender"]. '</td>
                        <td>' . $row["contact"]. '</td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td></td>
                    </tr>';
            }
        } else {
        echo "0 results";
        }
    }
?>