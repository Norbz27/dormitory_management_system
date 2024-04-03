<?php 
include_once '../db/db_conn.php';
    if(isset($_GET['payment_id'])) {
        // Sanitize the input
        $payment_id = mysqli_real_escape_string($conn, $_GET['payment_id']);
        include_once 'payment-admin_function.php';
        // Call the displayPaymentDetails function to generate modal content
        displayPaymentDetails($payment_id);
    } else {
        // If payment_id is not set, return an error message
        echo "Payment ID is not set.";
    }
    
    // Add JavaScript to remove previous modal content when closing the modal
    echo '<script>
            $(document).ready(function(){
                // When the modal is hidden, remove its content
                $("#paymentModal").on("hidden.bs.modal", function () {
                    $(this).removeData("bs.modal");
                    $(this).find(".modal-content").empty();
                });
            });
        </script>';
?>