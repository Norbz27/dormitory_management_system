<?php 
include_once 'header.php';
include_once 'payment-admin_function.php' ?>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .btn-group .dropdown-toggle::after {
            content: none;
        }

        .dropdown-item{
            width: 95%;
            margin-left: 4px;
        }
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Payments</h3>
                        </div>
                        <div class="col-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <form action="generate_report.php" method="post">
                                        <div class="row">
                                            <div class="col-6">
                                                <select class="form-control" name="month" id="month">
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary btn-sm" name="generate_report">Generate Report</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="search-box mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
          </div>
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <colgroup>
                                    <col style="width: auto;"> 
                                    <col style="width: auto;"> 
                                    <col style="width: auto;"> 
                                    <col style="width: auto;">
                                    <col style="width: auto;">
                                    <col style="width: auto;">
                                    <col style="width: 20px;"> 
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Tenant Name</th>
                                        <th>Tenant Type</th>
                                        <th>Ammount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php getAllPayments(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

    <!-- The Modal -->
    <div class="modal" id="rejectmodal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rejection Reason</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <form id="reason_form">
                    <div class="form-group">
                        <label>Rejection Reason</label>
                        <input type="text" class="form-control" name="reason" placeholder="Enter reason">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
     
      <script>
      feather.replace();
    </script>
    <script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
<div id="modal-container"></div>
<script>
    // jQuery script to handle modal display
    $(document).ready(function(){
        // Listen for click on any element with class 'view-btn'
        $('.view-btn').click(function(){
            // Get the payment ID from the clicked element's data-payment-id attribute
            var payment_id = $(this).data('payment-id');
            // Call the PHP function to display payment details passing the payment ID
            $.ajax({
                url: 'viewpaymentinfo.php', // Replace with your PHP script file
                method: 'GET',
                data: {payment_id: payment_id}, // Pass payment ID to PHP script
                success: function(response){
                    // Inject the modal content into a container div
                    $('#modal-container').html(response);
                    // Show the modal with the dynamically generated ID
                    $('#paymentModal_' + payment_id).modal('show');
                }
            });
        });
        $(document).on("click", ".delete-btn", function () {
        // Get the payment ID from the clicked button's data-payment-id attribute
        var payment_id = $(this).data('payment-id');
        // Confirm deletion
        if (confirm("Are you sure you want to delete this payment?")) {
            // Send AJAX request to delete payment
            $.ajax({
                url: 'deletepayment.php', // Replace with your PHP script file for deletion
                method: 'POST',
                data: {payment_id: payment_id}, // Pass payment ID to PHP script
                success: function(response){
                    // Reload page or update UI as needed
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        }
    });

        // When the modal is hidden, remove its content
        $('#modal-container').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
            $(this).find('.modal-content').empty();
        });

        $(document).on("click", ".accept-btn", function (e) {
            e.preventDefault();
            var id = $(this).val();
            var formData = new FormData();
            formData.append("accept_payment", true);
            formData.append("id", id);

            $.ajax({
                type: "POST",
                url: "server_function.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    console.log(res);
                } else if (res.status == 200) {
                    location.reload();
                }
                },
            });
        });

        $(document).on("click", ".reject-btn", function (e) {
            e.preventDefault();
            var id = $(this).val();

            $('#rejectmodal').modal('show');

            $(document).on("submit", "#reason_form", function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append("reject_payment", true);
                formData.append("id", id);

                $.ajax({
                type: "POST",
                url: "server_function.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    console.log(res);
                } else if (res.status == 200) {
                    location.reload();
                }
                },
                }); 
            });
        });
    });
    
</script>
    <!-- page-body-wrapper ends -->
    <?php include_once 'footer.php' ?>

