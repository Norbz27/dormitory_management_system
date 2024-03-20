<?php include_once 'header.php' ?>
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
           <!-- Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Payment ID:</strong> 123456</p>
                            <p><strong>Room No:</strong> 101</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Name:</strong> John Doe</p>
                            <p><strong>User type:</strong> Student</p>
                        </div>
                    </div>
                    
                    <div class="row mt-4 mb-5">
                        <div class="col-md-6">
                            <p><strong>Monthly Rate:</strong> ₱500</p>
                            <p><strong>Additional fee:</strong> ₱50</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Month of:</strong> Febuary 2024</p>
                            <p><strong>Total Amount:</strong> ₱1000</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="display: flex; justify-content: space-between;">
                                <span style="text-align: left; font-size: 18px">March 20, 2024</span>
                                <span style="text-align: right; font-size: 18px"><strong>Paid Amount:</strong> ₱550</span>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">View Receipt</button>
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
                                   <tr>
                                        <td>00000000</td>
                                        <td>Norberto Bruzon</td>
                                        <td>₱850.00</td>
                                        <td>04-20-2023</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn dropdown-toggle" style="content: none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view-btn" href="" data-toggle="modal" data-target="#paymentModal">View Details</a>
                                                </div>
                                            </div>
                                        </td>
                                   </tr>
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
    <!-- page-body-wrapper ends -->
    <?php include_once 'footer.php' ?>

