<?php
require('fpdf186/fpdf.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dormitorydb";

// Tenant ID to use
$tenantId = isset($_POST['tenants_id']) ? $_POST['tenants_id'] : '';

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
    $pdf->Cell(0, 10, 'Personal Information:', 0, 1); // New line
    $pdf->Cell(0, 10, 'Tenant Name: ' . $row['name'], 0, 1);
    $pdf->Cell(0, 10, 'Gender: ' . $row['gender'], 0, 1);
    $pdf->Cell(0, 10, 'Contact No.: ' . $row['contact'], 0, 1);
    $pdf->Cell(0, 10, 'User Type: ' . $row['description'], 0, 1);
    $pdf->Cell(0, 10, 'Start Date: ' . $row['Date'], 0, 1);
    $pdf->Cell(0, 10, 'Equipments: ' . $row['equipments'], 0, 1);
    $pdf->Cell(0, 10, 'Room Information', 0, 1); // New line
    $pdf->Cell(0, 10, 'Room Name: ' . $row['room_name'], 0, 1);
    $pdf->Cell(0, 10, 'Monthly Rate: ' . $row['monthly_rate'], 0, 1);
    $total_fee = $row['monthly_rate'] + $row['additional_fee'];
    $pdf->Cell(0, 10, 'Total Fee: ' . $total_fee, 0, 1);
    $pdf->Cell(0, 10, 'Floor Belong: ' . $row['floor_belong'], 0, 1);
    $pdf->Cell(0, 10, 'Additional Fee: ' . $row['additional_fee'], 0, 1);
} else {
    $pdf->Cell(0, 10, 'No data found', 0, 1);
}

// Output PDF
$pdf->Output();

// Close connection
$conn->close();
?>
