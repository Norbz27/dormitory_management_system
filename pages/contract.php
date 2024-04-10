<?php include_once 'header.php' ?>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contract-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .contract-details {
            margin-bottom: 20px;
        }
        .contract-details p {
            margin-bottom: 10px;
            font-size: 14px;
        }
        .contract-details strong {
            font-weight: 600;
        }
        .contract-details p:last-child {
            margin-bottom: 0;
        }
        h2 {
            color: #4B49AC;
        }
        .intro {
            margin-bottom: 30px;
            font-size: 18px;
        }
        .intro p{
            text-align: justify;
        }
        .terms-condition {
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 18px;
        }
        .terms-condition p{
            text-align: justify;
        }
    </style>
      <!-- partial -->
      <div class="main-panel">
    <div class="content-wrapper">
        <div class="container contract-container">
            <h2 class="text-center mb-4"><b>Contract</b></h2>
            <div class="intro">
                <p>This contract serves as an agreement between the landlord and the tenant. It outlines the terms and conditions that both parties must adhere to during the tenancy period. The agreement covers various aspects, including rent payments, property maintenance responsibilities, and duration of the tenancy.</p>
                <p>The terms and conditions outlined below are legally binding for both parties.</p>
            </div>

            <?php

            // Assuming $conn is your database connection
            include_once '../db/db_conn.php';
            
            if(isset($_SESSION['userid'])) {
                // Sanitize the input to prevent SQL injection (not needed with prepared statements)
                $userid = 6;
                echo '<script>console.log('.$userid.');</script>';
                
                // Query to fetch user information based on user ID
                $sql = "SELECT t.tenants_id, r.room_name, r.room_id, u.display_img, u.id, u.name, u.contact, u.gender, r.floor_belong, ut.monthly_rate, ut.description, ut.user_type_id, t.Date, t.additional_fee 
                        FROM tenants t 
                        LEFT JOIN users u ON t.user_id = u.id 
                        LEFT JOIN user_type ut ON t.user_type = ut.user_type_id 
                        LEFT JOIN room_details r ON t.room_id = r.room_id 
                        WHERE u.id = ?";
                
                // Prepare the statement
                $stmt = mysqli_prepare($conn, $sql);

                // Bind parameters
                mysqli_stmt_bind_param($stmt, "i", $userid);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if (!$result) {
                    // Query execution failed, print error message
                    echo '<div class="alert alert-danger">Failed to execute query: ' . mysqli_error($conn) . '</div>';
                } else {
                    // Check if any rows were returned
                    if (mysqli_num_rows($result) > 0) {
                        // Fetch user data
                        $userData = mysqli_fetch_assoc($result);
            ?>
                        <div class="row contract-details">
                            <div class="col-md-6">
                                <p><strong>Client Name:</strong> <?php echo $userData['name']; ?></p>
                                <p><strong>Contact Number:</strong> <?php echo $userData['contact']; ?></p>
                                <p><strong>Gender:</strong> <?php echo $userData['gender']; ?></p>
                                <p><strong>User Type:</strong> <?php echo $userData['description']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Room No.:</strong> <?php echo $userData['room_name']; ?></p>
                                <p><strong>Monthly Rate:</strong> ₱<?php echo $userData['monthly_rate']; ?></p>
                                <p><strong>Additional Fee:</strong> ₱<?php echo $userData['additional_fee']; ?></p>
                                <p><strong>Total Fee:</strong> ₱<?php echo $userData['monthly_rate'] + $userData['additional_fee']; ?></p>
                            </div>
                        </div>

            <div class="terms-condition">
                <h4 style="text-align: center; margin-bottom: 20px"><b>Terms and Conditions</b></h4>
                <p><b>PURPOSES:</b> The premises hereby leased shall be used exclusively by the LESSEE FOR Residential purposes only and shall not be diverted to other uses. It is hereby expressly agreed that if at any time the premises are used for other purposes, the LESSOR shall have the right to rescind this contract without prejudice to its other rights under the law.</p>
                <p><b>TERM:</b> This term of lease is for _________________________________ from _________________ to _______________________ inclusive.</p>
                <p><b>RENTAL RATE:</b> The monthly rental rate for the leased premises shall be Php _____________________. All rental payments shall be payable to the LESSOR (directly to the Finance Office).</p>
                <p><b>DEPOSIT:</b> The LESSEE shall deposit to the LESSOR upon signing of this contract and prior to move-in an amount equivalent to the rent for ONE (1) MONTH or the sum of Php __________________________ which shall answer for damages and any other obligations resulting from violation(s) of any of the provision of this contract.</p>
                <p><b>DEFAULT PAYMENT:</b> In case of default by the LESSEE in the payment of his/her rental, the LESSOR, at its option, may terminate this contract and eject the LESSEE. The LESSOR has the right to padlock the premises when the LESSEE is in default of payment for ONE (1) MONTH and may forfeit whatever rental deposit or advances have been given by the LESSEE.</p>
                <p><b>SUB-LEASE:</b> The LESSEE shall not directly or indirectly sublet, allow or permit the leased premises to be occupied in whole or in part by any person or entity and no right of interest thereto or therein shall be conferred on or vested in anyone by the LESSEE without the LESSOR’S written approval.</p>
                <p><b>FORCE MAJEURE:</b> If whole or any part of the leased premises shall be destroyed or damaged by fire, flood, lighting, typhoon, earthquake, storm, riot or any other unforeseen disabling acts of God, as to render the leased premises during the term substantially unfit for use and occupation of the LESSEE, then this lease contract may be terminated without compensation by the LESSOR or by the LESSEE by notice in writing to the other.</p>
                <p><b>LESSOR’S RIGHT OF ENTRY:</b> The LESSOR or its authorized agent shall after giving due notice to the LESSEE or its representative at any reasonable hour to examine the same or make repairs therein or for the operation and maintenance of the building or to exhibit the leased premises to prospective LESSEE, or to any other lawful purposes which may deem necessary.</p>
                <p><b>EXPIRATION OF LEASE:</b> At the expiration of the term of this lease or cancellation thereof, as herein provided, the LESSEE will promptly deliver to the LESSOR the leased premises with all corresponding keys and in as good and tenable condition as the same is now, ordinary wear and tear expected devoid of all occupants, movable furniture, articles and effects of any kind. Noncompliance with the terms of this clause by the LESSEE will give the LESSOR the right, at the latter’s option, to refuse to accept the delivery of the premises and compel the LESSEE to pay rent therefrom at the same rate plus Twenty-Five (25%) thereof as penalty until the LESSEE shall have complied with the terms thereof. The same penalty shall be imposed in case the LESSEE fails to leave the premises after expiration of this Contract of Lease or termination for any reason whatsoever. Failure to vacate the premises on the expiration date shall be treated as the new lease on a Daily Rate of _______/day and if exceeding a month, a monthly rate of ___________________.</p>
                <p><b>JUDICIAL RELIEF:</b> Should any one of the parties herein be compelled to seek judicial relief against the other, the losing party shall pay an amount of 100% of the amount claimed in the complaint as attorney’s fees which shall in no case be less that P50,000.00 pesos in addition to other cost and damages which the said party may be entitled to under the law.</p>
                <p><b>This CONTRACT OF LEASE shall be valid and binding between the parties, their successors-in-interest and assigns.</b></p>
            </div>
            <?php
                    } else {
                        // No rows returned
                        echo '<div class="alert alert-danger">No Contract found with user</div>';
                    }
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                // Handle case where user ID is not provided
                echo '<div class="alert alert-danger">User ID not provided</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>