<?php
    include_once '../db/db_conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include your database connection code here
        // Replace 'your_db_connection_file.php' with the actual file name
        include_once 'your_db_connection_file.php';
    
        // Retrieve form data
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $gender = $_POST['gender'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];
    
        // Call the addNewAccount function with the database connection and form data
        addNewAccount($conn, $name, $contact, $gender, $uid, $pwd);
    } else {
        // Redirect to the signup page if the form is not submitted
        header("Location: ../pages/accounts.php");
        exit();
    }

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

    function addNewAccount($conn, $name, $contact, $gender, $uid, $pwd){
        $sql = "INSERT INTO users (name, contact, gender, uid, pwd, status) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/accounts.php");
            exit();
        }

        $status = "New";
        $hasshedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssssss", $name, $contact, $gender, $uid, $hasshedPwd, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../pages/accounts.php");
        exit();
    }
?>
