<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remaining Time</title>
</head>
<body>
    <h1>Remaining Time Until Next Login Attempt</h1>
    <div id="remaining-time">
        <?php
        // Include the database connection file
        require_once 'Dbh.class.php';

        // Create a new Dbh object to connect to the database
        $dbh = new Dbh();
        $conn = $dbh->connect();
        $ip = $_SERVER['REMOTE_ADDR'];

        // Get the last login attempt time from the database
        $stmt = $conn->prepare("SELECT MAX(login_time) AS last_login FROM ip_details WHERE ip = '$ip'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && isset($row['last_login'])) {
            $last_login_time = $row['last_login'];

            // Calculate the remaining time until the next allowed login attempt
            $current_time = time();
            $login_time = $last_login_time + 60; // 60 seconds time window
            $remaining_time = $login_time - $current_time;

            echo 'Remaining Time: ' . $remaining_time . ' seconds<br>';

            // Display the remaining time
            if ($remaining_time <= 0) {
                echo "You can attempt to login now.";
            } else {
                $remaining_minutes = floor($remaining_time / 60);
                $remaining_seconds = $remaining_time % 60;
                echo "Next login attempt allowed in {$remaining_minutes} minutes and {$remaining_seconds} seconds.";
            }
        } else {
            echo "No login attempts recorded.";
        }
        ?>
    </div>
</body>
</html>
