<?php
    include_once '../db/db_conn.php';

    function getAllPayments() {
        global $conn;
        $sql = "SELECT p.payment_id, u.name, p.amount, p.date, p.status, p.reason, user_t.description FROM payments p LEFT JOIN users u ON p.user_id = u.id LEFT JOIN tenants ten ON u.id = ten.user_id LEFT JOIN tenant_type user_t ON ten.tenant_type = user_t.tenant_type_id;";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }
        
    
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $badge_color = ($row["status"] == 'Verified') ? 'badge-success' : (($row["status"] == 'Pending') ? 'badge-warning' : 'badge-danger');
                $formattedAmount = number_format($row['amount'], 2);

                echo '<tr data-payment-id="' . $row["payment_id"] . '">
                <td>' . $row["name"] . '</td>
                <td>' . $row["description"] . '</td>
                <td>₱' . $formattedAmount . '</td>
                <td>' . $row["date"] . '</td>
                <td><span class="badge ' . $badge_color . '">' . $row["status"] . '</span></td>
                <td>' . $row["reason"] . '</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item view-btn" style="cursor:pointer" data-payment-id="' . $row["payment_id"] . '">View Details</a>';
                            // Only show verify and reject buttons if the status is pending
                            if ($row["status"] == 'Pending') {
                                echo '<button class="dropdown-item accept-btn" style="cursor:pointer" value="' . $row["payment_id"] . '">Verify</button>
                                    <button class="dropdown-item reject-btn" style="cursor:pointer" value="' . $row["payment_id"] . '">Reject</button>';
                            }
                        echo '<a class="dropdown-item delete-btn" style="cursor:pointer" data-payment-id="' . $row["payment_id"] . '">Delete</a></div>
                    </div>
                </td>
            </tr>';
                        }            
        } else {
            echo "0 results";
        }
        
    }
    

    // Function to display payment details in the modal
    function displayPaymentDetails($payment_id) {
        global $conn;
        $sql = "SELECT p.payment_id, r.room_no, u.name, ut.description, t.monthlyrate, t.additional_fee, p.month_of, p.amount, p.date, p.receipt_img FROM payments p LEFT JOIN users u ON p.user_id = u.id LEFT JOIN tenants t ON u.id = t.user_id LEFT JOIN tenant_type ut ON t.tenant_type = ut.tenant_type_id LEFT JOIN room_details r ON t.room_id = r.room_id WHERE p.payment_id = $payment_id;";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            // Handle the query error
            die("Query failed: " . mysqli_error($conn));
        }
    
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Calculate the total fee
            $total_fee = $row["monthlyrate"] + $row["additional_fee"];
            // Format month_of as "Month Year"
            // Concatenate the formatted dates with a hyphen in between
            $formatted_date_range = $row["month_of"];

            // Format date as "Month Day, Year"
            $date_formatted = date('F j, Y', strtotime($row["date"]));

            $monthlyRate = $row['monthlyrate'];
            $additionalFee = $row['additional_fee'];
            $mount = $row['amount'];

            $formattedMonthlyRate = number_format($monthlyRate, 2);
            $formattedAdditionalFee = number_format($additionalFee, 2);
            $formattedAmount = number_format($mount, 2);
            // Generate unique modal IDs
            $modal_id = 'paymentModal_' . $payment_id;
            // Display modal content dynamically
            echo '<div class="modal fade" id="' . $modal_id . '" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <p><strong>Name:</strong> ' . $row["name"] . '</p>
                                </div>
                                <div class="col-md-7">
                                    <p><strong>Tenant type:</strong> ' . $row["description"] . '</p>
                                </div>
                            </div>
                            
                            <div class="row mt-4 mb-5">
                                <div class="col-md-5">
                                    <p><strong>Monthly Rate:</strong> ₱' . $formattedMonthlyRate . '</p>
                                    <p><strong>Additional fee:</strong> ₱' . $formattedAdditionalFee . '</p>
                                </div>
                                <div class="col-md-7">
                                    <p><strong>Month of:</strong> ' . $formatted_date_range . '</p>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="display: flex; justify-content: space-between;">
                                        <span style="text-align: left; font-size: 18px">' . $date_formatted . '</span>
                                        <span style="text-align: right; font-size: 18px"><strong>Paid Amount:</strong> ₱' . $formattedAmount . '</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <img src="assets/' . $row["receipt_img"] . '" style="border-radius: 10px;" width="100%" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>';
        } else {
            echo "Payment details not found";
        }
    }
    
?>
