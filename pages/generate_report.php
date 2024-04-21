<?php
require('fpdf186/fpdf.php');

// Function to generate PDF report
function generatePDF($conn, $month) {
    // Query to fetch users who paid and who did not pay in the specified month
    $sql = "SELECT u.name, u.contact, u.gender, p.amount, DATE_FORMAT(p.date, '%M %d, %Y') AS formatted_date
            FROM payments p 
            JOIN users u ON p.user_id = u.id 
            WHERE STR_TO_DATE(CONCAT(SUBSTRING_INDEX(p.month_of, ' - ', 1)), '%M %d, %Y') <= '$month' 
            AND STR_TO_DATE(CONCAT(SUBSTRING_INDEX(p.month_of, ' - ', -1)), '%M %d, %Y') >= '$month'
            AND p.status = 'Verified'";

    $result = mysqli_query($conn, $sql);

    // Initialize PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Add title
    $pdf->Cell(0, 10, 'Tenants who are paid for ' . date('F Y', strtotime($month)), 0, 1, 'C'); 

    $headerWidths = array(50, 30, 20, 30, 40); 
    $header = array('Name', 'Contact', 'Gender', 'Amount', 'Date'); 
    $numColumns = count($header);

    $totalWidth = array_sum($headerWidths);

    $startX = ($pdf->GetPageWidth() - $totalWidth) / 2;

    $pdf->SetX($startX);

    $pdf->SetFont('Arial', 'B', 12); 

    for ($i = 0; $i < $numColumns; $i++) {
        if ($i === 0) {
            $alignment = 'L'; 
        } else {
            $alignment = 'C'; 
        }
        $pdf->Cell($headerWidths[$i], 10, $header[$i], 1, 0, $alignment);
    }

    $pdf->SetFont('Arial', '', 12); 

    $pdf->Ln(); 

    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->SetX($startX);
        $pdf->Cell($headerWidths[0], 10, $row['name'], 1, 0, 'L');
        $pdf->Cell($headerWidths[1], 10, $row['contact'], 1, 0, 'C');
        $pdf->Cell($headerWidths[2], 10, $row['gender'], 1, 0, 'C');
        $pdf->Cell($headerWidths[3], 10, $row['amount'], 1, 0, 'C');
        $pdf->Cell($headerWidths[4], 10, $row['formatted_date'], 1, 1, 'C');
    }

    $pdf->Cell(0, 10, '', 0, 1);

    $sql = "SELECT u.name, u.contact, u.gender
            FROM users u
            LEFT JOIN payments p ON u.id = p.user_id 
            AND STR_TO_DATE(CONCAT(SUBSTRING_INDEX(p.month_of, ' - ', 1)), '%M %d, %Y') <= '$month'
            AND STR_TO_DATE(CONCAT(SUBSTRING_INDEX(p.month_of, ' - ', -1)), '%M %d, %Y') >= '$month'
            WHERE 
            p.payment_id IS NULL OR p.status != 'Verified';";

    $result = mysqli_query($conn, $sql);

    $pdf->SetFont('Arial', 'B', 12);

    // Add title
    $pdf->Cell(0, 10, 'Tenants who are not paid for ' . date('F Y', strtotime($month)), 0, 1, 'C'); 

  
    $headerWidths = array(73.5, 53.5, 43.5); 

    $header = array('Name', 'Contact', 'Gender'); 
    $numColumns = count($header);

    $totalWidth = array_sum($headerWidths);

    $startX = ($pdf->GetPageWidth() - $totalWidth) / 2;

    $pdf->SetX($startX);

    $pdf->SetFont('Arial', 'B', 12); 

    for ($i = 0; $i < $numColumns; $i++) {
        if ($i === 0) {
            $alignment = 'L'; 
        } else {
            $alignment = 'C'; 
        }
        $pdf->Cell($headerWidths[$i], 10, $header[$i], 1, 0, $alignment);
    }


    $pdf->SetFont('Arial', '', 12); 

    $pdf->Ln(); 

    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->SetX($startX);
        $pdf->Cell($headerWidths[0], 10, $row['name'], 1, 0, 'L');
        $pdf->Cell($headerWidths[1], 10, $row['contact'], 1, 0, 'C');
        $pdf->Cell($headerWidths[2], 10, $row['gender'], 1, 1, 'C');
    }



    $pdf->Output();


}

$conn = mysqli_connect('localhost', 'root', '', 'dormitorydb');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['generate_report'])) {
    $month = $_POST['month'];

    $month = mysqli_real_escape_string($conn, $month);

    $yearMonthDay = date('Y-m-d', strtotime("21 $month"));

    generatePDF($conn, $yearMonthDay);
}
?>
