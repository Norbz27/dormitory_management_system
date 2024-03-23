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
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="container contract-container">
                <h2 class="text-center mb-4">Contract</h2>
                <div class="intro">
                    <p>This contract serves as an agreement between the landlord and the tenant. It outlines the terms and conditions that both parties must adhere to during the tenancy period. The agreement covers various aspects, including rent payments, property maintenance responsibilities, and duration of the tenancy.</p>
                    <p>The terms and conditions outlined below are legally binding for both parties.</p>
                </div>

                <div class="row contract-details">
                    <div class="col-md-6">
                        <p><strong>Client Name:</strong> John Doe</p>
                        <p><strong>Contact Number:</strong> +63934567890</p>
                        <p><strong>Gender:</strong> Male</p>
                        <p><strong>User Type:</strong> Tenant</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Room No.:</strong> 101</p>
                        <p><strong>Monthly Rate:</strong> $500</p>
                        <p><strong>Additional Fee:</strong> $50</p>
                        <p><strong>Total Fee:</strong> $550</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <!-- page-body-wrapper ends -->
  </div>
  <?php include_once 'footer.php' ?>

