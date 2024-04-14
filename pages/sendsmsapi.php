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

// Query to fetch user_id, name, contact, Date, additional_fee, monthly_rate, and user_type_id
$sql = "SELECT t.user_id, u.name, u.contact, t.Date, t.additional_fee, ut.monthly_rate, ut.user_type_id
        FROM tenants t
        INNER JOIN users u ON t.user_id = u.id
        INNER JOIN user_type ut ON t.user_type = ut.user_type_id";

$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    // SMS parameters
    $send_data = [];
    $send_data['sender_id'] = "PhilSMS";
    $token = "67|njtjcDHrgeWHk1iHxomWrMaw30FpX4iyyRjxt0WT";

    // Loop through each tenant
    while ($row = $result->fetch_assoc()) {
        $recipient = $row['contact'];
        $name = $row['name'];
        $date = $row['Date'];
        $additional_fee = $row['additional_fee'];
        $monthly_rate = $row['monthly_rate'];
        $user_type_id = $row['user_type_id'];
        
        // Calculate total cost
        $total_cost = $additional_fee + $monthly_rate;
        
        // Compose message
        $message = "Dear $name, Starting Date $date. Welcome to our dormitory! Your total Monthly rate + other expenses is  $total_cost.";
        $send_data['recipient'] = $recipient;
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

        if ($get_sms_status === false) {
            die("Error sending SMS: " . curl_error($ch));
        }

        curl_close($ch);
    }
    echo "SMS sent successfully.";
} else {
    echo "No tenants found.";
}

$conn->close();
?>
