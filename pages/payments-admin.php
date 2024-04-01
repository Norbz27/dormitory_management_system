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
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Payments</h3>
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
                                    <col style="width: 20px;"> 
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Client Name</th>
                                        <th>Ammount</th>
                                        <th>Date</th>
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

        // When the modal is hidden, remove its content
        $('#modal-container').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
            $(this).find('.modal-content').empty();
        });
    });
</script>
    <!-- page-body-wrapper ends -->
    <?php include_once 'footer.php' ?>

