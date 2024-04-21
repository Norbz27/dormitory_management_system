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
$sql = "SELECT t.tenants_id, r.room_no, r.room_id, t.equipments, t.user_id, u.display_img, u.id, u.name, u.contact, u.gender, r.floor, t.monthlyrate, ut.description, ut.tenant_type_id, t.Date, t.additional_fee FROM tenants t LEFT JOIN users u ON t.user_id = u.id LEFT JOIN tenant_type ut ON t.tenant_type = ut.tenant_type_id LEFT JOIN room_details r ON t.room_id = r.room_id WHERE t.tenants_id = '$tenantId';";
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
    $pdf->Cell(0, 10, 'Personal Information', 0, 1, 'L'); // New line with centered alignment
    $pdf->SetFont('Arial', '', 12); // Set font back to regular
    
    // First row
    $pdf->Cell(95, 10, 'Tenant Name: ' . $row['name'], 0, 0);
    $pdf->Cell(95, 10, 'User Type: ' . $row['description'], 0, 1);
    
    // Second row
    $pdf->Cell(95, 10, 'Gender: ' . $row['gender'], 0, 0);
    $pdf->Cell(95, 10, 'Start Date: ' . $row['Date'], 0, 1);
    
    // Third row
    $pdf->Cell(95, 10, 'Contact No.: ' . $row['contact'], 0, 0);
    $pdf->Cell(95, 10, 'Equipments: ' . $row['equipments'], 0, 1);

    $pdf->Cell(0, 10, '', 0, 1);
    
    $pdf->SetFont('Arial', 'B', 12); // Set font to bold
    $pdf->Cell(0, 10, 'Room Information', 0, 1, 'L'); // New line with centered alignment
    $pdf->SetFont('Arial', '', 12); // Set font back to regular
    
    
    // Room Information
    $pdf->Cell(95, 10, 'Room Name: ' . $row['room_no'], 0, 0);
    $pdf->Cell(95, 10, 'Floor Belong: ' . $row['floor'], 0, 1);

    // Second row
    $pdf->Cell(95, 10, 'Monthly Rate: ' . $row['monthlyrate'], 0, 0);
    $pdf->Cell(95, 10, 'Start Date: ' . $row['Date'], 0, 1);

    // Third row
    $total_fee = $row['monthlyrate'] + $row['additional_fee'];
    $pdf->Cell(95, 10, 'Total Fee: ' . $total_fee, 0, 0);
    $pdf->Cell(95, 10, 'Additional Fee: ' . $row['additional_fee'], 0, 1);

    
    $pdf->Cell(0, 10, '', 0, 1);

    // Payment Information
    $pdf->SetFont('Arial', 'B', 12); // Set font to bold
    $pdf->Cell(0, 10, 'Transaction History', 0, 1, 'L'); // New line with left alignment
    $pdf->SetFont('Arial', 'B', 12); // Set font to bold for column headers

    // Column headers
    $pdf->Cell(47.5, 10, 'Payment ID', 1, 0);
    $pdf->Cell(47.5, 10, 'Amount', 1, 0);
    $pdf->Cell(47.5, 10, 'Date of', 1, 0);
    $pdf->Cell(47.5, 10, 'Date Issued', 1, 1);

    // Reset font back to regular for payment details
    $pdf->SetFont('Arial', '', 12);

    // Fetch payment information from the payments table
    $paymentSql = "SELECT * FROM payments WHERE user_id = '" . $row['user_id'] . "' AND status = 'Verified'";
    $paymentResult = $conn->query($paymentSql);

    // Check if payment information is available
    if ($paymentResult->num_rows > 0) {
        // Loop through each payment record
        while ($paymentRow = $paymentResult->fetch_assoc()) {
            // Display payment details
            $pdf->Cell(47.5, 10, $paymentRow['payment_id'], 1, 0);
            $pdf->Cell(47.5, 10, $paymentRow['amount'], 1, 0);
            $pdf->Cell(47.5, 10, $paymentRow['month_of'], 1, 0);
            $pdf->Cell(47.5, 10, $paymentRow['date'], 1, 1);
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
