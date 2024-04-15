<?php
require('fpdf186/fpdf.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dormitorydb";

// Tenant ID to use
$tenantId = isset($_GET['tenants_id']) ? $_GET['tenants_id'] : '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data for the specified tenant ID
$sql = "SELECT t.tenants_id, r.room_name, r.room_id, t.equipments, t.user_id, u.display_img, u.id, u.name, u.contact, u.gender, r.floor_belong, ut.monthly_rate, ut.description, ut.user_type_id, t.Date, t.additional_fee FROM tenants t LEFT JOIN users u ON t.user_id = u.id LEFT JOIN user_type ut ON t.user_type = ut.user_type_id LEFT JOIN room_details r ON t.room_id = r.room_id WHERE t.tenants_id = '$tenantId';";
$result = $conn->query($sql);

// Initialize PDF
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Output fetched data in PDF
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $pdf->SetFont('Arial', 'B', 12); // Set font to bold
    $pdf->Cell(0, 10, 'Personal Information:', 0, 1, 'C'); // New line with centered alignment
    $pdf->SetFont('Arial', '', 12); // Set font back to regular
    
    // First row
    $pdf->Cell(95, 10, 'Tenant Name: ' . $row['name'], 1);
    $pdf->Cell(95, 10, 'User Type: ' . $row['description'], 1, 1);
    
    // Second row
    $pdf->Cell(95, 10, 'Gender: ' . $row['gender'], 1);
    $pdf->Cell(95, 10, 'Start Date: ' . $row['Date'], 1, 1);
    
    // Third row
    $pdf->Cell(95, 10, 'Contact No.: ' . $row['contact'], 1);
    $pdf->Cell(95, 10, 'Equipments: ' . $row['equipments'], 1, 1);
    
    $pdf->SetFont('Arial', 'B', 12); // Set font to bold
    $pdf->Cell(0, 10, 'Room Information', 0, 1, 'C'); // New line with centered alignment
    $pdf->SetFont('Arial', '', 12); // Set font back to regular
    
    // Room Information
    $pdf->Cell(95, 10, 'Room Name: ' . $row['room_name'], 1);
    $pdf->Cell(95, 10, 'Floor Belong: ' . $row['floor_belong'], 1, 1);
    
    // Second row
    $pdf->Cell(95, 10, 'Monthly Rate: ' . $row['monthly_rate'], 1);
    $pdf->Cell(95, 10, 'Start Date: ' . $row['Date'], 1, 1);
    
    // Third row
    $total_fee = $row['monthly_rate'] + $row['additional_fee'];
    $pdf->Cell(95, 10, 'Total Fee: ' . $total_fee, 1);
    $pdf->Cell(95, 10, 'Additional Fee: ' . $row['additional_fee'], 1, 1);
    
    // Payment Information
    $pdf->SetFont('Arial', 'B', 12); // Set font to bold
    $pdf->Cell(0, 10, 'Payment Information', 0, 1, 'C'); // New line with centered alignment
    $pdf->SetFont('Arial', '', 12); // Set font back to regular

    // Fetch payment information from the payments table
    $paymentSql = "SELECT * FROM payments WHERE user_id = '" . $row['user_id'] . "'";
    $paymentResult = $conn->query($paymentSql);

    // Check if payment information is available
    if ($paymentResult->num_rows > 0) {
        // Loop through each payment record
        while ($paymentRow = $paymentResult->fetch_assoc()) {
            // Display payment details
            $pdf->Cell(95, 10, 'Payment ID: ' . $paymentRow['payment_id'], 1);
            $pdf->Cell(95, 10, 'Amount: ' . $paymentRow['amount'], 1, 1);
            $pdf->Cell(95, 10, 'Month: ' . $paymentRow['month_of'], 1);
            $pdf->Cell(95, 10, 'Date: ' . $paymentRow['date'], 1, 1);
        }
    } else {
        // If no payment records found, display a message
        $pdf->Cell(0, 10, 'No payment information available', 1, 1);
    }

} else {
    $pdf->Cell(0, 10, 'No data found', 0, 1);
}

// Output PDF
$pdf->Output();

// Close connection
$conn->close();
?>
