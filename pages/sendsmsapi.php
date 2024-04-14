<?php
// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dormitorydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch tenants and their corresponding users from the database
$sql = "SELECT t.*, u.name, u.contact FROM tenants t
        INNER JOIN users u ON t.user_id = u.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // SMS parameters
    $send_data = [];
    $send_data['sender_id'] = "PhilSMS";
    $token = "67|njtjcDHrgeWHk1iHxomWrMaw30FpX4iyyRjxt0WT ";

    // Loop through each tenant
    while ($row = $result->fetch_assoc()) {
        $recipient = $row['contact']; // Assuming 'contact' is the column name in the users table
        $name = $row['name'];
        $date = $row['Date'];
        $message = "Dear $name, your move-in date is on $date. Welcome to our dormitory!";
        $send_data['message'] = $message;
        
        // Send SMS
        $parameters = json_encode($send_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://app.philsms.com/api/v3/sms/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $get_sms_status = curl_exec($ch);
        curl_close($ch);
        
        // Log SMS status or handle errors if needed
        // Example: echo $get_sms_status;
    }
    echo "SMS sent successfully.";
} else {
    echo "No tenants found.";
}

$conn->close();
?>
